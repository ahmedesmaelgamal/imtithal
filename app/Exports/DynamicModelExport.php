<?php

namespace App\Exports;

use App\Enum\DailyReportRejectReasonEnum;
use App\Models\Admin;
use App\Models\Alert;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class DynamicModelExport implements FromCollection, WithHeadings, Responsable, WithColumnWidths
{
    protected $modelClass;
    protected $tableName;
    private $fileName;

    public function __construct($modelClass, protected $admin, protected $alert, protected $user, protected $area, protected $axis, protected $notice, protected $noticeType)
    {
        $this->modelClass = $modelClass;
        $this->tableName = Str::plural(Str::snake(class_basename($modelClass)));
//        dd($this->tableName);
        $this->fileName = "{$this->tableName}.xlsx";
    }

    public function collection()
    {
        if ($this->tableName == 'trips') {
            return $this->modelClass::with('area')->get()->map(function ($row) {
                return [
                    'trip_number' => $row->trip_number,
                    'air_carrier' => $row->air_carrier,
                    'departure_country' => $row->departure_country,
                    'readiness_list_number' => $row->readiness_list_number,
                    'service_provider' => $row->service_provider,
                    'hajj_groups_count' => $row->hajj_groups_count,
                    'hajjis_count' => $row->hajjis_count,
                    'arrival_date' => $row->arrival_date,
                    'arrival_time' => $row->arrival_time,
                    'executor' => $row->executor,
                    'contract_number' => $row->contract_number,
                    'area_name' => $row->area?->name,
                    'residence_city' => $row->residence_city,
                ];
            });
        }

        $columns = array_diff(Schema::getColumnListing($this->tableName), [
            'created_at', 'updated_at', 'fcm_token', 'otp', 'jwt_token',
            'password', 'otp_expire', 'deleted_at', 'delete_reason', 'image',
            'notification_type', 'true_parent_id', 'false_parent_id', 'order_number', 'plate_image', 'violation_image', 'map_url',
            'violation_video', 'level'

        ]);

        return $this->modelClass::select($columns)
            ->when($this->tableName == 'alerts', function($query) {
                $query->where('type', 'alert'); // Add this condition for alerts table
            })
            ->get()->map(function ($row) {
            if (isset($row->status)) {
                $row->status = $row->status == 1 ? 'نشط' : 'غير نشط';
            }
            if ($this->tableName == 'alerts') {
                if ($row->user_type === 0) {
                    $row->user_type = 'موظف';
                } elseif ($row->user_type == 1) {
                    $row->user_type = 'مشرف';
                } else {
                    $row->user_type = 'لا يوجد نوع محدد';
                }
                if (isset($row->alert_id)) {
                    $row->alert_id = $this->alert->find($row->leader_id)->name;
                }
                if (isset($row->leader_id)) {
                    $row->leader_id = $this->user->find($row->leader_id) ? $this->user->find($row->leader_id)->full_name : 'لا يوجد مشرف';
                } else {
                    $row->leader_id = 'لا يوجد مشرف';
                }
                if (isset($row->admin_id)) {
                    $row->admin_id = $this->admin->find($row->admin_id)->full_name;
                } else {
                    $row->admin_id = 'لا يوجد مدير';
                }

                if ($row->priority == 'low') {
                    $row->priority = 'منخفض';
                } elseif ($row->priority == 'mid') {
                    $row->priority = 'متوسط';
                } elseif ($row->priority == 'high') {
                    $row->priority = 'مرتفع';
                } else {
                    $row->priority = 'لا يوجد أولويه محدد';
                }

                if ($row->to == 0) {
                    $row->to = 'من المشرف الى الادراة';
                } elseif ($row->to == 1) {
                    $row->to = 'من المشرف الى الموظفين';
                } elseif ($row->to == 2) {
                    $row->to = 'من الادارة الى المشرفين';
                }
            }
            if ($this->tableName == 'alert_leaders') {
                if (isset($row->alert_id)) {
                    $row->alert_id = $this->alert->find($row->alert_id)->title;
                }
                if (isset($row->seen)) {
                    if ($row->seen == 0) {
                        $row->seen = 'غير مقروءة';
                    } elseif ($row->seen == 1) {
                        $row->seen = 'مقروءة';
                    }
                }
                if (isset($row->leader_id)) {
                    $row->leader_id = $this->user->find($row->leader_id)->full_name;
                } else {
                    $row->leader_id = 'لا يوجد مشرف';
                }


            }
            if ($this->tableName == 'alert_users') {
                if (isset($row->alert_id)) {
                    $row->alert_id = $this->alert->find($row->alert_id)->title;
                }
                if (isset($row->seen)) {
                    if ($row->seen == 0) {
                        $row->seen = 'غير مقروءة';
                    } elseif ($row->seen == 1) {
                        $row->seen = 'مقروءة';
                    }
                }
                if (isset($row->user_id)) {
                    $row->user_id = $this->user->find($row->user_id) ? $this->user->find($row->user_id)->full_name : 'لا يوجد موظف';
                } else {
                    $row->user_id = 'لا يوجد موظف';
                }
            }
            if ($this->tableName == 'area_locations') {
                if (isset($row->area_id)) {
                    $row->area_id = $this->area->find($row->area_id) ? $this->area->find($row->area_id)->name : 'لا يوجد منطقة';
                } else {
                    $row->area_id = 'لا يوجد منطقة';
                }
            }
            if ($this->tableName == 'area_teams') {
                if (isset($row->area_id)) {
                    $row->area_id = $this->area->find($row->area_id)->name;
                } else {
                    $row->area_id = 'لا يوجد منطقة';
                }
                if (isset($row->user_id)) {
                    $row->user_id = $this->user->find($row->user_id) ? $this->user->find($row->user_id)->full_name : 'لا يوجد موظف';
                } else {
                    $row->user_id = 'لا يوجد موظف';
                }

                if ($row->type == 0) {
                    $row->type = 'موظف';
                } elseif ($row->type == 1) {
                    $row->type = 'مشرف';
                }

            }
            if ($this->tableName == 'areas') {
                if (isset($row->axis_id)) {
                    $row->axis_id = $this->axis->find($row->axis_id)->name;
                } else {
                    $row->axis_id = 'لا يوجد محور';
                }

                if ($row->type == 0) {
                    $row->type = 'موقف';
                } elseif ($row->type == 1) {
                    $row->type = 'باص';
                } elseif ($row->type == 2) {
                    $row->type = 'سكك حديدية';
                } elseif ($row->type == 3) {
                    $row->type = 'طريق';
                } elseif ($row->type == 4) {
                    $row->type = 'محطة';
                } else {
                    $row->type = 'لا يوجد نوع محدد';
                }
            }
            if ($this->tableName == 'axis_questions') {
                if (isset($row->axis_id)) {
                    $row->axis_id = $this->axis->find($row->axis_id) ? $this->axis->find($row->axis_id)->name : "لا يوجد محور";
                } else {
                    $row->axis_id = 'لا يوجد محور';
                }

                if ($row->answer_type == 0) {
                    $row->answer_type = 'مقالي';
                } elseif ($row->answer_type == 1) {
                    $row->answer_type = 'اختيار من متعدد';
                } elseif ($row->answer_type == 2) {
                    $row->answer_type = 'نعم/لا';
                } else {
                    $row->answer_type = 'لا يوجد نوع محدد';
                }


                if (isset($row->require_file)) {
                    $row->require_file = $row->require_file == 0 ? 'لا' : 'نعم';
                }
            }
            if ($this->tableName == 'daily_reports') {
                if (isset($row->axis_id)) {
                    $row->axis_id = $this->axis->find($row->axis_id) ? $this->axis->find($row->axis_id)->name : 'لا يوجد محور';
                } else {
                    $row->axis_id = 'لا يوجد محور';
                }

                if ($row->monitor_type == 0) {
                    $row->monitor_type = 'تشغيليه';
                } elseif ($row->monitor_type == 1) {
                    $row->monitor_type = 'تخطيط و تنفيذ';
                } elseif ($row->monitor_type == 2) {
                    $row->monitor_type = 'أمن و سلامه';
                } else {
                    $row->monitor_type = 'لا يوجد نوع محدد';
                }


                if ($row->side_type == 0) {
                    $row->side_type = 'الرئاسة العامة لشؤون المسجد الحرام والمسجد النبوي';
                } elseif ($row->side_type == 1) {
                    $row->side_type = 'وزارة الداخلية';
                } elseif ($row->side_type == 2) {
                    $row->side_type = 'رئاسة أمن الدولة';
                } elseif ($row->side_type == 3) {
                    $row->side_type = 'الهيئة العامة للنقل';
                } elseif ($row->side_type == 4) {
                    $row->side_type = 'أمانة العاصمة المقدسة';
                } elseif ($row->side_type == 5) {
                    $row->side_type = 'لجنة نقل أداء مناسك الحج والعمرة والمصلين';
                } elseif ($row->side_type == 6) {
                    $row->side_type = 'الاتحاد العام للسيارات';
                } elseif ($row->side_type == 7) {
                    $row->organization_name = 'شركات النقل';
                } elseif ($row->side_type == 8) {
                    $row->side_type = 'شركات الحراسات الأمنية';
                } elseif ($row->side_type == 9) {
                    $row->side_type = 'وزارة المالية';
                } elseif ($row->side_type == 10) {
                    $row->side_type = 'وزارة النقل والخدمات اللوجستية';
                } elseif ($row->side_type == 11) {
                    $row->side_type = 'شركة الكهرباء السعودية';
                } elseif ($row->side_type == 12) {
                    $row->side_type = 'شركة المياه السعودية';
                } elseif ($row->side_type == 13) {
                    $row->side_type = 'هيئة الهلال الأحمر السعودي';
                } elseif ($row->side_type == 14) {
                    $row->side_type = 'حافلات مكة';
                } else {
                    $row->side_type = 'جهة غير محددة';
                }

            }
            if ($this->tableName == 'notice_types') {
//                if (!isset($row->level)) {
//                    $row->level = 'لا يوجد مستوى محدد';
//                }

                if (!isset($row->period)) {
                    $row->period = 'لا يوجد';
                }


                if ($row->priority == 'suggest') {
                    $row->priority = 'اقتراح';
                } elseif ($row->priority == 'low') {
                    $row->priority = 'منخفض';
                } elseif ($row->priority == 'mid') {
                    $row->priority = 'متوسط';
                } elseif ($row->priority == 'high') {
                    $row->priority = 'مرتفع';
                } else {
                    $row->priority = 'لا يوجد أولويه محدد';
                }

            }
            if ($this->tableName == 'notices') {

                if (isset($row->notice_type_id)) {
                    $row->notice_type_id = $this->noticeType->where('id', $row->notice_type_id)->first()->name;
                } else {
                    $row->notice_type_id = 'لا يوجد نوع إشعار';
                }

                if (isset($row->user_id)) {
                    $row->user_id = $this->user->find($row->user_id) ? $this->user->find($row->user_id)->full_name : 'لا يوجد مستخدم';
                } else {
                    $row->user_id = 'لا يوجد مستخدم';
                }

                if ($row->is_up == 0) {
                    $row->is_up = 'لم يتم تصعيد';
                } else {
                    $row->is_up = 'تم التصعيد';
                }


                if (!$row->refuse_notice) {
                    $row->refuse_notice = 'لا يوجد ملاحظات';
                }

                if (isset($row->leader_id)) {
                    $row->leader_id = $this->user->find($row->leader_id) ? $this->user->find($row->leader_id)->full_name : 'لا يوجد مشرف';
                } else {
                    $row->leader_id = 'لا يوجد مشرف';
                }
                if (isset($row->admin_id)) {
                    $row->admin_id = $this->admin->find($row->admin_id) ? $this->admin->find($row->admin_id)->full_name : 'لا يوجد مدير';
                } else {
                    $row->admin_id = 'لا يوجد مدير';
                }


                if ($row->refuse_reason === null) {
                    $row->refuse_reason = 'لا يوجد سبب محدد';
                } elseif ($row->refuse_reason == DailyReportRejectReasonEnum::INCOMPLETE_DATA->value) {
                    $row->refuse_reason = 'عدم اكتمال البيانات';
                } elseif ($row->refuse_reason == DailyReportRejectReasonEnum::DATA_ERRORS->value) {
                    $row->refuse_reason = 'وجود أخطاء في البيانات';
                } elseif ($row->refuse_reason == DailyReportRejectReasonEnum::LATE_SUBMISSION->value) {
                    $row->refuse_reason = 'التأخير في تسليم التقرير';
                } elseif ($row->refuse_reason == DailyReportRejectReasonEnum::NON_COMPLIANT_TEMPLATE->value) {
                    $row->refuse_reason = 'عدم تطابق التقرير مع النماذج المعتمدة';
                } elseif ($row->refuse_reason == DailyReportRejectReasonEnum::UNCLEAR_CONTENT->value) {
                    $row->refuse_reason = 'عدم وضوح المحتوى';
                } elseif ($row->refuse_reason == DailyReportRejectReasonEnum::MISSING_KEY_POINTS->value) {
                    $row->refuse_reason = 'عدم تغطية النقاط الأساسية';
                } elseif ($row->refuse_reason == DailyReportRejectReasonEnum::DATA_INCONSISTENCY->value) {
                    $row->refuse_reason = 'وجود تناقض في البيانات';
                } elseif ($row->refuse_reason == DailyReportRejectReasonEnum::WEAK_ANALYSIS->value) {
                    $row->refuse_reason = 'ضعف التحليل أو التوصيات';
                } elseif ($row->refuse_reason == DailyReportRejectReasonEnum::SPELLING_ERRORS->value) {
                    $row->refuse_reason = 'أخطاء إملائية أو لغوية';
                } elseif ($row->refuse_reason == DailyReportRejectReasonEnum::UNRELIABLE_SOURCES->value) {
                    $row->refuse_reason = 'عدم استناد التقرير إلى مصادر موثوقة';
                } elseif ($row->refuse_reason == DailyReportRejectReasonEnum::IRRELEVANT_INFORMATION->value) {
                    $row->refuse_reason = 'تقديم معلومات غير ذات صلة';
                } elseif ($row->refuse_reason == DailyReportRejectReasonEnum::IGNORED_INSTRUCTIONS->value) {
                    $row->refuse_reason = 'تجاهل التعليمات المحددة';
                } elseif ($row->refuse_reason == DailyReportRejectReasonEnum::POOR_ORGANIZATION->value) {
                    $row->refuse_reason = 'ضعف تنظيم التقرير';
                } elseif ($row->refuse_reason == DailyReportRejectReasonEnum::NO_SUMMARY->value) {
                    $row->refuse_reason = 'عدم وجود ملخص أو خلاصة';
                } elseif ($row->refuse_reason == DailyReportRejectReasonEnum::UNNECESSARY_REPETITION->value) {
                    $row->refuse_reason = 'التكرار أو الإطالة غير الضرورية';
                } elseif ($row->refuse_reason == DailyReportRejectReasonEnum::UNPROFESSIONAL_LANGUAGE->value) {
                    $row->refuse_reason = 'استخدام لغة غير مهنية';
                } elseif ($row->refuse_reason == DailyReportRejectReasonEnum::OUTDATED_DATA->value) {
                    $row->refuse_reason = 'عدم تحديث البيانات';
                } elseif ($row->refuse_reason == DailyReportRejectReasonEnum::LACK_OF_SUPPORTING_EVIDENCE->value) {
                    $row->refuse_reason = 'عدم تقديم أدلة داعمة';
                } elseif ($row->refuse_reason == DailyReportRejectReasonEnum::MISSING_IMPROVEMENT_POINTS->value) {
                    $row->refuse_reason = 'عدم تضمين نقاط التحسين';
                } elseif ($row->refuse_reason == DailyReportRejectReasonEnum::REPORT_NOT_REVIEWED->value) {
                    $row->refuse_reason = 'عدم مراجعة التقرير قبل تقديمه';
                } else {
                    $row->refuse_reason = 'سبب غير معروف';
                }
                if ($row->priority == '')

                    if ($row->user_type == 0) {
                        $row->user_type = 'موظف';
                    } elseif ($row->user_type == 1) {
                        $row->user_type = 'مشرف';
                    }
            }
            if ($this->tableName == 'bus_reports') {
                if (isset($row->area_id)) {
                    $row->area_id = $this->area->find($row->area_id) ? $this->area->find($row->area_id)->name : 'لا يوجد منطقه';
                } else {
                    $row->area_id = 'لا يوجد منطقه';
                }
                if (isset($row->user_id)) {
                    $row->user_id = $this->user->find($row->user_id)->full_name;
                } else {
                    $row->user_id = 'لا يوجد مستخدم';
                }
            }
            if ($this->tableName == 'violation_reports') {
                if (isset($row->user_id)) {
                    $row->user_id = $this->user->find($row->user_id)->full_name;
                } else {
                    $row->user_id = 'لا يوجد موظف';
                }
                if (isset($row->admin_id)) {
                    $row->admin_id = $this->admin->find($row->admin_id)->full_name;
                } else {
                    $row->admin_id = 'لا يوجد مدير';
                }

                if ($row->user_type == 0) {
                    $row->user_type = 'موظف';
                } elseif ($row->user_type == 1) {
                    $row->user_type = 'مشرف';
                }

                if (!isset($row->refuse_reason)) {
                    $row->refuse_reason = 'لا يوجد سبب محدد';
                }
                if (!isset($row->refuse_notes)) {
                    $row->refuse_notes = 'لا يوجد ملاحظات';
                }


            }
            if ($this->tableName == 'general_reports') {

                if (!isset($row->extra)) {
                    $row->extra = 'لا يوجد ملاحظات';
                }

                if (!isset($row->refuse_reason)) {
                    $row->refuse_reason = 'لا يوجد سبب محدد';
                }
                if (!isset($row->refuse_notes)) {
                    $row->refuse_notes = 'لا يوجد ملاحظات';
                }


                if (isset($row->leader_id)) {
                    $row->leader_id = $this->user->find($row->leader_id) ? $this->user->find($row->leader_id)->full_name : 'لا يوجد مدير';
                } else {
                    $row->user_id = 'لا يوجد مشرف';
                }

                if (isset($row->admin_id)) {
                    $row->admin_id = $this->admin->find($row->admin_id) ? $this->admin->find($row->admin_id)->full_name : 'لا يوجد مدير';
                } else {
                    $row->admin_id = 'لا يوجد مدير';
                }

            }
            if ($this->tableName == 'attendances') {
                if (isset($row->user_id)) {
                    $row->user_id = $this->user->find($row->user_id) ? $this->user->find($row->user_id)->full_name : 'لا يوجد موظف';
                } else {
                    $row->user_id = 'لا يوجد موظف';
                }


                if (!isset($row->checkin)) {
                    $row->checkin = 'لا يوجد موقع محدد';
                }
                if (!isset($row->checkout)) {
                    $row->checkout = 'لا يوجد موقع محدد';
                }
                if (!isset($row->checkin_lat)) {
                    $row->checkin_lat = 'لا يوجد موقع محدد';
                }
                if (!isset($row->checkin_long)) {
                    $row->checkin_long = 'لا يوجد موقع محدد';
                }
                if (!isset($row->checkout_lat)) {
                    $row->checkout_lat = 'لا يوجد موقع محدد';
                }
                if (!isset($row->checkout_long)) {
                    $row->checkout_long = 'لا يوجد موقع محدد';
                }
                if (!isset($row->date)) {
                    $row->date = 'لا يوجد تاريخ محدد';
                }


            }


            return $row;
        });
    }


    public function headings(): array
    {
        if ($this->tableName == 'trips') {
            return [
                'رقم الرحلة',
                'الناقل الجوي',
                'دولة الحجاج',
                'رقم كشف الاستعداد',
                'شركة تقديم الخدمة',
                'عدد مجموعات الحجاج بالرحلة',
                'عدد الحجاج',
                'تاريخ الوصول',
                'وقت الوصول',
                'المنفذ',
                'رقم العقد',
                'المنطقة',
                'مدينة السكن',
            ];
        }

        return array_diff(Schema::getColumnListing($this->tableName), ['created_at', 'updated_at', 'fcm_token',
            'otp', 'jwt_token', 'password',
            'otp_expire',
            'deleted_at',
            'delete_reason',
            'image',
            'notification_type',
            'true_parent_id',
            'false_parent_id',
            'order_number',
            'plate_image',
            'violation_image',
            'violation_video',
            'map_url',
            'level'

        ]);
    }

    public
    function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 20,
            'G' => 20,
        ];
    }


    public
    function toResponse($request)
    {
        return Excel::download($this, $this->fileName);
    }
}
