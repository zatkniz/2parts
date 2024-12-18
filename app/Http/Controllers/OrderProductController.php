<?php

namespace App\Http\Controllers;

use App\OrderProduct;
use Illuminate\Http\Request;

class OrderProductController extends Controller
{
    public function index()
    {
        return OrderProduct::get();
    }

    
    public function store(OrderProduct $orderProduct)
    {
    $orderProduct = OrderProduct::updateOrCreate(
        ['id' => $request->id],
        $request->all()
    );
    return $orderProduct;
    }
    
    public function show(OrderProduct $orderProduct)
    {
        return $orderProduct;
    }

   
    public function destroy($orderProduct)
    {
        return OrderProduct::where('id' , $orderProduct)->delete();
    }
}

