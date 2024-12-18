<?php

namespace App\Http\Controllers;

use App\ProductCharecteristic;
use Illuminate\Http\Request;

class ProductCharecteristicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductCharecteristic::get();
    }

    public function allWithCount() {
        return ProductCharecteristic::withCount('products as count')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $companyCategory = ProductCharecteristic::updateOrCreate(
            ['id' => $request->id],
            $request->all()
        );
        return $companyCategory;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductCharecteristic  $productCharecteristic
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCharecteristic $productCharecteristic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductCharecteristic  $productCharecteristic
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCharecteristic $productCharecteristic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductCharecteristic  $productCharecteristic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCharecteristic $productCharecteristic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductCharecteristic  $productCharecteristic
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCharecteristic $productCharecteristic)
    {
        return $productCharecteristic->delete();
    }
}
