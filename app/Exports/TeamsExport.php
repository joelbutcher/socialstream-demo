<?php

namespace App\Exports;

use App\Models\User;
use App\Services\Database\Exporter;
use Illuminate\Support\Collection;

class TeamsExport extends Exporter
{
    public function collection(): Collection
    {
        return $this->users(['ownedTeams'])->map(
            fn (User $user) => $user->allTeams(),
        )->flatten();
    }

    public function map($row): array
    {
        return parent::map($row->toArray());
    }
}
