<?php

namespace App\Services\Web;

use App\Enum\DailyReportRejectReasonEnum;
use App\Models\Notice as ObjModel;

use App\Models\NoticeType;
use App\Services\BaseService;

class SuggestionService extends BaseService
{

    public function __construct(
        protected ObjModel     $objModel,
        protected NoticeType   $noticeType,
        protected AdminService $adminService
    )
    {
        parent::__construct($objModel);
    }

    public function index()
    {
        $notices = $this->objModel->whereHas('noticeType', function ($query) {;
            $query->where('priority', 'suggest');
        })->get();


        $noticeTypes = $this->noticeType->where('priority', 'suggest')->get();
        return view('web.suggestion.index', ['noticeTypes' => $noticeTypes, 'notices' => $notices]);
    }

    public function indexDatatable($dataTable)
    {
        return $dataTable->render('web.suggestion.index');
    }

    public function storeSuggestionType($request)
    {
        $validator = $this->apiValidator($request->all(), [
            'name' => 'required',
            'period' => 'required|numeric',
        ]);

        if ($validator) {
            return $validator;
        }
        try {

            $noticeType = $this->noticeType->create([
                'name' => $request->name,
                'priority' => 'suggest',
                'period' => $request->period,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'تم إنشاء نوع الاقتراح بنجاح',
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false,
                'message' => 'حدث خطأ ما أثناء إنشاء نوع الاقتراح',
                'error' => $e->getMessage()], 500);
        }

    }

    public function updateSuggestionType($id, $request)
    {

        $validator = $this->apiValidator($request->all(), [
            'name' => 'required',
            'period' => 'required|numeric',
        ]);

        if ($validator) {
            return $validator;
        }
        try {
            $this->noticeType->where('id', $id)->update([
                'name' => $request->name,
                'period' => $request->period,
            ]);

            return response()->json([
                'status' => true,
                'msg' => 'تم تحديث نوع الاقتراح بنجاح',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'msg' => 'حدث خطأ ما أثناء تحديث نوع الاقتراح',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    public function show($id)
    {
        $notice = $this->objModel->find($id);
        $adminAction = $this->adminService->model->where('id', $notice->admin_id)->first();
        $refuseReasons = DailyReportRejectReasonEnum::cases();
        $noticeRefuseReason = is_numeric($notice->refuse_reason) && ctype_digit((string)$notice->refuse_reason)
            ? (int)$notice->refuse_reason
            : null;
        $rejectReason = $noticeRefuseReason !== null
            ? DailyReportRejectReasonEnum::from($noticeRefuseReason)->lang()
            : null;
        return view('web.notice.details', ['notice' => $notice, 'refuse_reasons' => $refuseReasons, 'adminAction' => $adminAction, 'rejectReason' => $rejectReason]);
    }


    public function updateSuggestionStatus($request, $id)
    {
        try {
            $notice = $this->objModel->find($id);

            if (!$notice) {
                return response()->json([
                    'success' => false,
                    'message' => 'لم يتم إيجاد التقرير',
                ], 404);
            }
            if ($notice->status != 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'حدث خطأ غير متوقع',
                ], 404);
            }

            if ($request->status == 'accept') {
                $notice->update([
                    'status' => '1',
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'تم إعتماد بنجاح'
                ], 200);
            } elseif ($request->status == 'refuse') {
                $reportStatus = $notice->update([
                    'status' => '2',
                    'refuse_notes' => $request->refuse_notes,
                    'refuse_reason' => $request->refuse_reason,
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

    public function deleteSuggestionType($id)
    {
        $noticeType = $this->noticeType->find($id);

        if (!$noticeType) {
            return response()->json([
                'status' => false,
                'msg' => 'حدث خطأ ما أثناء تحديث حالة التقرير',
            ], 500);
        }

        $noticeType->delete();

        return response()->json([
            'status' => true,
            'msg' => 'تم حذف نوع الاقتراح بنجاح',
        ], 200);
    }


    public function deleteSuggestion($id)
    {
        $notice = $this->objModel->find($id);

        if (!$notice) {
            return response()->json([
                'status' => false,
                'msg' => 'حدث خطأ ما أثناء تحديث الاقتراح',
            ], 500);
        }

        $notice->delete();

        return response()->json([
            'status' => true,
            'msg' => 'تم حذف الاقتراح بنجاح',
        ], 200);
    }

}
