<?php

namespace App\Enum;

enum NoticeTypePriorityEnum: string
{
    case SUGGEST = 'suggest';
    case LOW = 'low';
    case MID = 'mid';
    case HIGH = 'high';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function lang(): string
    {
        return match ($this) {
            self::SUGGEST => 'مقترحة',
            self::LOW => 'منخفضة',
            self::MID => 'متوسطة',
            self::HIGH => 'عالية',
        };
    }
}
