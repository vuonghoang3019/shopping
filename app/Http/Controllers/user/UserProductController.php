<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserProductController extends Controller
{
    private $product;
    private $category;
    private $productImage;
    private $rating;

    public function __construct(Product $product, Category $category, ProductImage $productImage, Rating $rating)
    {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->rating = $rating;
    }

    public function index()
    {
        try {
            return view('user.product.index');
        } catch (\Exception $exception) {
            abort(500);
        }
    }

    public function addToCart($id)
    {
        try {
            $product = $this->product->find($id);
            if ($product->quantity == 0) {
                return response()->json([
                    'code'    => 201,
                    'message' => 'error'
                ], 201);
            } else {
                $cart = session()->get('cart');
                if (isset($cart[$id])) {
                    $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
                } else {
                    $cart[$id] = [
                        'name'     => $product->name,
                        'price'    => $product->price,
                        'image'    => $product->feature_image_path,
                        'quantity' => 1
                    ];
                }
                session()->put('cart', $cart);
                return response()->json([
                    'code'    => 200,
                    'message' => 'success'
                ], 200);
            }
        } catch (\Exception $exception) {
            abort(500);
        }
    }

    public function AddToCartProductDetail($id, Request $request)
    {
        try {
            $product = $this->product->find($id);
            $cart = session()->get('cart');
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = $cart[$id]['quantity'] + $request->quantity;
            } else {
                $cart[$id] = [
                    'name'     => $product->name,
                    'price'    => $product->price,
                    'image'    => $product->feature_image_path,
                    'quantity' => $request->quantity
                ];
            }
            session()->put('cart', $cart);
            return response()->json([
                'code'    => 200,
                'message' => 'success'
            ], 200);
        } catch (\Exception $exception) {
            abort(500);
        }

    }

    public function showCart()
    {
        try {
            $categoryLimit = $this->category
                ->newQuery()
                ->where('parent_id', 0)
                ->with(['categoryChild'])
                ->take(3)->get();
            $carts = session()->get('cart');
            return view('user.home.cart', compact('carts', 'categoryLimit'));
        } catch (\Exception $exception) {
            abort(500);
        }
    }

    public function updateCart(Request $request)
    {
        try {
            $categoryLimit = $this->category
                ->newQuery()
                ->where('parent_id', 0)
                ->with(['categoryChild'])
                ->take(3)->get();
            if ($request->id && $request->quantity) {
                $carts = session()->get('cart');
                $carts[$request->id]['quantity'] = $request->quantity;
                session()->put('cart', $carts);
                $carts = session()->get('cart');
                $cart_component = view('user.home.cart', compact('carts', 'categoryLimit'))->render();
                return response()->json([
                    'cart_component' => $cart_component,
                    'code'           => 200
                ], 200);
            }
        } catch (\Exception $exception) {
            abort(500);
        }
    }

    public function deleteCart(Request $request)
    {
        try {
            $categoryLimit = $this->category
                ->newQuery()
                ->where('parent_id', 0)
                ->with(['categoryChild'])
                ->take(3)->get();
            if ($request->id) {
                $carts = session()->get('cart');
                unset($carts[$request->id]);
                session()->put('cart', $carts);
                $carts = session()->get('cart');
                $cart_component = view('user.home.cart', compact('carts', 'categoryLimit'))->render();
                return response()->json([
                    'cart_component' => $cart_component,
                    'code'           => 200
                ], 200);
            }
        } catch (\Exception $exception) {
            abort(500);
        }
    }

    public function productDetail($id)
    {
        try {
            $categoryLimit = $this->category
                ->newQuery()
                ->where('parent_id', 0)
                ->with(['categoryChild'])
                ->take(3)->get();
            $categories = $this->category->newQuery()->where('parent_id', 0)->with(['categoryChild'])->get();
            $productRecommend = $this->product->latest('view', 'desc')->take(6)->get();
            $productDetails = $this->product->find($id);
            $productImage = $this->product->newQuery()->where('id', $id)->with(['productImage'])->get();
            $carts = session()->get('cart');
            $ratings = $this->rating->newQuery()
                ->with(['product','user'])
                ->where('product_id',$id)
                ->orderBy('id','DESC')
                ->get();
            $ratingDashboard = $this->rating->newQuery()
                ->groupBy('number')
                ->where('product_id',$id)
                ->select(DB::raw('count(number) as total'))
                ->addSelect('number')
                ->get()->toArray();
            $arrayRatings = [];
            if (!empty($ratingDashboard))
            {
                for ($i = 1; $i <= 5; $i++)
                {
                    $arrayRatings[$i] = [
                        'total' => 0,
                        'number' => 0
                    ];
                    foreach ($ratingDashboard as $rating)
                    {
                        if ($rating['number'] == $i)
                        {
                            $arrayRatings[$i] = $rating;
                            continue;
                        }
                    }
                }
            }
            return view('user.product.productDetail', compact('productDetails', 'productImage',
                'categoryLimit', 'categories', 'productRecommend', 'carts','ratings','arrayRatings'));
        } catch (\Exception $exception) {
            abort(500);
        }
    }
}
