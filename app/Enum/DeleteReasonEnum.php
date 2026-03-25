<?php

namespace App\Enum;

enum DeleteReasonEnum: int
{
    case NO_LONGER_NEEDED = 1;
    case DISSATISFIED_WITH_SERVICE = 2;
    case FOUND_ALTERNATIVE = 3;
    case PERSONAL_REASONS = 4;
    case OTHER = 5;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function lang(): string
    {
        return match ($this) {
            self::NO_LONGER_NEEDED => 'لا يحتاجوني الان',
            self::DISSATISFIED_WITH_SERVICE => 'غير سعيدين بالخدمة',
            self::FOUND_ALTERNATIVE => 'وجد بديل',
            self::PERSONAL_REASONS => 'أسباب شخصية',
            self::OTHER => 'أحرى',
        };
    }
}
