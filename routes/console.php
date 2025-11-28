<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


use Illuminate\Support\Facades\Schedule;

// Run your auction closer every minute
Schedule::command('auctions:close')->everyMinute();
