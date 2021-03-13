<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Components\Recursive;
use Illuminate\Support\Str;
use App\Traits\DeleteModelTrait;
class CategoryController extends Controller
{
    use DeleteModelTrait;
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories =  $this->category->latest()->paginate(6);
        return view('admin.category.index',compact('categories'));
    }
    public function create()
    {
        $htmlOption = $this->getCategory($parentID = '');
        return view('admin.category.add',compact('htmlOption'));
    }
    public function store(Request $request)
    {
        try {
            $this->category->create([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'slug' => Str::slug($request->name)
            ]);
            return redirect()->route('categories.index');
        } catch (\Exception $ex) {
            abort(500);
        }

    }
    public function getCategory($parent_id)
    {
        $data = $this->category->all();
        $recursive = new Recursive($data);
        $htmlOption =  $recursive->categoryRecursive($parent_id);
        return $htmlOption;
    }
    public function edit($id)
    {
        $category = $this->category->find($id);
        $htmlOption = $this->getCategory($category->parent_id);
        return view('admin.category.edit',compact('category','htmlOption'));
    }
    public function update($id, Request $request)
    {
        try {
            $this->category->find($id)->update([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'slug' => Str::slug($request->name,'-')
            ]);
            return redirect()->route('categories.index');
        }catch (\Exception $ex)
        {
            abort(500);
        }
    }
    public function delete($id)
    {
//        try {
//            $this->category->find($id)->delete();
//            return redirect()->route('categories.index');
//        } catch (\Exception $e) {
//            abort(500);
//        }
        return $this->deleteModelTrait($id,$this->category);
    }
}
