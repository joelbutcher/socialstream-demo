<?php

namespace App\Exports;

use App\Models\User;
use App\Services\Database\Exporter;
use Illuminate\Support\Collection;

class ConnectedAccountsExport extends Exporter
{
    public function collection(): Collection
    {
        return $this->users(relations: ['connectedAccounts'])
            ->map(fn (User $user) => $user->connectedAccounts)
            ->flatten();
    }

    public function map($row): array
    {
        return parent::map($row->toArray());
    }
}
