<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use JavaScript;
use App\Customer;
use App\Part;
use App\Fund;
use App\Balance;
use App\Outfund;;
use Carbon\Carbon;
use Event;
use App\Events\FundSaved;
use App\Events\FundUpdated;

class FundsController extends Controller
{
    public function index()
    {
        return 'view('daily-funds')';
    }

    public function pastFunds()
    {
        return view('past-funds');
    }

    public function province()
    {
        return view('province');
    }

    public function showPastFunds($date)
    {
        $dateFrom = substr( $date , 5 );  
        $dateTo = substr($date , strpos( $date , "&to=" ) + 4 );
        // return date($dateTo);
        $result = Fund::where('isOffer' , 0)->with(['customer' , 'customer.balance' , 'user' , 'lastUser'])
        ->orderBy('created_at' , 'ASC')
        ->whereBetween('created_at', [$dateFrom, $dateTo])
        ->get();

        $outfund = OutFund::with(['outcome'])
        ->orderBy('created_at' , 'ASC')
        ->whereBetween('created_at', [$dateFrom, $dateTo])
        ->get();

        $summaries = array();
        $summaries[0] = (float)Fund::where('isOffer' , 0)->whereBetween('created_at', [$dateFrom, $dateTo])
                            ->sum('cost');
        $summaries[1] = Fund::where('isOffer' , 0)->whereBetween('created_at', [$dateFrom, $dateTo])
                            ->sum('payment');
        $summaries[2] = $summaries[0] - $summaries[1];
        $summaries[3] = (float)OutFund::whereBetween('created_at', [$dateFrom, $dateTo])
                    ->sum('total');;

        JavaScript::put([
            'result' => $result,
            'outfund' => $outfund,
            'summaries' => $summaries,
        ]);
        return view('past-funds-result' , compact('result'));
    }

    public function showPastFundsResult($date)
    {
        $dateFrom = substr( $date , 5 );  
        $dateTo = substr($date , strpos( $date , "&to=" ) + 4 );
        // return date($dateTo);
        $result = Fund::where('isOffer' , 0)->with(['customer' , 'customer.balance' , 'user' , 'lastUser'])
        ->orderBy('created_at' , 'ASC')
        ->whereBetween('created_at', [$dateFrom, $dateTo])
        ->get();

        $outfund = OutFund::with(['outcome'])
        ->orderBy('created_at' , 'ASC')
        ->whereBetween('created_at', [$dateFrom, $dateTo])
        ->get();

        $summaries = array();
        $summaries[0] = (float)Fund::where('isOffer' , 0)->whereBetween('created_at', [$dateFrom, $dateTo])
                            ->sum('cost');
        $summaries[1] = Fund::where('isOffer' , 0)->whereBetween('created_at', [$dateFrom, $dateTo])
                            ->sum('payment');
        $summaries[2] = $summaries[0] - $summaries[1];
        $summaries[3] = (float)OutFund::whereBetween('created_at', [$dateFrom, $dateTo])
                    ->sum('total');;

        JavaScript::put([
            'result' => $result,
            'outfund' => $outfund,
            'summaries' => $summaries,
        ]);
        return $result;
        return view('past-funds-result' , compact('result'));
    }

    public function showPastOutFundsResult($date)
    {
        $dateFrom = substr( $date , 5 );  
        $dateTo = substr($date , strpos( $date , "&to=" ) + 4 );
        // return date($dateTo);
        $result = Fund::where('isOffer' , 0)->with(['customer' , 'customer.balance' , 'user' , 'lastUser'])
        ->orderBy('created_at' , 'ASC')
        ->whereBetween('created_at', [$dateFrom, $dateTo])
        ->get();

        $outfund = OutFund::with(['outcome'])
        ->orderBy('created_at' , 'ASC')
        ->whereBetween('created_at', [$dateFrom, $dateTo])
        ->get();

        $summaries = array();
        $summaries[0] = (float)Fund::where('isOffer' , 0)->whereBetween('created_at', [$dateFrom, $dateTo])
                            ->sum('cost');
        $summaries[1] = Fund::where('isOffer' , 0)->whereBetween('created_at', [$dateFrom, $dateTo])
                            ->sum('payment');
        $summaries[2] = $summaries[0] - $summaries[1];
        $summaries[3] = (float)OutFund::whereBetween('created_at', [$dateFrom, $dateTo])
                    ->sum('total');;

        JavaScript::put([
            'result' => $result,
            'outfund' => $outfund,
            'summaries' => $summaries,
        ]);
        return $outfund;
        return view('past-funds-result' , compact('result'));
    }

