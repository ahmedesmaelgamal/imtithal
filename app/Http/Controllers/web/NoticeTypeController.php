<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\DataTables\AxisManagementDataTable;
use App\Http\DataTables\NoticeDataTable;
use App\Services\Web\NoticeService as ObjService;
use Illuminate\Http\Request;

class NoticeTypeController extends Controller
{
    public function __construct(protected ObjService $objService)
    {
    }

    public function indexDatatable(NoticeDataTable $dataTable)
    {
        return $dataTable->render('web.notice.index');
    }


    public function index()
    {
        return $this->objService->index();
    }
    public function create()
    {
        return $this->objService->create();
    }
    public function store(Request $request)
    {
        return $this->objService->store($request);

    }

}
