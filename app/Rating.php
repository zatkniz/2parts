<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'user_id',
        'company_id',
        'menu',
        'service',
        'price',
        'comments'
    ];

    protected $appends = ['average'];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function getAverageAttribute() {
        return round(($this->attributes['menu'] + $this->attributes['service'] + $this->attributes['price']) / 3, 1);
    }
}
