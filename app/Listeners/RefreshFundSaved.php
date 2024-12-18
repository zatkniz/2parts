<?php

namespace App\Listeners;

use App\Events\FundSaved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RefreshFundSaved
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
     * @param  FundSaved  $event
     * @return void
     */
    public function handle(FundSaved $event)
    {
        //
    }
}
