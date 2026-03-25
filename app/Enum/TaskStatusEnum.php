<?php

namespace App\Enum;

enum TaskStatusEnum: int
{
        //0 => new , 1 => started, 2 => under review , 3=> need edit, 4 => completed
    case NEW = 0;
    case STARTED = 1;
    case UNDER_REVIEW = 2;
    case NEED_EDIT = 3;
    case COMPLETED = 4;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }


    public function lang(): string
    {
        return match ($this) {
            self::NEW => 'لم يتم البدأ',
            self::STARTED => 'تم البدأ',
            self::UNDER_REVIEW => 'تحت المراجعة',
            self::NEED_EDIT => 'تحتاج للتعديل',
            self::COMPLETED => 'منتهية',
        };
    }
}
