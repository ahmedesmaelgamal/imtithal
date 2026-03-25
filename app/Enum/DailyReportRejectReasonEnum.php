<?php

namespace App\Enum;

enum DailyReportRejectReasonEnum: int
{

    case INCOMPLETE_DATA = 1;
    case DATA_ERRORS = 2;
    case LATE_SUBMISSION = 3;
    case NON_COMPLIANT_TEMPLATE = 4;
    case UNCLEAR_CONTENT = 5;
    case MISSING_KEY_POINTS = 6;
    case DATA_INCONSISTENCY = 7;
    case WEAK_ANALYSIS = 8;
    case SPELLING_ERRORS = 9;
    case UNRELIABLE_SOURCES = 10;
    case IRRELEVANT_INFORMATION = 11;
    case IGNORED_INSTRUCTIONS = 12;
    case POOR_ORGANIZATION = 13;
    case NO_SUMMARY = 14;
    case UNNECESSARY_REPETITION = 15;
    case UNPROFESSIONAL_LANGUAGE = 16;
    case OUTDATED_DATA = 17;
    case LACK_OF_SUPPORTING_EVIDENCE = 18;
    case MISSING_IMPROVEMENT_POINTS = 19;
    case REPORT_NOT_REVIEWED = 20;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function lang(): string
    {
        return match ($this) {
            self::INCOMPLETE_DATA => 'عدم اكتمال البيانات',
            self::DATA_ERRORS => 'وجود أخطاء في البيانات',
            self::LATE_SUBMISSION => 'التأخير في تسليم التقرير',
            self::NON_COMPLIANT_TEMPLATE => 'عدم تطابق التقرير مع النماذج المعتمدة',
            self::UNCLEAR_CONTENT => 'عدم وضوح المحتوى',
            self::MISSING_KEY_POINTS => 'عدم تغطية النقاط الأساسية',
            self::DATA_INCONSISTENCY => 'وجود تناقض في البيانات',
            self::WEAK_ANALYSIS => 'ضعف التحليل أو التوصيات',
            self::SPELLING_ERRORS => 'أخطاء إملائية أو لغوية',
            self::UNRELIABLE_SOURCES => 'عدم استناد التقرير إلى مصادر موثوقة',
            self::IRRELEVANT_INFORMATION => 'تقديم معلومات غير ذات صلة',
            self::IGNORED_INSTRUCTIONS => 'تجاهل التعليمات المحددة',
            self::POOR_ORGANIZATION => 'ضعف تنظيم التقرير',
            self::NO_SUMMARY => 'عدم وجود ملخص أو خلاصة',
            self::UNNECESSARY_REPETITION => 'التكرار أو الإطالة غير الضرورية',
            self::UNPROFESSIONAL_LANGUAGE => 'استخدام لغة غير مهنية',
            self::OUTDATED_DATA => 'عدم تحديث البيانات',
            self::LACK_OF_SUPPORTING_EVIDENCE => 'عدم تقديم أدلة داعمة',
            self::MISSING_IMPROVEMENT_POINTS => 'عدم تضمين نقاط التحسين',
            self::REPORT_NOT_REVIEWED => 'عدم مراجعة التقرير قبل تقديمه',
        };
    }
}
