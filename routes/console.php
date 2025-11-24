<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Backup scheduling
// Run every night at 01:30 AM when traffic is low
Schedule::command('backup:run')->dailyAt('01:30');

// Run cleanup (delete old backups) daily
Schedule::command('backup:clean')->dailyAt('02:00');

// Monitor health (check if backups are actually happening)
Schedule::command('backup:monitor')->dailyAt('03:00');
