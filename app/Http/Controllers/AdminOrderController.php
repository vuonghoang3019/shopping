<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\DeleteModelTrait;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    use DeleteModelTrait;

    private $order;
    private $oder_item;
    private $product;
    private $customer;

    public function __construct(Order $order, OrderItem $oder_item, Product $product, Customer $customer)
    {
        $this->order = $order;
        $this->oder_item = $oder_item;
        $this->product = $product;
        $this->customer = $customer;
    }

    public function index()
    {
        $orders = $this->order->newQuery()->with(['customer','user'])->paginate(8);
        return view('admin.order.index', compact('orders'));
    }
    public function viewDetail(Request $request, $id)
    {
        if ($request->ajax()) {
            $orders = $this->oder_item->newQuery()->with(['product'])->where('order_id', $id)->get();
            $html = view('admin.component.oderDetail', compact('orders'))->render();
            return response()->json($html);

        }
    }

    public function actionOrder($id)
    {
        $orders = $this->oder_item->newQuery()->with(['product'])->where('order_id', $id)->get();
        if ($orders) {
            //tru di so luong san pham
            foreach ($orders as $order) {
                $products = $this->product->find($order->product_id);
                $products->quantity = $products->quantity - $order->quantity;
                $products->is_pay++;
                //tang bien pay len 1
                $products->save();
            }
        }
        $this->order->find($id)->update(['status' => 1]);
        return redirect()->route('order.index');
    }
    public function delete($id)
    {
        $order = $this->order->find($id);
        $this->customer->where('id',$order->customer_id)->delete();
        return $this->deleteModelTrait($id, $this->order);

    }
}
