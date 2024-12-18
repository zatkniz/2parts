<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Payroll;
use JavaScript;
use Carbon\Carbon;

class PayrollController extends Controller
{
    public function index(){
        return view('payroll');
    }

    public function currentPayroll(){
        $result = Employee::with('payroll')->where('active' , '=' , 1)->get();
        foreach ($result as $key => $value) {
            $dt = Carbon::parse(Carbon::today());
            $payroll = Payroll::firstOrNew(
                [
                    'employee_id' => $value['id'],
                    'payroll_month' => $dt->month,
                    'payroll_year' => $dt->year
                ], 
                [
                    'payroll_period_01_1' => 0 , 
                    'payroll_period_01_2' => 0 , 
                    'payroll_period_01_3' => 0 , 
                    'payroll_period_01_4' => 0 , 
                    'payroll_period_01_5' => 0 , 
                    'payroll_period_02_1' => 0 , 
                    'payroll_period_02_2' => 0 , 
                    'payroll_period_02_3' => 0 , 
                    'payroll_period_02_4' => 0 , 
                    'payroll_period_02_5' => 0 , 
                    'payroll_month' => $dt->month , 
                    'payroll_year' => $dt->year , 
                    'enanti' => 0 , 
                    'extras' => 0 
                ]
            );
            $payroll->save();
        }
        return Payroll::where('payroll_month' , $dt->month)->where('payroll_year' , $dt->year)->with('employee')->get();
    }

    public function singlePayroll(Employee $employee){
        return Employee::with('allpayroll')->where('id' , $employee->id )->get();
    }

    public function savePayroll(Request $request){
        foreach ($request->input() as $key => $value) {
            $payroll = Payroll::find($request->input()[$key]['id']);
            $payroll->payroll_period_01_1 = $request->input()[$key]['payroll_period_01_1'];
            $payroll->payroll_period_01_2 = $request->input()[$key]['payroll_period_01_2'];
            $payroll->payroll_period_01_3 = $request->input()[$key]['payroll_period_01_3'];
            $payroll->payroll_period_01_4 = $request->input()[$key]['payroll_period_01_4'];
            $payroll->payroll_period_01_5 = $request->input()[$key]['payroll_period_01_5'];
            $payroll->payroll_period_02_1 = $request->input()[$key]['payroll_period_02_1'];
            $payroll->payroll_period_02_2 = $request->input()[$key]['payroll_period_02_2'];
            $payroll->payroll_period_02_3 = $request->input()[$key]['payroll_period_02_3'];
            $payroll->payroll_period_02_4 = $request->input()[$key]['payroll_period_02_4'];
            $payroll->payroll_period_02_5 = $request->input()[$key]['payroll_period_02_5'];
            $payroll->enanti = $request->input()[$key]['enanti'];
            $payroll->extras = $request->input()[$key]['extras'];
            $payroll->gift = $request->input()[$key]['gift'];
            $payroll->save();
        }
        return;
    }

    public function updatePayroll(Request $request){
        $dt = Carbon::parse(Carbon::today());
        $payroll = Payroll::find($request->input('id'));
        $payroll->enanti = $request->input('extras');
        $payroll->gift = $request->input('gift');
        $payroll->payroll_period_01_1 = $request->input('payroll_period_01_1');
        $payroll->payroll_period_01_1_date = $request->input('payroll_period_01_1') > 0 && $request->input('payroll_period_01_1_date') == '' ? $dt->day.'/'.$dt->month.'/'.$dt->year : $request->input('payroll_period_01_1_date') ;
        $payroll->payroll_period_01_2 = $request->input('payroll_period_01_2');
        $payroll->payroll_period_01_2_date = $request->input('payroll_period_01_2') > 0 && $request->input('payroll_period_01_2_date') == '' ? $dt->day.'/'.$dt->month.'/'.$dt->year : '' ;
        $payroll->payroll_period_01_3 = $request->input('payroll_period_01_3');
        $payroll->payroll_period_01_3_date = $request->input('payroll_period_01_3') > 0 && $request->input('payroll_period_01_3_date') == '' ? $dt->day.'/'.$dt->month.'/'.$dt->year : '' ;
        $payroll->payroll_period_01_4 = $request->input('payroll_period_01_4');
        $payroll->payroll_period_01_4_date = $request->input('payroll_period_01_4') > 0 && $request->input('payroll_period_01_4_date') == '' ? $dt->day.'/'.$dt->month.'/'.$dt->year : '' ;
        $payroll->payroll_period_01_5 = $request->input('payroll_period_01_5');
        $payroll->payroll_period_01_5_date = $request->input('payroll_period_01_5') > 0 && $request->input('payroll_period_01_5_date') == '' ? $dt->day.'/'.$dt->month.'/'.$dt->year : '' ;
        $payroll->payroll_period_02_1 = $request->input('payroll_period_02_1');
        $payroll->payroll_period_02_1_date = $request->input('payroll_period_02_1') > 0 && $request->input('payroll_period_02_1_date') == '' ? $dt->day.'/'.$dt->month.'/'.$dt->year : '' ;
        $payroll->payroll_period_02_2 = $request->input('payroll_period_02_2');
        $payroll->payroll_period_02_2_date = $request->input('payroll_period_02_2') > 0 && $request->input('payroll_period_02_2_date') == '' ? $dt->day.'/'.$dt->month.'/'.$dt->year : '' ;
        $payroll->payroll_period_02_3 = $request->input('payroll_period_02_3');
        $payroll->payroll_period_02_3_date = $request->input('payroll_period_02_3') > 0 && $request->input('payroll_period_02_3_date') == '' ? $dt->day.'/'.$dt->month.'/'.$dt->year : '' ;
        $payroll->payroll_period_02_4 = $request->input('payroll_period_02_4');
        $payroll->payroll_period_02_4_date = $request->input('payroll_period_02_4') > 0 && $request->input('payroll_period_02_4_date') == '' ? $dt->day.'/'.$dt->month.'/'.$dt->year : '' ;
        $payroll->payroll_period_02_5 = $request->input('payroll_period_02_5');
        $payroll->payroll_period_02_5_date = $request->input('payroll_period_02_5') > 0 && $request->input('payroll_period_02_5_date') ? $dt->day.'/'.$dt->month.'/'.$dt->year : '' ;
        $payroll->save();
        return $payroll;
    }
}
