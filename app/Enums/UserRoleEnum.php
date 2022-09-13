<?php

namespace App\Enums;

enum UserRoleEnum: int
{
    case Standard = 0;
    case Admin = 1;

    public function name(): string
    {
        return match ($this) {
            self::Standard => 'Standard',
            self::Admin => 'Admin',
        };
    }
}
