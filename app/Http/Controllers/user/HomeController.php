<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    private $slider;
    private $category;
    private $product;
    private $setting;
    private $user;
    private $order;
    private $order_items;

    public function __construct(Slider $slider, Category $category, Product $product,
                                Setting $setting, User $user, Order $order, OrderItem $order_items)
    {
        $this->slider = $slider;
        $this->category = $category;
        $this->product = $product;
        $this->setting = $setting;
        $this->user = $user;
        $this->order = $order;
        $this->order_items = $order_items;
    }

    public function index()
    {
        $carts = session()->get('cart');
        $sliders = $this->slider->latest()->take(3)->get();
        $categories = $this->category->newQuery()->where('parent_id', 0)->where('home', 1
        )->with(['categoryChild'])->get();
        $products = $this->product->where('status', 1)->latest()->take(6)->get();
        $productRecommend = $this->product->latest('view', 'desc')->take(6)->get();
        $categoryLimit = $this->category->newQuery()->where('parent_id', 0)->with(['categoryChild'])->take(3)->get();
        //check user login, chua dang nhap thi thoi
        //C2: Luc mua hang thanh cong, luu vao 1 list nhung danh muc san pham da mua vao bang don hang.
        if (Auth::check()) {
            $orders = $this->order->where([
                'user_id' => \auth()->user()->id,
                'status'  => 1
            ])->pluck('id');
            if (!empty($orders)) {
                $listID = $this->order_items->whereIn('order_id', $orders)->distinct()->pluck('product_id');
                if (!empty($listID)) {
                    $listIDProduct = $this->product->whereIn('id', $listID)->distinct()->pluck('category_id');
                    if (!empty($listIDProduct)) {
                        $productSuggest = $this->product->whereIn('category_id', $listIDProduct)->limit(6)->get();
                    }
                }
            }
        }

        return view('user.home.home', compact('sliders', 'categories',
            'products', 'productRecommend', 'categoryLimit', 'carts'));

    }

    public function loginUser()
    {

        $categoryLimit = $this->category->newQuery()->where('parent_id', 0)->with(['categoryChild'])->take(3)->get();
        $carts = session()->get('cart');
        return view('user.home.login', compact('categoryLimit', 'carts'));
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
        }
        catch (\Exception $exception) {
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
        }
        catch (\Exception $exception) {
            abort(500);
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('loginUser');
    }

    public function productHaveSeen(Request $request)
    {
        if ($request->ajax()) {
            $listID = $request->id;
            $products = $this->product->whereIn('id', $listID)->get();
            $html = view('user.home.components.productHaveSeen', compact('products'))->render();
            return response()->json([
                'data' => $html
            ]);

        }

    }

}
