<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JavaScript;
use App\Customer;
use App\Part;
use App\Fund;
use App\Balance;
use App\Outfund;
use Carbon\Carbon;

class Statistics extends Controller
{
    public function index(){
        return view('statistics');
    }

    public function monthly(){
        $dt = Carbon::now();
        $funds[0] = Fund::select([
            \DB::raw('sum(cost) as `sum` , sum(payment) as `payment`'), 
            \DB::raw('DATE(created_at) as day')
          ])->groupBy('day')
          // And restrict these results to only those created in the last week
          ->whereMonth('created_at' , $dt->month)
          ->whereYear('created_at' , $dt->year)
          ->get();
        $funds[1] = Outfund::select([
            \DB::raw('sum(total) as `payment`'), 
            \DB::raw('DATE(created_at) as day')
          ])->groupBy('day')
          // And restrict these results to only those created in the last week
          ->whereMonth('created_at' , $dt->month)
          ->whereYear('created_at' , $dt->year)
          ->get();
        $funds[2] = Fund::
          whereMonth('created_at' , $dt->month)
          ->whereYear('created_at' , $dt->year)
          ->sum('cost');
        $funds[3] = Fund::
          whereMonth('created_at' , $dt->month)
          ->whereYear('created_at' , $dt->year)
          ->count();
          $funds[4] = Fund::
          whereMonth('created_at' , $dt->month)
          ->whereYear('created_at' , $dt->year)
          ->sum('payment');
          $funds[5] = Outfund::
          whereMonth('created_at' , $dt->month)
          ->whereYear('created_at' , $dt->year)
          ->sum('total');
        return $funds;
    }

    public function monthlyOtherMonth($month , $year){
        $dt = Carbon::now();
        $funds[0] = Fund::select([
            \DB::raw('sum(cost) as `sum` , sum(payment) as `payment`'), 
            \DB::raw('DATE(created_at) as day')
          ])->groupBy('day')
          // And restrict these results to only those created in the last week
          ->whereMonth('created_at' , $month)
          ->whereYear('created_at' , $year)
          ->get();
        $funds[1] = Outfund::select([
            \DB::raw('sum(total) as `payment`'), 
            \DB::raw('DATE(created_at) as day')
          ])->groupBy('day')
          // And restrict these results to only those created in the last week
          ->whereMonth('created_at' , $month)
          ->whereYear('created_at' , $year)
          ->get();
        $funds[2] = Fund::
          whereMonth('created_at' , $month)
          ->whereYear('created_at' , $year)
          ->sum('cost');
        $funds[3] = Fund::
          whereMonth('created_at' , $month)
          ->whereYear('created_at' , $year)
          ->count();
          $funds[4] = Fund::
          whereMonth('created_at' , $month)
          ->whereYear('created_at' , $year)
          ->sum('payment');
          $funds[5] = Outfund::
          whereMonth('created_at' , $month)
          ->whereYear('created_at' , $year)
          ->sum('total');
        return $funds;
    }

    public function monthlyOtherMonthUser($month , $year , $user){
        $dt = Carbon::now();
        $funds[0] = Fund::select([
            \DB::raw('sum(cost) as `sum` , sum(payment) as `payment`'), 
            \DB::raw('DATE(created_at) as day')
          ])->groupBy('day')
          ->where('customer_id' , '=' , $user)
          // And restrict these results to only those created in the last week
          ->whereMonth('created_at' , $month)
          ->whereYear('created_at' , $year)
          ->get();
        $funds[1] = Outfund::select([
            \DB::raw('sum(total) as `payment`'), 
            \DB::raw('DATE(created_at) as day')
          ])->groupBy('day')
          // And restrict these results to only those created in the last week
          ->whereMonth('created_at' , $month)
          ->whereYear('created_at' , $year)
          ->get();
        $funds[2] = Fund::
          where('customer_id' , '=' , $user)
          ->whereMonth('created_at' , $month)
          ->whereYear('created_at' , $year)
          ->sum('cost');
        $funds[3] = Fund::
          where('customer_id' , '=' , $user)
          ->whereMonth('created_at' , $month)
          ->whereYear('created_at' , $year)
          ->count();
          $funds[4] = Fund::
          where('customer_id' , '=' , $user)
          ->whereMonth('created_at' , $month)
          ->whereYear('created_at' , $year)
          ->sum('payment');
          $funds[5] = Outfund::
          whereMonth('created_at' , $month)
          ->whereYear('created_at' , $year)
          ->sum('total');
        return $funds;
    }

