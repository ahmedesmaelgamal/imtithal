<?php

namespace App\Http\DataTables;

use App\Models\GeneralReport as ObjModel;
use App\Services\Web\UserService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class GeneralReportDataTable extends DataTable
{
    public function __construct(
        protected ObjModel $objModel,
        protected UserService $userService
    )
    {
        parent::__construct($objModel);
    }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('title', function ($query) {
                return '<div class="d-flex">
                            <div class="icon-table">
                                <img src="'.asset('web/image/file-icon.png').'" alt="no-image">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="name-table mb-2">'.$query->title.'</h6>
                                <p class="file-size"></p>
                            </div>
                        </div>';
            })
            ->editColumn('user', function ($query) {
                $user = $this->userService->model->find($query->leader_id);

                if (!$user) {
                    return '<div class="d-flex">
                    <img class="image-table" src="'.getFile(null, 'assets/uploads/avatar.png').'" alt="no-image">
                    <h6 class="name-table d-flex align-items-center">Unknown User</h6>
                </div>';
                }

                return '<div class="d-flex">
                <img class="image-table" src="'.getFile($user->image, 'assets/uploads/avatar.png').'" alt="no-image">
                <h6 class="name-table d-flex align-items-center">'.$user->full_name.'</h6>
            </div>';
            })


            ->editColumn('status', function ($query) {
                if ($query->status=='1'){
                    return ' <span class="status-accept">
                            معتمد
                         </span>';
                }
                elseif ($query->status=='2'){
                    return ' <span class="status-refuse">
                                        مرفوضة
                              </span>';
                }else{
                    return   ' <span class="status-new">
                            معلق
                         </span>';
                }

            })
            ->editColumn('created_at', function ($query) {
                return \Carbon\Carbon::parse($query->created_at)->locale('ar')->translatedFormat('d F Y');
            })
            ->addColumn('actions', function ($query) {
                return '
                            <a href="' . route('general_report.show', ['general_report_id' => $query->id]) . '" class="view">
                                <img class="h-24" src="' . asset('web/image/eye-icon.png') . '" >
                                عرض
                            </a>
                ';
            })
            ->rawColumns(['title','user','actions','status']);
    }

    public
    function query(ObjModel $model): QueryBuilder
    {
        return $model->newQuery()
            ->when(request('leader'), function ($query) {
                $query->where('leader_id', request('leader'));
            })
            ->when(request('role'), function ($query) {
                $query->whereHas('user.roles', function ($query) {
                    $query->where('name', request('role'));
                });
            })
            ->when(request('date'), function ($query) {
                $query->whereDate('created_at', request('date'));
            })
            ->when(request('status'), function ($query) {
                $query->where('status', request('status'));
            });
    }
}
