<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    private $slider;
    private $category;
    private $product;
    private $setting;
    private $user;

    public function __construct(Slider $slider, Category $category, Product $product, Setting $setting, User $user)
    {
        $this->slider = $slider;
        $this->category = $category;
        $this->product = $product;
        $this->setting = $setting;
        $this->user = $user;
    }

    public function index()
    {
        try {
            $sliders = $this->slider->latest()->take(3)->get();
            $categories = $this->category->newQuery()->where('parent_id', 0)->with(['categoryChild'])->get();
            $products = $this->product->where('status',1)->latest()->take(6)->get();
            $productRecommend = $this->product->latest('view', 'desc')->take(6)->get();
            $categoryLimit = $this->category->newQuery()->where('parent_id', 0)->with(['categoryChild'])->take(3)->get();
            return view('user.home.home', compact('sliders', 'categories', 'products', 'productRecommend', 'categoryLimit'));
        } catch (\Exception $exception) {
            abort(500);
        }
    }

    public function loginUser()
    {

        $categoryLimit = $this->category->newQuery()->where('parent_id', 0)->with(['categoryChild'])->take(3)->get();
        return view('user.home.login', compact('categoryLimit'));

    }

    public function register(Request $request)
    {
        try {
            $this->user->create([
                'name'     => $request->name,
                'password' => Hash::make($request->password),
                'email'    => $request->email
            ]);
            return redirect()->route('login');
        } catch (\Exception $exception) {
            abort(500);
        }
    }

    public function postLogin(Request $request)
    {
        try {
            if (auth()->attempt([
                'email'    => $request->email,
                'password' => $request->password
            ])) {
                return redirect()->route('home');
            }
        } catch (\Exception $exception) {
            abort(500);
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('loginUser');
    }

}
