<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    protected $fillable = [
        'body', 'cost', 'customer_id', 'isInvoice', 'isReceipt', 'comments', 'isOffer'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function customerPrint()
    {
        return $this->belongsTo('App\Customer');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
  
    public function lastUser()
    {
        return $this->belongsTo('App\User' , 'last_user_id');
    }

    public function delivery()
    {
        return $this->belongsTo('App\Employee' , 'delivery_id');
    }
}
