<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Checkout extends Controller
{
    private $category;
    private $customer;
    private $order_item;
    private $order;

    public function __construct(Category $category, Customer $customer, OrderItem $order_item, Order $order)
    {
        $this->customer = $customer;
        $this->category = $category;
        $this->order_item = $order_item;
        $this->order = $order;
    }

    public function checkout()
    {
        try {
            $carts = session()->get('cart');
            $categoryLimit = $this->category
                ->newQuery()
                ->where('parent_id', 0)
                ->with(['categoryChild'])
                ->take(3)->get();
            return view('user.home.checkout', compact('categoryLimit', 'carts'));
        } catch (\Exception $exception) {
            abort(500);
        }
    }

    public function store(Request $request)
    {
        try {
            $carts = session()->get('cart');
            $total = 0;
            foreach ($carts as $id => $cart) {
                $total += $cart['price'] * $cart['quantity'];
            }
            $custom = $this->customer->create([
                'name'    => $request->name,
                'address' => $request->address,
                'email'   => $request->email,
                'phone'   => $request->phone
            ]);
            $orders = $custom->order_user()->create([
                'customer_id' => $custom->id,
                'note'        => $request->note,
                'total'       => $total
            ]);
            if ($orders) {
                foreach ($carts as $id => $cart) {
                    $this->order_item->create([
                        'order_id'   => $orders->id,
                        'product_id' => $id,
                        'price'      => $cart['price'],
                        'quantity'   => $cart['quantity'],
                    ]);
                }
            }
            session()->forget('cart');
            return redirect()->route('home');
        } catch (\Exception $exception) {
            abort(500);
        }
    }
}
