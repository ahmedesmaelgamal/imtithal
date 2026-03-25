<?php

namespace App\Services\Api\Map;

use App\Enum\AreaTypeEnum;
use App\Enum\DailyReportAssignUserStatusEnum;
use App\Http\Resources\Leaders\LeaderResource;
use App\Http\Resources\Map\BusTimeResource;
use App\Http\Resources\Map\MapAdminResource;
use App\Http\Resources\Map\MapAlertResource;
use App\Http\Resources\Map\MapAreaResource;
use App\Http\Resources\Map\MapAxisQuestionPercentageResource;
use App\Http\Resources\Map\MapAxisQuestionResource;
use App\Http\Resources\Map\MapBaseAlertResource;
use App\Http\Resources\Map\MapDailyReportDetailsResource;
use App\Http\Resources\Map\MapDailyReportResource;
use App\Http\Resources\Map\MapFullNoticeResource;
use App\Http\Resources\Map\MapNoticeDetailsResource;
use App\Http\Resources\Map\MapNoticeResource;
use App\Http\Resources\Map\MapRoleResource;
use App\Http\Resources\Map\MapTeamResource;
use App\Http\Resources\Map\MapUserResource;
use App\Http\Resources\NoticeResource;
use App\Http\Resources\Users\AreaResource;
use App\Http\Resources\Users\AxisQuestionResource;
use App\Http\Resources\Users\AxisResource;
use App\Http\Resources\Users\DailyReportResource;
use App\Http\Resources\Users\UserResource;
use App\Models\Admin;
use App\Models\Alert;
use App\Models\AlertUser;
use App\Models\Area;
use App\Models\AreaTeam;
use App\Models\Attendance;
use App\Models\Axis;
use App\Models\AxisQuestion;
use App\Models\BusReport;
use App\Models\DailyAssignUserAnswer;
use App\Models\DailyReport;
use App\Models\DailyReportAssignUser;
use App\Models\DeviceToken;
use App\Models\GeneralReport;
use App\Models\Notice;
use App\Models\NoticeType;
use App\Models\QuestionAnswer;
use App\Models\User;
use App\Models\ViolationReport;
use App\Services\BaseService;
use App\Services\Web\DailyReportAssignService;
use Carbon\Carbon;
use Google\Service\AndroidEnterprise\Device;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Tymon\JWTAuth\Facades\JWTAuth;

class MapService extends BaseService
{
    public function __construct(protected Area                  $area,
                                protected Axis                  $axis,
                                protected AreaTeam              $areaTeam,
                                protected User                  $user,
                                protected DailyReport           $dailyReport,
                                protected Notice                $notice,
                                protected Attendance            $attendance,
                                protected DailyReportAssignUser $dailyReportAssign,
                                protected DailyAssignUserAnswer $dailyAssignUserAnswer,
                                protected AxisQuestion          $axisQuestion,
                                protected QuestionAnswer        $questionAnswer,
                                protected ViolationReport       $violationReport,
                                protected GeneralReport         $generalReport,
                                protected Alert                 $alert,
                                protected NoticeType            $noticeType,
                                protected BusReport             $busReport,

    )
    {
    }

    public function login($request)
    {
        $validator = $this->apiValidator($request->all(), [
            'national_or_email' => 'required',
            'password' => 'required',
        ]);

        if ($validator) {
            return $validator;
        }
        $admin = Admin::where('national_id', $request->national_or_email)->
        orWhere('email', $request->national_or_email)->first();

        if (!$admin) {
            return $this->responseMsg('لا يمكن العثور على الموظف', null, 422);
        }

        if ($admin->status == 0) {
            return $this->responseMsg('حسابك غير نشط، يرجى الاتصال بالمسؤول', null, 422);
        }
        if ($admin->is_map == 0) {
            return $this->responseMsg('لا يمكن تسجيل الدخول، يرجى الاتصال بالمسؤول', null, 422);
        }

        $token = Auth::guard('map')->attempt([
            'national_id' => $admin->national_id,
            'password' => $request->password
        ]);
        $admin->token = 'Bearer ' . $token;


        if ($token) {
            return $this->responseMsg('تم تسجيل الدخول ', MapAdminResource::make($admin));
        } else {
            return $this->responseMsg('فشل تسجيل الدخول، تحقق من بيانات الاعتماد الخاصة بك', null, 422);
        }

    }

    public function logout($request)
    {
        $user = Auth::guard('map')->user();


        $token = JWTAuth::getToken();
        JWTAuth::invalidate($token);
       $fcmToken= DeviceToken::where('token', $request->fcm_token)->first();
       if($fcmToken){
           $fcmToken->delete();

       }
        Auth::guard('map')->logout();


        return $this->responseMsg('تم تسجيل الخروج', null);
    }


    public function getAreas($axis_id)
    {
        $areas = $this->area->where('axis_id', $axis_id)->get();
        return $this->successResponse(MapAreaResource::collection($areas));
    }


    public function getAreasWithoutAxis()
    {
        $areas = $this->area->get();
        return $this->successResponse(MapAreaResource::collection($areas));
    }

    public function getAxes()
    {

        return $this->successResponse(AxisResource::collection($this->axis->get()));
    }

    public function getAxisDetails($id)
    {
        $object = $this->axis->find($id);
        if ((!$object)) {
            return $this->responseMsg('Axis not found', 404);
        }

        $axisAreas = $object->areas()->get();
        $areasTeamCount = $this->areaTeam->whereIn('area_id', $axisAreas->pluck('id'))->count();

        $daily_reports_count = $this->dailyReport->where('axis_id', $id)->count();

        $userIds = $this->notice->pluck('user_id')->toArray();
        $users = $this->areaTeam->whereIn('area_id', $axisAreas->pluck('id'))->pluck('user_id')->toArray();
        $usersFiltered = array_unique(array_merge($userIds, $users));
        $noticeCount = $this->user->whereIn('id', $usersFiltered)->count();

        $data = [
            'id' => $object->id,
            'user_count' => $areasTeamCount,
            'daily_reports_count' => $daily_reports_count,
            'notice_count' => $noticeCount,

        ];


    }

    public function getAreaDetails($id)
    {

        $area = $this->area->find($id);
        if (!$area) {
            return $this->responseMsg('Area not found', 404);
        }

        $leader = $this->areaTeam->where('area_id', $area->id)->where('type', '1')->first()->user;
        $data = [
            'name' => $area->name,
            'area_type' => AreaTypeEnum::from($area->type)->lang(),
            'type' => $area->type,
            'id' => $leader->id,
            'leader' => $leader->full_name,
            'phone' => $leader->phone,
            'image' => getFile($leader->image, 'assets/uploads/avatar.png'),
            'national_id' => (int)$leader->national_id,
            'users' => MapUserResource::collection($this->user->whereIn('id', $this->areaTeam->where('area_id', $area->id)->where('type', '0')->get()->pluck('user_id'))->get()),
        ];
        return $this->successResponse($data);

    }

