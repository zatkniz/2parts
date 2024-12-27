<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Part;
use App\Models\Fund;
use App\Models\Cash;
use App\Models\Balance;
use App\Models\Frame;
use App\Models\Outfund;;
use Carbon\Carbon;
use Event;
use App\Events\FundSaved;
use App\Events\FundUpdated;
use App\Http\Controllers\OutcomesController;

class FundsController extends Controller
{
    public function index(Request $request)
    {
		$outcomesController = new OutcomesController();

        return [
            'funds' => $this->all($request),
            'summaries' => $this->summaries($request),
            'dailyCash' => $this->dailyCash(),
            'outfunds' => $outcomesController->all($request),
        ];
    }
	
	public function getDailyFunds()
    {
		$outcomesController = new OutcomesController();

        return [
            'funds' => $this->all($request),
            'summaries' => $this->summaries($request),
            'dailyCash' => $this->dailyCash(),
            'outfunds' => $outcomesController->all($request),
        ];
    }

    public function pastFunds()
    {
        return view('past-funds');
    }

    public function province()
    {
        return view('province');
    }

    public function dailyCash() {
        $outfunds = (float)OutFund::where('created_at', '>=', Carbon::today())
                    ->where(function($q) {
                        $q->where('is_bank', 0)
                        ->orWhereNull('is_bank');
                    })
                    ->sum('total');
                    
        $funds = (float)Fund::where('isOffer' , 0)
                    ->where('isBank', 0)
                    ->where('created_at', '>=', Carbon::today())
                    ->sum('payment');

        $cash = Cash::where('created_at', '>=', Carbon::today())->first();

        return (isset($cash['amount']) ? $cash['amount'] : 0) + ($funds - $outfunds) ;
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

        $data = [
            'result' => $result,
            'outfund' => $outfund,
            'summaries' => $summaries,
        ];

        return response()->json($data);
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

        return $customer->id;
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
        $query = "
            SELECT funds.*, 
                   customers.name as customer_name, 
                   customers.email as customer_email, 
                   customers.address as customer_address, 
                   customers.created_at as customer_created_at, 
                   customers.updated_at as customer_updated_at, 
                   customers.afm as customer_afm, 
                   customers.tel as customer_tel, 
                   customers.tel2 as customer_tel2, 
                   customers.mobile as customer_mobile, 
                   customers.fax as customer_fax, 
                   customers.doy as customer_doy, 
                   customers.brand as customer_brand, 
                   customers.incharge as customer_incharge, 
                   customers.state as customer_state, 
                   customers.job as customer_job, 
                   customers.active as customer_active, 
                   customers.employee_id as customer_employee_id, 
                   customers.limit as customer_limit, 
                   balances.id as balance_id, 
                   balances.customer_id as balance_customer_id, 
                   balances.balance as balance_balance, 
                   balances.created_at as balance_created_at, 
                   balances.updated_at as balance_updated_at, 
                   users.id as user_id, 
                   users.name as user_name, 
                   users.email as user_email, 
                   users.username as user_username, 
                   users.created_at as user_created_at, 
                   users.updated_at as user_updated_at, 
                   users.role as user_role, 
                   users.active as user_active, 
                   last_users.id as last_user_id, 
                   last_users.name as last_user_name, 
                   last_users.email as last_user_email, 
                   last_users.username as last_user_username, 
                   last_users.created_at as last_user_created_at, 
                   last_users.updated_at as last_user_updated_at, 
                   last_users.role as last_user_role, 
                   last_users.active as last_user_active,
				   frames.name as frame_name
            FROM funds
            LEFT JOIN customers ON funds.customer_id = customers.id
            LEFT JOIN balances ON customers.id = balances.customer_id
            LEFT JOIN users ON funds.user_id = users.id
			LEFT JOIN frames ON funds.frame_id = frames.id
            LEFT JOIN users as last_users ON funds.last_user_id = last_users.id
            WHERE funds.isOffer = 1
            AND funds.created_at >= ?
            ORDER BY funds.created_at ASC
        ";
    
        $funds = \DB::select($query, [Carbon::now()->subMonths(2)]);
    
        $transformedFunds = collect($funds)->map(function ($fund) {
            return [
                'id' => $fund->id,
                'fund_code' => $fund->fund_code,
                'body' => $fund->body,
                'earnings' => $fund->earnings,
                'saved_body' => $fund->saved_body,
                'parts_codes' => $fund->parts_codes,
                'parts_places' => $fund->parts_places,
                'price' => $fund->price,
                'saved_price' => $fund->saved_price,
                'cars' => $fund->cars,
                'cost' => $fund->cost,
                'car_model' => $fund->car_model,
                'payment' => $fund->payment,
                'total' => $fund->total,
                'user_id' => $fund->user_id,
                'last_user_id' => $fund->last_user_id,
                'customer_id' => $fund->customer_id,
                'isInvoice' => $fund->isInvoice,
                'isReceipt' => $fund->isReceipt,
                'hasPay' => $fund->hasPay,
                'created_at' => $fund->created_at,
                'updated_at' => $fund->updated_at,
                'isProvince' => $fund->isProvince,
                'provinceCode' => $fund->provinceCode,
                'provinceWay' => $fund->provinceWay,
                'deposit' => $fund->deposit,
                'credit' => $fund->credit,
                'isOffer' => $fund->isOffer,
                'comments' => $fund->comments,
                'isBank' => $fund->isBank,
                'delivery_id' => $fund->delivery_id,
                'bank_id' => $fund->bank_id,
                'frame_id' => $fund->frame_id,
                'frame' => [
                    'id' => $fund->frame_id,
                    'name' => $fund->frame_name,
                    // 'model' => $fund->frame_model,
                    // 'year' => $fund->frame_year,
                    // 'created_at' => $fund->frame_created_at,
                    // 'updated_at' => $fund->frame_updated_at,
                ],
                'customer' => [
                    'id' => $fund->customer_id,
                    'name' => $fund->customer_name,
                    'email' => $fund->customer_email,
                    'address' => $fund->customer_address,
                    'created_at' => $fund->customer_created_at,
                    'updated_at' => $fund->customer_updated_at,
                    'afm' => $fund->customer_afm,
                    'tel' => $fund->customer_tel,
                    'tel2' => $fund->customer_tel2,
                    'mobile' => $fund->customer_mobile,
                    'fax' => $fund->customer_fax,
                    'doy' => $fund->customer_doy,
                    'brand' => $fund->customer_brand,
                    'incharge' => $fund->customer_incharge,
                    'state' => $fund->customer_state,
                    'job' => $fund->customer_job,
                    'active' => $fund->customer_active,
                    'employee_id' => $fund->customer_employee_id,
                    'limit' => $fund->customer_limit,
                    'balance' => [
                        'id' => $fund->balance_id,
                        'customer_id' => $fund->balance_customer_id,
                        'balance' => $fund->balance_balance,
                        'created_at' => $fund->balance_created_at,
                        'updated_at' => $fund->balance_updated_at,
                    ],
                ],
                'user' => [
                    'id' => $fund->user_id,
                    'name' => $fund->user_name,
                    'email' => $fund->user_email,
                    'username' => $fund->user_username,
                    'created_at' => $fund->user_created_at,
                    'updated_at' => $fund->user_updated_at,
                    'role' => $fund->user_role,
                    'active' => $fund->user_active,
                ],
                'last_user' => [
                    'id' => $fund->last_user_id,
                    'name' => $fund->last_user_name,
                    'email' => $fund->last_user_email,
                    'username' => $fund->last_user_username,
                    'created_at' => $fund->last_user_created_at,
                    'updated_at' => $fund->last_user_updated_at,
                    'role' => $fund->last_user_role,
                    'active' => $fund->last_user_active,
                ],
            ];
        });

        $transformedFunds = collect($transformedFunds) ->groupBy(function ($item, $key) {
            return $item['customer']['name'];
        });
    
        return response()->json($transformedFunds);
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

    public function customerSummaries ($customer) {
        $result = array();
        $result[0] =  number_format((float)Fund::where('isOffer' , 0)
                            ->where('customer_id', $customer)
                            ->where('isOffer' , 0)
                            ->sum('cost'), 2, '.', '');
        $result[1] = Fund::where('isOffer' , 0)
                            ->where('customer_id', $customer)
                            ->where('isOffer' , 0)
                            ->sum('payment');
        $result[2] = $result[0] - $result[1];
        $result[3] = number_format((float)OutFund::where('created_at', '>=', Carbon::today())
                    ->sum('total'), 2, '.', '');
        $result[7] = number_format((float)OutFund::where('created_at', '>=', Carbon::today())
                    ->where('is_bank' , 1)->sum('total'), 2, '.', '');
        $result[8] = number_format((float)OutFund::where('created_at', '>=', Carbon::today())
                    ->where(function($query) {
                        return $query->where('is_bank' , 0)
                                ->orWhereNull('is_bank');
                    })
                    ->sum('total'), 2, '.', '');
        $result[4] =  number_format((float)Fund::where('isBank' , 0)
                    ->where('isOffer' , 0)
                    ->where('customer_id', $customer)
                    ->sum('payment'), 2, '.', '');
        $result[5] =  number_format((float)Fund::where('isBank' , 1)
                    ->where('isOffer' , 0)
                    ->where('customer_id', $customer)
                    ->sum('payment'), 2, '.', '');
        $result[6] = Fund::where('isOffer' , 0)
                    ->where('price' , '>' , 0)
                    ->where('credit' , null)
                    ->where('customer_id', $customer)
                    ->count();
        $result[1] = number_format( $result[1], 2, '.', '');
        return $result;
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
        $result[7] = number_format((float)OutFund::where('created_at', '>=', Carbon::today())
                    ->where('is_bank' , 1)->sum('total'), 2, '.', '');
        $result[8] = number_format((float)OutFund::where('created_at', '>=', Carbon::today())
                    ->where(function($query) {
                        return $query->where('is_bank' , 0)
                                ->orWhereNull('is_bank');
                    })
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
        $fund->saved_body = $request->input('saved_body');
        $fund->earnings = $request->input('earnings');
        $fund->parts_codes = $request->input('parts_codes');
        $fund->parts_places = $request->input('parts_places');
        $fund->car_model = $request->input('car_model');
        $fund->cars = $request->input('cars');
        $fund->price = $request->input('price');
        $fund->saved_price = $request->input('saved_price');
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
        $fund->bank_id = $request->input('bank_id');       
        $fund->credit = $request->input('creditPrice');

        if($request->has('pastDate')){
            $fund->created_at = Carbon::createFromDate($request->input('pastDate'));
        }
        // $fund->created_at = Carbon::createFromDate( $request->input('pastDate')[2], $request->input('pastDate')[1], $request->input('pastDate')[0]);
        $fund->save();
        $fund->fund_code = Carbon::parse($fund->created_at)->year.Carbon::parse($fund->created_at)->month.Carbon::parse($fund->created_at)->day.'-'.$fund->id;
        $fund->save();
        
        $frame_item = $request->input('frame');
        $frame = Frame::updateOrCreate(
            ['id' => isset($frame_item['id']) ? $frame_item['id'] : null],
            [
                'name' => isset($frame_item['name']) ? $frame_item['name'] : null,
                'car_number' => isset($frame_item['car_number']) ? $frame_item['car_number'] : null,
                'brand' => isset($frame_item['brand']) ? $frame_item['brand'] : null,
                'model' => isset($frame_item['model']) ? $frame_item['model'] : null,
                'year' => isset($frame_item['year']) ? Carbon::create($frame_item['year'])->toDateTimeString() : null,
            ]
        );

        $fund->frame()->associate($frame);
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
        if($fund->isOffer && !$request->input('isOffer')) {
            $fund->updated_at = Carbon::now();
            $fund->created_at = Carbon::now();
        }

        $fund->body = $request->input('body');
        $fund->saved_body = $request->input('saved_body');
        $fund->earnings = $request->input('earnings');
        $fund->parts_codes = $request->input('parts_codes');
        $fund->parts_places = $request->input('parts_places');
        $fund->car_model = $request->input('car_model');
        $fund->cars = $request->input('cars');
        $fund->price = $request->input('price');
        $fund->saved_price = $request->input('saved_price');
        $fund->cost = $request->input('cost');
        $fund->total = $request->input('total');
        $fund->credit = $request->input('creditPrice');
        $fund->comments = $request->input('comments');
        $fund->isOffer = $request->input('isOffer');
        $fund->isBank = $request->input('isBank');
        $fund->bank_id = $request->input('bank_id');       
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
            $newFund->parts_places = $request->input('parts_places');
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

        $frame_item = $request->input('frame');
        $frame = Frame::updateOrCreate(
            ['id' => isset($frame_item['id']) ? $frame_item['id'] : null],
            [
                'name' => isset($frame_item['name']) ? $frame_item['name'] : null,
                'car_number' => isset($frame_item['car_number']) ? $frame_item['car_number'] : null,
                'brand' => isset($frame_item['brand']) ? $frame_item['brand'] : null,
                'model' => isset($frame_item['model']) ? $frame_item['model'] : null,
                'year' => isset($frame_item['year']) ? Carbon::create($frame_item['year'])->toDateTimeString() : null,
            ]
        );

        $fund->frame()->associate($frame);
        $fund->save();

        $balance = Balance::firstOrNew(
            ['customer_id' => $request->input('customer_id')]
        );
        if($request->input('customer_id') != 1){
        $balance->balance = Fund::where('isOffer' , 0)->where('customer_id' , $request->input('customer_id'))->where('isOffer' , 0)->sum('cost') - Fund::where('isOffer' , 0)->where('customer_id' , $request->input('customer_id'))->where('isOffer' , 0)->sum('payment') - Fund::where('isOffer' , 0)->where('customer_id' , $request->input('customer_id'))->where('isOffer' , 0)->sum('credit');
        }
        $balance->save();
        broadcast(new FundSaved());
        
        // FundUpdated
        // event(new FundUpdated());

        return Fund::whereId($fund->id)->with(['customer' , 'customer.balance' , 'user' , 'lastUser' , 'delivery'])->first();
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
        broadcast(new FundSaved());
        return 'success';
    }

    public function mergeFunds(Request $request , Fund $startedCustomer , Fund $finishedCustomer )
    {
        $startedCustomer->body = $startedCustomer->body.','.$finishedCustomer->body;
        $startedCustomer->body = $startedCustomer->saved_body.','.$finishedCustomer->saved_body;
        $startedCustomer->earnings = $startedCustomer->earnings.','.$finishedCustomer->earnings;
        $startedCustomer->price = $startedCustomer->price.'%'.$finishedCustomer->price;                              
        $startedCustomer->saved_price = $startedCustomer->saved_price.'%'.$finishedCustomer->saved_price;                              
        $startedCustomer->cars = $startedCustomer->cars.','.$finishedCustomer->cars;                              
        $startedCustomer->parts_codes = $startedCustomer->parts_codes.'%'.$finishedCustomer->parts_codes;                              
        $startedCustomer->parts_places = $startedCustomer->parts_places.'%'.$finishedCustomer->parts_places;                              
        $startedCustomer->cost = $startedCustomer->cost + $finishedCustomer->cost;                              
        $startedCustomer->payment = $startedCustomer->payment + $finishedCustomer->payment;                              
        $startedCustomer->total = $startedCustomer->total + $finishedCustomer->total;                                                         
        $startedCustomer->car_model = $startedCustomer->car_model.','.$finishedCustomer->car_model;   
        $startedCustomer->save();    
        $finishedCustomer->delete();     
        broadcast(new FundSaved());                  
        return $startedCustomer->body;
    }



    public function sendMail(Request $request , Fund $fund )
    {
        $customer = Customer::find($fund->customer_id);
        $customer->email = $request->input('customer.email');
        $customer->save();
        Mail::send('email.invoice', ['fund' => $fund], function ($m) use ($fund , $customer) {
            // $m->from('info@2-parts.gr', 'Παρραγελία από 2-parts');

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
