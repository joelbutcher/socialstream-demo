<?php

namespace App\Console\Commands;

use App\Jobs\BackupDatabase;
use App\Jobs\RefreshDatabase;
use App\Jobs\RestoreDatabase;
use App\Notifications\Slack\SlackAppRefreshFailedNotification;
use App\Notifications\Slack\SlackAppRefreshSuccessfulNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
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

        // Fixes pgsql sequences out of sync issues.
        DB::raw("SELECT setval('users_id_seq', (SELECT MAX(id) FROM users)+1)");
        DB::raw("SELECT setval('teams_id_seq', (SELECT MAX(id) FROM teams)+1)");
        DB::raw("SELECT setval('connected_accounts_id_seq', (SELECT MAX(id) FROM connected_accounts)+1)");

        SlackAppRefreshSuccessfulNotification::send();

        return self::SUCCESS;
    }
}
