<?php

namespace App\Http\Controllers;

use App\Company;
use App\Translation;
use App\Product;
use App\CompanyType;
use App\CompanyCategory;
use App\CompanyUser;
use Illuminate\Http\Request;
use Auth;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Builder;

class CompaniesController extends Controller
{
    public function index()
    {
        return Company::with(['media', 'companyTypes', 'companyCategory.products.translations', 'companyCategory.translations', 'companyCategory.products.media'])->get()->append('distance');
    }

    public function companyList(Request $request) {
        $companies = Company::with(['user', 'companyCategory.products.media', 'media', 'subscriptions']);
        foreach ($request->all() as $key => $value) {
            switch ($key) {
                case 'company_type_ids':

                    $companies->whereHas('companyTypes', function (Builder $query) use ($value) {
                        $query->whereIn('company_type_id', $value);
                    });

                    break;

                case 'subscriptions':

                    $companies->whereHas('subscriptions', function (Builder $query) use ($value) {
                        if($value != null)
                            $query->where('subscription_type_id', $value);
                    });

                    break;
                
                default:
                    $companies->where($key, (bool) $value);
                    break;
            }
         }
        return $companies->get();
    }

    public function insertNewCompany(Request $request) {

        $user = $request->id ? null : $request->user()->id;

        $company = $this->store($request);

        $company->translate($request->translations);
        
        $company->saveMedia($request->media);
        
        if(array_key_exists("address",$company->getChanges()) || array_key_exists("po_box",$company->getChanges()) || array_key_exists("state",$company->getChanges()))
            $company->savePlace($request->address, $request->po_box, $request->state);

        $company->companyTypes()->sync($request->company_type_ids);
        
        $company->companyCategory()->delete();

        $this->saveCompanyCategory($request->company_category, $company);
        
        if($user != null)
            CompanyUser::updateOrCreate([
                'user_id' => $request->user()->id,
                'company_id' => $company->id
                ],[
                'company_id' => $company->id
            ]);

        return $this->show($company->id);
    }

    public function store(Request $request)
    {
        $company = Company::updateOrCreate(
            ['id' => $request->id],
            $request->all()
        );
        return $company;
    }

    public function saveCompanyCategory($company_category, $company) {
        collect($company_category)->map(function($category, $index) use ($company){
            $companyCategory = CompanyCategory::updateOrCreate(['id' => array_key_exists('id', $category) ? $category['id'] : null],[
                'company_id' => $company->id,
                'order' => $index,
                'disabled' => isset($category['disabled']) ? $category['disabled'] : false,
                'product_category_id' => 1
            ]);

            $companyCategory->translate($category['translations']);

            $companyCategory->products()->delete();
            if(array_key_exists('products', $category))
                $this->saveCompanyCategoryProducts($category['products'], $company, $companyCategory);
        });
    }


    public function saveCompanyCategoryProducts($category_products, $company, $companyCategory) {
        collect($category_products)->map(function($product, $index) use ($company, $companyCategory){
            $newProduct = Product::updateOrCreate(['id' => array_key_exists('id', $product) ? $product['id'] : null],[
                'company_id' => $company->id,
                'per_kilo' => array_key_exists('per_kilo', $product) ? $product['per_kilo'] : false,
                'per_glass' => array_key_exists('per_glass', $product) ? $product['per_glass'] : false,
                'price' => array_key_exists('price', $product) ? $product['price'] : 0,
                'price_offer' => array_key_exists('price_offer', $product) ? $product['price_offer'] : 0,
                'order' => $index,
                'calories' => array_key_exists('calories', $product) ? $product['calories'] : 0,
                'preperation_time' => array_key_exists('preperation_time', $product) ? $product['preperation_time'] : 0,
                'disabled' => isset($product['disabled']) ? $product['disabled'] : false,
                'company_category_id' => $companyCategory->id,
            ]);

            $newProduct->translate($product['translations']);
            if(isset($product['media']))
                $newProduct->saveMedia($product['media']);

            if(isset($product['product_combinations_ids']))
                $newProduct->productCombinations()->sync($product['product_combinations_ids']);

            if(isset($product['product_characteristics_ids']))
                $newProduct->productCharacteristics()->sync($product['product_characteristics_ids']);
                
            if(isset($product['product_type_ids']))
                $newProduct->productCategories()->sync($product['product_type_ids']);

            $companyCategory->products()->save($newProduct);
        });
    }


    public function searchByName (Request $request) {
        $companies = Company::has('subscriptions');
        if($request->has('search') && $request->search != ''){
            $name = $request->search;
            $companies->whereHas('translations', function (Builder $query) use ($name) {
                $query->where('name', 'ilike', '%' . $name . '%');
            });
    
            $address = json_decode($this->searchLocation($request->search));
            // return response()->json($address);
            if($address->status == 'OK'){
                $dd = collect($address->results[0]->address_components)->filter(function($ad) {
                    return collect($ad->types)->contains('locality');
                })->first();
                // return $dd->long_name;
                $companies->orWhereHas('companyAddress', function (Builder $query) use ($dd) {
                    $query->where('locality', $dd->long_name);
                });
            }
        } 

        if($request->has('filters')  && count($request->filters) > 0){
            $filters = $request->filters;
            $companies->whereHas('companyTypes', function (Builder $query) use ($filters) {
                $query->whereIn('company_type_id', $filters);
            });
        }

        return $companies->with(['media', 'companyTypes', 'companyCategory.products.translations', 'companyCategory.translations', 'companyCategory.products.media', 'companyCategory.products.productCombinations'])->get();
    }

    public function searchLocation ($address) {
        $client = new Client([
            'base_uri' => 'https://maps.googleapis.com/maps/api/geocode/json'
        ]);
        $response = $client->get('', [
                'query' => [
                    'address' => $address . ' greece',
                    'key' => 'AIzaSyBE7wQxX9WNoEDG3NZtmx4duujwM7YJoBc',
                ]
            ]
        );
        $data = $response->getBody()->getContents();
        return $data;
    }
    
    public function show($company)
    {
        return Company::
                    whereId($company)
                    ->with(['media', 'companyTypes', 'companyCategory.products.translations', 'companyCategory.translations', 'companyCategory.products.media', 'companyCategory.products.productCombinations'])
                    ->first();
    }

    public function searchCatalogue(Request $request, $company)
    {
        $name = $request->search;

        $products = Product::whereCompanyId($company)->whereHas('translations', function (Builder $query) use ($name) {
            $query->where('name', 'ilike', '%' . $name . '%')->orWhere('description', 'ilike', '%' . $name . '%');
        });

        return $products->with(['translations', 'media', 'productCombinations'])->get();
    }
   
    public function destroy($company)
    {
        return Company::where('id' , $company)->delete();
    }
}