    public function getLeaderDetails($id)
    {
        $leader = $this->user->find($id);
        $data = [
            'name' => $leader->full_name,
            'phone' => $leader->phone,
            'image' => getFile($leader->image, 'assets/uploads/avatar.png'),
            'national_id' => (int)$leader->national_id,
            'complete_daily_reports_count' => $this->dailyReportAssign->where('leader_id', $leader->id)->where('status', DailyReportAssignUserStatusEnum::COMPLETED)->count(),
            'refused_daily_reports_count' => $this->dailyReportAssign->where('leader_id', $leader->id)->where('status', DailyReportAssignUserStatusEnum::NEED_EDIT)->count(),
            'notice_count' => $this->notice->where('leader_id', $leader->id)->count(),
            'reports_count' => $this->violationReport->where('user_id', $leader->id)->where('user_type', '0')->count() + $this->generalReport->
                where('leader_id', $leader->id)
                    ->count(),
            'leader_team' => $this->areaTeam->where('user_id', $leader->id)->first()
                ? MapTeamResource::collection($this->user->whereIn('id', $this->areaTeam->where('area_id', $this->areaTeam->where('user_id', $leader->id)->first()->area_id)->where('type', '0')->get()->pluck('user_id'))->get())
                : [],

        ];

        return $this->successResponse($data);


    }


    public function getUserDetails($id)
    {

        $user = $this->user->find($id);
        $totalDays = Carbon::parse($user->created_at)->diffInDays(now());
        $attendances = $this->attendance->where('user_id', $user->id)->count();
        $data = [
            'user' => MapUserResource::make($user),
            'complete_daily_reports_count' => $this->dailyReportAssign->where('user_id', $user->id)->where('status', DailyReportAssignUserStatusEnum::COMPLETED)->count(),
//            'refused_daily_reports_count' => $this->dailyReportAssign->where('user_id', $user->id)->where('status', DailyReportAssignUserStatusEnum::NEED_EDIT)->count(),
            'reports_count' => $this->violationReport->where('user_id', $user->id)->where('user_type', '0')->count(),
            'notice_count' => $this->notice->where('user_id', $user->id)->count(),
            'attendance_percentage' => round($attendances / $totalDays * 100),
            'absence_percentage' => round((($totalDays - $attendances) / $totalDays) * 100),
            'daily_reports' => MapDailyReportDetailsResource::collection($this->dailyReportAssign->where('user_id', $user->id)->get()),


        ];

        return $this->successResponse($data);


    }

    public function getDailyReportDetails($request, $id)
    {
        $dailyReportAssign = $this->dailyReportAssign->where('daily_report_id', $id)->where('user_id', $request->user_id)->first();

        if (!$dailyReportAssign) {

            return $this->responseMsg('لم يتم العثور علي التقرير', null, 404);
        }

//        dd($dailyReportAssign->id);

        $data = [
            'user_name' => $dailyReportAssign->user->full_name,
            'date' => Carbon::parse($dailyReportAssign->created_at)->locale('ar')->translatedFormat('d F Y'),
            'title' => (string)$dailyReportAssign->dailyReport->title,
            'description' => (string)$dailyReportAssign->dailyReport->description,
            'questions' => $dailyReportAssign->axis->axisQuestions()->get()->map(function ($question) use ($dailyReportAssign) {
                return new MapAxisQuestionResource($question, $dailyReportAssign->id);
            }),
            ];
        return $this->successResponse($data);

    }


    public function getFilterObjects($request)
    {
        // Define type and period filters
        //   '0' => 'موقف',
        //  '1' => 'باص',
        //  '2' => 'سكة حديدية',
        //  '3' => 'طريق',
        //  '4' => 'محطة',

        $periodFilters = [
            0 => now()->subDays(1),
            1 => now()->subWeek(),
            2 => now()->subMonth(),
            3 => now()->subYear(),
        ];

        // Check filter parent if 0 search in axis
        if ($request->parent == 0) {
            $object = $this->axis->where('name', 'like', '%' . $request->search . '%')
                ->when($request->period, function ($query) use ($request, $periodFilters) {
                    if (isset($periodFilters[$request->period])) {
                        $query->where('created_at', '>=', $periodFilters[$request->period]);
                    }
                })
                ->when($request->type, function ($query) use ($request) {
                    $query->whereHas('areas', function ($query) use ($request) {
                        $query->where('type', $request->type);
                    });
                })
                ->orderBy('id', 'desc')
                ->get();

            $data = [
                'axes' => AxisResource::collection($object),
                'areas' => AreaResource::collection($this->area->whereIn('axis_id', $object->pluck('id'))->get()),
            ];

            return $this->successResponse($data);

        } elseif ($request->parent == 1) {
            $object = $this->area->where('name', 'like', '%' . $request->search . '%')
                ->when($request->period, function ($query) use ($request, $periodFilters) {
                    if (isset($periodFilters[$request->period])) {
                        $query->where('created_at', '>=', $periodFilters[$request->period]);
                    }
                })
                ->when($request->type, function ($query) use ($request) {

                    $query->where('type', $request->type);
                })
                ->orderBy('id', 'desc')
                ->get();

            $data = [
                'areas' => MapAreaResource::collection($object),
            ];

            return $this->successResponse($data);
        } elseif ($request->parent == 2) {
            $object = $this->dailyReport->where('title', 'like', '%' . $request->search . '%')
                ->when($request->period, function ($query) use ($request, $periodFilters) {
                    if (isset($periodFilters[$request->period])) {
                        $query->where('created_at', '>=', $periodFilters[$request->period]);
                    }
                })
                ->when($request->type, function ($query) use ($request) {
                    $areaIds = $this->area->where('type', $request->type)->pluck('axis_id');

                    $query->whereIn('axis_id', $areaIds);
                })
                ->orderBy('id', 'desc')
                ->get();

            $data = [
                'daily_reports' => MapDailyReportResource::collection($object),
            ];

            return $this->successResponse($data);
        } elseif ($request->parent == 3) {

            $object = $this->area->when($request->period, function ($query) use ($request, $periodFilters) {
                if (isset($periodFilters[$request->period])) {
                    $query->where('created_at', '>=', $periodFilters[$request->period]);
                }
            })
                ->when($request->type, function ($query) use ($request) {
                    $areaIds = $this->area->where('type', $request->type)->pluck('axis_id');

                    $query->whereIn('axis_id', $areaIds);
                })
                ->orderBy('id', 'desc')
                ->get();

            $dailyReports = $this->dailyReport->where('title', 'like', '%' . $request->search . '%')->whereIn('axis_id', $object->pluck('axis_id'))->get();
            $data = [
                'daily_reports' => MapDailyReportResource::collection($dailyReports),
            ];

            return $this->successResponse($data);

        } elseif ($request->parent == 4) {

            $object = $this->noticeType
                ->when($request->period, function ($query) use ($request, $periodFilters) {
                    if (isset($periodFilters[$request->period])) {
                        $query->where('created_at', '>=', $periodFilters[$request->period]);
                    }
                })
                ->distinct()
                ->orderBy('id', 'desc')
                ->get();

            $data = [
                'notice' => MapNoticeResource::collection($object),


            ];


            return $this->successResponse($data);

        } elseif ($request->parent == 5) {
            $object = $this->dailyReport->where('title', 'like', '%' . $request->search . '%')
                ->when($request->period, function ($query) use ($request, $periodFilters) {
                    if (isset($periodFilters[$request->period])) {
                        $query->where('created_at', '>=', $periodFilters[$request->period]);
                    }
                })
                ->when($request->type, function ($query) use ($request) {
                    $areaIds = $this->area->where('type', $request->type)->pluck('axis_id');

                    $query->whereIn('axis_id', $areaIds);
                })
                ->orderBy('id', 'desc')
                ->get();

            $objectAssigned = $this->dailyReportAssign->whereIn('daily_report_id', $object->pluck('id'))->get();


            $data = [
                'assigned' => MapDailyReportResource::collection($object->whereIn('id', $objectAssigned->pluck('daily_report_id'))),

            ];


            return $this->successResponse($data);
        } elseif ($request->parent == 6) {
            $object = $this->alert->where('to', '2')
                ->when($request->period, function ($query) use ($request, $periodFilters) {
                    if (isset($periodFilters[$request->period])) {
                        $query->where('created_at', '>=', $periodFilters[$request->period]);
                    }
                })
                ->orderBy('id', 'desc')
                ->get();


            $data = [
//                'alerts' => MapBaseAlertResource::collection($object),


            ];


            return $this->successResponse();
        }

    }


