<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\DataTables\AttendanceDataTable;
use App\Services\Web\AttendanceService as ObjService;

class AttendanceController extends Controller
{
    public function __construct(

        protected ObjService $objService,

    )
    {
    }

    public function indexDatatable(AttendanceDataTable $dataTable)
    {


        return $dataTable->render('web.attendance.index') ;
    }


    public function index()
    {
        return $this->objService->index();
    }

    public function show($id)
    {
        return $this->objService->show($id);

    }
}
