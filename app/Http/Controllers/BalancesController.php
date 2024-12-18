<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Balance;
use App\Fund;
use App\Customer;
use JavaScript;
use Carbon\Carbon;

class BalancesController extends Controller
{
    public function index(){
        $result = Customer::has('balance')->where('active' , '=' , 1 )->with('balance')->orderBy('name')->get();
        $hasBalances = Customer::has('hasBalance')->where('active' , '=' , 1 )->with('balance')->orderBy('name')->get();
        JavaScript::put([
            'result' => $result,
            'hasBalances' => $hasBalances
        ]);
        return view('balances');
    }
}
