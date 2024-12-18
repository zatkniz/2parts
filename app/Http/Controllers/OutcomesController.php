<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Outcome;
use App\Outfund;
use Carbon\Carbon;
use Event;
use App\Events\FundSaved;

class OutcomesController extends Controller
{
    public function all(){
        return Outfund::with(['outcome'])
                ->orderBy('created_at' , 'ASC')
                ->where('created_at', '>=', Carbon::today())
                ->get();
    }
    
    public function getOutfunds(){
        return Outcome::all();
    }

    public function quickSearch(Request $request)
    {
        return Outcome::where('name' , 'like' , '%'.$request->input('name').'%')->get();
    }

    public function saveNewOutcome(Request $request){
        $outcome = Outcome::firstOrCreate(
            ['name' => $request->input('name')]
        );
        return $outcome;
    }
   
    public function updateOutfund(Request $request ,  $outfund)
    {
        $outfund = Outfund::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'outcome_id' => $request->input('name'),
                'total' => $request->input('price'),
                'delivery_id' => $request->input('delivery_id')
            ]
        );
        broadcast(new FundSaved())->toOthers();
        return $outfund;
    }

    public function saveOutcome(Request $request){
        $outfund = new Outfund;
        $outfund->outcome_id = $request->input('name');
        $outfund->total = $request->input('price');
        $outfund->delivery_id = $request->input('delivery_id');
        $outfund->created_at = Carbon::createFromDate( $request->input('pastDate')[2], $request->input('pastDate')[1], $request->input('pastDate')[0]);        
        $outfund->save();
        broadcast(new FundSaved())->toOthers();
        return $outfund;
    }

    public function deleteOutfund(Request $request , Outfund $outfund )
    {
        $outfund->delete();
        broadcast(new FundSaved())->toOthers();
        return 'success';
    }

    public function quickEditOutcome(Request $request , Outcome $outcome )
    {
        $outcome->name = $request->input('name');
        $outcome->save();
        return $outcome;
    }

    public function quickDeleteOutcome(Request $request , Outcome $outcome )
    {
        $outcome->delete();
        return $outcome;
    }

    public function findOutcome(Request $request , Outcome $outcome )
    {
        return $outcome;
    }
}