    // details if he searches in the last function using 0

    public function getDetailsForParent0($request)
    {
        $periodFilters = [
            0 => now()->subDays(1),
            1 => now()->subWeek(),
            2 => now()->subMonth(),
            3 => now()->subYear(),
        ];

        $axis_id = $request->axis_id;
        $area_id = $request->area_id;
        $period = $request->period;

        $axisAreas = $this->area->where('axis_id', $axis_id)->get();
        $axisTeamCount = $this->areaTeam->whereIn('area_id', $axisAreas->pluck('id'))->get();
        $teamCount = $axisTeamCount->count();
        $noticeCount = $this->notice->whereIn('user_id', $axisTeamCount->pluck('user_id'))->count();

        // جمع الحضور لكل يوم من أيام الأسبوع
        $attendanceStats = $this->attendance
            ->whereIn('user_id', $axisTeamCount->pluck('user_id'))
            ->when(isset($periodFilters[$period]), function ($query) use ($periodFilters, $period) {
                $query->where('created_at', '>=', Carbon::now()->startOfWeek());
            })
            ->get()
            ->groupBy(function ($attendance) {
                return Carbon::parse($attendance->date)->format('l');
            });

        // تحويل الأيام إلى العربية
        $daysOfWeek = [
            'Sunday' => 'الأحد',
            'Monday' => 'الاثنين',
            'Tuesday' => 'الثلاثاء',
            'Wednesday' => 'الأربعاء',
            'Thursday' => 'الخميس',
            'Friday' => 'الجمعة',
            'Saturday' => 'السبت',
        ];

        // حساب الحضور والغياب
        $attendanceData = [];
        foreach ($daysOfWeek as $key => $dayName) {
            $dayAttendances = $attendanceStats->get($key, collect());
            $attendanceCount = min($dayAttendances->count(), $teamCount); // منع تجاوز 100%
            $absenceCount = max(0, $teamCount - $attendanceCount); // منع القيم السالبة

            $attendanceData[$dayName] = [
                'attendance' => $attendanceCount,
                'absence' => $absenceCount,
            ];
        }

        // حساب النسب المئوية
        $attendancePercentages = [];
        $absencePercentages = [];
        foreach ($attendanceData as $day => $data) {
            if ($teamCount > 0) {
                $attendancePercentages[$day] = round(($data['attendance'] / $teamCount) * 100, 2);
                $absencePercentages[$day] = round(($data['absence'] / $teamCount) * 100, 2);
            } else {
                $attendancePercentages[$day] = 0;
                $absencePercentages[$day] = 0;
            }
        }

        // حساب نسبة التقارير اليومية المكتملة وغير المكتملة
        $dailyReportCompletionStats = [];
        $dailyReportNotCompletionStats = [];
        foreach ($daysOfWeek as $key => $dayName) {
            $dayDate = Carbon::now()->startOfWeek()->addDays(array_search($key, array_keys($daysOfWeek)));
            $dayReports = $this->dailyReport->where('axis_id', $axis_id)
                ->whereDate('created_at', $dayDate->format('Y-m-d'))
                ->pluck('id');

            $completedReports = $this->dailyReportAssign->whereIn('daily_report_id', $dayReports)
                ->where('status', '4')->count();

            $notCompletedReports = $this->dailyReportAssign->whereIn('daily_report_id', $dayReports)
                ->where('status', '!=', '4')->count();


            $totalReports = $dayReports->count();
            $dailyReportCompletionStats[$dayName] = ($totalReports > 0) ? round(($completedReports / $totalReports) * 100, 2) : 0;
            $dailyReportNotCompletionStats[$dayName] = ($totalReports > 0) ? round(($notCompletedReports / $totalReports) * 100, 2) : 0;
        }

        // حساب الأسئلة والإجابات
        $axisQuestions = $this->axisQuestion->where('axis_id', $axis_id)
            ->where('answer_type', '2')
            ->get();

        $axisQuestionsAnswers = $this->questionAnswer->whereIn('axis_question_id', $axisQuestions->pluck('id'))->get();
        $UsersAnswers = $this->dailyAssignUserAnswer->whereIn('axis_question_id', $axisQuestions->pluck('id'))->get();
        $UsersAnswerYes = $this->dailyAssignUserAnswer->whereIn('question_answer_id', $axisQuestionsAnswers->where('answer', 'نعم')->pluck('id'))->get();
        $UsersAnswerNo = $this->dailyAssignUserAnswer->whereIn('question_answer_id', $axisQuestionsAnswers->where('answer', 'لا')->pluck('id'))->get();

        // إعداد البيانات للإرجاع
        $data = [
            'numberOfUsersInAxisCount' => $teamCount,
            'numberOfDailyReportsInAxis' => $this->dailyReport->where('axis_id', $axis_id)->count(),
            'noticeCount' => $noticeCount,
            'attendance_percentages' => $attendancePercentages,
            'absence_percentages' => $absencePercentages,
            'percentageOfDoneAxisToDailyReports' => $dailyReportCompletionStats,
            'percentageOfNotDoneAxisToDailyReports' => $dailyReportNotCompletionStats,
            'axisQuestions' => $axisQuestions->map(function ($question) use ($UsersAnswers, $UsersAnswerYes, $UsersAnswerNo) {
                return (new MapAxisQuestionPercentageResource($question))
                    ->setAnswers($UsersAnswers, $UsersAnswerYes, $UsersAnswerNo);
            }),
        ];

        return $this->successResponse($data);
    }


