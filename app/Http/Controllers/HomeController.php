<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JavaScript;
use App\Models\Customer;
use App\Models\Part;
use App\Models\Fund;
use App\Models\Balance;
use App\Models\Outfund;;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dt = Carbon::now();
        $fund = Fund::whereYear( 'created_at' , $dt->year )->where('isOffer' , 0)->count();
        $fundMonth = Fund::whereYear( 'created_at' , $dt->year )->whereMonth( 'created_at' , $dt->month )->where('isOffer' , 0)->count();
        $topCustomers = Fund::selectRaw('customer_id, sum(cost) as price , count(*) as count')
                                ->where('customer_id' , '!=' , '1')
                                ->where('isOffer' , 0)
                                ->groupBy('customer_id')
                                ->orderBy('price' , 'DESC')
                                ->with(['customer' , 'customer.balance'])
                                ->whereYear( 'created_at' , $dt->year )
                                ->get();
        $topOutfunds = Outfund::selectRaw('outcome_id, sum(total) as price , count(*) as count')
                                ->groupBy('outcome_id')
                                ->orderBy('price' , 'DESC')
                                ->with(['outcome'])
                                ->whereYear( 'created_at' , $dt->year )
                                ->take(20)
                                ->get();
        $fundPrice = Fund::whereYear( 'created_at' , $dt->year )->where('isOffer' , 0)->sum('cost');
        $fundPriceMonth = Fund::whereYear( 'created_at' , $dt->year )->whereMonth( 'created_at' , $dt->month )->where('isOffer' , 0)->sum('cost');
        $balanceMonth = Balance::has('customer')->whereYear( 'created_at' , $dt->year )->whereMonth( 'created_at' , $dt->month )->sum('balance');
        $balance = Balance::where('balance' , '>' , '0')->sum('balance');
        $outfund = Outfund::whereYear( 'created_at' , $dt->year )->sum('total');
        $outfundMonth = Outfund::whereYear( 'created_at' , $dt->year )->whereMonth( 'created_at' , $dt->month )->sum('total');

        $data = [
            "fund" => $fund,
            "fundPrice" => $fundPrice,
            "outfundMonth" => $outfundMonth,
            "balanceMonth" => $balanceMonth,
            "balance" => $balance,
            "outfund" => $outfund,
            "fundMonth" => $fundMonth,
            "topCustomers" => $topCustomers,
            "topOutfunds" => $topOutfunds,
            "fundPriceMonth" => $fundPriceMonth
        ];

        return response()->json($data);

        return view('home' , compact(['fund' , 'fundPrice' , 'outfundMonth' , 'balanceMonth' ,'balance' , 'outfund' , 'fundMonth' , 'topCustomers' , 'topOutfunds' , 'fundPriceMonth']));
    }
}
