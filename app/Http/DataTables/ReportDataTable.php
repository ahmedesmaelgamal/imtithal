<?php

namespace App\Http\DataTables;

use App\Models\Axis as ObjModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;



class ReportDataTable extends DataTable
{
    public function __construct(
        protected ObjModel                 $objModel,

    )
    {
        parent::__construct($objModel);
    }


    public
    function query(ObjModel $model): QueryBuilder
    {
        return $model->newQuery();
    }
}
