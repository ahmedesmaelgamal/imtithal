<?php

namespace App\Http\DataTables;

use App\Models\Survey as ObjModel;
use App\Services\Web\AreaService;
use App\Services\Web\SurveyQuestionService;
use App\Services\Web\AreaTeamService;
use App\Services\Web\UserService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use App\Services\Web\DailyReportService;
use App\Services\Web\DailyReportAssignService;


class SurveyManagementDataTable extends DataTable
{
    public function __construct(
        protected ObjModel $objModel,
        protected DailyReportAssignService $dailyReportAssignService,
        protected DailyReportService $dailyReportService,
        protected SurveyQuestionService $surveyQuestionService,
        protected AreaService $areaService,
        protected AreaTeamService $areaTeamService,
        protected UserService $userService,
    ) {
        // parent::__construct();
    }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('title', function ($query) {
                return $query->title;
            })
            ->editColumn('description', function ($query) {
                return $query->description;
            })
            ->editColumn('number_of_questions', function ($query) {
                $questions = $query->surveyQuestions->count();
                return $questions > 0 ? $questions . ' اسئلة' : 'لا يوجد اسئلة';
            })
            // ->editColumn('area_count', function ($query) {
            //     $areaCount = $this->areaService->model->where('axis_id', $query->id)->count();
            //     return $areaCount > 0 ? $areaCount : 'لا يوجد مواقع';
            // })
            // ->addColumn('employees', content: function ($query) {
            //     $div = '';
            //     $areaTeams = $this->areaService->model->with('memberTeam')->where('axis_id', $query->id)->get();
            //     $teamMembers = $areaTeams->pluck('memberTeam')->flatten();
            //     if ($teamMembers->count() == 0) {
            //         return '<div >
            //                     <span >لا يوجد</span>
            //                 </div>';
            //     }
            //     $div = '<div class="table-info position-relative">';
            //     foreach ($teamMembers as $index => $teamMember) {
            //         $usersImage = $this->userService->model->where('id', $teamMember->first()->user_id)->first();
            //         if ($usersImage) {
            //             $div .= '<img class="team-image" style="position: absolute;right: ' . ((20 * $index) + 1) . 'px;" src="' . getFile($usersImage->image, 'assets/uploads/avatar.png') . '" alt="no-image">';
            //         }
            //         if ($index >= 3) {
            //             break;
            //         }
            //     }
            //     if ($teamMembers->count() > 4) {
            //         $div .= '
            //                         <span class="number-team" style="position: absolute;right: 81px;">+' . ($teamMembers->count() - 4) . '</span>
            //                    ';
            //     }
            //     $div .= ' </div>';

            //     return $div;
            // })
            // ->addColumn('supervisors', content: function ($query) {
            //     $div = '';

            //     $areaTeams = $this->areaService->model->with('leaderTeam')->where('axis_id', $query->id)->get();
            //     $teamMembers = $areaTeams->pluck('leaderTeam')->flatten();
            //     if ($teamMembers->count() == 0) {
            //         return '<div >
            //                     <span >لا يوجد</span>
            //                 </div>';
            //     }
            //     $div = '<div class="table-info position-relative">';
            //     foreach ($teamMembers as $index => $teamMember) {
            //         $usersImage = $this->userService->model->where('id', $teamMember->first()->user_id)->first();
            //         if ($usersImage) {
            //             $div .= '<img class="team-image" style="position: absolute;right: ' . ((20 * $index) + 1) . 'px;" src="' . getFile($usersImage->image, 'assets/uploads/avatar.png') . '" alt="no-image">';
            //         }
            //         if ($index >= 3) {
            //             break;
            //         }
            //     }
            //     if ($teamMembers->count() > 4) {

            //         $div .= '
            //                         <span class="number-team" style="position: absolute;right: 81px;">+' . ($teamMembers->count() - 4) . '</span>
            //                    ';
            //     }
            //     $div .= ' </div>';

            //     return $div;
            // })
            ->addColumn('actions', function ($query) {
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
                if ($query->surveyQuestions->count() > 0) {

                    // $actions .='
                    //      <li>
                    //         <a data-id="' . $query->id . '" class="btn axisReportPrint dropdown-item">
                    //                 <img class="h-24" src="' . asset('web/image/eye-icon.png') . '" alt="no-image">
                    //                طباعة التقرير
                    //         </a>
                    //     </li>';
    
                    $actions .= '
                                    <li>
                                        <a class="edit dropdown-item" href="' . route('surveyEdit', $query->id) . '"  data-id="' . $query->id . '">
                                            <img class="h-24" src="' . asset('web/image/edit-icon.png') . '" alt="no-image">
                                            تعديل
                                        </a>
                                    </li>
                                    ';
                }
                $actions .= '
                                
                                <li>
                                    <a href="' . route('surveyDelete', $query->id) . '" class="dropdown-item axisDelete" data-id="' . $query->id . '">
                                            <img class="h-24" src="' . asset('web/image/trash.png') . '" alt="no-image">
                                            حذف
                                    </a>
                                 </li>
                            </ul>
                        </div>
                        ';
                return $actions;
            })
            ->rawColumns(['employees', 'supervisors', 'actions']);
    }

    public function query(ObjModel $model): QueryBuilder
    {
        return $model->newQuery()
            ->when(request('title'), function ($query) {
                $query->where('title', 'like', '%' . request('title') . '%');
            })
            ->when(request('description'), function ($query) {
                $query->where('description', 'like', '%' . request('description') . '%');
            })
            ->when(request('num_of_questions'), function ($query) {
                $query->whereHas('surveyQuestions', function ($query) {
                    $query->where('question', 'like', '%' . request('num_of_questions') . '%');
                });
            })
            ->when(request('date'), function ($query) {
                $query->whereDate('created_at', '<=', request('date'));
            })
            // ->when(request('num_of_areas'), function ($query) {
            //     $query->whereHas('areas', function ($query) {
            //         $query->where('name', 'like', '%' . request('num_of_areas') . '%');
            //     });
            // })
        ;
    }
}
