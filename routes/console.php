<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('cache:all', function () {
    $this->call('config:cache');
    $this->call('route:cache');
    $this->call('view:cache');
    $this->call('event:cache');
    $this->call('optimize');
})->purpose('Cache all the things')->hourly();
