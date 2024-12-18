<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allowance extends Model
{
    protected $fillable = [
        'id', 'employee_id' , 'days' , 'start_date' , 'reason'
    ];

    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }
}
