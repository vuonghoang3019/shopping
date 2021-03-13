<?php

namespace App\Http\Controllers;

use App\Models\RoleTest;
use App\Models\UserTest;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminControllerUserModule extends Controller
{
    use StorageImageTrait;
    private $user_test;
    private $role_test;
    public function __construct(UserTest $user_test,RoleTest $role_test)
    {
        $this->user_test = $user_test;
        $this->role_test = $role_test;
    }
    public function index()
    {
        $user_tests = $this->user_test->paginate(5);
        return view('admin.user_module.index',compact('user_tests'));
    }
    public function create()
    {
        $role_tests = $this->role_test->all();
        return view('admin.user_module.add',compact('role_tests'));
    }
    public function store(Request $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];
//            $dataUpload = $this->storageTraitUpload($request,'image_path','user_test');
//            if (!empty($dataUpload))
//            {
//                $data['image_path'] = $dataUpload['file_path'];
//                $data['image_name'] = $dataUpload['file_name'];
//            }
            $dataUpload = $this->storageTraitUpload($request,'image_path','user_test');
            if (!empty($dataUpload) )
            {
                $data['image_path'] = $dataUpload['file_path'];
                $data['image_name'] = $dataUpload['file_name'];
            }
            $user_testAdd = $this->user_test->create($data);
            $user_testAdd->role_tests()->attach($request->roletest_id);
            return redirect()->route('user_module.index');
        }
        catch (\Exception $exception)
        {
            Log::error('Message'. $exception->getMessage(). 'Line' .$exception->getLine());
        }
    }
}
