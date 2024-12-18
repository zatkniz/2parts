<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Employee extends Model
{
    use HasFactory;

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
        return $this->hasOne('App\Models\Payroll')->where('payroll_month' , '=' , $dt->month );
    }

    public function allpayroll()
    {
        return $this->hasMany('App\Models\Payroll');
    }

    public function customers()
    {
        return $this->hasMany('App\Models\Customer');
    }
}
