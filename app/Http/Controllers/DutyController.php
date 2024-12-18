<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Duty;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Event;
use App\Events\DutyCreated;

class DutyController extends Controller
{
    public function index()
    {
        return view('duties');
    }

    public function all()
    {
        return Duty::where('is_done' , '=' , '1')->with('user')->get();
    }

    public function complete(Duty $duty)
    {
        $duty->is_done = 0;
        $duty->save();
        event(new DutyCreated());
        return $duty;
    }

    public function count()
    {
        $dt = Carbon::now();
        $day = $dt->day < 10 ? '0'.$dt->day : $dt->day;
        $month = $dt->month < 10 ? '0'.$dt->month : $dt->month;
        $end_date = $day.'/'.$month.'/'.$dt->year;
        return Duty::where('is_done' , '=' , '1')->where('end_date' , '=' , $end_date)->count();
    }

    public function save(Request $request)
    {
        $duty = Duty::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'user_id' => Auth::user()->id,
                'body' => $request->input('body'),
                'end_date' => $request->input('end_date'),
            ]
        );
        event(new DutyCreated());
        return $duty;
    }
}
