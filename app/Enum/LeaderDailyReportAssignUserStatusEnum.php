<?php

namespace App\Enum;

enum LeaderDailyReportAssignUserStatusEnum: int
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
        /*
         *  0,1,3
         * lately - متأخرة
         * */
        return match ($this) {
            self::NEW => 'تحت التنفيذ',
            self::STARTED => 'تحت التنفيذ',
            self::UNDER_REVIEW => 'تحتاج المراجعة',
            self::NEED_EDIT => 'مرفوضة',
            self::COMPLETED => 'معتمدة',
        };
    }
}
