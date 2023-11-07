<?php

namespace App\Imports;

use App\Models\User;
use App\Services\Database\Importer;

/**
 * @extends Importer<User>
 */
class UsersImport extends Importer
{
    protected function modelClass(): string
    {
        return User::class;
    }
}
