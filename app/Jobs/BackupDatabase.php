<?php

namespace App\Jobs;

use App\Exports\ConnectedAccountsExport;
use App\Exports\SessionsExport;
use App\Exports\TeamsExport;
use App\Exports\UsersExport;
use App\Services\Database\Exporter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Maatwebsite\Excel\Facades\Excel;

class BackupDatabase implements ShouldQueue
{
    use Dispatchable, Queueable, InteractsWithQueue;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        collect([
            'users' => new UsersExport(),
            'sessions' => new SessionsExport(),
            'teams' => new TeamsExport(),
            'connected_accounts' => new ConnectedAccountsExport(),
        ])->each(function (Exporter $exporter, string $table) {
            Excel::store(
                $exporter,
                "database/exports/$table.xlsx",
                writerType: \Maatwebsite\Excel\Excel::XLSX
            );
        });
    }
}
