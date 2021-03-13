<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddRequest;
use App\Models\Role;
use App\Models\User;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    use DeleteModelTrait;
    use StorageImageTrait;
    private $user;
    private $role;
    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }
    public function index()
    {
        $users = $this->user->paginate(5);
        return view('admin.user.index',compact('users'));
    }
    public function create()
    {
        $roles = $this->role->all();
        return view('admin.user.add',compact('roles'));
    }
    public function store(UserAddRequest $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];
            $userUpload = $this->storageTraitUpload($request,'image','user');
            if (!empty($userUpload))
            {
                $data['image'] = $userUpload['file_path'];
            }
            $user = $this->user->create($data);
            $user->roles()->attach($request->role_id);
            return redirect()->route('users.index');
        }
        catch (\Exception $exception)
        {
            Log::error('Message'. $exception->getMessage(). 'Line' .$exception->getLine());
        }
    }
    public function edit($id)
    {
        $rolesEdit = $this->role->all();
        $userEdit = $this->user->find($id);
        $roleUser = $userEdit->roles;
        return view('admin.user.edit',compact('userEdit','rolesEdit','roleUser'));
    }
    public function update(Request $request,$id)
    {
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ];
            $userEdit = $this->user->find($id);
            $dataUpload = $this->storageTraitUpload($request,'image','user');
            if (!empty($dataUpload))
            {
                $data['image'] = $dataUpload['file_path'];
            }
            $this->user->find($id)->update($data);
            $userEdit->roles()->sync($request->role_id);
            return redirect()->route('users.index');

        }
        catch (\Exception $exception)
        {
            Log::error('Message'. $exception->getMessage(). 'Line' .$exception->getLine());
        }
    }
    public function delete($id)
    {
        return $this->deleteModelTrait($id,$this->user);
    }
}
