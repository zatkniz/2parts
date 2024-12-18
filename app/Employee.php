<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'email' ,
        'surname' ,
        'address' ,
        'afm' ,
        'amka' ,
        'telephone' ,
        'telephone2' ,
        'bank_account' ,
        'position' ,
        'hiring_date' ,
        'firing_date' ,
        'active' ,
        'percentage' ,
    ];

    public function payroll()
    {
        $dt = Carbon::parse(Carbon::today());
        return $this->hasOne('App\Payroll')->where('payroll_month' , '=' , $dt->month );
    }

    public function allpayroll()
    {
        return $this->hasMany('App\Payroll');
    }

    public function customers()
    {
        return $this->hasMany('App\Customer');
    }
}
