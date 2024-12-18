<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Fund;;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email'
    ];

    protected $appends = ['has_overcome_balance', 'fund_number'];

    public function getHasOvercomeBalanceAttribute()
    {
        return $this->attributes['limit'] != null && $this->attributes['limit'] < $this->balance->balance;
    }

    public function getFundNumberAttribute()
    {
        return Fund::where('customer_id', $this->id)->whereDate('created_at', '>', Carbon::createFromFormat('d/m/Y H:i:s',  '17/5/2021 00:00:00')->toDateString())->count();
    }

    public function balance()
    {
        return $this->hasOne('App\Models\Balance');
    }

    public function hasBalance()
    {
        return $this->hasOne('App\Models\Balance')->where('balance' , '>' , '0');
    }
   
    public function fundsCount()
    {
        return $this->hasOne('App\Models\Fund')->selectRaw('customer_id, count(*) as count , sum(cost) as price')->groupBy('customer_id');
    }

    public function fundsDailyCount()
    {
        return $this->hasOne('App\Models\Fund')->selectRaw('customer_id, count(*) as count , sum(cost) as price')->groupBy('customer_id')->where('created_at', '>=', Carbon::today());
    }

    public function fundsMonthlyCount()
    {
        $dt = Carbon::parse(Carbon::today());
        return $this->hasOne('App\Models\Fund')->selectRaw('customer_id, count(*) as count , sum(cost) as price')->groupBy('customer_id');
    }

    public function fundsPaysCount()
    {
        $dt = Carbon::parse(Carbon::today());
        return $this->hasOne('App\Models\Fund')->selectRaw('customer_id, count(*) as count , sum(payment) as price')->groupBy('customer_id');
    }

    public function fundsWeeklyCount()
    {
        $dt = Carbon::parse(Carbon::today());
        return $this->hasOne('App\Models\Fund')->selectRaw('customer_id, count(*) as count , sum(cost) as price')->groupBy('customer_id')->where('created_at', '>=',Carbon::now()->subWeeks(1))->where('created_at', '<=', Carbon::now()->subDays(1));
    }

    public function fundsYearCount()
    {
        $dt = Carbon::parse(Carbon::today());
        return $this->hasOne('App\Models\Fund')->selectRaw('customer_id, count(*) as count , sum(cost) as price')->groupBy('customer_id')->whereYear('created_at' ,  $dt->year);
    }

    public function lastFund()
    {
        return $this->hasOne('App\Models\Fund')->selectRaw('customer_id , created_at')->orderBy('created_at' , 'DESC');
    }

    public function funds()
    {
        return $this->hasMany('App\Models\Fund');
    }

    public function printCustomersfunds()
    {
        return $this->hasOne('App\Models\Fund')
        ->selectRaw('customer_id, count(*) as count , sum(cost) as price')->groupBy('customer_id')
                    ->where('customer_id' , '!=' , '1')
                    // ->whereMonth('created_at' , '9' )
                    // ->whereYear('created_at' , '2017' )
                    ->where('price' , '>' , '0');               
    }
}
