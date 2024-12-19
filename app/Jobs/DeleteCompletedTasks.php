<?php

namespace App\Jobs;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteCompletedTasks implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle(): void
    {
        $oneWeekAgo = Carbon::now()->subWeek();

        Task::where('completed', true)
            ->where('completed_at', '<=', $oneWeekAgo)
            ->delete();
    }
}
