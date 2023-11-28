<?php

namespace App\Console\Commands;

use App\Jobs\BackupDatabase;
use App\Jobs\RefreshDatabase;
use App\Jobs\RestoreDatabase;
use App\Notifications\Slack\SlackAppRefreshFailedNotification;
use App\Notifications\Slack\SlackAppRefreshSuccessfulNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Throwable;

class Refresh extends Command
{
    protected $signature = 'app:refresh';

    public function handle(): int
    {
        Bus::chain([
            new BackupDatabase(),
            new RefreshDatabase(),
            new RestoreDatabase(),
        ])->catch(function (Throwable $exception) {
            SlackAppRefreshFailedNotification::send($exception->getMessage());

            throw $exception;
        })->dispatch();

        // Cleanup
        Storage::deleteDirectory('database/exports');

        SlackAppRefreshSuccessfulNotification::send();

        return self::SUCCESS;
    }
}
