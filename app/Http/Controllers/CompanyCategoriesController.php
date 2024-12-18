<?php

namespace App\Http\Controllers;

use App\CompanyCategory;
use App\Company;
use App\Category;
use App\Product;
use Illuminate\Http\Request;

class CompanyCategoriesController extends Controller
{
    public function index()
    {
        return CompanyCategory::get();
    }

    
    public function store(CompanyCategory $companyCategory)
    {
        $companyCategory = CompanyCategory::updateOrCreate(
            ['id' => $request->id],
            $request->all()
        );
        return $companyCategory;
    }

    public function updateCompanyProducts(Request $request)
    {
        return collect($request)->map(function ($category, $index) {
            $category['order'] = $index;
            CompanyCategory::updateOrCreate(
                ['id' => $category['id']],
                $category
            );

            collect($category['products'])->map(function ($product, $i) use ($category) {
                $product['order'] = $i;
                $product['company_category_id'] = $category['id'];
                Product::updateOrCreate(
                    ['id' => $product['id']],
                    $product
                );
            });

            return $category;
        });
    }

    public function companyProducts ($company){
        return CompanyCategory::whereCompanyId($company)->with(['productCategory', 'products.media', 'translations'])->orderBy('order')->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CompanyCategory  $companyCategory
     * @return \Illuminate\Http\Response
     */
    
    public function show(CompanyCategory $companyCategory)
    {
        return $companyCategory;
    }

   
    public function destroy($companyCategory)
    {
        return CompanyCategory::where('id' , $companyCategory)->delete();
    }
}
