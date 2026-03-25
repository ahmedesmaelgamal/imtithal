<?php

namespace App\Http\DataTables;

use App\Models\Notice as ObjModel;
use App\Services\Web\NoticeService;
use App\Services\Web\UserService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;


class NoticeDataTable extends DataTable
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
//            ->addColumn('actions', function ($query) {
//                return '
//                        <div class="table-info">
//                            <button class="btn-menu dropdown-toggle" type="button"
//                                    id="dropdownMenuButton1"
//                                    data-bs-toggle="dropdown" aria-expanded="false">
//                                <i class="fa-solid fa-ellipsis-vertical"></i>
//                            </button>
//                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
//                                <li>
//                                    <a href="'.route('notice.show',$query->id).'" class="dropdown-item  view">
//                                        <img
//                                            class="h-24"
//                                            src="' . asset('web/image/eye-icon.png') . '"
//                                            alt="no-image"
//                                        />
//                                        عرض
//                                    </a>
//                                </li>
//                                <li>
//                                    <a class="dropdown-item updateNotice" id="updateNotice" data-id="' . $query->id . ' "  data-bs-toggle="modal" data-bs-target="#editNoticeModal">
//                                        <img class="h-24 editNotice" src="' . asset('web/image/edit-icon.png') . '" alt="no-image">
//                                        تعديل
//                                    </a>
//                                </li>
//                                <li>
//                                    <a href="' . route('notice.destroy', $query->id) . '" class="dropdown-item deleteNotice" data-id="' . $query->id . '">
//                                            <img class="h-24" src="' . asset('web/image/trash.png') . '" alt="no-image">
//                                            حذف
//                                    </a>
//                                </li>
//                            </ul>
//                        </div>
//                ';
//            })
            ->rawColumns(['name', 'user', 'actions', 'status', 'priority', 'created_at']);
    }

    public function query(ObjModel $model): QueryBuilder
    {
        return $model->newQuery()
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
