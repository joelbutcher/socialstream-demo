<?php

namespace App\Console\Commands;

use App\Jobs\RestoreDatabase;
use Illuminate\Console\Command;

class RestoreDb extends Command
{
    protected $signature = 'app:restore-db';

    public function handle(): int
    {
        RestoreDatabase::dispatch();

        return self::SUCCESS;
    }
}
