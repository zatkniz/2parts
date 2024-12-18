<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outfund extends Model
{
    use HasFactory;

    protected $fillable = [
        'outcome_id',
        'total' ,
        'delivery_id',
        'is_bank',
        'bank_id'
    ];
    
    public function outcome()
    {
        return $this->belongsTo('App\Models\Outcome');
    }
}
