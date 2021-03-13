<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\ModuleDetail;
use App\Models\RoleTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminModuleRoleTestController extends Controller
{
    private $role_test;
    private $module_detail;
    private $module;
    public function __construct(RoleTest $role_test,ModuleDetail $moduleDetail,Module $module)
    {
        $this->role_test = $role_test;
        $this->module_detail = $moduleDetail;
        $this->module = $module;
    }
    public function index()
    {
        $role_tests = $this->role_test->paginate(5);
        return view('admin.module_role.index',compact('role_tests'));
    }
    public function create()
    {
        $modules = $this->module
            ->newQuery()
            ->where('parent_id',0)
            ->with(['details', 'child', 'child.details'])->get();
        return view('admin.module_role.add',compact('modules'));
    }
    public function store(Request $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'display_name' => $request->display_name
            ];
            $role_TestAdd = $this->role_test->create($data);
            $role_TestAdd->role_moduleDetail()->attach($request->module_detail_id);
            return redirect()->route('module_role.index');
        }
        catch (\Exception $exception)
        {
            Log::error('Message'. $exception->getMessage(). 'Line' .$exception->getLine());
        }
    }
    public function edit($id)
    {
        $modules = $this->module
            ->newQuery()
            ->where('parent_id',0)
            ->with(['details', 'child', 'child.details'])->get();
        $roletest_edit = $this->role_test->find($id);
        $roletest_checked = $roletest_edit->role_moduleDetail;
        return view('admin.module_role.edit',compact('modules','roletest_edit','roletest_checked'));
    }
    public function update($id, Request $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'display_name' => $request->display_name
            ];
            $this->role_test->find($id)->update($data);
            $role_TestEdit = $this->role_test->find($id);
            $role_TestEdit->role_moduleDetail()->sync($request->module_detail_id);
            return redirect()->route('module_role.index');
        }
        catch (\Exception $exception)
        {
            Log::error('Message'. $exception->getMessage(). 'Line' .$exception->getLine());
        }
    }
}
