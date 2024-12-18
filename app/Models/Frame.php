<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Frame extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'car_number', 'brand', 'model', 'year'
    ];

    public function fund()
    {
        return $this->hasOne('App\Models\Fund');
    }

    public function getYearAttribute($value) {
        return Carbon::create($value)->format('Y-m');
    }
}
