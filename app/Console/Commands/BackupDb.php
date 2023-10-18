<?php

namespace App\Console\Commands;

use App\Jobs\BackupDatabase;
use Illuminate\Console\Command;

class BackupDb extends Command
{
    protected $signature = 'app:backup-db';

    public function handle(): int
    {
        BackupDatabase::dispatch();

        return self::SUCCESS;
    }
}