    public function getDetailsForParent1($request)
    {
        $periodFilters = [
            0 => now()->subDays(1),
            1 => now()->subWeek(),
            2 => now()->subMonth(),
            3 => now()->subYear(),
        ];


        $axis_id = $request->axis_id;
        $area_id = $request->area_id;
        $period = $request->period;


        $areaTeamCount = $this->areaTeam->where('area_id', $area_id)->get();
        // جمع الحضور لكل يوم من أيام الأسبوع
        $attendanceStats = $this->attendance
            ->whereIn('user_id', $areaTeamCount->pluck('user_id'))
            ->when(isset($periodFilters[$period]), function ($query) use ($periodFilters, $period) {
                $query->where('created_at', '>=', $periodFilters[$period]);
            })
            ->get()
            ->groupBy(function ($attendance) {
                return Carbon::parse($attendance->date)->format('l'); // يوم الأسبوع
            });

        // تحويل الأيام إلى أسماء باللغة العربية
        $daysOfWeek = [
            'Sunday' => 'الأحد',
            'Monday' => 'الاثنين',
            'Tuesday' => 'الثلاثاء',
            'Wednesday' => 'الأربعاء',
            'Thursday' => 'الخميس',
            'Friday' => 'الجمعة',
            'Saturday' => 'السبت',
        ];

        // حساب الحضور والغياب
        $attendanceData = [];
        foreach ($daysOfWeek as $key => $dayName) {
            $dayAttendances = $attendanceStats->get($key, collect());
            $attendanceData[$dayName] = [
                'attendance' => $dayAttendances->count(),
                'absence' => $areaTeamCount->count() - $dayAttendances->count(),
            ];
        }

        // حساب النسب المئوية
        $attendancePercentages = [];
        $absencePercentages = [];
        foreach ($attendanceData as $day => $data) {
            if ($areaTeamCount->count() > 0) {
                $attendancePercentages[$day] = $data['attendance'] / $areaTeamCount->count() * 100;
                $absencePercentages[$day] = $data['absence'] / $areaTeamCount->count() * 100;
            } else {
                // If no team members, set percentages to 0
                $attendancePercentages[$day] = 0;
                $absencePercentages[$day] = 0;
            }
        }


        // حساب النسبة المئوية للتقارير اليومية المكتملة لكل يوم بناءً على الحالة "COMPLETED"
        $dailyReports = $this->dailyReport->where('axis_id', $axis_id)->pluck('id');
        $dailyReportCompletionStats = [];
        $dailyReportNotCompletionStats = [];

        foreach ($daysOfWeek as $key => $dayName) {
            // حساب تاريخ اليوم المعني في الأسبوع بناءً على التاريخ الحالي
            $dayDate = Carbon::now()->startOfWeek()->addDays(array_search($key, array_keys($daysOfWeek))); // الحصول على تاريخ اليوم (مثلاً الأحد، الاثنين)
            $dayReports = $this->dailyReport->where('axis_id', $axis_id)
                ->whereDate('created_at', $dayDate->format('Y-m-d'))->pluck('id'); // التقارير اليومية لهذا اليوم

            // التحقق من وجود تقارير بهذا اليوم مع الحالة "COMPLETED" قبل القسمة
            $completedReports = $this->dailyReportAssign->whereIn('daily_report_id', $dayReports)
                ->where('status', 'COMPLETED')->count();

            // التحقق من التقارير غير المكتملة (التي تحتوي على حالة "NOT COMPLETED")
            $notCompletedReports = $this->dailyReportAssign->whereIn('daily_report_id', $dayReports)
                ->where('status', 'NOT COMPLETED')->count();

            // تحقق من أن عدد التقارير أكبر من صفر قبل القيام بالقسمة
            $dailyReportCompletionStats[$dayName] = $dayReports->count() > 0
                ? round(($completedReports / $dayReports->count()) * 100, 2)
                : 0; // إذا لم توجد تقارير، ضع النسبة 0

            // حساب نسبة التقارير غير المكتملة
            $dailyReportNotCompletionStats[$dayName] = $dayReports->count() > 0
                ? round(($notCompletedReports / $dayReports->count()) * 100, 2)
                : 0; // إذا لم توجد تقارير، ضع النسبة 0
        }
        $axisQuestions = $this->axisQuestion->where('axis_id', $axis_id)
            ->where('answer_type', '2')
            ->get();
        $axisQuestionsAnswers = $this->questionAnswer->whereIn('axis_question_id', $axisQuestions->pluck('id'))->get();
        $UsersAnswers = $this->dailyAssignUserAnswer->whereIn('axis_question_id', $axisQuestions->pluck('id'))->get();
        $UsersAnswerYes = $this->dailyAssignUserAnswer->whereIn('question_answer_id', $axisQuestionsAnswers->where('answer', 'نعم')->pluck('id'))->get();
        $UsersAnswerNo = $this->dailyAssignUserAnswer->whereIn('question_answer_id', $axisQuestionsAnswers->where('answer', 'لا')->pluck('id'))->get();

        $busReportBusReport = BusReport::where('area_id', $area_id)->whereDate('created_at', Carbon::today())->first();
        $data = [
            'numberOfUsersInAreaCount' => $areaTeamCount->count(),
            'busesCount' => $busReportBusReport->bus_count ?? null,
            'end_time' => $busReportBusReport ? [
                'day' => $busReportBusReport->end_time ? Carbon::parse($busReportBusReport->end_time)->locale('ar')->translatedFormat('d') : null,
                'time' => $busReportBusReport->end_time ? Carbon::parse($busReportBusReport->end_time)->format('h:i') . ' ' .
                    (Carbon::parse($busReportBusReport->end_time)->format('A') == 'AM' ? 'صباحاً' : 'مساءً') : null
            ] : null,
            'numberOfDailyReportsInArea' => $this->dailyReportAssign
                ->where('daily_report_id', $this->dailyReport->where('axis_id', $axis_id)->pluck('id')->toArray())
                ->count(),

            'numberOfDailyReportsAssignedInArea' => $this->dailyReportAssign
                ->where('area_id', $area_id)
                ->count(),

            'attendance_percentages' => $attendancePercentages,
            'absence_percentages' => $absencePercentages,
            'percentageOfDoneAxisToDailyReports' => $dailyReportCompletionStats,
            'percentageOfNotDoneAxisToDailyReports' => $dailyReportNotCompletionStats,
            'axisQuestions' => $axisQuestions->map(function ($question) use ($UsersAnswers, $UsersAnswerYes, $UsersAnswerNo) {
                return (new MapAxisQuestionPercentageResource($question))
                    ->setAnswers($UsersAnswers, $UsersAnswerYes, $UsersAnswerNo);
            }),
        ];

        return $this->successResponse($data);
    }