    public function email()
    {
        return view('email.invoice');
    }

    public function createNewCustomer(Request $request)
    {
        $customer = new Customer;
        $customer->name = $request->input('name');
        $customer->active = 1;
        $customer->save();

        $balance = Balance::firstOrCreate(
            ['customer_id' => $customer->id],
            ['balance' => 0]
        );

        return $customer;
    }

    public function createNewPart(Request $request)
    {
        $part = Part::firstOrCreate(
            ['name' => $request->input('name')]
        );
        return $part;
    }
    
    public function all(Request $request)
    {
        return Fund::where('isOffer' , 0)->with(['customer' , 'customer.balance' , 'user' , 'lastUser' , 'delivery'])
                    ->orderBy('created_at' , 'ASC')
                    ->where('created_at', '>=', Carbon::today())
                    ->where('isOffer' , 0)
                    ->get();
    }

    public function offers(Request $request)
    {
        return Fund::with(['customer' , 'customer.balance' , 'user' , 'lastUser'])
                    ->orderBy('created_at' , 'ASC')
                    ->where('isOffer' , 1)
                    ->get();
    }

    public function allProvince(Request $request)
    {
        return Fund::where('isOffer' , 0)->with(['customer' , 'customer.balance' , 'user' , 'lastUser'])
                    ->orderBy('created_at' , 'ASC')
                    ->where('isProvince', '=', '1')
                    ->whereRaw('cost > payment and (cost > deposit or deposit is null)')
                    // ->whereRaw('cost > deposit')
                    ->get();
    }

    public function summaries(Request $request)
    {
        $result = array();
        $result[0] =  number_format((float)Fund::where('isOffer' , 0)->where('created_at', '>=', Carbon::today())
                            ->where('isOffer' , 0)
                            ->sum('cost'), 2, '.', '');
        $result[1] = Fund::where('isOffer' , 0)->where('created_at', '>=', Carbon::today())
                            ->where('isOffer' , 0)
                            ->sum('payment');
        $result[2] = $result[0] - $result[1];
        $result[3] = number_format((float)OutFund::where('created_at', '>=', Carbon::today())
                    ->sum('total'), 2, '.', '');
        $result[4] =  number_format((float)Fund::where('isBank' , 0)->where('created_at', '>=', Carbon::today())
                    ->where('isOffer' , 0)
                    ->sum('payment'), 2, '.', '');
        $result[5] =  number_format((float)Fund::where('isBank' , 1)->where('created_at', '>=', Carbon::today())
                    ->where('isOffer' , 0)
                    ->sum('payment'), 2, '.', '');
        $result[6] = Fund::where('isOffer' , 0)->where('created_at', '>=', Carbon::today())
                    ->where('price' , '>' , 0)
                    ->where('credit' , null)
                    ->count();
        $result[1] = number_format( $result[1], 2, '.', '');
        return $result;
    }

