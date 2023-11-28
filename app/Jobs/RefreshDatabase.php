<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;

class RefreshDatabase implements ShouldQueue
{
    use Dispatchable, Queueable, InteractsWithQueue;

    public function handle(): void
    {
        Artisan::call('migrate:fresh', ['--step' => true, '--seed'  => true, '--force'  => true]);
    }
}
