<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyType extends Model
{
    protected $fillable = [
        'company_type_id', 'name', 'company_kind_id'
    ];

    public $timestamps = false;

    public function company()
    {
        return $this->belongsToMany('App\Company');
    }

    public function companyKind()
    {
        return $this->belongsTo('App\CompanyKind');
    }
}
