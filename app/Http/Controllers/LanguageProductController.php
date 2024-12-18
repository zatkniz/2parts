<?php

namespace App\Http\Controllers;

use App\LanguageProduct;
use App\Language;
use App\Product;
use Illuminate\Http\Request;

class LanguageProductController extends Controller
{
    public function index()
    {
        return LanguageProduct::get();
    }

    
    public function store(LanguageProduct $languageProduct)
    {
    $languageProduct = LanguageProduct::updateOrCreate(
        ['id' => $request->id],
        $request->all()
    );
    return $languageProduct;
    }
    
    public function show(LanguageProduct $languageProduct)
    {
        return $languageProduct;
    }

   
    public function destroy($languageProduct)
    {
        return LanguageProduct::where('id' , $languageProduct)->delete();
    }
}
