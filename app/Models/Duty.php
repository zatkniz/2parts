<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duty extends Model
{
    use HasFactory;

    protected $fillable = [
        'body', 'id', 'user_id' , 'end_date'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
