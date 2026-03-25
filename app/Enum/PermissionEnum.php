<?php

namespace App\Enum;

enum PermissionEnum: string
{
    case REPORTS = 'reports';
    case NOTIFICATIONS = 'notifications';
    case NOTICES = 'notices';
    case AXES = 'axes';
    case USERS = 'users';
    case ADMINS = 'admins';
    case ROLES = 'roles';
    case DAILY_REPORTS = 'daily_reports';
    case LOGS = 'logs';
    case SETTINGS = 'settings';

    case SUPPORTS = 'supports';
    case SEASONS = 'seasons';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function lang(): string
    {
        return match ($this) {
            self::REPORTS => 'ادارة التقارير',
            self::NOTICES => 'ادارة التنبيهات',
            self::NOTIFICATIONS => 'ادارة البلاغات',
            self::AXES => 'ادارة المحاور',
            self::ADMINS => 'ادارة مدراء النظام',
            self::USERS => 'ادارة الموظفين',
            self::ROLES => 'ادارة الأدوار والصلاحيات',
            self::DAILY_REPORTS => 'ادارة التقارير اليومية',
            self::LOGS => 'سجل عمليات النظام',
            self::SETTINGS => 'الإعدادات',
            self::SUPPORTS => 'ادارة الدعم الفني',
            self::SEASONS => 'ادارة المواسم',
        };
    }
}
