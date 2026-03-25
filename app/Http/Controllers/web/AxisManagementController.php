<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\DataTables\AxisManagementDataTable;
use App\Services\Web\AxesManagementService as ObjService;
use Illuminate\Http\Request;

class AxisManagementController extends Controller
{
    public function __construct(protected ObjService $objService)
    {
    }

    public function indexDatatable(AxisManagementDataTable $dataTable)
    {
        return $dataTable->render('web.axes_management.index');
    }


    public function index()
    {
        return $this->objService->index();
    }

    public function edit($id)
    {
        return $this->objService->edit($id);
    }

    public function create()
    {
        return $this->objService->create();
    }

    public function store(Request $request)
    {
        return $this->objService->store($request);

    }

    public function update(Request $request)
    {
        return $this->objService->update($request);

    }

    public function deleteAxisQuestion($id)
    {
        return $this->objService->deleteAxisQuestion($id);
    }

    public function delete($id)
    {
        return $this->objService->deleteAxis($id);
    }

    public function axisReportPrint(Request $request)
    {
        return $this->objService->axisReportPrint($request);
    }

    public function importQuestions(Request $request)
    {
        $request->validate([
            'axis_id' => 'required|exists:axes,id',
            'file'    => 'required|mimes:xlsx,xls,csv'
        ]);

        \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\AxisQuestionImport($request->axis_id), $request->file('file'));

        return response()->json([
            'status' => true,
            'msg'    => 'تم استيراد الأسئلة بنجاح'
        ]);
    }

    public function importReports(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\ReportImport(), $request->file('file'));

        return response()->json([
            'status' => true,
            'msg'    => 'تم استيراد التقارير والأسئلة بنجاح'
        ]);
    }
}
