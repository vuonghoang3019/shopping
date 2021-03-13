<?php

namespace App\Http\Controllers;

use App\Components\Recursive;
use App\Http\Requests\ProductAddRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class AdminProductController extends Controller
{
    use StorageImageTrait;
    use DeleteModelTrait;

    private $category;
    private $product;
    private $productImage;
    private $tag;

    public function __construct(Category $category, Product $product, ProductImage $productImage, Tag $tag)
    {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->tag = $tag;
    }

    public function index(Request $request)
    {
        $products = $this->product->latest()->paginate(5);
        $htmlOption = $this->getCategory($parentID = '');
        if ($request->search) $products = $this->product->newQuery()->
        where('name', 'like', '%' . $request->search . '%')->paginate(5);
        if ($request->category_id) $products = $this->product->newQuery()->
        where('category_id', $request->category_id)->paginate(5);
        return view('admin.product.index', compact('products', 'htmlOption'));
    }

    public function getCategory($parent_id)
    {
        $data = $this->category->all();
        $recursive = new Recursive($data);
        $htmlOption = $recursive->categoryRecursive($parent_id);
        return $htmlOption;
    }

    public function create()
    {
        $htmlOption = $this->getCategory($parentID = '');
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
        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . 'Line' . $exception->getLine());
        }
    }

    public function edit($id)
    {
        $product = $this->product->find($id);
        $htmlOption = $this->getCategory($product->category_id);
        return view('admin.product.edit', compact('htmlOption', 'product'));
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
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message' . $exception->getMessage() . 'Line' . $exception->getLine());
        }
    }

    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->product);
    }
}
