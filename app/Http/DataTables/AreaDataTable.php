<?php

namespace App\Http\DataTables;

use App\Enum\AreaTypeEnum;
use App\Models\Area;
use App\Models\Area as ObjModel;
use App\Models\AxisQuestion;
use App\Services\Web\AreaService;
use App\Services\Web\AreaTeamService;
use App\Services\Web\AxisQuestionService;
use App\Services\Web\UserService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;


use App\Services\Web\DailyReportService;
use App\Services\Web\DailyReportAssignService;


class AreaDataTable extends DataTable
{


    public function dataTable(QueryBuilder $query)
    {
        $dataTable = (new EloquentDataTable($query))
            ->addColumn('area_locations', function ($query) {
                $area = $this->areaService->model->where('axis_id', $query->id)->first();
                return $area ? $area->name  : 'No Data';
            })
            ->addColumn('type', function ($query) {
                $areaType = AreaTypeEnum::from($query->type)->lang();
//                dd($areaType);
                return $areaType;
            })
            ->addColumn('area_team', function ($query) {
                $areas = $this->areaService->model->where('axis_id', $query->id)->get();
                $div = '';
                foreach ($areas as $area) {
                    $areaTeams = $this->areaTeamService->model->where('area_id', $area->id)->where('type', 0)->get();
                    $div = '<div class="table-info position-relative">';
                    foreach ($areaTeams as $index => $areaTeam) {
                        $usersImage = $this->userService->model->where('id', $areaTeam->user_id)->first();
                        if ($usersImage) {
                            $div .= '<img class="team-image" style="position: absolute;right: ' . ((20 * $index) + 1) . 'px;" src="' . getFile($usersImage->image, 'assets/uploads/avatar.png') . '" alt="no-image">';
                        }
                    }
                    $div .= '</div>';
                }
                return getFile($usersImage->image, 'assets/uploads/avatar.png');
            })
            ->addColumn('supervisors', function ($query) {
                $areas = $this->areaService->model->where('axis_id', $query->id)->get();
                $div = '';
                foreach ($areas as $area) {
                    $areaTeams = $this->areaTeamService->model->where('area_id', $area->id)->where('type', 2)->get();
                    $div = '<div class="table-info position-relative">';
                    foreach ($areaTeams as $index => $areaTeam) {
                        $usersImage = $this->userService->model->where('id', $areaTeam->user_id)->first();
                        if ($usersImage) {
                            $div .= '<img class="team-image" style="position: absolute;right: ' . ((20 * $index) + 1) . 'px;" src="' . getFile($usersImage->image, 'assets/uploads/avatar.png') . '" alt="no-image">';
                        }
                    }
                    $div .= '</div>';
                }
                return getFile($usersImage->image, 'assets/uploads/avatar.png');
            })
            ->addColumn('actions', function ($query) {
                return '
        <a href="' . route('area', ['axis_id' => $query->id]) . '" class="view">
            <img class="h-24" src="' . asset('web/image/eye-icon.png') . '" alt="no-image">
            عرض
        </a>
    ';
            })
            ->rawColumns(['area_locations', 'area_team', 'supervisors', 'actions'])
            ->orderColumn('area_locations', function ($query, $order) {
                // Explicitly prevent sorting
                return $query;
            })
            ->orderColumn('area_locations', function ($query, $order) {
                return; // Prevent orderin
            });

        return response()->json($dataTable->toArray());
    }


    public function query(ObjModel $model): QueryBuilder
    {
        return $model->newQuery();
    }
}
