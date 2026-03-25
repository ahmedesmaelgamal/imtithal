<?php

namespace App\Http\DataTables;

use App\Models\Alert as ObjModel;
use App\Services\Web\UserService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class AlertManagementDataTable extends DataTable
{
    public function __construct(
        protected ObjModel    $objModel,
        protected UserService $userService
    )
    {
        parent::__construct($objModel);
    }

    public function dataTable(QueryBuilder $query)
    {
        $query = $query->where('type', 'alert')
            ->where(function ($q) {
                $q->whereHas('alertLeaders', function ($query) {
                    $query->where('admin_id', auth('web')->user()->id);
                })
                    ->orWhereHas('alertUsers', function ($query) {
                        $query->where('admin_id', auth('web')->user()->id);
                    });
            })
            ->with(['alertLeaders', 'alertUsers']);

        return (new EloquentDataTable($query))
            ->addColumn('title', function ($query) {
                return '
                            <div class="d-flex">
                                <div class="high-priority">
                                    <i class="fa-regular fa-bell fa-lg"></i>
                                </div>
                                <div class="d-flex align-items-center">
                                    <h6 class="name-table mb-2">
                                        ' . $query->title . '
                                    </h6>
                                </div>
                            </div>
                    ';
            })
            ->editColumn('user', function ($query) {
//                dd($query->alertLeaders);
                $leader=null;
                $user=null;
                if ($query->alertLeaders->first())
                    $leader = $this->userService->model->where('id', $query->alertLeaders->first()->leader_id)->first();
                else{
                    $user = $this->userService->model->where('id', $query->alertUsers->first()->user_id)->first();
                }
                if ($leader){
                    return '<div class="d-flex">
                            <img class="image-table" src="' . getFile(($leader) ?? $leader->image, 'assets/uploads/avatar.png') . '" alt="no-image">
                            <h6 class="name-table d-flex align-items-center">' . $leader->full_name . '</h6>
                        </div>';
                }elseif($user){
                    return '<div class="d-flex">
                            <img class="image-table" src="' . getFile(($user) ?? $user->image, 'assets/uploads/avatar.png') . '" alt="no-image">
                            <h6 class="name-table d-flex align-items-center">' . $user->full_name . '</h6>
                        </div>';
                }else{
                    return '<div class="d-flex">
                            <img class="image-table" src="' . getFile(null, 'assets/uploads/avatar.png') . '" alt="no-image">
                            <h6 class="name-table d-flex align-items-center">لا يوجد</h6>
                        </div>';
                }

            })
            ->editColumn('created_at', function ($query) {
                return \Carbon\Carbon::parse($query->created_at)->locale('ar')->translatedFormat('d F Y');
            })
            ->addColumn('actions', function ($query) {
                return '
                            <a href="' . route('alert.show', ['alert' => $query->id]) . '" class="view">
                                <img class="h-24" src="' . asset('web/image/eye-icon.png') . '" >
                                عرض
                            </a>
                ';
            })
            ->rawColumns(['title', 'actions', 'priority', 'user', 'created_at']);
    }


    public function query(ObjModel $model): QueryBuilder
    {
        return $model->newQuery()
            ->when(request('date'), function ($query) {;
                $query->whereDate('created_at', request('date'));
            })
            ->when(request('user'), function ($query) {
                $query->where('leader_id', request('user'));
            })
            ->latest();
    }
}
