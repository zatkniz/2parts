<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $fillable = [
        'name',
        'language_id',
        'description',
    ];

    public function language()
    {
        return $this->belongsTo('App\Language');
    }
}
