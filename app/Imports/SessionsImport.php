<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SessionsImport implements ToArray, WithHeadingRow
{
    use Importable;

    public function array(array $array): array
    {
        DB::table('sessions')->insert($array);

        return $array;
    }
}