    public function getDetailsForParent2($request)
    {
        $periodFilters = [
            0 => now()->subDays(1),
            1 => now()->subWeek(),
            2 => now()->subMonth(),
            3 => now()->subYear(),
        ];


        $axis_id = $request->axis_id;
        $area_id = $request->area_id;
        $period = $request->period;


        $areaTeamCount = $this->areaTeam->where('area_id', $area_id)->get();
        $attendancePercentage = $areaTeamCount->count() > 0
            ? round(($this->attendance
                        ->whereIn('user_id', $areaTeamCount->pluck('user_id'))
                        ->when(isset($periodFilters[$period]), function ($query) use ($periodFilters, $period) {
                            $query->where('created_at', '>=', $periodFilters[$period]);
                        })
                        ->count() / ($areaTeamCount->count() * count($areaTeamCount->pluck('user_id')->unique()))) * 100, 2)
            : 0;


        $dailyReports = $this->dailyReport->where('axis_id', $axis_id)->pluck('id');
        $percentageOfDoneAxisToDailyReports = $dailyReports->count() > 0
            ? round($this->dailyReportAssign->whereIn('daily_report_id', $dailyReports)
                    ->where('status', DailyReportAssignUserStatusEnum::COMPLETED)
                    ->count() / $dailyReports->count() * 100, 2)
            : 0;
        $axisQuestions = $this->axisQuestion->where('axis_id', $axis_id)
            ->where('answer_type', '2')
            ->get();
        $axisQuestionsAnswers = $this->questionAnswer->whereIn('axis_question_id', $axisQuestions->pluck('id'))->get();
        $UsersAnswers = $this->dailyAssignUserAnswer->whereIn('axis_question_id', $axisQuestions->pluck('id'))->get();
        $UsersAnswerYes = $this->dailyAssignUserAnswer->whereIn('question_answer_id', $axisQuestionsAnswers->where('answer', 'نعم')->pluck('id'))->get();
        $UsersAnswerNo = $this->dailyAssignUserAnswer->whereIn('question_answer_id', $axisQuestionsAnswers->where('answer', 'لا')->pluck('id'))->get();


        // Prepare week days in Arabic
        $daysOfWeek = [
            'Sunday' => 'الأحد',
            'Monday' => 'الاثنين',
            'Tuesday' => 'الثلاثاء',
            'Wednesday' => 'الأربعاء',
            'Thursday' => 'الخميس',
            'Friday' => 'الجمعة',
            'Saturday' => 'السبت',
        ];


        // Fetch daily reports related to the axis
        $dailyReports = $this->dailyReport->where('axis_id', $axis_id)->pluck('id');

        // Compute daily report completion percentages
        $dailyReportCompletionStats = [];
        foreach ($daysOfWeek as $key => $dayName) {
            $dayDate = Carbon::now()->startOfWeek()->addDays(array_search($key, array_keys($daysOfWeek)));

            $dayReports = $this->dailyReport->where('axis_id', $axis_id)
                ->whereDate('created_at', $dayDate->format('Y-m-d'))
                ->pluck('id');

            $allReports = $this->dailyReportAssign
                ->whereIn('daily_report_id', $dayReports)
                ->count();

            $dailyReportCompletionStats[$dayName] = $dayReports->count() > 0 ? round(($completedReports / $dayReports->count()) * 100, 2) : 0;

            $notcompletedReports = $this->dailyReportAssign
                ->whereIn('daily_report_id', $dayReports)
                ->where('status', DailyReportAssignUserStatusEnum::NEED_EDIT)
                ->count();

            $dailyReportNonCompletionStats[$dayName] = $dayReports->count() > 0
                ? round(($notcompletedReports / $dayReports->count()) * 100, 2)
                : 0;
        }


        $data = [
            'YesAnswerPercentage' => $this->dailyAssignUserAnswer
                ->whereIn('question_answer_id', $axisQuestionsAnswers->whereIn('answer', ['نعم', 'لا'])->pluck('id'))->count() > 0
                ? round($this->dailyAssignUserAnswer->whereIn('question_answer_id', $axisQuestionsAnswers->where('answer', 'نعم')->pluck('id'))->count()
                    / $this->dailyAssignUserAnswer->whereIn('question_answer_id', $axisQuestionsAnswers->whereIn('answer', ['نعم', 'لا'])->pluck('id'))->count() * 100, 2)
                : 0,
            'noAnswerPercentage' => $this->dailyAssignUserAnswer
                ->whereIn('question_answer_id', $axisQuestionsAnswers->whereIn('answer', ['نعم', 'لا'])->pluck('id'))->count() > 0
                ? round($this->dailyAssignUserAnswer->whereIn('question_answer_id', $axisQuestionsAnswers->where('answer', 'لا')->pluck('id'))->count()
                    / $this->dailyAssignUserAnswer->whereIn('question_answer_id', $axisQuestionsAnswers->whereIn('answer', ['نعم', 'لا'])->pluck('id'))->count() * 100, 2)
                : 0,
            'numberOfDailyReportsInArea' => $this->dailyReportAssign->whereIn('daily_report_id', $dailyReports)->count(),
            'numberOfAcceptedDailyReportsInArea' => $this->dailyReportAssign->whereIn('daily_report_id', $dailyReports->pluck('id'))->where('status', '4')->count(),
            'numberOfRejectedDailyReportsInArea' => $this->dailyReportAssign->whereIn('daily_report_id', $dailyReports->pluck('id'))->where('status', '3')->count(),
            'PercentageOfAxisToAttendance' => $attendancePercentage,
            'percentageOfAbsence' => 100 - $attendancePercentage,
            'usersRate' => $this->dailyReportAssign->count() > 0 ? round($this->dailyReportAssign->where('status', DailyReportAssignUserStatusEnum::COMPLETED)->count() / $this->dailyReportAssign->count() * 100, 2) : 0,
            'daily_report_completion' => $dailyReportCompletionStats,
            'daily_report_non_completion' => $dailyReportNonCompletionStats,
            'percentageOfDoneAxisToDailyReports' => $percentageOfDoneAxisToDailyReports,
            'axisQuestions' => $axisQuestions->map(function ($question) use ($UsersAnswers, $UsersAnswerYes, $UsersAnswerNo) {
                return (new MapAxisQuestionPercentageResource($question))
                    ->setAnswers($UsersAnswers, $UsersAnswerYes, $UsersAnswerNo);
            }),
        ];

        return $this->successResponse($data);
    }

