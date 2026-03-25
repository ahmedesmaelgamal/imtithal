<?php

namespace App\Http\Controllers\Api;

use App\Models\Area;
use App\Models\DailyReportAssignUser;
use App\Models\GeneralReport;
use App\Models\User;
use App\Models\ViolationReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\FirestoreService;

class FcmController
{
    protected $firestoreService;
    public int $dailyReport = 0;
    public int $dailyGrowthPercentage = 0;

    public int $users = 0;
    public int $userGrowthPercentage = 0;

    public int $reports = 0;
    public int $reportGrowthPercentage = 0;

    public int $areas = 0;
    public int $areaGrowthPercentage = 0;

    public function __construct(FirestoreService $firestoreService)
    {
        $this->firestoreService = $firestoreService;
    }

    public function addUsersToFirestore()
    {
        // جلب جميع المستخدمين من قاعدة البيانات
        $users = User::all();

        // تحويل البيانات إلى تنسيق مناسب لـ Firestore
        $usersData = $users->map(function ($user) {
            return [
                'user_id' => $user->id, // الاحتفاظ بالمعرف إذا كنت بحاجة له
                'name' => $user->full_name,
                'email' => $user->email,
                'national_id' => $user->national_id,
                'image' => getFile($user->image),
                'created_at' => $user->created_at->toDateTimeString(),
                'updated_at' => $user->updated_at->toDateTimeString(),
                'role' => $user->getRoleNames()->first(),
                'lat' => '21.3891',
                'long' => '39.8579',
            ];
        })->toArray();
        // حفظ جميع المستخدمين في Firestore
        $result = [];
        foreach ($usersData as $user) {
            $result = $this->firestoreService->addUser($user);
        }

        // إرسال جميع المستخدمين إلى Firestore

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'All users successfully stored in Firestore',
                'data' => $result
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to store users in Firestore',
            ]);
        }
    }

    public function updateStatsFirestore()
    {
        //  get daily report stats
        $dailyReportCount = DailyReportAssignUser::whereDate('created_at', Carbon::now())->count();
        $yesterdayDailyReport = DailyReportAssignUser::whereDate('created_at', Carbon::yesterday())->count();

        $this->dailyReport = $dailyReportCount;

        if ($yesterdayDailyReport > 0) {
            $this->dailyGrowthPercentage = (($dailyReportCount - $yesterdayDailyReport) / $yesterdayDailyReport) * 100;
        } else {
            $this->dailyGrowthPercentage = $dailyReportCount > 0 ? 100 : 0;
        }

        // get user stats
        $todayUsers = User::whereDate('created_at', Carbon::today())->count();
        $yesterdayUsers = User::whereDate('created_at', Carbon::yesterday())->count();

        $this->users = $todayUsers; // إجمالي عدد المستخدمين

        // حساب نسبة الزيادة (تجنب القسمة على صفر)
        if ($yesterdayUsers > 0) {
            $this->userGrowthPercentage = (($todayUsers - $yesterdayUsers) / $yesterdayUsers) * 100;
        } else {
            $this->userGrowthPercentage = $todayUsers > 0 ? 100 : 0;
        }

        // get reports stats
        $todayReports = GeneralReport::whereDate('created_at', Carbon::today())->count() + ViolationReport::whereDate('created_at', Carbon::today())->count();
        $yesterdayReports = GeneralReport::whereDate('created_at', Carbon::yesterday())->count() + ViolationReport::whereDate('created_at', Carbon::yesterday())->count();

        $this->reports = $todayReports;

        if ($yesterdayReports > 0) {
            $this->reportGrowthPercentage = (($todayReports - $yesterdayReports) / $yesterdayReports) * 100;
        } else {
            $this->reportGrowthPercentage = $todayReports > 0 ? 100 : 0;
        }

        // get areas stats
        $areaCount = Area::whereDate('created_at', Carbon::now())->count();
        $yesterdayArea = Area::whereDate('created_at', Carbon::yesterday())->count();

        $this->areas = $areaCount;

        if ($yesterdayArea > 0) {
            $this->areaGrowthPercentage = (($areaCount - $yesterdayArea) / $yesterdayArea) * 100;
        } else {
            $this->areaGrowthPercentage = $areaCount > 0 ? 100 : 0;
        }

        $data = [
            'users_count' => $this->users,
            'user_growth_percentage' => $this->userGrowthPercentage,
            'daily_report_count' => $this->dailyReport,
            'daily_growth_percentage' => $this->dailyGrowthPercentage,
            'reports_count' => $this->reports,
            'report_growth_percentage' => $this->reportGrowthPercentage,
            'areas_count' => $this->areas,
            'area_growth_percentage' => $this->areaGrowthPercentage,
            'updated_at' => now()->toIso8601String()
        ];

        // حفظ الإحصائيات في Firestore
        return $this->firestoreService->addStats($data);
    }

    public function addMessage(Request $request)
    {
        // حفظ الرسالة في Firestore عبر REST API
        return $this->firestoreService->addMessage($request);
    }
}
