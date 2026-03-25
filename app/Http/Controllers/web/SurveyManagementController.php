<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\DataTables\SurveyManagementDataTable;
use App\Services\Web\SurveyManagementService as ObjService;
use Illuminate\Http\Request;

class SurveyManagementController extends Controller
{
    public function __construct(protected ObjService $objService)
    {
    }

    public function indexDatatable(SurveyManagementDataTable $dataTable)
    {
        return $dataTable->render('web.surveys_management.index');
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

    public function deleteSurvayQuestion($id)
    {
        return $this->objService->deleteSurveyQuestion($id);
    }

    public function delete($id)
    {
        return $this->objService->deleteSurvey($id);
    }

    public function survayReportPrint(Request $request)
    {
        return $this->objService->survayReportPrint($request);
    }

    public function importQuestions(Request $request)
    {
        $request->validate([
            'survay_id' => 'required|exists:survays,id',
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\SurvayQuestionImport($request->survay_id), $request->file('file'));

        return response()->json([
            'status' => true,
            'msg' => 'تم استيراد الأسئلة بنجاح'
        ]);
    }

    public function importReports(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\SurveyReportImport(), $request->file('file'));

        return response()->json([
            'status' => true,
            'msg' => 'تم استيراد التقارير والأسئلة بنجاح'
        ]);
    }
}
