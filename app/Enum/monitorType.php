<?php

namespace App\Enum;

enum monitorType :int
{
    case OPERATIONAL = 0; // تشغيلية
    case PLANNING_AND_EXECUTION = 1; // تخطيط وتنفيذ
    case SECURITY_AND_SAFETY = 2;// أمن وسلامة

    public function values()

    {
        return array_column(self::cases(), 'value');

    }

    public function lang()
    {
        return match ($this) {
            self::OPERATIONAL => 'تشغيلية',
            self::PLANNING_AND_EXECUTION => 'تخطيط وتنفيذ',
            self::SECURITY_AND_SAFETY => 'أمن وسلامة',
        };

    }
}
