<?php

namespace App\Exports;

use App\Models\User;
use App\Services\Database\Exporter;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SessionsExport extends Exporter
{
    public function collection(): Collection
    {
        return DB::table('sessions')
            ->whereIn('user_id', $this->users()->pluck('id')->all())
            ->get();
    }
}