    public function getDetailsForParent3($request)
    {
        $periodFilters = [
            0 => now()->subDays(1),
            1 => now()->subWeek(),
            2 => now()->subMonth(),
            3 => now()->subYear(),
        ];

        $axis_id = $request->axis_id;
        $area_id = $request->area_id;
        $period = $request->period;

        // جلب الفرق في المحور المحدد
        $axisAreas = $this->area->where('axis_id', $axis_id)->get();
        $axisTeamCount = $this->areaTeam->whereIn('area_id', $axisAreas->pluck('id'))->get();
        $noticeCount = $this->notice->whereIn('user_id', $axisTeamCount->pluck('user_id'))->count();
        $teamCount = $axisTeamCount->count();

        if ($teamCount === 0) {
            return $this->successResponse([
                'numberOfUsersInAxisCount' => 0,
                'message' => 'لا يوجد أعضاء في هذه المنطقة.',
                'attendance_percentages' => [],
                'absence_percentages' => [],
                'daily_report_completion_percentages' => [],
                'notice_percentages' => [],
            ]);
        }

        // جلب الحضور لكل يوم
        $attendanceStats = $this->attendance
            ->whereIn('user_id', $axisTeamCount->pluck('user_id'))
            ->when(isset($periodFilters[$period]), function ($query) use ($periodFilters, $period) {
                $query->where('created_at', '>=', $periodFilters[$period]);
            })
            ->get()
            ->groupBy(fn($attendance) => Carbon::parse($attendance->created_at)->format('l'));

        // جلب البلاغات لكل يوم
        $noticesStats = $this->notice
            ->whereIn('user_id', $axisTeamCount->pluck('user_id'))
            ->when(isset($periodFilters[$period]), function ($query) use ($periodFilters, $period) {
                $query->where('created_at', '>=', $periodFilters[$period]);
            })
            ->get()
            ->groupBy(fn($notice) => Carbon::parse($notice->created_at)->format('l'));

        // جلب التقارير اليومية المرفوعة لكل يوم
        $dailyReportAssignStats = $this->dailyReportAssign
            ->whereIn('user_id', $axisTeamCount->pluck('user_id'))
            ->when(isset($periodFilters[$period]), function ($query) use ($periodFilters, $period) {
                $query->where('created_at', '>=', $periodFilters[$period]);
            })
            ->get()
            ->groupBy(fn($dailyReportAssign) => Carbon::parse($dailyReportAssign->created_at)->format('l'));

        // تحويل الأيام إلى العربية
        $daysOfWeek = [
            'Sunday' => 'الأحد',
            'Monday' => 'الاثنين',
            'Tuesday' => 'الثلاثاء',
            'Wednesday' => 'الأربعاء',
            'Thursday' => 'الخميس',
            'Friday' => 'الجمعة',
            'Saturday' => 'السبت',
        ];

        // حساب نسب الحضور والغياب لكل يوم
        $attendancePercentages = [];
        $absencePercentages = [];
        foreach ($daysOfWeek as $key => $dayName) {
            $dayAttendances = $attendanceStats->get($key, collect());
            $attendanceCount = min($dayAttendances->count(), $teamCount);
            $absenceCount = max(0, $teamCount - $attendanceCount);

            $attendancePercentages[$dayName] = ($teamCount > 0)
                ? round(($attendanceCount / $teamCount) * 100, 2)
                : 0;

            $absencePercentages[$dayName] = ($teamCount > 0)
                ? round(($absenceCount / $teamCount) * 100, 2)
                : 0;
        }

        // حساب نسبة التقارير المكتملة لكل يوم
        $dailyReportCompletionPercentages = [];
        foreach ($daysOfWeek as $key => $dayName) {
            $dayReportsAssigns = $dailyReportAssignStats->get($key, collect());
            $totalAssignedReports = $dayReportsAssigns->count();  // إجمالي التقارير المرفوعة
            $completedReportsAssignsCount = $dayReportsAssigns->where('status', '4')->count(); // عدد التقارير المكتملة

            $dailyReportCompletionPercentages[$dayName] = ($totalAssignedReports > 0)
                ? round(($completedReportsAssignsCount / $totalAssignedReports) * 100, 2)
                : 0;
        }

        // حساب نسبة البلاغات لكل يوم
        $noticePercentages = [];
        foreach ($daysOfWeek as $key => $dayName) {
            $dayNotices = $noticesStats->get($key, collect());
            $noticePercentage = ($teamCount > 0)
                ? round(($dayNotices->count() / $teamCount) * 100, 2)
                : 0;
            $noticePercentages[$dayName] = min($noticePercentage, 100);
        }

        return $this->successResponse([
            'numberOfUsersInAxisCount' => $teamCount,
            'attendance_percentages' => $attendancePercentages,
            'absence_percentages' => $absencePercentages,
            'daily_report_completion_percentages' => $dailyReportCompletionPercentages,
            'notice_percentages' => $noticePercentages,
            'numberOfDailyReportsInAxis' => $this->dailyReport->where('axis_id', $axis_id)->count(),
            'noticeCount' => $noticeCount,
        ]);
    }


    public function getDetailsForParent4($request)
    {
        $periodFilters = [
            0 => now()->subDays(1),
            1 => now()->subWeek(),
            2 => now()->subMonth(),
            3 => now()->subYear(),
        ];


        $axis_id = $request->axis_id;
        $area_id = $request->area_id;
        $period = $request->period;


//        $axisAreas = $this->area->where('axis_id', $axis_id)->get();
//        $axisTeamCount = $this->areaTeam->whereIn('area_id', $axisAreas->pluck('id'))->get();
//        $notice = $this->notice->where('notice_type_id', $request->notice_type_id)->whereIn('user_id', $axisTeamCount->pluck('user_id'))->get();
        $notice = $this->notice
            ->when($request->has('notice_type_id') && $request->notice_type_id !== null, function ($query) use ($request) {
                return $query->where('notice_type_id', $request->notice_type_id);
            })
            ->get();

        $data = [

            'notice' => $notice->count(),
            'openNoticesCount' => $notice->whereNotIn('status', ['2', '1'])->count(),
            'closedNoticesCount' => $notice->whereIn('status', ['2', '1'])->count(),
            'highNoticesCount' => $notice->filter(function ($notice) {
                return $notice->noticeType->priority === 'high';
            })->count(),
            'lowNoticesCount' => $notice->filter(function ($notice) {
                return $notice->noticeType->priority === 'low';
            })->count(),
            'midNoticesCount' => $notice->filter(function ($notice) {
                return $notice->noticeType->priority === 'mid';
            })->count(),


        ];

        return $this->successResponse($data);
    }

