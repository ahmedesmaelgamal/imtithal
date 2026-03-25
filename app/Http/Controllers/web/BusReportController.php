<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\DataTables\BusReportDataTable;
use App\Services\Web\BusReportService as ObjService;
use Illuminate\Http\Request;

class BusReportController extends Controller
{
    public function __construct(protected ObjService $objService)
    {
    }

    public function index()
    {
        return $this->objService->index();
    }

    public function show($id)
    {
        //
    }

    public function indexDatatable(BusReportDataTable $dataTable)
    {
        return $dataTable->render('web.bus.index');
    }
}
