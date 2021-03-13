<?php

namespace App\Http\Controllers;

use App\Components\MenuRecursive;
use App\Components\Recursive;
use App\Models\Menu;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;

class MenuController extends Controller
{
    private $menuRecursive;
    use DeleteModelTrait;
    public function __construct(MenuRecursive $menuRecursive,Menu $menu)
    {
        $this->menuRecursive = $menuRecursive;
        $this->menu = $menu;
    }

    public function index()
    {
        $menus = $this->menu->paginate(5);
        return view('admin.menu.index',compact('menus'));
    }
    public function create()
    {
        try {
            $optionSelect = $this->menuRecursive->menuRecursive();
            return view('admin.menu.add', compact('optionSelect'));
        } catch (\Exception $e) {
            abort(500);
        }
    }
    public function store(Request $request)
    {
        try {
            $this->menu->create([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'slug' => Str::slug($request->name, '-')
            ]);
            return redirect()->route('menus.index')->with('success','done');
        } catch (\Exception $e) {
            abort(500);
        }
    }
    public function edit($id)
    {
        $menuEdit = $this->menu->find($id);
        $optionSelect = $this->menuRecursive->menuRecursiveEdit($this->menu->find($id)->parent_id);
        return view('admin.menu.edit',compact('menuEdit','optionSelect'));
    }
    public function update($id, Request $request)
    {
        try
        {
            $this->menu->find($id)->update([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'slug' => Str::slug($request->name, '-')
            ]);
            return redirect()->route('menus.index');
        }
        catch (\Exception $ex)
        {
            abort(500);
        }
    }
    public function delete($id)
    {
        return $this->deleteModelTrait($id,$this->menu);
    }
}
