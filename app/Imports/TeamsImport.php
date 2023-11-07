<?php

namespace App\Imports;

use App\Models\Team;
use App\Services\Database\Importer;

/**
 * @extends Importer<Team>
 */
class TeamsImport extends Importer
{
    protected function modelClass(): string
    {
        return Team::class;
    }
}
