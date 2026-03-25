<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\DataTables\NoticeDataTable;
use App\Http\DataTables\NoticeTypeDataTable;
use App\Services\Web\NoticeService as ObjService;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function __construct(protected ObjService $objService)
    {
    }

    public function index()
    {
        return $this->objService->index();
    }

    public function noticeIndexDatatable(NoticeDataTable $dataTable)
    {
        return $this->objService->indexDatatable($dataTable);
    }

    public function noticeTypeIndexDatatable(NoticeTypeDataTable $dataTable)
    {
        return $this->objService->indexDatatable($dataTable);
    }

    public function show($id)
    {
        return $this->objService->show($id);
    }

    public function create()
    {
        return $this->objService->create();
    }

    public function storeNoticeType(Request $request)
    {
        return $this->objService->storeNoticeType($request);

    }
    public function updateNoticeStatus(Request $request, $id)
    {
        return $this->objService->updateNoticeStatus($request,$id);
    }
    public function deleteNoticeType($id)
    {
        return $this->objService->deleteNoticeType($id);

    }
    public function deleteNotice($id)
    {
        return $this->objService->deleteNotice($id);

    }
    public function updateNoticeType($id , Request $request)
    {
        return $this->objService->updateNoticeType($id,$request);

    }
}
