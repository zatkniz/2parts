<?php

namespace App\Listeners;

use App\Events\FundUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Customer;
use App\Part;
use App\Fund;
use App\Balance;
use App\Outfund;;

class UpdatesAllBalances implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FundUpdated  $event
     * @return void
     */
    public function handle(FundUpdated $event)
    {
        $allcustomers = Customer::all();
        
        foreach ($allcustomers as $key => $value) {
            $balance = Balance::firstOrNew(
                ['customer_id' => $allcustomers[$key]->id]
            );
            $balance->balance = Fund::where('isOffer' , 0)->where('customer_id' , $allcustomers[$key]->id)->where('isOffer' , 0)->sum('cost') - Fund::where('isOffer' , 0)->where('customer_id' , $allcustomers[$key]->id)->where('isOffer' , 0)->sum('payment') - Fund::where('isOffer' , 0)->where('customer_id' , $allcustomers[$key]->id)->where('isOffer' , 0)->sum('credit');
        
            $balance->save();
        }
    }
}
