<?php

namespace App\Jobs;

use App\Imports\ConnectedAccountsImport;
use App\Imports\SessionsImport;
use App\Imports\TeamsImport;
use App\Imports\UsersImport;
use App\Services\Database\Importer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class RestoreDatabase implements ShouldQueue
{
    use Dispatchable, Queueable, InteractsWithQueue;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        collect([
            'sessions' => new SessionsImport(),
            'users' => new UsersImport(),
            'teams' => new TeamsImport(),
            'connected_accounts' => new ConnectedAccountsImport(),
        ])->each(function (SessionsImport|Importer $importer, string $table) {
            Excel::import(
                $importer,
                "database/exports/$table.xlsx",
            );
        });
    }
}
