<?php

namespace App\Jobs;

use App\Notifications\Slack\SlackDbRestoreFailedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class RestoreDatabase implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly array $tables = [
        'users',
        'sessions',
        'teams',
        'connected_accounts',
    ]) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->tables()->each(function (string $table) {
            $this->import(
                table: $table,
                filePath: "database/exports/$table.xlsx"
            );
        });

        // Cleanup
        Storage::deleteDirectory('database/exports');
    }

    private function tables(): Collection
    {
        return collect($this->tables);
    }

    private function import(string $table, string $filePath): void
    {
        $importerClass = $this->getImporterClass(table: $table);

        if (! class_exists($importerClass)) {
            abort(404, "Importer not found [$importerClass] for table: $table.");
        }

        Excel::import(
            new $importerClass(),
            $filePath,
        );
    }

    private function getImporterClass(string $table): string
    {
        $basename = Str::of($table)->camel()->ucfirst()->toString();

        return "App\\Imports\\{$basename}Import";
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        SlackDbRestoreFailedNotification::send(
            message: $exception->getMessage(),
        );
    }

}
