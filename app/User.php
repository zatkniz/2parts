<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function countFunds()
    {
        return $this->hasOne('App\Fund')
                    ->selectRaw('user_id, count(*) as count , sum(cost) as price , sum(payment) as payment')
                    ->where('body' , '!=' , 'Είσπραξη')
                    ->where('price' , '>' , 0)                    
                    ->where('body' , 'NOT LIKE' , '%Αριθ. Τιμόλ')
                    ->where('body' , 'NOT LIKE' , '%Είσπραξη')
                    ->where('body' , 'NOT LIKE' , '%Αριθ. Πιστωτικού')
                    ->groupBy('user_id');
    }
    
    public function countYearFunds()
    {
        return $this->hasOne('App\Fund')
                    ->selectRaw('user_id, count(*) as count , sum(cost) as price , sum(payment) as payment')
                    ->where('body' , '!=' , 'Είσπραξη')
                    ->where('price' , '>' , 0)                    
                    ->where('body' , 'NOT LIKE' , '%Αριθ. Τιμόλ')
                    ->where('body' , 'NOT LIKE' , '%Είσπραξη')
                    ->where('body' , 'NOT LIKE' , '%Αριθ. Πιστωτικού')
                    ->groupBy('user_id')
                    ->whereYear('created_at' , Carbon::now()->year);
    }

    public function countMonthFunds()
    {
        return $this->hasOne('App\Fund')
                    ->selectRaw('user_id, count(*) as count , sum(cost) as price , sum(payment) as payment')
                    ->where('body' , '!=' , 'Είσπραξη')
                    ->where('price' , '>' , 0)                    
                    ->where('body' , 'NOT LIKE' , '%Αριθ. Τιμόλ')
                    ->where('body' , 'NOT LIKE' , '%Είσπραξη')
                    ->where('body' , 'NOT LIKE' , '%Αριθ. Πιστωτικού')                 
                    ->groupBy('user_id')
                    ->whereMonth('created_at' , Carbon::now()->month)
                    ->whereYear('created_at' , Carbon::now()->year);
    }

    public function countWeekFunds()
    {
        return $this->hasOne('App\Fund')
                    ->selectRaw('user_id, count(*) as count , sum(cost) as price , sum(payment) as payment')
                    ->where('body' , '!=' , 'Είσπραξη')
                    ->where('price' , '>' , 0)                    
                    ->where('body' , 'NOT LIKE' , '%Αριθ. Τιμόλ')
                    ->where('body' , 'NOT LIKE' , '%Είσπραξη')
                    ->where('body' , 'NOT LIKE' , '%Αριθ. Πιστωτικού')
                    ->groupBy('user_id')
                    ->whereBetween('created_at', [Carbon::now()->startOfWeek()->format('Y-m-d'), Carbon::now()->endOfWeek()->format('Y-m-d')]);
    }

    public function countDailyFunds()
    {
        return $this->hasOne('App\Fund')
                    ->selectRaw('user_id, count(*) as count , sum(cost) as price , sum(payment) as payment')
                    ->where('body' , '!=' , 'Είσπραξη')
                    ->where('price' , '>' , 0)                    
                    ->where('body' , 'NOT LIKE' , '%Αριθ. Τιμόλ')
                    ->where('body' , 'NOT LIKE' , '%Είσπραξη')
                    ->where('body' , 'NOT LIKE' , '%Αριθ. Πιστωτικού')
                    ->groupBy('user_id')
                    ->where('created_at', '>=' , Carbon::today());
    }

    public function MonthlyFunds()
    {
        return $this->hasMany('App\Fund')
                    ->selectRaw('user_id, count(*) as count , sum(cost) as price, MONTH(created_at) month')
                    ->where('body' , '!=' , 'Είσπραξη')
                    ->where('price' , '>' , 0)                    
                    ->where('body' , 'NOT LIKE' , '%Αριθ. Τιμόλ')
                    ->where('body' , 'NOT LIKE' , '%Είσπραξη')
                    ->where('body' , 'NOT LIKE' , '%Αριθ. Πιστωτικού')
                    ->groupBy(['user_id' , 'month']);
    }

    public function MonthlyFundsDaily()
    {
        return $this->hasMany('App\Fund')
                    ->selectRaw('user_id, count(*) as count , sum(cost) as price, CAST(created_at AS date) date')
                    ->where('body' , '!=' , 'Είσπραξη')
                    ->where('price' , '>' , 0)                    
                    ->where('body' , 'NOT LIKE' , '%Αριθ. Τιμόλ')
                    ->where('body' , 'NOT LIKE' , '%Είσπραξη')
                    ->where('body' , 'NOT LIKE' , '%Αριθ. Πιστωτικού')
                    ->groupBy(['user_id' , 'date']);
    }
}
