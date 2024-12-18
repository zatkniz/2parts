<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Fund;
use App\Employee;
use JavaScript;
use Carbon\Carbon;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('name')->get();
        return view('customers' , compact('$customers'));
    }

    public function all()
    {
        return Customer::orderBy('name')->where('active' , 1)->get();
    }

    public function detailed()
    {   
        return Customer::with(['balance' , 'fundsCount' , 'lastFund' , 'fundsDailyCount' , 'fundsMonthlyCount' ,'fundsYearCount' , 'fundsWeeklyCount' ])
                        ->where('active' , '=' , 1 )
                        ->orderBy('name')
                        ->get();
    }

    public function quickSearch(Request $request)
    {
        return Customer::where('name' , 'like' , '%'.$request->input('name').'%')->get();
    }
    
    public function singleCustomer(Request $request , Customer $id)
    {
        $result = $id;
        $stats = Customer::with(['balance' , 'fundsCount' , 'lastFund' , 'fundsDailyCount' , 'fundsMonthlyCount' ,'fundsYearCount' , 'fundsWeeklyCount' ])->where('id' , $id->id)->get();
        $funds =  Fund::where('isOffer' , 0)->with(['customer' , 'customer.balance' , 'user' , 'lastUser'])
                        ->orderBy('created_at' , 'DESC')
                        ->where('customer_id', '=', $id->id)
                        ->get();
        $summaries = array();
        $summaries[0] = (float)Fund::where('isOffer' , 0)->where('customer_id', '=', $id->id)
                            ->sum('cost');
                            $summaries[1] = (float)Fund::where('isOffer' , 0)->where('customer_id', '=', $id->id)
                            ->sum('payment');
                            $summaries[2] = $result[0] - $result[1];
        $employees = Employee::whereActive(1)->get();
        JavaScript::put([
            'result' => $result,
            'stats' => $stats,
            'funds' => $funds,
            'summaries' => $summaries,
            'employees' => $employees,
        ]);
        return view('customers-single' , compact(['result']));
    }

    public function singleCustomerResult(Request $request , Customer $id)
    {
        $result = $id;
        $stats = Customer::with(['balance' , 'fundsCount' , 'lastFund' , 'fundsDailyCount' , 'fundsMonthlyCount' ,'fundsYearCount' , 'fundsWeeklyCount' ])->where('id' , $id->id)->get();
        $funds =  Fund::where('isOffer' , 0)->with(['customer' , 'customer.balance' , 'user' , 'lastUser' , 'delivery'])
        ->orderBy('created_at' , 'DESC')
                        ->where('customer_id', '=', $id->id)
                        ->get();
        $summaries = array();
        $summaries[0] = (float)Fund::where('isOffer' , 0)->where('customer_id', '=', $id->id)
                            ->sum('cost');
                            $summaries[1] = (float)Fund::where('isOffer' , 0)->where('customer_id', '=', $id->id)
                            ->sum('payment');
                            $summaries[2] = $result[0] - $result[1];
        JavaScript::put([
            'result' => $result,
            'stats' => $stats,
            'funds' => $funds,
            'summaries' => $summaries,
        ]);
        return $funds;
    }
    

    public function singleCustomerWithPastFunds(Request $request , Customer $id , $date)
    {
        $dateFrom = substr( $date , 5 );  
        $dateTo = substr($date , strpos( $date , "&to=" ) + 4 );
        $result = $id;
        $stats = Customer::with(['balance' , 'fundsCount' , 'lastFund' , 'fundsDailyCount' , 'fundsMonthlyCount' ,'fundsYearCount' , 'fundsWeeklyCount' ])->where('id' , $id->id)->get();
        $funds =  Fund::where('isOffer' , 0)->with(['customer' , 'customer.balance' , 'user' , 'lastUser'])
                        ->orderBy('created_at' , 'DESC')
                        ->where('customer_id', '=', $id->id)
                        ->whereBetween('created_at', [$dateFrom, $dateTo])
                        ->get();

        $summaries = array();
        $summaries[0] = (float)Fund::where('isOffer' , 0)->where('customer_id', '=', $id->id)
                        ->whereBetween('created_at', [$dateFrom, $dateTo])
                            ->sum('cost');
        $summaries[1] = (float)Fund::where('isOffer' , 0)->where('customer_id', '=', $id->id)
                        ->whereBetween('created_at', [$dateFrom, $dateTo])
                            ->sum('payment');
        $summaries[2] = $result[0] - $result[1];
        JavaScript::put([
            'result' => $result,
            'stats' => $stats,
            'funds' => $funds,
            'summaries' => $summaries,
        ]);
        return view('customers-single' , compact(['result']));
    }

    public function singleCustomerWithPastFundsResult(Request $request , Customer $id , $date)
    {
        $dateFrom = substr( $date , 5 );  
        $dateTo = substr($date , strpos( $date , "&to=" ) + 4 );
        $result = $id;
        $stats = Customer::with(['balance' , 'fundsCount' , 'lastFund' , 'fundsDailyCount' , 'fundsMonthlyCount' ,'fundsYearCount' , 'fundsWeeklyCount' ])->where('id' , $id->id)->get();
        $funds =  Fund::where('isOffer' , 0)->with(['customer' , 'customer.balance' , 'user' , 'lastUser'])
                        ->orderBy('created_at' , 'DESC')
                        ->where('customer_id', '=', $id->id)
                        ->whereBetween('created_at', [$dateFrom, $dateTo])
                        ->get();

        $summaries = array();
        $summaries[0] = (float)Fund::where('isOffer' , 0)->where('customer_id', '=', $id->id)
                        ->whereBetween('created_at', [$dateFrom, $dateTo])
                            ->sum('cost');
        $summaries[1] = (float)Fund::where('isOffer' , 0)->where('customer_id', '=', $id->id)
                        ->whereBetween('created_at', [$dateFrom, $dateTo])
                            ->sum('payment');
        $summaries[2] = $result[0] - $result[1];
        JavaScript::put([
            'result' => $result,
            'stats' => $stats,
            'funds' => $funds,
            'summaries' => $summaries,
        ]);
        return $funds;
    }
    
    public function saveCustomer(Request $request , Customer $id)
    {
        $result = $id;
        JavaScript::put([
            'result' => $result,
            ]);
        return view('customers-single' , compact(['result']));
    }

    public function saveSingleCustomer(Request $request , Customer $customer)
    {
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->address = $request->input('address');
        $customer->afm = $request->input('afm');
        $customer->tel = $request->input('tel');
        $customer->tel2 = $request->input('tel2');
        $customer->mobile = $request->input('mobile');
        $customer->fax = $request->input('fax');
        $customer->doy = $request->input('doy');
        $customer->brand = $request->input('brand');
        $customer->employee_id = $request->input('employee_id');
        $customer->incharge = $request->input('incharge');
        $customer->state = $request->input('state');
        $customer->job = $request->input('job');
        $customer->active = $request->input('active');
        $customer->limit = $request->input('limit');
        $customer->save();
        return [$request->input() , $customer];
    }
}
