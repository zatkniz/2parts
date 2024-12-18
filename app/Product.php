<?php

namespace App;
use App\Scopes\DisableScope;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected static function boot()
    {
        parent::boot();
  
        static::addGlobalScope(new DisableScope);
    }
    
    protected $with = [
        'translations'
    ];

    protected $appends = ['product_type_ids', 'product_characteristics_ids'];

    protected $fillable = [
        'company_category_id', 'company_id', 'name', 'order', 'price', 'price_offer', 'calories', 'preperation_time', 'disabled', 'per_kilo', 'per_glass'
    ];

    public function companyCategory()
    {
        return $this->belongsTo('App\CompanyCategory');
    }

    public function translate($translations)
    {
        $this->translations()->delete();
        return  collect($translations)->map(function ($translation) {
            $t = new Translation([
                'language_id' => $translation['language_id'],
                'name' => isset($translation['name']) ? $translation['name'] : ' ',
                'description' => $translation['description'],
            ]);

            $this->translations()->save($t);
        });
    }

    public function saveMedia($media)
    {
        $this->media()->delete();
        return  collect($media)->map(function ($media, $index) {
            $t = new Media([
                'url' => $media['url'],
                'order' => $index,
            ]);

            $this->media()->save($t);
        });
    }
    
    public function translations()
    {
        return $this->morphMany('App\Translation', 'translation')->orderBy('language_id', 'ASC');
    }

    public function getProductTypeIdsAttribute()
    {
        return $this->productCategories->pluck('id');
    }
    
    public function getProductCharacteristicsIdsAttribute()
    {
        return $this->productCharacteristics->pluck('id');
    }

    public function getProductCombinationsIdsAttribute()
    {
        return $this->productCombinations->pluck('id');
    }

    public function productCharacteristics()
    {
        return $this->belongsToMany('App\ProductCharecteristic');
    }

    public function productCombinations()
    {
        return $this->belongsToMany('App\Product', 'product_combinations', 'combination_product_id');
    }

    public function productCategories()
    {
        return $this->belongsToMany('App\ProductType');
    }

    public function media()
    {
        return $this->morphMany('App\Media', 'media');
    }
}