    public function getDetailsForParent5($request)
    {
        $periodFilters = [
            0 => now()->subDays(1),
            1 => now()->subWeek(),
            2 => now()->subMonth(),
            3 => now()->subYear(),
        ];

        $axis_id = $request->axis_id;
        $area_id = $request->area_id;
        $period = $request->period;

        // جلب أعضاء الفريق في المنطقة
        $areaTeam = $this->areaTeam->where('area_id', $area_id)->get();
        $leaders = $areaTeam->where('type', '1')->pluck('user_id');

        // جلب التقارير اليومية
        $dailyReportAssign = $this->dailyReportAssign->where('axis_id', $axis_id)->get();

        // جلب التقارير العامة بناءً على القادة
        $generalReports = $this->generalReport
            ->whereIn('leader_id', $leaders)
            ->when(isset($periodFilters[$period]), function ($query) use ($periodFilters, $period) {
                return $query->where('created_at', '>=', $periodFilters[$period]);
            })
            ->get()
            ->groupBy(fn($report) => Carbon::parse($report->date)->format('l'));

        // جلب تقارير المخالفات بناءً على القادة
        $violationReports = $this->violationReport
            ->whereIn('user_id', $leaders)
            ->when(isset($periodFilters[$period]), function ($query) use ($periodFilters, $period) {
                return $query->where('created_at', '>=', $periodFilters[$period]);
            })
            ->get()
            ->groupBy(fn($report) => Carbon::parse($report->date)->format('l'));

        // تحويل أيام الأسبوع إلى العربية
        $daysOfWeek = [
            'Sunday' => 'الأحد',
            'Monday' => 'الاثنين',
            'Tuesday' => 'الثلاثاء',
            'Wednesday' => 'الأربعاء',
            'Thursday' => 'الخميس',
            'Friday' => 'الجمعة',
            'Saturday' => 'السبت',
        ];

        $generalReportsPercentages = [];
        $violationReportsPercentages = [];
        $reportsStatusPercentages = [];
        $totalLeaders = $leaders->count();

        foreach ($daysOfWeek as $key => $dayName) {
            $generalCount = $generalReports->get($key, collect())->count();
            $violationCount = $violationReports->get($key, collect())->count();

            // حساب نسبة التقارير العامة إلى عدد القادة
            $generalReportsPercentages[$dayName] = ($totalLeaders > 0)
                ? round(($generalCount / $totalLeaders) * 100, 2)
                : 0;

            // حساب نسبة تقارير المخالفات إلى عدد القادة
            $violationReportsPercentages[$dayName] = ($totalLeaders > 0)
                ? round(($violationCount / $totalLeaders) * 100, 2)
                : 0;

            // حساب نسبة التقارير حسب الحالة
            $totalReports = $generalCount + $violationCount;
            $pendingReports = $generalReports->get($key, collect())->where('status', '0')->count()
                + $violationReports->get($key, collect())->where('status', '0')->count();

            $approvedReports = $generalReports->get($key, collect())->where('status', '1')->count()
                + $violationReports->get($key, collect())->where('status', '1')->count();

            $rejectedReports = $generalReports->get($key, collect())->where('status', '2')->count()
                + $violationReports->get($key, collect())->where('status', '2')->count();

            $reportsStatusPercentages[$dayName] = [
                'pending' => ($totalReports > 0) ? round(($pendingReports / $totalReports) * 100, 2) : 0,
                'approved' => ($totalReports > 0) ? round(($approvedReports / $totalReports) * 100, 2) : 0,
                'rejected' => ($totalReports > 0) ? round(($rejectedReports / $totalReports) * 100, 2) : 0,
            ];
        }

        // إعداد البيانات للإرجاع
        $data = [
            'dailyReportAssignCount' => $dailyReportAssign->count(),
            'completedDailyReportAssignCount' => $dailyReportAssign->where('status', '4')->count(),
            'cancelledDailyReportAssignCount' => $dailyReportAssign->where('status', '3')->count(),
            'general_reports_percentages' => $generalReportsPercentages,  // نسبة التقارير العامة
            'violation_reports_percentages' => $violationReportsPercentages,  // نسبة تقارير المخالفات
            'reports_status_percentages' => $reportsStatusPercentages, // نسبة التقارير حسب الحالة
        ];

        return $this->successResponse($data);
    }


    public function getDetailsForParent6($request)
    {
        $periodFilters = [
            0 => now()->subDays(1),
            1 => now()->subWeek(),
            2 => now()->subMonth(),
            3 => now()->subYear(),
        ];
        $period = $request->period;
        $is_seen = $request->is_seen;
        $alerts = $this->alert
            ->whereIn('to', ['1'])
            ->when(isset($periodFilters[$period]), function ($query) use ($periodFilters, $period) {
                $query->where('created_at', '>=', $periodFilters[$period]);
            })
            ->get();
        if ($is_seen == 1) {
            foreach ($alerts as $alert) {
                if (AlertUser::where('alert_id', $alert->id)->where('seen', 0)->exists()) {
                    $alerts = $alerts->reject(function ($item) use ($alert) {
                        return $item->id === $alert->id;
                    });

                } else {
                    $alert->seen = 1;
                }
            }
        } elseif ($is_seen == 0) {
            foreach ($alerts as $alert) {
                if (AlertUser::whereIn('alert_id', [$alert->id])->where('seen', 1)->count() == AlertUser::where('alert_id', $alert->id)->count()) {
                    $alerts = $alerts->reject(function ($item) use ($alert) {
                        return $item->id === $alert->id;
                    });
                } else {
                    $alert->seen = 0;
                }
            }
        }

        $data = [
            'alertsCount' => $alerts->count(),
            'highAlertsCount' => $alerts->where('priority', 'high')->count(),
//            'highAlertsPercentage' => $alerts->count() > 0 ? round(($alerts->where('priority', 'high')->count() / $alerts->count()) * 100, 2) : 0,
            'lowAlertsCount' => $alerts->where('priority', 'low')->count(),
//            'lowAlertsPercentage' => $alerts->count() > 0 ? round(($alerts->where('priority', 'low')->count() / $alerts->count()) * 100, 2) : 0,
            'midAlertsCount' => $alerts->where('priority', 'mid')->count(),
//            'midAlertsPercentage' => $alerts->count() > 0 ? round(($alerts->where('priority', 'mid')->count() / $alerts->count()) * 100, 2) : 0,

//            'unseenAlertsCount' => $alerts->filter(function ($alert) {
//                return $alert->alertUsers->where('seen', '1')->count() === 0;
//            })->count(),
//
//            'seenAlertsCount' => $alerts->filter(function ($alert) {
//                return $alert->alertUsers->where('seen', '0')->count() === 0; // الجميع رأوها
//            })->count(),


        ];

        return $this->successResponse($data);
    }


    public function getNotice($request)
    {

        $periodFilters = [
            0 => now()->subDays(1),
            1 => now()->subWeek(),
            2 => now()->subMonth(),
            3 => now()->subYear(),
        ];
        $period = $request->period;
        $notices = $this->notice
            ->when($request->status !== null, function ($query) use ($request) {
                if ($request->status == 0) {
                    $query->whereIn('status', ['0', '3']);
                } elseif ($request->status == 1) {
                    $query->whereIn('status', ['1', '2']);
                }
            })
            ->when($request->priority, function ($query) use ($request) {
                $query->whereHas('noticeType', function ($q) use ($request) {
                    $q->where('priority', $request->priority);
                });
            })->when(isset($periodFilters[$period]), function ($query) use ($periodFilters, $period) {
                $query->where('created_at', '>=', $periodFilters[$period]);
            })
            ->when($request->notice_type_id, fn($query) => $query->where('notice_type_id', $request->notice_type_id))
            ->get();

        return $this->responseMsg('تمت العملية بنجاح', MapNoticeDetailsResource::collection($notices));
    }

