<?php

namespace App;
use App\Scopes\DisableScope;

use Illuminate\Database\Eloquent\Model;

class CompanyCategory extends Model
{

    protected static function boot()
    {
        parent::boot();
  
        static::addGlobalScope(new DisableScope);
    }

    public function productCategory()
    {
        return $this->belongsTo('App\ProductCategory');
    }

    protected $appends = ['available_languages'];

    public function products()
    {
        return $this->hasMany('App\Product')->orderBy('order');
    }

    public function getAvailableLanguagesAttribute()
    {
        return $this->translations->pluck('language_id');
    }
    
    protected $fillable = [
        'order', 'company_id', 'product_category_id' , 'disabled'
    ];

    public function translations()
    {
        return $this->morphMany('App\Translation', 'translation')->orderBy('language_id', 'ASC');
    }

    public function translate($translations)
    {
        $this->translations()->delete();
        return collect($translations)->map(function ($translation) {
            $t = new Translation([
                'language_id' => $translation['language_id'],
                'name' => isset($translation['name']) ? $translation['name'] : ' ',
                'description' => $translation['description'],
            ]);

            $this->translations()->save($t);
        });
    }

}
