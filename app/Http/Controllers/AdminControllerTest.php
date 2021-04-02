<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminControllerTest extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }
    public function postLogin(Request $request)
    {
        $data = $request->only('email','password');
        if (Auth::guard('admin')->attempt($data))
        {
            return redirect()->route('dashboard');
        }
        return redirect()->back();
    }
}
