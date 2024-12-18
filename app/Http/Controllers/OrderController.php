<?php

namespace App\Http\Controllers;
use App\Order;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders');
    }

    public function getAll()
    {
        return Order::all();
    }

    public function store(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            $id = isset( $value['id'] ) ? $value['id'] : null;
            $order = Order::firstOrNew(['id' => $id]);
            $order->brand = isset( $value['brand'] )?  $value['brand'] : null;
            $order->code = isset( $value['code'] )?  $value['code'] : null;
            $order->quantity = isset( $value['quantity'] )?  $value['quantity'] : null;
            $order->info = isset( $value['info'] )?  $value['info'] : null;
            $order->done = isset( $value['done'] )?  $value['done'] : null;

            if($id == null){
                $order->user_id = Auth::user()->id;
            }

            if(isset( $value['for_remove']) && $value['for_remove'] ){
                $order->delete();
            }else{
                $order->save();
            }
        }
        return Order::all();
    }
}