    public function getNoticeDetails($id)
    {
        $notice = $this->notice->find($id);
        if (!$notice) {
            return $this->responseMsg('البلاغ غير موجود', 404);
        }

        return $this->responseMsg('تمت العملية بنجاح', new MapFullNoticeResource($notice));

    }

    public function getAlerts($request)
    {
        $periodFilters = [
            0 => now()->subDays(1),
            1 => now()->subWeek(),
            2 => now()->subMonth(),
            3 => now()->subYear(),
        ];
        $period = $request->period;
        $alerts = $this->alert->where('to', '1')
            ->when($request->priority, function ($query) use ($request) {
                $query->where('priority', $request->priority);
            })->when(isset($periodFilters[$period]), function ($query) use ($periodFilters, $period) {
                $query->where('created_at', '>=', $periodFilters[$period]);
            })
            ->with('alertUsers')
            ->get();

        if ($request->seen == 1) {
            foreach ($alerts as $alert) {
                if (AlertUser::where('alert_id', $alert->id)->where('seen', 0)->exists()) {
                    $alerts = $alerts->reject(function ($item) use ($alert) {
                        return $item->id === $alert->id;
                    });

                } else {
                    $alert->seen = 1;
                }
            }
        } elseif ($request->seen == 0) {
            foreach ($alerts as $alert) {
                if (AlertUser::whereIn('alert_id', [$alert->id])->where('seen', 1)->count() == AlertUser::where('alert_id', $alert->id)->count()) {
                    $alerts = $alerts->reject(function ($item) use ($alert) {
                        return $item->id === $alert->id;
                    });
                } else {
                    $alert->seen = 0;
                }
            }
        }


        return $this->responseMsg('تمت العملية بنجاح', MapAlertResource::collection($alerts));
    }

    public function getRoles()
    {
        $roles = Role::where('guard_name', 'user')->get();
        return $this->responseMsg('تمت العملية بنجاح', MapRoleResource::collection($roles));

    }


    public function getDetailsForParent7($request)
    {
        $periodFilters = [
            0 => now()->subDays(1),
            1 => now()->subWeek(),
            2 => now()->subMonth(),
            3 => now()->subYear(),
        ];

        $axis_id = $request->axis_id;
        $area_id = $request->area_id;
        $period = $request->period;

        $axisQuestions = $this->axisQuestion->where('axis_id', $axis_id)
            ->where('answer_type', '2')
            ->get();

        $axisQuestionsAnswers = $this->questionAnswer
            ->whereIn('axis_question_id', $axisQuestions->pluck('id'))
            ->get();

        $UsersAnswers = $this->dailyAssignUserAnswer
            ->whereIn('axis_question_id', $axisQuestions->pluck('id'))
            ->get();

        $UsersAnswerYes = $this->dailyAssignUserAnswer
            ->whereIn('question_answer_id', $axisQuestionsAnswers->where('answer', 'نعم')->pluck('id'))
            ->get();

        $UsersAnswerNo = $this->dailyAssignUserAnswer
            ->whereIn('question_answer_id', $axisQuestionsAnswers->where('answer', 'لا')->pluck('id'))
            ->get();

        // الحسابات الإحصائية للحضور
        $areaTeamCount = $this->areaTeam->where('area_id', $area_id)->get();
        $totalTeamMembers = $areaTeamCount->count(); // عدد أعضاء الفريق

        $attendanceStats = $this->attendance
            ->whereIn('user_id', $areaTeamCount->pluck('user_id'))
            ->when(isset($periodFilters[$period]), function ($query) use ($periodFilters, $period) {
                $query->where('created_at', '>=', $periodFilters[$period]);
            })
            ->get()
            ->groupBy(function ($attendance) {
                return Carbon::parse($attendance->date)->format('l'); // يوم الأسبوع
            });

        // أيام الأسبوع بالعربية
        $daysOfWeek = [
            'Sunday' => 'الأحد',
            'Monday' => 'الاثنين',
            'Tuesday' => 'الثلاثاء',
            'Wednesday' => 'الأربعاء',
            'Thursday' => 'الخميس',
            'Friday' => 'الجمعة',
            'Saturday' => 'السبت',
        ];

        // حساب الحضور والغياب بشكل صحيح
        $attendanceData = [];
        foreach ($daysOfWeek as $key => $dayName) {
            $dayAttendances = $attendanceStats->get($key, collect())->unique('user_id'); // إزالة التكرارات

            $actualAttendance = min($dayAttendances->count(), $totalTeamMembers); // التأكد من عدم تجاوز الحضور لإجمالي الفريق
            $actualAbsence = max($totalTeamMembers - $actualAttendance, 0); // تجنب القيم السالبة

            $attendanceData[$dayName] = [
                'attendance' => $actualAttendance,
                'absence' => $actualAbsence,
            ];
        }

        // حساب النسب المئوية بشكل دقيق
        $attendancePercentages = [];
        $absencePercentages = [];
        foreach ($attendanceData as $day => $data) {
            if ($totalTeamMembers > 0) {
                $attendancePercentages[$day] = round(($data['attendance'] / $totalTeamMembers) * 100, 2);
                $absencePercentages[$day] = round(($data['absence'] / $totalTeamMembers) * 100, 2);
            } else {
                $attendancePercentages[$day] = 0;
                $absencePercentages[$day] = 0;
            }
        }

        // تجهيز البيانات للرد
        $data = [
            'attendance_percentages' => $attendancePercentages,
            'absence_percentages' => $absencePercentages,
            'axisQuestions' => $axisQuestions->map(function ($question) use ($UsersAnswers, $UsersAnswerYes, $UsersAnswerNo) {
                return (new MapAxisQuestionPercentageResource($question))
                    ->setAnswers($UsersAnswers, $UsersAnswerYes, $UsersAnswerNo);
            }),
        ];

        return $this->successResponse($data);
    }

    public function getBusesTimes($areaId)
    {
        $busesTimes = $this->busReport->where('area_id', $areaId)->get();

        return $this->responseMsg('تم الحصول على البيانات بنجاح', BusTimeResource::collection($busesTimes));

    }


    public function storeFcm($request)
    {
        $validator = $this->apiValidator($request->all(), [
            'fcm_token' => 'required',
        ]);

        if ($validator) {
            return $validator;
        }

        $deviceToken=new DeviceToken();
        $deviceToken->admin_id=Auth::guard('map')->user()->id;
        $deviceToken->token=$request->fcm_token;    
        $deviceToken->save();

        return $this->responseMsg('Fcm Token Saved Successfully', null);
    }

}



