<?php

namespace App\Services\Web;

use App\Enum\DailyReportRejectReasonEnum;
use App\Enum\ReportStatusEnum;
use App\Models\Notice as ObjModel;

use App\Models\NoticeType;
use App\Services\BaseService;
use App\Services\FirestoreService;
use Illuminate\Http\Request;

class NoticeService extends BaseService
{
//    protected string $folder = 'admin/admin';
//    protected string $route = 'adminHome';

    public function __construct(
        protected ObjModel     $objModel,
        protected NoticeType   $noticeType,
        protected AdminService $adminService,
        protected FirestoreService $firestoreService,
    )
    {
        parent::__construct($objModel);
    }

    public function index()
    {
        $notices = $this->objModel->all();
        $noticeTypes = $this->noticeType->all();
        return view('web.notice.index', ['noticeTypes' => $noticeTypes,'notices' => $notices]);
    }

    public function indexDatatable($dataTable)
    {
        return $dataTable->render('web.notice.index');
    }

    public function storeNoticeType($request)
    {
        $validator = $this->apiValidator($request->all(), [
            'name' => 'required',
            'priority' => 'required|in:' . implode(',', ['suggest', 'low', 'mid', 'high']),
            'period' => 'required|numeric',
//            'level' => 'required|in:' . implode(',', ['لم يتم التصعيد', 'اذا لم يعالج', 'تصعيد مباشر']),
        ]);

        if ($validator) {
            return $validator;
        }
        try {

            $noticeType = $this->noticeType->create([
                'name' => $request->name,
                'priority' => $request->priority,
                'period' => $request->period,
//                'level' => $request->level,
            ]);
//            dd($noticeType);

            return response()->json([
                'success' => true,
                'message' => 'تم إنشاء نوع البلاغ بنجاح',
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false,
                'message' => 'حدث خطأ ما أثناء إنشاء نوع البلاغ',
                'error' => $e->getMessage()], 500);
        }

    }

    public function updateNoticeType($id, $request)
    {

        $validator = $this->apiValidator($request->all(), [
            'name' => 'required',
            'priority' => 'required|in:' . implode(',', ['suggest', 'low', 'mid', 'high']),
            'period' => 'required|numeric',
//            'level' => 'required|in:' . implode(',', ['لم يتم التصعيد', 'اذا لم يعالج', 'تصعيد مباشر']),
        ]);

        if ($validator) {
            return $validator;
        }
        try {
            $this->noticeType->where('id', $id)->update([
                'name' => $request->name,
                'priority' => $request->priority,
                'period' => $request->period,
//                'level' => $request->level,
            ]);

            return response()->json([
                'status' => true,
                'msg' => 'تم تحديث نوع البلاغ بنجاح',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'msg' => 'حدث خطأ ما أثناء تحديث نوع البلاغ',
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


    public function updateNoticeStatus($request, $id)
    {
        try {
            $notice = $this->objModel->find($id);

            if (!$notice) {
                return response()->json([
                    'success' => false,
                    'message' => 'لم يتم إيجاد التقرير',
                ], 404);
            }

            if ($notice->status != '0' && $notice->status != '3') {
                return response()->json([
                    'success' => false,
                    'message' => 'حدث خطأ غير متوقع',
                ], 404);
            }

            if ($request->status == 'accept') {
                $notice->update([
                    'status' => '1',
                ]);

                $notice_firestore = $this->objModel->find($id);
                $this->firestoreService->updateNotice($notice_firestore);

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
                $notice_firestore = $this->objModel->find($id);
                $this->firestoreService->updateNotice($notice_firestore);
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

    public function deleteNoticeType($id)
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
            'msg' => 'تم حذف نوع البلاغ بنجاح',
        ], 200);
    }


    public function deleteNotice($id)
    {
        $notice = $this->objModel->find($id);

        if (!$notice) {
            return response()->json([
                'status' => false,
                'msg' => 'حدث خطأ ما أثناء تحديث البلاغ',
            ], 500);
        }

        $notice->delete();

        return response()->json([
            'status' => true,
            'msg' => 'تم حذف البلاغ بنجاح',
        ], 200);
    }

}
