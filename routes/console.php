<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {
    Loan::where('status', 'dipinjam')
        ->where('due_date', '<', Carbon::today())
        ->update(['status' => 'terlambat']);
})->dailyAt('00:01')->name('update-overdue-loans');

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
