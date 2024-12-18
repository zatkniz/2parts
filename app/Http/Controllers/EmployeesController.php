<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Employee;
use App\Fund;
use App\Payroll;
use JavaScript;
use Carbon\Carbon;

class EmployeesController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('name')->get();
        return view('employees' , compact('$customers'));
    }

    public function create()
    {
        return view('employee-single');
    }

    public function newEmployee(Request $request)
    {
        $employee = Employee::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'name' => $request->input('name'),
                'surname' => $request->input('surname'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'afm' => $request->input('afm'),
                'amka' => $request->input('amka'),
                'telephone' => $request->input('telephone'),
                'telephone2' => $request->input('telephone2'),
                'bank_account' => $request->input('bank_account'),
                'position' => $request->input('position'),
                'salary' => $request->input('salary'),
                'absent_days' => $request->input('absent_days'),
                'hiring_date' => $request->input('hiring_date'),
                'firing_date' => $request->input('firing_date'),
                'active' => $request->input('active'),
                'percentage' => $request->input('percentage'),
            ]
        );
        $employee->absent_days = $request->input('absent_days');
        $employee->salary = $request->input('salary');
        $employee->salary = $request->input('salary');
        $employee->save();
        return $employee;
    }

    public function sellers() {
        return Employee::whereNotNull('percentage')->get();
    }

    public function singleEmployee(Request $request , Employee $employee)
    {
        JavaScript::put([
            'employee' => $employee,
        ]);
        $Employee = Employee::orderBy('name')->get();
        return view('employee-single' , compact(['$customers']));
    }

    public function all(Request $request)
    {
        return Employee::all();
    }

    public function employeesCustomers($employee, $month, $year)
    {

        return Employee::whereId($employee)->with(['customers' , 'customers.fundsMonthlyCount' => function ($query) use ($month,$year) {
            $query->whereMonth('created_at' ,  $month)->whereYear('created_at' ,  $year);
        } , 'customers.fundsPaysCount'  => function ($query) use ($month,$year) {
            $query->whereMonth('created_at' ,  $month)->whereYear('created_at' ,  $year);
        }])->first();
    }

    public function activeEmployees(Request $request)
    {
        return Employee::where('active' , 1)->get();
    }

    public function getOneEmployee(Employee $employee)
    {
        return $employee;
    }
}
