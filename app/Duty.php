<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Duty extends Model
{
    protected $fillable = [
        'body', 'id', 'user_id' , 'end_date'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