    public function saveFund(Request $request)
    {
        $fund = new Fund;
        $fund->fund_code = Carbon::now()->year.Carbon::now()->month.Carbon::now()->day.'-';
        $fund->body = $request->input('body');
        $fund->parts_codes = $request->input('parts_codes');
        $fund->car_model = $request->input('car_model');
        $fund->cars = $request->input('cars');
        $fund->price = $request->input('price');
        $fund->cost = $request->input('cost');
        $fund->total = $request->input('total');
        $fund->payment = $request->input('payment');
        $fund->customer_id = $request->input('customer_id');
        $fund->delivery_id = $request->input('delivery_id');
        $fund->isProvince = $request->input('isProvince');
        $fund->provinceCode = $request->input('provinceCode');
        $fund->provinceWay = $request->input('provinceWay');
        $fund->user_id = Auth::user()->id;
        $fund->last_user_id = Auth::user()->id;
        $fund->isReceipt = $request->input('isReceipt');
        $fund->isInvoice = $request->input('isInvoice');
        $fund->hasPay = $request->input('hasPay');
        $fund->comments = $request->input('comments');
        $fund->isOffer = $request->input('isOffer');
        $fund->isBank = $request->input('isBank');        
        $fund->credit = $request->input('creditPrice');
        $fund->created_at = Carbon::createFromDate( $request->input('pastDate')[2], $request->input('pastDate')[1], $request->input('pastDate')[0]);
        $fund->save();
        $fund->fund_code = Carbon::parse($fund->created_at)->year.Carbon::parse($fund->created_at)->month.Carbon::parse($fund->created_at)->day.'-'.$fund->id;
        $fund->save();
        $balance = Balance::firstOrNew(
            ['customer_id' => $request->input('customer_id')]
        );
        if($request->input('customer_id') != 1){
            $balance->balance = Fund::where('isOffer' , 0)->where('customer_id' , $request->input('customer_id'))->where('isOffer' , 0)->sum('cost') - Fund::where('isOffer' , 0)->where('customer_id' , $request->input('customer_id'))->where('isOffer' , 0)->sum('payment') - Fund::where('isOffer' , 0)->where('customer_id' , $request->input('customer_id'))->where('isOffer' , 0)->sum('credit');
        }
        $balance->save();
        broadcast(new FundSaved());
        
        return Fund::whereId($fund->id)->with(['customer' , 'customer.balance' , 'user' , 'lastUser' , 'delivery'])
                                        ->first();
    }

