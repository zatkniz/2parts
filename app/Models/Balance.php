<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'balance'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer')->orderBy('name')->where('active' , '=' , 1 );
    }
}
