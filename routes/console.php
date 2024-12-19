<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('delete:completed-tasks', function () {
    $this->comment('Deleting completed tasks older than one week...');
    dispatch(new \App\Jobs\DeleteCompletedTasks());
})->purpose('Delete completed tasks older than one week')->daily();
