<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $fillable = [
        'customer_id', 'balance'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Customer')->orderBy('name')->where('active' , '=' , 1 );
    }
}
