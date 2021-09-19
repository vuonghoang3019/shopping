<?php

namespace App\Http\Controllers;

use App\Components\Recursive;
use App\Http\Requests\ProductAddRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class AdminProductController extends Controller {
    use StorageImageTrait;
    use DeleteModelTrait;

    protected $productRepo;
    private $category;
    private $product;
    private $productImage;
    private $tag;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function index(Request $request)
    {
        $htmlOption = $this->productRepo->getCategory($parentID = '');
//        if ($request->search)
//        {
//            $products = $this->product->newQuery()->where('name', 'like', '%' . $request->search . '%')->paginate(5);
//        }
//        if ($request->category_id)
//        {
//            $products = $this->product->newQuery()->where('category_id', $request->category_id)->paginate(5);
//        }
        $products = $this->productRepo->getProduct();
        return view('admin.product.index', compact('products','htmlOption'));
    }

    public function create()
    {
        $htmlOption = $this->productRepo->getCategory($parentID = '');
        return view('admin.product.add', compact('htmlOption'));
    }

    public function store(Request $request)
    {
        try {
            $dataCreate = [
                'name'        => $request->name,
                'price'       => $request->price,
                'sale'        => $request->sale,
                'category_id' => $request->category_id,
                'content'     => $request->contents,
                'number'      => $request->quantity,
                'user_id'     => auth()->id()
            ];
            $dataUpload = $this->storageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUpload)) {
                $dataCreate['feature_image_name'] = $dataUpload['file_name'];
                $dataCreate['feature_image_path'] = $dataUpload['file_path'];
            }

            $product = $this->product->create($dataCreate);
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem) {
                    $dataProductDetail = $this->storageTraitUploadMultiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductDetail['file_path'],
                        'image_name' => $dataProductDetail['file_name']
                    ]);
                }
            }
            $tagId = [];
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tasInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagId[] = $tasInstance->id;
                }
            }
            $product->tags()->attach($tagId);
            return redirect()->route('products.index');
        }
        catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . 'Line' . $exception->getLine());
        }
    }

    public function edit($id)
    {
        try {
            $product = $this->product->find($id);
            $htmlOption = $this->getCategory($product->category_id);
            return view('admin.product.edit', compact('htmlOption', 'product'));
        }
        catch (\Exception $exception) {
            abort(500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataUpdate = [
                'name'        => $request->name,
                'price'       => $request->price,
                'sale'        => $request->sale,
                'category_id' => $request->category_id,
                'content'     => $request->contents,
                'quantity'    => $request->quantity,
                'user_id'     => auth()->id()
            ];
            $dataUpload = $this->storageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUpload)) {
                $dataUpdate['feature_image_name'] = $dataUpload['file_name'];
                $dataUpdate['feature_image_path'] = $dataUpload['file_path'];
            }
            $this->product->find($id)->update($dataUpdate);
            $product = $this->product->find($id);
            if ($request->hasFile('image')) {
                $this->productImage->where('product_id', $id)->delete();
                foreach ($request->image as $fileItem) {
                    $dataProductDetail = $this->storageTraitUploadMultiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductDetail['file_path'],
                        'image_name' => $dataProductDetail['file_name']
                    ]);
                }
            }
            //insert tags
            $tagId = [];
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tasInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagId[] = $tasInstance->id;
                }

            }
            $product->tags()->sync($tagId);
            DB::commit();
            return redirect()->route('products.index');
        }
        catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message' . $exception->getMessage() . 'Line' . $exception->getLine());
        }
    }

    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->product);
    }

    public function action($id)
    {
        $product = $this->product->find($id);
        $product->update([
            'status' => $product->status == 1 ? 0 : 1
        ]);
        return redirect()->route('products.index');
    }
}
