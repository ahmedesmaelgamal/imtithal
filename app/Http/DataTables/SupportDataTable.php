<?php

namespace App\Http\DataTables;

use App\Models\SupportTicket as ObjModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Str;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class SupportDataTable extends DataTable
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
                            <a class="view border-0" href="'. route('supports.show',$query->id) .'" data-id="' . $query->id . '">
                                <img class="h-24" src="' . asset('web/image/eye-icon.png') . '" alt="no-image">
                                عرض
                            </a>
                        ';
            })
            ->editColumn('user_id', function ($query) {
                return '<div class="d-flex">
                <img class="image-table" src="'.getFile($query->user->image, 'assets/uploads/avatar.png').'" alt="no-image">
                <h6 class="name-table d-flex align-items-center">'.$query->user->full_name.'</h6>
            </div>';
            })
            ->editColumn('status', function ($query) {
                return $query->status == 1 ? 'تم الرد' : 'لم يتم الرد';
            })
            ->editColumn('priority', function ($query) {
                if ($query->priority == 'high') {
                    return 'عالي';
                }elseif ($query->priority == 'medium') {
                    return 'متوسط';
                }else{
                    return 'منخفض';
                }
            })
            ->editColumn('message', function ($query) {
                return Str::limit($query->message, 50);
            })
            ->rawColumns(['actions','user_id']);
    }

    public function query(ObjModel $model): QueryBuilder
    {
        return $model->newQuery();
    }
}
