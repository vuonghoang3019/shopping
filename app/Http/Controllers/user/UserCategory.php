<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class UserCategory extends Controller
{
    private $category;
    private $product;

    public function __construct(Category $category, Product $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function index($slug, $categoryID)
    {
        try {
            $categoryLimit = $this->category->newQuery()->where('parent_id', 0)->with(['categoryChild'])->take(3)->get();
            $products = $this->product->newQuery()->where('category_id', $categoryID)->paginate(9);
            $categories = $this->category->newQuery()->where('parent_id', 0)->with(['categoryChild'])->get();
            $carts = session()->get('cart');
            return view('user.product.category.index', compact('categoryLimit', 'products', 'categories','carts'));
        } catch (\Exception $exception) {
            abort(500);
        }

    }
}
