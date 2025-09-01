<?php

namespace App\Listeners;

use App\Events\NewBidPlaced;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ExtendAuctionTime
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewBidPlaced $event): void
    {
        //
    }
}
