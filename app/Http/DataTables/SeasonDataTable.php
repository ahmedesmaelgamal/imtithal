<?php

namespace App\Http\DataTables;

use App\Models\Season as ObjModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;


class SeasonDataTable extends DataTable
{

    public function __construct(
        protected ObjModel $objModel,
    )
    {

    }


    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('actions', function ($query) {
                return '
        <div class="table-info">
            <button class="btn-menu dropdown-toggle" type="button"
                    id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis-vertical icon-table"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li>
                    <a class="dropdown-item edit" style="cursor: pointer;"
                       data-id="' . $query->id . '"
                       data-bs-toggle="modal" data-bs-target="#editSeasonModal">
                        <img class="h-24 editSeason" src="' . asset('web/image/edit-icon.png') . '" alt="no-image">
                        تعديل
                    </a>
                </li>
                <li>
                    <a href="' . route('seasons.destroy', $query->id) . '" class="dropdown-item deleteSeason">
                        <img class="h-24" src="' . asset('web/image/trash.png') . '" alt="no-image">
                        حذف
                    </a>
                </li>
            </ul>
        </div>
    ';
            })->editColumn('status', function ($obj) {
                return $this->StatusDatatableCustom($obj, '1');
            })
            ->rawColumns(['actions', 'status']);

    }

    public function StatusDatatableCustom($objModel, $status = 1, $column = 'status')
    {
        return '<div class="form-check form-switch d-flex">
                <label class="form-check-label ms-2" for="statusSwitch-' . $objModel->id . '">فعال</label>
                <input class="form-check-input ms-0" type="checkbox"
                       id="statusSwitch-' . $objModel->id . '"
                       data-id="' . $objModel->id . '"
                       name="status"
                       onchange="updateStatus(this)"
                       ' . ($objModel->{$column} == $status ? 'checked' : '') . ' />
            </div>';
    }

    public function query(ObjModel $model): QueryBuilder
    {
        return $model->newQuery()->withoutGlobalScopes();
    }
}
