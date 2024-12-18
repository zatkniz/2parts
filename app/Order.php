<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'brand', 'code', 'quantity', 'info', 'user_id', 'done'
    ];

    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
