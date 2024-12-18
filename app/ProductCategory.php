<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'name'];

    public function productCategory()
    {
       $this->belongsToMany("App\CompanyCategory");
    }

    public function translations()
    {
        return $this->morphMany('App\Translation', 'translation')->orderBy('language_id', 'ASC');
    }
}
