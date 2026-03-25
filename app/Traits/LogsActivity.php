<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    public static function bootLogsActivity()
    {
        static::created(function ($model) {
            $model->logActivity('create');
        });

        static::updated(function ($model) {
            $model->logActivity('update');
        });

        static::deleted(function ($model) {
            $model->logActivity('delete');
        });
    }

    protected function logActivity(string $event)
    {
        ActivityLog::create([
            'admin_id' => auth('web')->check() ? auth('web')->id() : null,
            'event' => $event,
            'model_type' => get_class($this),
            'model_id' => $this->id,
            'description' => $this->getActivityDescription($event),
            'old_data' => $event === 'update' ? $this->getOriginal() : null,
            'new_data' => $this->toArray(),
            'ip_address' => request()->ip(),
        ]);
    }

    protected function getActivityDescription(string $event): string
    {
        $modelName = $this->getModelArabicName();

        return match ($event) {
            'create' => "تم إنشاء سجل جديد في {$modelName}.",
            'update' => "تم تحديث سجل في {$modelName}.",
            'delete' => "تم حذف سجل من {$modelName}.",
            default => "حدث غير معروف في {$modelName}."
        };
    }

    protected function getModelArabicName(): string
    {
        return match (get_class($this)) {
            'App\Models\User' => 'الموظفين',
            'App\Models\Admin' => 'المشرفين',
            'App\Models\Alert' => 'الإشعارات',
            'App\Models\AlertLeader' => 'إشعارات القادة',
            'App\Models\AlertUser' => 'إشعارات الموطفين',
            'App\Models\Area' => 'المناطق',
            'App\Models\AreaLocation' => 'مواقع المناطق',
            'App\Models\AreaTeam' => 'فرق المناطق',
            'App\Models\Attendance' => 'الحضور',
            'App\Models\Axis' => 'المحاور',
            'App\Models\AxisQuestion' => 'أسئلة المحاور',
            'App\Models\BaseModel' => 'النموذج الأساسي',
            'App\Models\DailyAssignUserAnswer' => 'إجابات الموطف اليومية',
            'App\Models\DailyReport' => 'التقارير اليومية',
            'App\Models\DailyReportAssignUser' => 'تعيينات تقارير الموظف اليومية',
            'App\Models\GeneralReport' => 'التقارير العامة',
            'App\Models\Media' => 'الوسائط',
            'App\Models\Notice' => 'الإشعارات',
            'App\Models\NoticeType' => 'أنواع الإشعارات',
            'App\Models\PolicyPrivacy' => 'سياسة الخصوصية',
            'App\Models\QuestionAnswer' => 'الإجابات على الأسئلة',
            'App\Models\Room' => 'الغرف',
            'App\Models\RoomMessage' => 'رسائل الغرف',
            'App\Models\Setting' => 'الإعدادات',
            'App\Models\SupportChat' => 'دردشة الدعم',
            'App\Models\SupportChatMessage' => 'رسائل دردشة الدعم',
            'App\Models\ViolationReport' => 'تقارير المخالفات',
            default => 'السجلات'
        };
    }
}
