<?php

namespace App\Http\DataTables;

use App\Models\AreaTeam;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class AreaDetailsDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('user_id', function ($query) {
                return '
                    <div class="d-flex">
                        <img class="image-table" src="' . getFile($query->user->image, 'assets/uploads/avatar.png') . '" alt="no-image">
                        <div>
                            <h6 class="name-table d-flex align-items-center">' . $query->user->full_name . '</h6>
                            <p class="fs-12 fw-400 text-secondary">سعودي</p>
                        </div>
                    </div>
                ';
            })
            ->addColumn('national_id', function ($query) {
                return $query->user->national_id;
            })
            ->addColumn('role', function ($query) {
                return $query->user->getRoleNames()->first();
            })
            ->editColumn('created_at', function ($query) {
                return Carbon::parse($query->created_at)->locale('ar')->translatedFormat('d F Y');
            })
            ->addColumn('actions', function ($query) {
                 return '
                     <a href="' . route('areaTeamMember.delete', ['id' => $query->id]) . '" class="deleteAreaTeamMember">
                         <img class="h-24" src="' . asset('web/image/trash.png') . '" alt="no-image">

                     </a>
                 ';
            })
            ->rawColumns(['user_id', 'actions']);
    }

    public function query(AreaTeam $model): QueryBuilder
    {
        return $model->newQuery()
            ->where('area_id', $this->id)->with('user');
    }
}
