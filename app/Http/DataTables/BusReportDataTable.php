<?php

namespace App\Http\DataTables;

use App\Models\BusReport as ObjModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Str;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class BusReportDataTable extends DataTable
{
    public function __construct(protected ObjModel $objModel)
    {
        parent::__construct($objModel);
    }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('actions', function ($query) {
                return '
                            <a class="view border-0" href="' . route('supports.show', $query->id) . '" data-id="' . $query->id . '">
                                <img class="h-24" src="' . asset('web/image/eye-icon.png') . '" alt="no-image">
                                عرض
                            </a>
                        ';
            })
            ->editColumn('user_id', function ($query) {
                return '<div class="d-flex">
                <img class="image-table" src="' . getFile($query->user->image, 'assets/uploads/avatar.png') . '" alt="no-image">
                <h6 class="name-table d-flex align-items-center">' . $query->user->full_name . '</h6>
            </div>';
            })
            ->editColumn('area_id', function ($query) {
                return $query->area->name;
            })
            ->editColumn('end_time', function ($query) {
                return \Carbon\Carbon::parse($query->end_time)->locale('ar')->translatedFormat('d F Y h:i A');
            })
            ->rawColumns(['actions', 'user_id', 'area_id']);
    }

    public function query(ObjModel $model): QueryBuilder
    {
        return $model->newQuery();
    }
}