    public function updateFund(Request $request , Fund $fund)
    {
        $fund->body = $request->input('body');
        $fund->parts_codes = $request->input('parts_codes');
        $fund->car_model = $request->input('car_model');
        $fund->cars = $request->input('cars');
        $fund->price = $request->input('price');
        $fund->cost = $request->input('cost');
        $fund->total = $request->input('total');
        $fund->credit = $request->input('creditPrice');
        $fund->comments = $request->input('comments');
        $fund->isOffer = $request->input('isOffer');
        $fund->isBank = $request->input('isBank');
        if($request->input('isProvince') == 0){
            $fund->payment = $request->input('payment');
        }
        if($request->input('isProvince') == 1 && Carbon::parse($request->input('created_at'))->format('d/m/Y') == Carbon::parse(Carbon::now())->format('d/m/Y')){
            $fund->payment = $request->input('payment');
        }else if($request->input('isProvince') == 1 && Carbon::parse($request->input('created_at'))->format('d/m/Y') != Carbon::parse(Carbon::now())->format('d/m/Y')){
            $fund->deposit = $fund->deposit + $request->input('payment');
            $newFund = new Fund;
            $newFund->body = 'Είσπραξη Αντικαταβολής';
            $newFund->parts_codes = $request->input('parts_codes');
            $newFund->car_model = $request->input('car_model');
            $newFund->cars = $request->input('cars');
            $newFund->payment = $request->input('payment');
            $newFund->price = 0;
            $newFund->cost = 0;
            $newFund->user_id = Auth::user()->id;
            $newFund->total = $request->input('total');
            $newFund->last_user_id = Auth::user()->id;
            $newFund->customer_id = $request->input('customer_id');
            $newFund->isReceipt = $request->input('isReceipt');
            $newFund->isInvoice = $request->input('isInvoice');
            $newFund->isProvince = $request->input('isProvince');
            $newFund->provinceCode = $request->input('provinceCode');
            $newFund->provinceWay = $request->input('provinceWay');
            $newFund->hasPay = $request->input('hasPay');
            $newFund->fund_code = Carbon::now()->year.Carbon::now()->month.Carbon::now()->day.'-'.$fund->id;
            $newFund->updated_at = Carbon::now();
            $newFund->created_at = Carbon::now();
            $newFund->save();
        }
        $fund->last_user_id = Auth::user()->id;
        $fund->customer_id = $request->input('customer_id');
        $fund->delivery_id = $request->input('delivery_id');
        $fund->isReceipt = $request->input('isReceipt');
        $fund->isInvoice = $request->input('isInvoice');
        $fund->isProvince = $request->input('isProvince');
        $fund->provinceCode = $request->input('provinceCode');
        $fund->provinceWay = $request->input('provinceWay');
        $fund->hasPay = $request->input('hasPay');
        $fund->fund_code = Carbon::now()->year.Carbon::now()->month.Carbon::now()->day.'-'.$fund->id;
        $fund->updated_at = Carbon::now();
        // if($request->input('isProvince') == 1 && $request->input('payment') == $request->input('cost')){
        //     $newFund = new Fund;
        //     $newFund->body = 'Είσπραξη Αντικαταβολής';
        //     $newFund->parts_codes = $request->input('parts_codes');
        //     $newFund->car_model = $request->input('car_model');
        //     $newFund->cars = $request->input('cars');
        //     $newFund->price = 0;
        //     $newFund->cost = 0;
        //     $newFund->user_id = Auth::user()->id;
        //     $newFund->total = $request->input('total');
        //     $newFund->payment = $request->input('payment');
        //     $newFund->last_user_id = Auth::user()->id;
        //     $newFund->customer_id = $request->input('customer_id');
        //     $newFund->isReceipt = $request->input('isReceipt');
        //     $newFund->isInvoice = $request->input('isInvoice');
        //     $newFund->isProvince = $request->input('isProvince');
        //     $newFund->provinceCode = $request->input('provinceCode');
        //     $newFund->provinceWay = $request->input('provinceWay');
        //     $newFund->hasPay = $request->input('hasPay');
        //     $newFund->fund_code = Carbon::now()->year.Carbon::now()->month.Carbon::now()->day.'-'.$fund->id;
        //     $newFund->updated_at = Carbon::now();
        //     $newFund->created_at = Carbon::now();
        //     $newFund->save();
        // }
        $fund->save();
        $balance = Balance::firstOrNew(
            ['customer_id' => $request->input('customer_id')]
        );
        if($request->input('customer_id') != 1){
        $balance->balance = Fund::where('isOffer' , 0)->where('customer_id' , $request->input('customer_id'))->where('isOffer' , 0)->sum('cost') - Fund::where('isOffer' , 0)->where('customer_id' , $request->input('customer_id'))->where('isOffer' , 0)->sum('payment') - Fund::where('isOffer' , 0)->where('customer_id' , $request->input('customer_id'))->where('isOffer' , 0)->sum('credit');
        }
        $balance->save();
        broadcast(new FundSaved())->toOthers();
        
        // FundUpdated
        // event(new FundUpdated());

        return $balance;
    }

    public function deleteFund(Request $request , Fund $fund )
    {
        $fund->delete();
        $balance = Balance::firstOrNew(
            ['customer_id' => $request->input('customer_id')]
        );
        if($request->input('customer_id') != 1){
            $balance->balance = Fund::where('isOffer' , 0)->where('customer_id' , $request->input('customer_id'))->where('isOffer' , 0)->sum('cost') - Fund::where('isOffer' , 0)->where('customer_id' , $request->input('customer_id'))->where('isOffer' , 0)->sum('payment') - Fund::where('isOffer' , 0)->where('customer_id' , $request->input('customer_id'))->where('isOffer' , 0)->sum('credit');
        }
        $balance->save();
        broadcast(new FundSaved())->toOthers();
        return 'success';
    }

