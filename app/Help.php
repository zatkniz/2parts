<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    protected $fillable = ['name'];

    public function helpBody()
    {
        return $this->hasMany('App\HelpBody');
    }
}
