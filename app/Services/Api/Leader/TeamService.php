<?php

namespace App\Services\Api\Leader;

use App\Http\Resources\Leaders\DailyReportResource;
use App\Http\Resources\Leaders\LeaderDailyReportAssignResource;
use App\Http\Resources\Leaders\TeamResource;
use App\Http\Resources\Users\UserResource;
use App\Models\AreaTeam;
use App\Models\ViolationReport;
use App\Services\BaseService;
use App\Models\User as objModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * Summary of LeaderService
 */
class TeamService extends BaseService
{
    /**
     * Summary of __construct
     * @param objModel $objModel
     */
    public function __construct(objModel $objModel,protected AreaTeam $areaTeam,protected ViolationReport $violationReport)
    {
        parent::__construct($objModel);
    }


    public function getTeam($request)
    {
        $leader = Auth::guard('user')->user();
        $areaId = $this->areaTeam->where('user_id', $leader->id)->pluck('area_id');
        $myTeamMembers = $this->areaTeam->whereIn('area_id', $areaId)->pluck('user_id');
        $users = $this->model->whereIn('id', $myTeamMembers)
            ->when($request->search, function ($query) use ($request) {$query->where('full_name', 'like', '%' . $request->search . '%');})->where('id', '!=', $leader->id)->get();
        return $this->responseMsg('تمت العملية بنجاح', TeamResource::collection($users));
    }

    public function getAttendances($id, $request)
    {
        // Find the user by ID
        $user = $this->model->findOrFail($id);

        $fromDate = Carbon::parse($request->from_date)->format('Y-m-d');
        $toDate = Carbon::parse($request->to_date)->format('Y-m-d');

        // Group attendances by month
        $attendances = $user->attendances()
            ->when($request->from_date, function ($query) use ($fromDate, $toDate) {
                $query->whereBetween('date', [$fromDate, $toDate]);
            })
            ->selectRaw('MONTH(date) as month, id, user_id, date, checkin, checkout') // Explicitly list columns
            ->orderBy('date', 'asc')
            ->get()
            ->groupBy('month');

        // Transform the grouped data
        $attendances = $attendances->map(function ($group, $month) {
            return [
                'month' => Carbon::create()->month($month)->monthName, // Get month name
                'attendances' => $group->map(function ($attendance) {
                    return [
                        'id' => $attendance->id,
                        'date' => $attendance->date,
                        'checkin' => Carbon::parse($attendance->checkin)->format('h:i A'), // Format checkin time
                        'checkout' =>$attendance->checkout? Carbon::parse($attendance->checkout)->format('h:i A'):null, // Format checkout time
                    ];
                }),
            ];
        });

        // Return the response with grouped data
        return $this->responseMsg('تمت العملية بنجاح', $attendances->values());
    }

    public function getTeamDetails($id)
    {
        $user = $this->model->where('id',$id)->first();
        $dailyReports = $user->userDailyReports;
        $violationReports = $this->violationReport->where('user_id', $user->id)
            ->where('user_type', '1')
            ->get();
        return $this->responseMsg('تمت العملية بنجاح',[
            'user'=>TeamResource::make($user),
            'statistics'=> [
                'daily_reports' => $user->userDailyReports()->count(),
                'complete_daily_reports'=> $user->userDailyReports()->where('status','4')->count(),
                'not_complete_daily_reports'=> $user->userDailyReports()->whereIn('status',['0','1','3'])->count(),
                'late_daily_reports'=> $user->userDailyReports()->whereIn('status',['0','1','3'])
                    ->whereDate('deadline', '<=', Carbon::now())->count(),
                'notices' => $user->userNotices()->count(),

                'dailyReportsCount' => (int) $user->userDailyReports()->count(),
                'newDailyReportsCount' => (int) $user->userDailyReports()->where('status', '1')->count(),
                'notStartedDailyReportsCount' => (int) $user->userDailyReports()->where('status', '0')->count(),
                'completedDailyReportsCount' => (int) $user->userDailyReports()->where('status', '2')->count(),
                'lateDailyReportsCount' => (int) $user->userDailyReports()->where('status', '!=', '4')->where('deadline', '<', Carbon::now())->count(),
                'violationReportsCount' => (int) $violationReports->count(),
            ],
            'dailyReports' => LeaderDailyReportAssignResource::collection($dailyReports),
        ]);
    }
}
