<?php

namespace App\Enums;

enum UserLevel: int
{
    case SUPERADMIN = 0;
    case ADMIN = 1;
    case OWNER = 2;
    case USER = 3;

    public function label(): string
    {
        return match($this) {
            self::SUPERADMIN => 'Super Admin',
            self::ADMIN => 'Admin',
            self::OWNER => 'Owner',
            self::USER => 'Customer',
        };
    }

    public static function labels(): array
    {
        return array_column(array_map(fn($case) => [$case->value => $case->label()], self::cases()), null, 'value');
    }
}
