<?php

namespace App\Providers;

use App\Jobs\BackupDatabase;
use App\Jobs\RestoreDatabase;
use App\Models\ProcessedJob;
use App\Notifications\Slack\SlackDbBackupSuccessfulNotification;
use App\Notifications\Slack\SlackDbRestoreSuccessfulNotification;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;

class QueueServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Queue::after(function (JobProcessed $event) {
            if ($event->job->hasFailed()) {
                return;
            }

            match($event->job->resolveName()) {
                BackupDatabase::class => SlackDbBackupSuccessfulNotification::send(),
                RestoreDatabase::class => SlackDbRestoreSuccessfulNotification::send(),
            };

            ProcessedJob::query()->create([
                'uuid' => $event->job->uuid(),
                'name' => $event->job->resolveName(),
                'payload' => $event->job->payload(),
                'job_id' => $event->job->getJobId(),
                'queue' => $event->job->getQueue(),
                'attempts' => $event->job->attempts(),
                'processed_at' => now(),
            ]);
        });
    }
}
