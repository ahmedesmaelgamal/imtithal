<?php

namespace App\Http\DataTables;

use App\Models\Notice as ObjModel;
use App\Services\Web\UserService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;


class SuggestionDataTable extends DataTable
{
    public function __construct(
        protected ObjModel    $objModel,
        protected UserService $userService
    )
    {
        parent::__construct($objModel);
    }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('name', function ($query) {
                return '<div class="d-flex">
                            <div class="icon-table">
                                <img src="' . asset('web/image/information.png') . '" alt="no-image">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="name-table mb-2">' . (($query->noticeType==null)?" ":$query->noticeType->name) . '</h6>
                            </div>
                        </div>
                        ';
            })
            ->addColumn('user', function ($query) {
                $user = $this->userService->model->where('id', $query->user_id)->orWhere('id', $query->leader_id)->first();
                if ($user){

                return '<div class="d-flex">
                            <img class="image-table" src="' . getFile($user->image, 'assets/uploads/avatar.png') . '" alt="no-image">
                            <h6 class="name-table d-flex align-items-center">' . $user->full_name . '</h6>
                        </div>
                        ';
                }
                return 'لا يوجد';
            })
            ->editColumn('priority', function ($query) {
                $priority = ($query->noticeType)?$query->noticeType->priority:'لا يوجد';
                if ($priority == 'high') {
                    return '
                    <div class="table-info text-green">' . "مرتفعه" . '</div>
                    ';

                } elseif ($priority == 'mid') {
                    return '
                    <div class="table-info text-brown">' . "متوسطة" . '</div>
                    ';
                } elseif ($priority == 'low') {
                    return '
                    <div class="table-info text-red">' . "منخفضه" . '</div>
                    ';
                }
                elseif ($priority == 'suggest') {
                    return '
                    <div class="table-info text-secondary">' . "اقتراح" . '</div>
                    ';
                }
                return '
                              <div class="table-info text-red">' . $priority . '</div>

                ';
            })
            ->editColumn('status', function ($query) {
                if ($query->status == '2') {
                    return ' <span class="status-refuse">
                            مرفوض
                         </span>';
                } elseif ($query->status == '1') {
                    return ' <span class="status-accept">
                                        مقبول
                              </span>';
                } else {
                    return ' <span class="status-new">
                            قيد المراجعه
                         </span>';
                }

            })
            ->editColumn('created_at', function ($query) {
                return \Carbon\Carbon::parse($query->created_at)->locale('ar')->translatedFormat('d F Y');
            })
            ->addColumn('actions', function ($query) {
                return '
                          <a href="'.route('notice.show',$query->id).'" class="view">
                            <img
                                class="h-24"
                                src="' . asset('web/image/eye-icon.png') . '"
                                alt="no-image"
                            />
                            عرض
                        </a>
                ';
            })

            ->rawColumns(['name', 'user', 'actions', 'status', 'priority', 'created_at']);
    }

    public function query(ObjModel $model): QueryBuilder
    {
        return $model->whereHas('noticeType', function ($q) {
            $q->where('priority', 'suggest');
        })
            ->with(['user', 'noticeType'])
            ->select('notices.*')
            ->when(request('search'), function ($q) {
                $q->whereHas('user', function ($q) {
                    $q->where('full_name', 'like', '%' . request('search') . '%');
                });
            })
            ->when(request('name'), function ($q) {
                $q->whereHas('noticeType', function ($q) {
                    $q->where('name', 'like', '%' . request('name') . '%');
                });
            })
            ->when(request('status'), function ($q) {
                $q->whereHas('noticeType', function ($q) {
                    $q->where('status', '=', request('status'));
                });
            })
            ->
        newQuery()
            ->when(request('user'),function ($q){
                $q->where('user_id',request('user'));
            })
            ->when(request('priority'),function ($q){
                $q->whereHas('noticeType',function ($q){
                    $q->where('priority','=',request('priority'));
                });
            })
            ->when(request('status'),function ($q){
                $q->where('status','=',request('status'));
            })
            ->when(request('date'),function ($q){
                $q->whereDate('created_at','=',request('date'));
            })
            ->where('is_up','=','1');
    }
}
