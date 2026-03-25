<?php

namespace App\Enum;

enum NoticeStatusEnum: int
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
            self::NEW => 'جديدة',
            self::ACCEPTED => 'مقبولة',
            self::REJECTED => 'مرفوضة',
            self::IS_UP => 'تم التصعيد',
        };
    }
}
