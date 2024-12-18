<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allowance extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'employee_id' , 'days' , 'start_date' , 'reason'
    ];

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee');
    }
}
