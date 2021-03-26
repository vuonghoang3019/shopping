<?php

namespace App\Http\Controllers;

use App\Models\Order;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    private $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    public function index()
    {
        if (auth()->check()) {
            $moneyDay = $this->order->whereDay('updated_at',date('d'))->where('status',1)->sum('total');
            $moneyMonth = $this->order->whereMonth('updated_at',date('m'))->where('status',1)->sum('total');
            $dataMoney = [
                [
                    "name" => "Doanh thu ngày",
                    "y" => (int)$moneyDay
                ],
                [
                    "name" => "Doanh thu Thang",
                    "y" => (int)$moneyMonth
                ],
            ];
            $dataMoney = json_encode($dataMoney);
            return view('dashboard',compact('dataMoney'));
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
