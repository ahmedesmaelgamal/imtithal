<?php

namespace App\Enum;

enum UserRoleEnum: int
{
    case SYSTEM_ADMIN = 1;
    case SUPERVISOR = 2;
    case MONITOR = 3;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function lang(): string
    {
        return match ($this) {
            self::SYSTEM_ADMIN => 'مدير النظام',
            self::SUPERVISOR => 'مشرف',
            self::MONITOR => 'مراقب',
        };
    }
}

