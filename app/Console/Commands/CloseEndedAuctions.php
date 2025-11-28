<?php

namespace App\Console\Commands;

use App\Models\Auction;
use Illuminate\Console\Command;

class CloseEndedAuctions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auctions:close';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
  // app/Console/Commands/CloseEndedAuctions.php
public function handle()
{
    $ended = Auction::where('status', 'active')
        ->where('planned_end_time', '<=', now())
        ->get();

    foreach ($ended as $auction) {
        $auction->closeAuction();
        $this->info("Auction #{$auction->id} closed → Winner: " . ($auction->winner?->name ?? 'None'));
    }
}
}
