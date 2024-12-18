<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use HasFactory;

    protected $with = [
        'frame'
    ];

    protected $fillable = [
        'body', 'cost', 'customer_id', 'isInvoice', 'isReceipt', 'comments', 'isOffer'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function customerPrint()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
  
    public function lastUser()
    {
        return $this->belongsTo('App\Models\User' , 'last_user_id');
    }

    public function getCostAttribute()
    {
        return round($this->attributes['cost'], 2);
    }

    public function getTotalAttribute()
    {
        return round($this->attributes['total'], 2);
    }

    public function delivery()
    {
        return $this->belongsTo('App\Models\Employee' , 'delivery_id');
    }

    public function frame()
    {
        return $this->belongsTo('App\Models\Frame');
    }
}
