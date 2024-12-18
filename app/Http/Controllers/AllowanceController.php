<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Allowance;

class AllowanceController extends Controller
{
    public function save(Request $request){
        $allowance = Allowance::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'employee_id' => $request->input('employee_id'),
                'days' => $request->input('days'),
                'start_date' => $request->input('start_date'),
                'reason' => $request->input('reason'),
            ]
        );
        return $allowance;
    }

    public function all(Request $request , $employeeId){
        return Allowance::where('employee_id' , $employeeId)->with('employee')->get();
    }

    public function delete(Allowance $allowance){
        $allowance->delete();
        return 'success';
    }
}
