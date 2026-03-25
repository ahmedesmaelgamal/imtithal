<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\DataTables\DailyReportDataTable;
use App\Http\DataTables\DailyReportAssignUserDataTable;
use App\Services\Web\DailyReportService as ObjService;
use Illuminate\Http\Request;

class DailyReportController extends Controller
{
    public function __construct(protected ObjService $objService)
    {
    }

    public function indexDatatable(DailyReportDataTable $dailyReportDataTable )
    {
       return $this->objService->indexDatatable($dailyReportDataTable);
    }


    public function index2Datatable(DailyReportAssignUserDataTable $dailyReportAssignUserDataTable)
    {

        return $this->objService->indexDatatable($dailyReportAssignUserDataTable);

    }
    public function destroyDailyReportAssignUser($id)
    {
        return $this->objService->destroyDailyReportAssignUser($id);

    }

    public function index()
    {
        return $this->objService->index();
    }

    public function store(Request $request)
    {
        return $this->objService->store($request);

    }

    public function show($daily_report_id)
    {
        return $this->objService->show($daily_report_id);
    }


        public function showDailyReportAssignUser($daily_report_assign_user_id)
    {
        return $this->objService->showDailyReportAssignUser($daily_report_assign_user_id);


    }
    public function edit($id)
    {
        return $this->objService->edit($id);
    }
    public function update(Request $request,$id)
    {
        return $this->objService->update($request,$id);

    }
    public function destroy($id)
    {
        return $this->objService->destroy($id);
    }



}
