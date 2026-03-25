<?php

namespace App\Enum\map;

enum MapNoticeStatusEnum: int
{
    case NEW = 0;
    case ACCEPTED = 1;
    case REJECTED = 2;

    case IS_UP = 3;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function lang(): string
    {
        return match ($this) {
            self::NEW => 'مفتوحه',
            self::ACCEPTED => 'مقفوله',
            self::REJECTED => 'مقفوله',
            self::IS_UP => 'مفتوحه',
        };
    }
}
