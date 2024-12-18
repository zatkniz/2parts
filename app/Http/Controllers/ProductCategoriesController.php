<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoriesController extends Controller
{
    public function index()
    {
        return ProductCategory::get();
    }

    
    public function store(Request $request)
    {
        $productCategory = ProductCategory::updateOrCreate(
            ['id' => $request->id],
            $request->all()
        );
        return $productCategory;
    }
    
    public function show(ProductCategory $productCategory)
    {
        return $productCategory;
    }

   
    public function destroy($productCategory)
    {
        return ProductCategory::where('id' , $productCategory)->delete();
    }
}
