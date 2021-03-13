<?php

namespace App\Http\Controllers;

use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return view('dashboard');
        } else {
            return view('login');
        }
    }

    public function loginAdmin() // view form loign
    {
        try {
            if (auth()->check()) {
                return redirect()->to('admin/dashboard');
            }
            return view('login');
        } catch (\Exception $exception) {
            abort(500);
        }

    }

    public function postloginAdmin(Request $request)
    {
        try {
            $remember = $request->has('remember_me') ? true : false;
            if (auth()->attempt([
                'email'    => $request->email,
                'password' => $request->password
            ], $remember)) {
                return redirect()->to('admin/dashboard');
            }
        } catch (\Exception $exception) {
            abort(500);
        }

    }

    public function logout()
    {
        auth()->logout();
        return redirect()->to('admin');
    }
}
