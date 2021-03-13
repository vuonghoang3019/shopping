<?php

namespace App\Http\Controllers;
use App\Models\Module;
use App\Models\ModuleDetail;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminModuleDetailController extends Controller
{
    private $moduleDetail;
    private $module;
    public function __construct(ModuleDetail $moduleDetail,Module $module)
    {
        $this->moduleDetail = $moduleDetail;
        $this->module = $module;
    }
    public function create()
    {
        $modules = $this->module
            ->newQuery()
            ->where('parent_id',0)
            ->with(['details', 'child', 'child.details'])->get();
        return view('admin.module_detail.add',compact('modules'));
    }
    public function store(Request $request)
    {
        foreach ($request->module_chilrent as $value)
        {
            $dataChild = [
                'code' => $request->display_name,
                'display_name' => $request->display_name,
                'soft' => 1,
                'module_id' => $request->module_id,
                'value' => $value
            ];
            $this->moduleDetail->create($dataChild);
        }
        return redirect()->route('module_detail.create');
    }
}
