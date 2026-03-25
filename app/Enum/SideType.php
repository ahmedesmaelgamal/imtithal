<?php

namespace App\Enum;

enum SideType :int
{
    case  ROYAL_COMMISSION_MAKKAH_HOLY_SITES =0;
    case MINISTRY_OF_INTERIOR =1;
    case PRESIDENCY_OF_STATE_SECURITY = 2;
    case GENERAL_AUTHORITY_FOR_TRANSPORT = 3;
    case HOLY_CAPITAL_MUNICIPALITY = 4;
    case COMMITTEE_FOR_TRANSPORTING_HAJJ_UMRAH_PRAYER_PERFORMERS = 5;
    case GENERAL_UNION_OF_CARS = 6;
    case TRANSPORT_COMPANIES = 7;
    case SECURITY_GUARD_COMPANIES = 8;
    case MINISTRY_OF_FINANCE = 9;
    case MINISTRY_OF_TRANSPORT_AND_LOGISTICS_SERVICES = 10;
    case SAUDI_ELECTRICITY_COMPANY = 11;
    case SAUDI_WATER_COMPANY = 12;
    case SAUDI_RED_CRESCENT_AUTHORITY = 13;
    case MAKKAH_BUSES = 14;


    public function values()
    {
        return array_column(self::cases(), 'value');

    }

    public function lang()
    {
        return match ($this) {
            self::ROYAL_COMMISSION_MAKKAH_HOLY_SITES => 'الهيئة الملكية لمدينة مكة المكرمة والمشاعر المقدسة',
            self::MINISTRY_OF_INTERIOR => 'وزارة الداخلية',
            self::PRESIDENCY_OF_STATE_SECURITY => 'رئاسة أمن الدولة',
            self::GENERAL_AUTHORITY_FOR_TRANSPORT => 'الهيئة العامة للنقل',
            self::HOLY_CAPITAL_MUNICIPALITY => 'أمانة العاصمة المقدسة',
            self::COMMITTEE_FOR_TRANSPORTING_HAJJ_UMRAH_PRAYER_PERFORMERS => 'لجنة نقل الحجاج والمعتمرين والمصلين',
            self::GENERAL_UNION_OF_CARS => 'النقابة العامة للسيارات',
            self::TRANSPORT_COMPANIES => 'شركات النقل',
            self::SECURITY_GUARD_COMPANIES => 'شركات الحراسات الأمنية',
            self::MINISTRY_OF_FINANCE => 'وزارة المالية',
            self::MINISTRY_OF_TRANSPORT_AND_LOGISTICS_SERVICES => 'وزارة النقل والخدمات اللوجستية',
            self::SAUDI_ELECTRICITY_COMPANY => 'الشركة السعودية للكهرباء',
            self::SAUDI_WATER_COMPANY => 'الشركة السعودية للمياه',
            self::SAUDI_RED_CRESCENT_AUTHORITY => 'الهيئة السعودية للهلال الأحمر',
            self::MAKKAH_BUSES => 'حافلات مكة',
            default => 'غير معروف',
        };
    }

}
