<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    private $role;
    private $permission;
    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }
    public function index()
    {
        $roles = $this->role->paginate(5);
        return view('admin.role.index',compact('roles'));
    }
    public function create()
    {
        $permissionsParent  = $this->permission->where('parent_id', 0)->get();
        return view('admin.role.add',compact('permissionsParent'));
    }
    public function store(Request $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'display_name' => $request->display_name,
            ];
            $roleAdd = $this->role->create($data);
            $roleAdd->Permission_Roles()->attach($request->permission_id);
            return redirect()->route('roles.index');
        }
        catch (\Exception $exception)
        {
            Log::error('Message'. $exception->getMessage(). 'Line' .$exception->getLine());
        }
    }
    public function edit($id)
    {
        $permissionsParent  = $this->permission->where('parent_id', 0)->get();
        $roleEdit = $this->role->find($id);
        $permission_Checked = $roleEdit->Permission_Roles;
        return view('admin.role.edit',compact('roleEdit','permissionsParent','permission_Checked'));
    }
    public function update(Request $request,$id)
    {
        try {
            $data = [
                'name' => $request->name,
                'display_name' => $request->display_name,
            ];
            $this->role->find($id)->update($data);
            $roleEdit = $this->role->find($id);
            $roleEdit->Permission_Roles()->sync($request->permission_id);
            return redirect()->route('roles.index');
        }
        catch (\Exception $exception)
        {
            Log::error('Message'. $exception->getMessage(). 'Line' .$exception->getLine());
        }
    }
}
