<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'employee_id',
        'payroll_period_01_1' ,
        'payroll_period_01_2' ,
        'payroll_period_01_3' ,
        'payroll_period_01_4' ,
        'payroll_period_01_5' ,
        'payroll_period_02_1' ,
        'payroll_period_02_2' ,
        'payroll_period_02_3' ,
        'payroll_period_02_4' ,
        'payroll_period_02_5' ,
        'payroll_month' ,
        'payroll_year' ,
        'enanti' ,
        'extras' ,
        'gift' ,
    ];

    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }

    public function activeEmployee()
    {
        return $this->belongsTo('App\Employee')->where('active' , '=' , 1);
    }
}