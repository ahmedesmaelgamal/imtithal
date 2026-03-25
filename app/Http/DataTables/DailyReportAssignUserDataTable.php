<?php

namespace App\Http\DataTables;

use App\Models\DailyReportAssignUser as ObjModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;


class DailyReportAssignUserDataTable extends DataTable
{
    public function __construct(
        protected ObjModel $objModel,
    )
    {
        parent::__construct($objModel);
    }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('deadline', function ($query) {
                return \Carbon\Carbon::parse($query->deadline)->locale('ar')->translatedFormat('d F Y');
            })->addColumn('actions', function ($query) {

                $actions = '';
                $actions .= '
                        <div class="table-info">
                            <button class="btn-menu dropdown-toggle" type="button"
                                    id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical "></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            ';
                $actions .= '
                                <li>
                                     <a href="' . route('daily_report_assign_user.show',['daily_report_assign_user_id'=>$query->id]) . '" class="dropdown-item " data-id="' . $query->id . '">
                                        <img class="h-24" src="' . asset('web/image/eye-icon.png') . '" >
                                       عرض
                                   </a>

                                </li>
                                ';
                if ($query->status != 4 ? true : false) {
                    $actions .= '
                                <li>
                                    <a href="' . route('daily_report_assign_user.destroy_daily_report_assign_user', ['id' => $query->id]) . '" class="dropdown-item deleteDailyReportAssignUser" data-id="' . $query->id . '">
                                            <img class="h-24" src="' . asset('web/image/trash.png') . '" alt="no-image">
                                            حذف
                                    </a>
                                 </li>
                                 ';
                }
                $actions .= '
                            </ul>
                        </div>
                ';
                return $actions;
            })->addColumn('title', function ($query) {
                return $query->dailyReport->title;
            })
            ->editColumn('user_id', function ($query) {
                if ($query->user) {
                    return $query->user->full_name;
                } else {
                    return 'لا يوجد';
                }

            })->editColumn('leader_id', function ($query) {
                if ($query->leader) {
                    return $query->leader->full_name;

                } else {
                    return 'لا يوجد';
                }
            })->editColumn('status', function ($query) {

                if ($query->status == '0') {
                    return '<span class="status-new">لم يتم البدء</span>';
                } elseif ($query->status == '1') {
                    return '<span class="status-new">تم البدء</span>';
                } elseif ($query->status == '2') {
                    return '<span class="status-new">تحت المراجعه</span>';
                } elseif ($query->status == '3') {
                    return '<span class="status-refuse">تحتاج للتعديل</span>';
                } elseif ($query->status == '4') {
                    return '<span class="status-accept">منتهه</span>';
                } else {
                    return '<span class="">غير معروف</span>';
                }
            })
            ->rawColumns(['actions', 'status']);

    }

    public function query(ObjModel $model): QueryBuilder
    {
        return $model->newQuery()
            ->when(request('date'), function ($query) {
                $query->whereDate('deadline', request('date'));
            })
            ->when(request('user'), function ($query) {
                $query->where('user_id', request('user'));
            })
            ->when(request('leader'), function ($query) {
                $query->where('leader_id', request('leader'));
            })
            ->when(request('status'), function ($query) {
                $query->where('status', request('status'));
            })
            ->latest();
    }

}