    public function monthlyOtherMonthOutcome($month , $year , $user){
      $dt = Carbon::now();
      $funds[0] = Outfund::select([
          \DB::raw('sum(total) as `sum` , sum(total) as `payment`'), 
          \DB::raw('DATE(created_at) as day')
        ])->groupBy('day')
        ->where('outcome_id' , '=' , $user)
        // And restrict these results to only those created in the last week
        ->whereMonth('created_at' , $month)
        ->whereYear('created_at' , $year)
        ->get();
      $funds[1] = Outfund::select([
          \DB::raw('sum(total) as `payment`'), 
          \DB::raw('DATE(created_at) as day')
        ])->where('outcome_id' , '=' , $user)
        ->groupBy('day')
        // And restrict these results to only those created in the last week
        ->whereMonth('created_at' , $month)
        ->whereYear('created_at' , $year)
        ->get();
      $funds[2] = Outfund::
        where('outcome_id' , '=' , $user)
        ->whereMonth('created_at' , $month)
        ->whereYear('created_at' , $year)
        ->sum('total');
      $funds[3] = Outfund::
        where('outcome_id' , '=' , $user)
        ->whereMonth('created_at' , $month)
        ->whereYear('created_at' , $year)
        ->count();
        $funds[4] = 0;
        $funds[5] = 0;
      return $funds;
  }

    public function monthlyOtherMonthRanged($month , $year , $monthTo , $yearTo){
        $dt = Carbon::now();
        $dateFrom = $year.'-'.$month.'-01';
        $dateTo = $yearTo.'-'.$monthTo.'-01';
        $funds[0] = Fund::select([
            \DB::raw('sum(cost) as `sum` , sum(payment) as `payment`'), 
            \DB::raw('DATE(created_at) as day')
          ])->groupBy('day')
          // And restrict these results to only those created in the last week
          ->whereBetween('created_at' , [$dateFrom, $dateTo])
          ->get();
        $funds[1] = Outfund::select([
            \DB::raw('sum(total) as `payment`'), 
            \DB::raw('DATE(created_at) as day')
          ])->groupBy('day')
          // And restrict these results to only those created in the last week
          ->whereBetween('created_at' , [$dateFrom, $dateTo])
          ->get();
        $funds[2] = Fund::
          whereBetween('created_at' , [$dateFrom, $dateTo])
          ->sum('cost');
        $funds[3] = Fund::
          whereBetween('created_at' , [$dateFrom, $dateTo])
          ->count();
          $funds[4] = Fund::
          whereBetween('created_at' , [$dateFrom, $dateTo])
          ->sum('payment');
          $funds[5] = Outfund::
          whereBetween('created_at' , [$dateFrom, $dateTo])
          ->sum('total');
        return $funds;
    }

    public function monthlyOtherMonthRangedUser($month , $year , $monthTo , $yearTo , $user){
        $dt = Carbon::now();
        $dateFrom = $year.'-'.$month.'-01';
        $dateTo = $yearTo.'-'.$monthTo.'-01';
        $funds[0] = Fund::select([
            \DB::raw('sum(cost) as `sum` , sum(payment) as `payment`'), 
            \DB::raw('DATE(created_at) as day')
          ])->groupBy('day')
          // And restrict these results to only those created in the last week
          ->where('customer_id' , '=' , $user)
          ->whereBetween('created_at' , [$dateFrom, $dateTo])
          ->get();
        $funds[1] = Outfund::select([
            \DB::raw('sum(total) as `payment`'), 
            \DB::raw('DATE(created_at) as day')
          ])->groupBy('day')
          // And restrict these results to only those created in the last week
          ->whereBetween('created_at' , [$dateFrom, $dateTo])
          ->get();
        $funds[2] = Fund::
          where('customer_id' , '=' , $user)
          ->whereBetween('created_at' , [$dateFrom, $dateTo])
          ->sum('cost');
        $funds[3] = Fund::
          where('customer_id' , '=' , $user)
          ->whereBetween('created_at' , [$dateFrom, $dateTo])
          ->count();
          $funds[4] = Fund::
          where('customer_id' , '=' , $user)
          ->whereBetween('created_at' , [$dateFrom, $dateTo])
          ->sum('payment');
          $funds[5] = Outfund::
          whereBetween('created_at' , [$dateFrom, $dateTo])
          ->sum('total');
        return $funds;
    }

    public function yearStatistics($year){
      $dt = Carbon::now();
      $funds[0] = Fund::select([
          \DB::raw('sum(cost) as `sum` , sum(payment) as `payment`'), 
          \DB::raw('MONTH(created_at) as day')
        ])->groupBy('day')
        // And restrict these results to only those created in the last week
        ->whereYear('created_at' , $year)
        ->get();
      $funds[1] = Outfund::select([
          \DB::raw('sum(total) as `payment`'), 
          \DB::raw('MONTH(created_at) as day')
        ])->groupBy('day')
        // And restrict these results to only those created in the last week
        ->whereYear('created_at' , $year)
        ->get();
      $funds[2] = Fund::
        whereYear('created_at' , $year)
        ->sum('cost');
      $funds[3] = Fund::
        whereYear('created_at' , $year)
        ->count();
        $funds[4] = Fund::
        whereYear('created_at' , $year)
        ->sum('payment');
        $funds[5] = Outfund::
        whereYear('created_at' , $year)
        ->sum('total');
      return $funds;
  }

