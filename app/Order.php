<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'company_id'];

    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct');
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
