<?php

namespace App\Http\DataTables;

use App\Models\Admin;
use App\Models\ActivityLog as ObjModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;


class ActivityLogDataTable extends DataTable
{
    public function __construct(
        protected ObjModel                 $objModel,
        protected Admin $user
    )
    {
        parent::__construct($objModel);
    }



    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('admin_id', function ($obj) {

                return $obj->admin_id?$obj->admin->full_name :"التطبيق";

            })


            ->editColumn('created_at', function ($obj) {
                return \Carbon\Carbon::parse($obj->created_at)->locale('ar')->translatedFormat('d F Y');

            });

    }

    public function query(ObjModel $model): QueryBuilder
    {
        return $model->newQuery()->latest();
    }
}
