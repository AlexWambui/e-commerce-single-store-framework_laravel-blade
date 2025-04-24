<?php

namespace App\Enums;

enum UserLevel: int
{
    case INACTIVE = 0;
    case ACTIVE = 1;
    case BANNED = 2;

    public function label(): string
    {
        return match($this) {
            self::INACTIVE => 'Inactive',
            self::ACTIVE => 'Active',
            self::BANNED => 'Banned',
        };
    }

    public static function labels(): array
    {
        return array_column(array_map(fn($case) => [$case->value => $case->label()], self::cases()), null, 'value');
    }
}
