<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['user_id', 'company_id'];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
