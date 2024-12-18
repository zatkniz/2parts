<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outfund extends Model
{
    protected $fillable = [
        'outcome_id',
        'total' ,
        'delivery_id'
    ];
    
    public function outcome()
    {
        return $this->belongsTo('App\Outcome');
    }
}
