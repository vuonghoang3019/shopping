<?php
namespace App\Http\Controllers;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Traits\DeleteModelTrait;
use Illuminate\Support\Facades\Log;

class AdminPermissionController extends Controller
{
    use DeleteModelTrait;
    private $permission;
    private $module;
    public function __construct(Permission $permission,Module $module)
    {
        $this->permission = $permission;
        $this->module = $module;
    }
    public function index()
    {
        $permissions = $this->permission->where('parent_id',0)->paginate(8);
        return view('admin.permission.index',compact('permissions'));
    }
    public function create()
    {
        $modules = $this->module->all();
        return view('admin.permission.add',compact('modules'));
    }
    public function store(Request $request)
    {
        $data = [
            'name' => $request->module_parent,
            'display_name' => $request->module_parent,
            'parent_id' => 0,
        ];
        $permissions = $this->permission->create($data);
        foreach ($request->module_chilrent as $value)
        {
            $dataChild = [
                'name' => $value,
                'display_name' => $value,
                'parent_id' => $permissions->id,
                'key_code' => $value.'-'.$request->module_parent
            ];
            $this->permission->create($dataChild);
        }
        return redirect()->route('permissions.index');
    }
    public function edit($id)
    {
        $modules = $this->module->all();
        $permissionEdit = $this->permission->find($id);
        $permission_Check = $this->permission->newQuery()->where('id',$id)->with(['PermissionsChild'])->get();
        return view('admin.permission.edit',compact('modules','permissionEdit','permission_Check'));
    }
    public function update(Request $request,$id)
    {
        $this->permission->newQuery()->where('parent_id',$id)->delete();
        $dataUpdate = [
            'name' => $request->module_parent,
            'display_name' => $request->module_parent,
            'parent_id' => 0,
        ];
        $this->permission->where('id',$id)->update($dataUpdate);
        $permissionEdit = $this->permission->find($id);
        foreach ($request->module_chilrent as $value)
        {
            $dataChild = [
                'name' => $value,
                'display_name' => $value,
                'parent_id' => $request->id,
                'key_code' => $value.'-'.$request->module_parent
            ];
            $permissionAdd =  $this->permission->create($dataChild);
            $permissionEdit->Role_Permission()->sync($permissionAdd->id);
        }
        return redirect()->route('permissions.index');
    }
    public function delete($id)
    {
        return $this->deleteModelParent_idTrait($id,$this->permission);
    }
}
