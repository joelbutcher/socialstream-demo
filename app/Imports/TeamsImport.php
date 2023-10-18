<?php

namespace App\Imports;

use App\Models\Team;
use App\Services\Database\Importer;

class TeamsImport extends Importer
{
    protected function modelClass(): string
    {
        return Team::class;
    }
}
