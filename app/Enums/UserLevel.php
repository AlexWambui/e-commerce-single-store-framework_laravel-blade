<?php

namespace App\Enums;

enum UserLevel: int
{
    case SUPERADMIN = 0;
    case ADMIN = 1;
    case OWNER = 2;
    case USER = 3;
    case CASHIER = 4;

    public function label(): string
    {
        return match($this) {
            self::SUPERADMIN => 'Super Admin',
            self::ADMIN => 'Admin',
            self::OWNER => 'Owner',
            self::USER => 'Customer',
            self::CASHIER => 'Cashier',
        };
    }

    public static function labels(): array
    {
        return collect(self::cases())->mapWithKeys(fn($case) => [
            $case->value => $case->label(),
        ])->toArray();
    }
}
