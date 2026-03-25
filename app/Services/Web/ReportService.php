<?php

namespace App\Services\Web;

use App\Enum\DailyReportRejectReasonEnum;
use App\Enum\ReportStatusEnum;
use App\Models\Admin as ObjModel;

use App\Models\GeneralReport;
use App\Models\ViolationReport;
use App\Services\BaseService;

class ReportService extends BaseService
{
//    protected string $folder = 'admin/admin';
//    protected string $route = 'adminHome';

    public function __construct(
        ObjModel                  $objModel,
        protected ViolationReport $violationReport,
        protected GeneralReport   $generalReport
    )
    {
        parent::__construct($objModel);
    }

    public function index()
    {
        return view('web.report.index');
    }

    public function indexDatatable($dataTable)
    {
        return $dataTable->render('web.daily_report.index');
    }

    public function updateReportStatus($request, $id)
    {
        try {
            if ($request->type == 'violation') {
                $report = $this->violationReport->find($id);
            } elseif ($request->type == 'general') {
                $report = $this->generalReport->find($id);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'حدث خطأ غير متوقع',
                ], 404);
            }

            if (!$report) {
                return response()->json([
                    'success' => false,
                    'message' => 'لم يتم إيجاد التقرير',
                ], 404);
            }


            if ($report->status != 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'لا يمكن تعديل حالة التقرير',
                ], 404);
            }

            if ($request->status == 'accept') {
                $report->update([
                    'status' => '1',
                    'admin_id'=>auth()->user()->id
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'تم إعتماد بنجاح'
                ], 200);
            } elseif ($request->status == 'refuse') {
                $reportStatus = $report->update([
                    'status' => '2',
                    'refuse_notes' => $request->refuse_notes,
                    'refuse_reason' => $request->refuse_reason,
                    'admin_id'=>auth()->user()->id
                ]);
                if ($reportStatus) {
                    return response()->json([
                        'success' => true,
                        'message' => 'تم رفض بنجاح'
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'حدث خطأ ما أثناء تحديث حالة التقرير',
                    ], 500);
                }

            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'حدث خطأ ما أثناء تحديث حالة التقرير',
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ ما أثناء تحديث حالة التقرير',
                'error' => $e->getMessage()
            ], 500);
        }
    }


}
