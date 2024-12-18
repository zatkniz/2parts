<?php

namespace App\Http\Controllers;

use App\Product;
use App\Order;
use App\OrderProduct;
use App\Translation;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class ProductsController extends Controller
{
    public function index()
    {
        return Product::get();
    }

    
    public function store(Request $request)
    {
    $product = Product::updateOrCreate(
        ['id' => $request->id],
        $request->all()
    );
    return $product;
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
        return Product::whereId($product)->with(['productCombinations.media', 'media'])->first();
    }

    public function translate(Product $product, Request $request)
    {
        $translation = new Translation([
            'company_id' => 1,
            'language_id' => 1,
            'description' => 'Lorem ipsum',
        ]);
        return $product->translations()->save($translation);
    }

   
    public function destroy($product)
    {
        return Product::where('id' , $product)->delete();
    }

    public function topProducts($company, Request $request) {
        if($request->date == 'today'){
            $date = Carbon::today()->toDateString();
        } else if($request->date == 'week') {
            $date = Carbon::now()->startOfWeek()->toDateString();
        } else if($request->date == 'month') {
            $date = Carbon::now()->startOfMonth()->toDateString();
        } else {
            $date = Carbon::now()->startOfYear()->toDateString();
        }

        return OrderProduct::whereHas('order', function (Builder $query) use ($company, $date) {
            $query->whereCompanyId($company);
            $query->whereDate('created_at', '>=', $date);
        })->with('product.companyCategory.productCategory')->get()->groupBy(function ($item, $key) {
            return $item['product']['name'];
        })->map(function ($item, $key) {
            $count = count($item);
            return $item->reduce(function ($carry, $item) use ($count) {
                return (object) [
                    "product" => $item['product'],
                    "count" => $count
                ];
            }, 0);
        })->sortByDesc('count')->take(5)->toArray();
    }
}