    public function mergeFunds(Request $request , Fund $startedCustomer , Fund $finishedCustomer )
    {
        $startedCustomer->body = $startedCustomer->body.','.$finishedCustomer->body;
        $startedCustomer->price = $startedCustomer->price.'%'.$finishedCustomer->price;                              
        $startedCustomer->cars = $startedCustomer->cars.','.$finishedCustomer->cars;                              
        $startedCustomer->parts_codes = $startedCustomer->parts_codes.'%'.$finishedCustomer->parts_codes;                              
        $startedCustomer->cost = $startedCustomer->cost + $finishedCustomer->cost;                              
        $startedCustomer->payment = $startedCustomer->payment + $finishedCustomer->payment;                              
        $startedCustomer->total = $startedCustomer->total + $finishedCustomer->total;                                                         
        $startedCustomer->car_model = $startedCustomer->car_model.','.$finishedCustomer->car_model;   
        $startedCustomer->save();    
        $finishedCustomer->delete();                       
        return $startedCustomer->body;
    }



    public function sendMail(Request $request , Fund $fund )
    {
        $customer = Customer::find($fund->customer_id);
        $customer->email = $request->input('customer.email');
        $customer->save();
        Mail::send('email.invoice', ['fund' => $fund], function ($m) use ($fund , $customer) {
            $m->from('info@2-parts.gr', 'Παρραγελία από 2-parts');

            $m->to($customer->email)->subject('Κωδικός Παρραγελίας: ' . $fund->fund_code );
        });
        return $customer->email;
    }

    public function findCustomer(Request $request , Customer $customer )
    {
        return $customer;
    }

    public function findPart(Request $request , Part $part )
    {
        return $part;
    }

    public function quickEditCustomer(Request $request , Customer $customer )
    {
        $customer->name = $request->input('name');
        $customer->save();
        return $customer;
    }

    public function quickDeleteCustomer(Request $request , Customer $customer )
    {
        $customer->name = $request->input('name');
        $customer->delete();
        return $customer;
    }

    public function quickEditPart(Request $request , Part $part )
    {
        $part->name = $request->input('name');
        $part->save();
        return $part;
    }

    public function quickDeletePart(Request $request , Part $part )
    {
        $part->name = $request->input('name');
        $part->delete();
        return $part;
    }

    public function single($searchQuery)
    {
        $result = Fund::where('isOffer' , 0)->with(['customer' , 'customer.balance' , 'user' , 'lastUser'])
        ->orderBy('created_at' , 'ASC')
        ->where('fund_code', $searchQuery)
        ->first();
        JavaScript::put([
            'result' => $result
        ]);
        return view('search' , compact('result'));
    }

    public function singleResult($searchQuery)
    {
        return Fund::where('isOffer' , 0)->with(['customer' , 'customer.balance' , 'user' , 'lastUser'])
        ->where('fund_code', $searchQuery)
        ->orderBy('created_at' , 'ASC')
        ->get();
    }

        
    public function prints(Request $request)
    {
        return view('print');
    }

    public function sellerPrints(Request $request)
    {
        return view('seller-print');
    }

    public function employersStatistics(Request $request)
    {
        return view('employers-statistics');
    }

    public function weeklyPrints(Request $request)
    {
        return Customer::where('id' , '!=' , '1')->where('active' , '1')->orderBy('name')->get();
    }

    public function weeklyPrintsWithMonth(Request $request)
    {
        if($request->input('date') != ''){
            $dt = Carbon::createFromFormat('d/m/Y', '01/'.$request->input('date'));
        }else{
            $dt = Carbon::parse(Carbon::today());
        }
        return Customer::whereHas('printCustomersfunds' , function ($query) use ($dt) {
                                    $query->whereMonth('created_at', '=' , $dt->month );
                                    $query->whereYear('created_at' , '=' , $dt->year );
                                })
                        ->with(['printCustomersfunds' =>  function ($query) use ($dt) {
                            $query->whereMonth('created_at', '=' , $dt->month );
                            $query->whereYear('created_at' , '=' , $dt->year );
                         },'balance'])  
                        ->orderBy('name')      
                        ->get();
    }
}
