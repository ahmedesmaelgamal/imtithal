<?php

namespace App\Services\Web;

use App\Models\DailyReportAssignUser;
use App\Models\Attendance as ObjModel;

use App\Models\User;
use App\Services\BaseService;

use Carbon\Carbon;

class AttendanceService extends BaseService
{

    public function __construct(
        protected ObjModel $objModel,
        protected User     $user
    )
    {
        parent::__construct($objModel);
    }

    public function index()
    {

        $numberOfAttendanceToday = $this->objModel->whereDate('created_at', Carbon::today())->count();
        $users = $this->user->whereDoesntHave('roles', function ($query) {
            $query->where('name', '=', 'مشرف');;
        })->get();

        return view('web.attendance.index', [
            'numberOfAttendanceToday' => $numberOfAttendanceToday,
            'numberOfAttendance' => $users->count() - $numberOfAttendanceToday,

        ]);
    }


//    public function show($id)
//    {
//        $objs = $this->objModel->where('user_id', $id)->get();
//        $monthsOfUsers = $this->objModel
//            ->where('user_id', $id)
//            ->orderBy('date', 'desc')
//            ->get()
//            ->map(fn($obj) => $obj->created_at->format('F'))
//            ->unique()
//            ->values();
//
//
//        return view('web.attendance.show', [
//            'objs' => $objs,
//            'user' => $this->user->find($id),
//            'monthsOfUsers' => $monthsOfUsers
//
//        ]);
//
//    }

    public function show($id)
    {
        // Get the user's attendance records
        $objs = $this->objModel->where('user_id', $id)->get();

        $userCreated = $this->user->find($id);
        // Get unique months for the user's attendance records
        $monthsOfUsers = $this->objModel
            ->where('user_id', $id)
            ->orderBy('date', 'desc')
            ->get()
            ->map(fn($obj) => $obj->created_at->format('F'))
            ->unique()
            ->values();

        // Get the earliest and latest attendance dates
        $earliestDate = $userCreated->created_at->format('Y-m-d');//$objs->min('date');
        $latestDate = $objs->max('date');

        // Get all dates between the earliest and latest attendance dates
        $allDates = [];
        for ($date = Carbon::parse($earliestDate)->copy(); $date->lte(Carbon::parse($latestDate)); $date->addDay()) {
            $allDates[] = $date->format('Y-m-d');
        }


        // Get the dates when the user had attendance records
        $attendanceDates = $objs->pluck('date')->toArray();

        // Find the dates when the user was absent
        $absentDates = array_diff($allDates, $attendanceDates);

        // Pass data to the view
        return view('web.attendance.show', [
            'objs' => $objs,
            'user' => $this->user->find($id),
            'monthsOfUsers' => $monthsOfUsers,
            'absentDates' => $absentDates, // Pass absent dates to the view
        ]);
    }

}
