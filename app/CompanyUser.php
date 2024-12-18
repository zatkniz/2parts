<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyUser extends Model
{
    protected $fillable = [
        'company_id',
        'user_id',
    ];

    protected $table = 'company_user';
}
