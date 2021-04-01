<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminControllerTest extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }
    public function postLogin()
    {

    }
}
