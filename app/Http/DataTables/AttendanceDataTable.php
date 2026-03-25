<?php

namespace App\Http\DataTables;

use App\Models\Attendance;
use App\Models\User as ObjModel;
use App\Services\Web\UserService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;


class AttendanceDataTable extends DataTable
{
    public function __construct(
        protected ObjModel    $objModel,
        protected UserService $userService,
        protected Role        $role,
        protected Attendance  $attendance
    )
    {
        parent::__construct($objModel);
    }


    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('name', function ($query) {


                return '
                        <div class="d-flex">
                          <img class="image-table" src="' . getFile($query->image, 'assets/uploads/avatar.png') . '" alt="no-image">
                           <div>
                                <h6 class="name-table d-flex align-items-center">' . $query->full_name . '</h6>
                                <p class="fs-12 fw-400 text-secondary">سعودي</p>
                            </div>
                        </div>
                ';
            })
            ->addColumn('role', function ($query) {

                return $query ? $query->getRoleNames()->first() : 'No Role';
            })
            ->addColumn('numberOfAttendances', function ($query) {

                return $this->attendance->where('user_id', $query->id)->count();

            })->addColumn('numberOfAbsences', function ($query) {
                // Get the user's creation date and the current date
                $startDate = Carbon::parse($query->created_at)->startOfDay(); // Ensure it starts at midnight
                $endDate = Carbon::now()->endOfDay(); // Ensure it includes the current day

                // Calculate total days (inclusive of start and end dates)
                $totalDays = $startDate->diffInDays($endDate) + 1; // Add 1 to include both start and end dates

                // Get the number of attendances
                $attendances = $this->attendance
                    ->where('user_id', $query->id)
                    ->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                    ->count();

                // Calculate absences
                return floor($totalDays - $attendances);
            })
            ->addColumn('daysNameOfAbsences', function ($query) {
                // Get the user's creation date and the current date
                $startDate = Carbon::parse($query->created_at)->startOfDay(); // Ensure it starts at midnight
                $endDate = Carbon::now()->endOfDay(); // Ensure it includes the current day

                // Get all dates between the start and end date
                $allDates = [];
                for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                    $allDates[] = $date->format('Y-m-d');
                }

                // Get the dates when the user had attendance records
                $attendanceDates = $this->attendance
                    ->where('user_id', $query->id)
                    ->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
                    ->pluck('date') // Assuming 'date' is the column storing the attendance date
                    ->toArray();

                // Find the dates when the user was absent
                $absentDates = array_diff($allDates, $attendanceDates);

                // Map the absent dates to their corresponding day names
                $absentDayNames = [];
                foreach ($absentDates as $absentDate) {
                    // Set the locale to Arabic
                    Carbon::setLocale('ar');
                    // Format the day name in Arabic
                    $absentDayNames[] = Carbon::parse($absentDate)->translatedFormat('l'); // 'l' gives the full day name in Arabic
                }

                // Return the day names as a comma-separated string
                return implode(' , ', $absentDayNames);
            })
            ->addColumn('actions', function ($query) {
                return '

                <a href="' . route('attendance.show', $query->id) . '" class="view">
                                                        <img class="h-24" src="' . asset('web/image/eye-icon.png') . '" alt="no-image">
                                                        عرض
                  </a>
                        ';
            })
            ->rawColumns(['name', 'actions']);
    }

    public function query(ObjModel $model): QueryBuilder
    {
        return $model->newQuery()
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', '=', 'مشرف');
            })
            ->when(request('from') && request('to'), function ($query) {
                return $query->whereHas('attendances', function ($q) {
                    $q->whereBetween('date', [request('from'), request('to')]);
                });
            })
            ->when(request('from') && !request('to'), function ($query) {
                return $query->whereHas('attendances', function ($q) {
                    $q->where('date', '>=', request('from'));
                });
            })
            ->when(!request('from') && request('to'), function ($query) {
                return $query->whereHas('attendances', function ($q) {
                    $q->where('date', '<=', request('to'));
                });
            });
    }
}
