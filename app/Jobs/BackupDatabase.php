<?php

namespace App\Jobs;

use App\Notifications\Slack\SlackDbBackupFailedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class BackupDatabase implements ShouldQueue
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
            $this->export(
                table: $table,
                filePath: "database/exports/$table.xlsx"
            );
        });
    }

    private function tables(): Collection
    {
        return collect($this->tables);
    }

    private function export(string $table, string $filePath): void
    {
        $exporterClass = $this->getExporterClass(table: $table);

        if (! class_exists($exporterClass)) {
            abort(404, "Exporter not found [$exporterClass] for table: $table.");
        }

        Excel::store(
            new $exporterClass(),
            $filePath,
            writerType: \Maatwebsite\Excel\Excel::XLSX
        );
    }

    private function getExporterClass(string $table): string
    {
        $basename = Str::of($table)->camel()->ucfirst()->toString();

        return "App\\Exports\\{$basename}Export";
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        SlackDbBackupFailedNotification::send(
            message: $exception->getMessage(),
        );
    }
}
