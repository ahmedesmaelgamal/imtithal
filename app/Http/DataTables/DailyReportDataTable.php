<?php

namespace App\Http\DataTables;

use App\Models\DailyReport as ObjModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;


class DailyReportDataTable extends DataTable
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
            ->editColumn('created_at', function ($query) {
                return $query->created_at->locale('ar')->translatedFormat('d F Y');

            })->addColumn('actions', function ($query) {

//                $actions = '
//                                <li>
//                                    <a class="edit dropdown-item" href="' . route('area', ['axis_id' => $query->id]) . '" class="view">
//                                        <img class="h-24" src="' . asset('web/image/eye-icon.png') . '" alt="no-image">
//                                         عرض
//                                    </a>
//                                </li>
//                                <li>
//                                    <a href="' . route('axisDelete', $query->id) . '" class="dropdown-item axisDelete" data-id="' . $query->id . '">
//                                            <img class="h-24" src="' . asset('web/image/trash.png') . '" alt="no-image">
//                                            حذف
//                                    </a>
//                                 </li>
//                            </ul>
//                        </div>
//                        ';
//                return $actions;

                return '
                        <div class="table-info">
                            <button class="btn-menu dropdown-toggle" type="button"
                                    id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical "></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="edit dropdown-item" data-bs-toggle="modal"  data-id="' . $query->id . '">
                                        <img class="h-24" src="' . asset('web/image/edit-icon.png') . '" alt="no-image">
                                        تعديل
                                    </a>
                                </li>
                                <li>
                                    <a href="' . route('daily_report.destroy', $query->id) . '" class="dropdown-item deleteDailyReport" data-id="' . $query->id . '">
                                            <img class="h-24" src="' . asset('web/image/trash.png') . '" alt="no-image">
                                            حذف
                                    </a>
                                 </li>
                            </ul>
                        </div>
                ';
            })
            ->rawColumns(['actions']);
    }

    public function query(ObjModel $model): QueryBuilder
    {
        return $model->newQuery()
            ->when(request('axis'),function ($q){
                $q->where('axis_id',request('axis'));
            })
            ->when(request('monitor_type'),function ($q){
                $q->where('monitor_type',request('monitor_type'));
            })
            ->when(request('side_type'),function ($q){
                $q->where('side_type',request('side_type'));
            })
            ->when(request('deadline'),function ($q){
                $q->whereDate('deadline',request('deadline'));
            })
            ->latest();
    }
}
