<?php

namespace App\Services\Web;

use App\Models\Axis;
use App\Models\DailyAssignUserAnswer;
use App\Models\DailyReport as ObjdModel;

use App\Models\DailyReportAssignUser;
use App\Services\BaseService;
use Illuminate\Support\Facades\Validator;

class DailyReportService extends BaseService
{
    protected string $folder = 'web.daily_report';

//    protected string $route = 'web.daily_report';

    public function __construct(protected ObjdModel $objModel, protected Axis $axis, protected DailyReportAssignUser $dailyReportAssignUser, protected DailyAssignUserAnswer $dailyAssignUserAnswer)
    {
        parent::__construct($objModel);
    }


    public function indexDatatable($dataTable)
    {
        return $dataTable->render('web.daily_report.index');
    }

    public function index()
    {
        return view($this->folder . '.index', [
            'axes' => $this->axis->get(),

        ]);
    }

    public function show($daily_report_id)
    {
        $obj = $this->model->findOrFail($daily_report_id);
        return view($this->folder . '.show', [
            'obj' => $obj,
        ]);

    }

    public function showDailyReportAssignUser($daily_report_assign_user_id)
    {
        $obj = $this->dailyReportAssignUser->findOrFail($daily_report_assign_user_id);
        return view($this->folder . '.showAssignUser', [
            'obj' => $obj,
        ]);

    }


    public function store($request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'axis_id' => 'required',
            'deadline' => 'required|date|after_or_equal:today',
            'monitor_type' => 'required',
            'side_type' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = $request->all();

        $obj = $this->model->create(($data));
        if ($obj) {


            return redirect()->route('daily_report.index')->with('success', 'تم انشاء التقرير بنجاح');
        }

        return redirect()->route('daily_report.index')->with('error', 'لم يتم انشاء التقرير ');


    }

    public function edit($id)
    {

        $dailyReport = $this->model->find($id);

        if (!$dailyReport) {
            return response()->json(['error' => 'daily report not found'], 404);
        }

        return response()->json([
            'id' => $dailyReport->id,
            'title' => $dailyReport->title,
            'description' => $dailyReport->description,
            'axis_id' => $dailyReport->axis_id,
            'monitor_type' => $dailyReport->monitor_type,
            'side_type' => $dailyReport->side_type,
            'deadline' => $dailyReport->deadline,
        ]);

    }

    public function update($request, $id)
    {
//        dd($request);
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'axis_id' => 'required',
            'deadline' => 'required|date|after_or_equal:today',
            'monitor_type' => 'required',
            'side_type' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = $request->all();
        $dailyReport = $this->model->find($id);
//        dd($dailyReport);

        $obj = $dailyReport->update(($data));
        if ($obj) {
            return response()->json(['success' => true, 'msg' => 'تم تعديل التقرير اليومي بنجاح'], 200);

        }
        return response()->json(['success' => false, 'msg' => 'لم يتم تعديل التقرير اليومي '], 200);

    }


    public function destroy($id)
    {
        $dailyReport = $this->objModel->where('id', $id)->first();
        if ($dailyReport) {
            $dailyReport->delete();
            return $this->responseMsg('تم حذف التقرير اليومي بنجاح', null, 200);
        } else {
            return $this->responseMsg('حدث خطأ أثناء حذف التقرير اليومي', null, 500);
        }
    }

    public function destroyDailyReportAssignUser($id)
    {
        $dailyReportAssignUser = $this->dailyReportAssignUser->where('id', $id)->first();
        $dailyAssignUserAnswer = $this->dailyAssignUserAnswer->where('daily_report_assign_user_id', $dailyReportAssignUser->id)->get();
        if ($dailyReportAssignUser) {
            $dailyAssignUserAnswer->each->delete();
            $dailyReportAssignUser->delete();
            return $this->responseMsg('تم حذف التقرير اليومي بنجاح', null, 200);
        } else {
            return $this->responseMsg('حدث خطأ أثناء حذف التقرير اليومي', null, 500);
        }
    }
}
