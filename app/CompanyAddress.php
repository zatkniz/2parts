<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyAddress extends Model
{
    protected $fillable = [
        'route', 'country', 'locality', 'postal_code', 'administrative_area', 'location'
    ];
}
