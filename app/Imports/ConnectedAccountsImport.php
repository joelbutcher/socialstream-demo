<?php

namespace App\Imports;

use App\Models\ConnectedAccount;
use App\Services\Database\Importer;

class ConnectedAccountsImport extends Importer
{
    protected function modelClass(): string
    {
        return ConnectedAccount::class;
    }
}
