<?php

namespace App\Http\DataTables;

use App\Models\Alert as ObjModel;
use App\Services\Web\UserService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class NotificationManagementDataTable extends DataTable
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
        $query = $query->where('type', 'notification')
            ->where('to','1')
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
                $user=null;
                $leader=null;
                if ($query->alertLeaders?->first()) {
                    $leader = $this->userService->model->where('id', $query->alertLeaders->first()->leader_id)->first();
                } else {
                    $user = $query->alertUsers?->first()
                        ? $this->userService->model->where('id', $query->alertUsers->first()->user_id)->first()
                        : null;
                }

                if ($leader!=null){
                    return '<div class="d-flex">
                            <img class="image-table" src="' . getFile( $leader->image, 'assets/uploads/avatar.png') . '" alt="no-image">
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
            ->editColumn('priority', function ($query) {
                $priority = $query->priority ?? 'لا يوجد';
                if ($priority == 'high') {
                    return '
                    <div class="table-info text-green">عاليه</div>
                    ';

                } elseif ($priority == 'mid') {
                    return '
                    <div class="table-info text-brown">متوسطه</div>
                    ';
                } elseif ($priority == 'low') {
                    return '
                    <div class="table-info text-red">منخفضه</div>
                    ';
                } else {
                    return '
                              <div class="table-info text-red">لا يوجد</div>

                ';
                }
            })
            ->editColumn('created_at', function ($query) {
                return \Carbon\Carbon::parse($query->created_at)->locale('ar')->translatedFormat('d F Y');
            })
            ->addColumn('status', function ($query) {
                // Use alertLeaders and alertUsers (plural) as defined in your with() call
                $leaderStatus = $query->alertLeaders->where('alert_id', $query->id)->first();
                $userStatus = $query->alertUsers->where('alert_id', $query->id)->first();
                if ($leaderStatus) {
                    if ($leaderStatus->seen == 0) {
                        return '<span class="status-new"> جديد </span>';
                    } elseif ($leaderStatus->seen == 1) {
                        return '<span class="status-accept"> مقروء </span>';
                    }
                } elseif ($userStatus) {
                    if ($userStatus->seen == 0) {
                        return '<span class="status-new"> جديد </span>';
                    } elseif ($userStatus->seen == 1) {
                        return '<span class="status-accept"> مقروء </span>';
                    }
                }
            })
            ->addColumn('actions', function ($query) {
                return '
                            <a href="' . route('notification.show', ['notification_id' => $query->id]) . '" class="view">
                                <img class="h-24" src="' . asset('web/image/eye-icon.png') . '" >
                                عرض
                            </a>
                ';
            })
            ->rawColumns(['title', 'status', 'actions', 'priority', 'user', 'created_at']);
    }


    public function query(ObjModel $model): QueryBuilder
    {
        return $model->newQuery()
            ->when(request('date'), function ($query) {;
                $query->whereDate('created_at', request('date'));
            })
            ->when(request('priority'), function ($query) {
                $query->where('priority', request('priority'));
            })
            ->when(request('user'), function ($query) {
                $query->where('leader_id', request('user'));
            })
            ->latest();
    }
}