    public function yearStatisticsUser($year , $user){
      $dt = Carbon::now();
      $funds[0] = Fund::select([
          \DB::raw('sum(cost) as `sum` , sum(payment) as `payment`'), 
          \DB::raw('MONTH(created_at) as day')
        ])->groupBy('day')
        ->where('customer_id' , '=' , $user)
        // And restrict these results to only those created in the last week
        ->whereYear('created_at' , $year)
        ->get();
      $funds[1] = Outfund::select([
          \DB::raw('sum(total) as `payment`'), 
          \DB::raw('MONTH(created_at) as day')
        ])->groupBy('day')
        // And restrict these results to only those created in the last week
        ->whereYear('created_at' , $year)
        ->get();
      $funds[2] = Fund::
        where('customer_id' , '=' , $user)
        ->whereYear('created_at' , $year)
        ->sum('cost');
      $funds[3] = Fund::
        where('customer_id' , '=' , $user)
        ->whereYear('created_at' , $year)
        ->count();
        $funds[4] = Fund::
        where('customer_id' , '=' , $user)
        ->whereYear('created_at' , $year)
        ->sum('payment');
        $funds[5] = Outfund::
        whereYear('created_at' , $year)
        ->sum('total');
      return $funds;
  }

    public function yearStatisticsOutcome($year , $user){
      $dt = Carbon::now();
      $funds[0] = Outfund::select([
          \DB::raw('sum(total) as `sum` , sum(total) as `payment`'), 
          \DB::raw('MONTH(created_at) as day')
        ])->groupBy('day')
        ->where('outcome_id' , '=' , $user)
        // And restrict these results to only those created in the last week
        ->whereYear('created_at' , $year)
        ->get();
      $funds[1] = Outfund::select([
          \DB::raw('sum(total) as `payment`'), 
          \DB::raw('MONTH(created_at) as day')
        ])->groupBy('day')
        // And restrict these results to only those created in the last week
        ->whereYear('created_at' , $year)
        ->get();
      $funds[2] = Outfund::
        where('outcome_id' , '=' , $user)
        ->whereYear('created_at' , $year)
        ->sum('total');
      $funds[3] = Outfund::
        where('outcome_id' , '=' , $user)
        ->whereYear('created_at' , $year)
        ->count();
        $funds[4] = 0;
        $funds[5] = 0;
      return $funds;
  }

    public function allStatistics(){
      $dt = Carbon::now();
      $funds[0] = Fund::select([
          \DB::raw('sum(cost) as `sum` , sum(payment) as `payment`'), 
          \DB::raw('YEAR(created_at) as day')
        ])->groupBy('day')
        // And restrict these results to only those created in the last week
        ->get();
      $funds[1] = Outfund::select([
          \DB::raw('sum(total) as `payment`'), 
          \DB::raw('YEAR(created_at) as day')
        ])->groupBy('day')
        // And restrict these results to only those created in the last week
        ->get();
      $funds[2] = Fund::sum('cost');
      $funds[3] = Fund::count();
        $funds[4] = Fund::sum('payment');
        $funds[5] = Outfund::sum('total');
      return $funds;
  }

    public function allStatisticsUser($user){
      $dt = Carbon::now();
      $funds[0] = Fund::select([
          \DB::raw('sum(cost) as `sum` , sum(payment) as `payment`'), 
          \DB::raw('YEAR(created_at) as day')
        ])->groupBy('day')
        ->where('customer_id' , '=' , $user)
        // And restrict these results to only those created in the last week
        ->get();
      $funds[1] = Outfund::select([
          \DB::raw('sum(total) as `payment`'), 
          \DB::raw('YEAR(created_at) as day')
        ])->groupBy('day')
        // And restrict these results to only those created in the last week
        ->get();
      $funds[2] = Fund::where('customer_id' , '=' , $user)->sum('cost');
      $funds[3] = Fund::where('customer_id' , '=' , $user)->count();
        $funds[4] = Fund::where('customer_id' , '=' , $user)->sum('payment');
        $funds[5] = Outfund::sum('total');
      return $funds;
  }

    public function allStatisticsOutcome($user){
      $dt = Carbon::now();
      $funds[0] = Outfund::select([
          \DB::raw('sum(total) as `sum` , sum(total) as `payment`'), 
          \DB::raw('YEAR(created_at) as day')
        ])->groupBy('day')
        ->where('outcome_id' , '=' , $user)
        // And restrict these results to only those created in the last week
        ->get();
      $funds[1] = Outfund::select([
          \DB::raw('sum(total) as `payment`'), 
          \DB::raw('YEAR(created_at) as day')
        ])->groupBy('day')
        // And restrict these results to only those created in the last week
        ->get();
      $funds[2] = Outfund::where('outcome_id' , '=' , $user)->sum('total');
      $funds[3] = Outfund::where('outcome_id' , '=' , $user)->count();
        $funds[4] = 0;
        $funds[5] = 0;
      return $funds;
  }
}