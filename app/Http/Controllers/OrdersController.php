<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use Illuminate\Http\Request;
use Auth;
class OrdersController extends Controller
{
    public function index()
    {
        return Order::get();
    }

    
    public function store(Request $request)
    {
        $order = Order::updateOrCreate(
            ['id' => $request->id],
            $request->all()
        );

        collect($request->products)->map(function ($product) use ($order) {
            $t = new OrderProduct([
                'order_id' => $order->id,
                'product_id' => $product['product']['id'],
                'quantity' => $product['quantity'],
                'price' => $product['product']['price_offer'] > 0 ? $product['product']['price_offer'] : $product['product']['price'],
            ]);

            $order->orderProducts()->save($t);
        });
        return $this->show($order->id);
    }
    
    public function show($order)
    {
        return Order::whereId($order)->with(['orderProducts.product'])->first();
    }

    public function userOrders () {
        return Order::whereUserId(Auth::id())->with('orderProducts.product.translations','company')->orderBy('created_at', 'DESC')->get();
    }
   
    public function destroy($order)
    {
        return Order::where('id' , $order)->delete();
    }
}
