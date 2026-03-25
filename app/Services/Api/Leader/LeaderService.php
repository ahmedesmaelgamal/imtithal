<?php

/**
 * Summary of namespace App\Services\Api\Leader
 */

namespace App\Services\Api\Leader;

use App\Enum\VehicleType;
use App\Http\Resources\BaseGeneralReportResource;
use App\Http\Resources\BaseNoticeResource;
use App\Http\Resources\BaseViolationReportResource;
use App\Http\Resources\GeneralReportResource;
use App\Http\Resources\Leaders\BusReportResource;
use App\Http\Resources\Leaders\LeaderAlertResource;
use App\Http\Resources\Leaders\LeaderDailyReportAssignResource;
use App\Http\Resources\Leaders\TeamResource;
use App\Http\Resources\NoticeResource;
use App\Http\Resources\NoticeTypeResource;
use App\Http\Resources\Users\AreaResource;
use App\Http\Resources\ViolationReportResource;
use App\Models\Alert;
use App\Models\AlertUser;
use App\Models\Area;
use App\Models\AreaTeam;
use App\Models\BusReport;
use App\Models\GeneralReport;
use App\Models\Media;
use App\Models\Notice;
use App\Models\NoticeType;
use App\Models\PolicyPrivacy;
use App\Models\User;
use App\Models\ViolationReport;
use App\Services\BaseService;
use App\Services\FirestoreService;
use App\Traits\OneSignalNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Summary of LeaderService
 */
class LeaderService extends BaseService
{
    use OneSignalNotification;

    /**
     * Summary of __construct
     * @param \App\Models\User $objModel
     */
    public function __construct(
        User                       $objModel,
        protected PolicyPrivacy $policyPrivacy,
        protected AreaTeam         $areaTeam,
        protected Alert            $alert,
        protected AlertUser        $alertUser,
        protected Media            $media,
        protected ViolationReport  $violationReport,
        protected GeneralReport    $generalReport,
        protected Notice           $notice,
        protected FirestoreService $firestoreService,
        protected BusReport        $busReport,
        protected Area             $area,
        protected NoticeType       $noticeType
    ) {
        $this->initializeOneSignalTrait();

        parent::__construct($objModel);
    }


    /**
     * Summary of home
     * @return \Illuminate\Http\JsonResponse
     */
    public function home(): \Illuminate\Http\JsonResponse
    {
        $leader = auth('user')->user();
        $reportsReviewed = $leader->leaderReports()
            ->where('status', '4')->count();
        $reportsUnderReview = $leader->leaderReports()
            ->where('status', '2')->latest()->get();
        $leaderSuggestCount = $leader->leaderNotices()
            ->whereHas('noticeType', function ($notice) {
                return $notice->where('priority', 'suggest');
            })->count();

        $leaderNoticesCount = $leader->leaderNotices()->whereHas('noticeType', function ($notice) {
            return $notice->where('priority', '!=', 'suggest');
        })->count();
        // Get all areas of the user

        $areaIds = $leader->areas()->pluck('area_id');
        $teamIds = $this->areaTeam->whereIn('area_id', $areaIds)->pluck('user_id');
        $teams = $this->model->whereIn('id', $teamIds)->where('id', '!=', $leader->id)->get();
        // generate violation Reports reference_number


        $lastReference = $this->violationReport->max('reference_number');

        if (!$lastReference) {
            $newReference = date('Ymd') . '000000';
        } else {
            $newReference = intval($lastReference) + 1;
        }

        return response()->json([
            'message' => 'تمت العملية بنجاح',
            'teams' => TeamResource::collection($teams),
            'reportsReviewedCount' => $reportsReviewed,
            'reportsUnderReviewCount' => $reportsUnderReview->count(),
            'reportsUnderReview' => LeaderDailyReportAssignResource::collection($reportsUnderReview),
            'leaderSuggestCount' => $leaderSuggestCount,
            'leaderNoticesCount' => $leaderNoticesCount,
            'newReference' => $newReference

        ]);
    }


    /**
     * Summary of storeFcm
     * @param mixed $request
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function storeFcm($request)
    {
        $validator = $this->apiValidator($request->all(), [
            'fcm_token' => 'required',
        ]);

        if ($validator) {
            return $validator;
        }
        $user = User::where('id', Auth::guard('user')->user()->id)->first();
        $user->fcm_token = $request->fcm_token;
        $user->save();
        return $this->responseMsg('تم حفظ التوكن الخاص بالتطبيق', null);
    }


    public function getAlerts()
    {
        $leader = auth('user')->user();
        $alerts = $this->alert->where('leader_id', $leader->id)->get();
        return $this->responseMsg('تمت العملية بنجاح', LeaderAlertResource::collection($alerts));
    }

    public function addAlert($request)
    {
        $leader = auth('user')->user();
        $areaIds = $leader->areas()->pluck('area_id');
        $teamIds = $this->areaTeam->whereIn('area_id', $areaIds)->where('user_id', '!=', $leader->id)->pluck('user_id');
        $validator = $this->apiValidator($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'to' => 'required|in:0,1',
            'priority' => 'required|in:low,mid,high',
        ]);

        if ($validator) {
            return $validator;
        }

        $newAlert = new $this->alert();
        $newAlert->title = $request->title;
        $newAlert->body = $request->body;
        $newAlert->leader_id = $leader->id;
        $newAlert->to = $request->to;
        $newAlert->type = 'notification';
        $newAlert->priority = $request->priority;
        if ($newAlert->save()) {
            $newAlert->alertLeaders()->create([
                'leader_id' => $leader->id
            ]);
            if ($request->has('files')) {
                $this->storeFiles($request->file('files'), $newAlert->id);
            }
            if ($newAlert->to == '1') {
                foreach ($teamIds as $user_id) {
                    $newAlert->alertUsers()->create([
                        'user_id' => $user_id
                    ]);


                    // send notification
                    $playerId[] = $this->model->find($user_id)->fcm_token;
                    $title = 'تنبيه من المشرف';
                    $message = $request->body . ' يرجى اتخاذ الإجراء اللازم.';
                    $data = [
                        'notification_type' => 'notification',
                        'user_type' => 'other',  // leader  or  other
                        'user_id' => $this->model->find($user_id)->id
                    ];
                    $response = $this->sendNotificationToUser($playerId, $title, $message, null, $data);
                    if (!$response) {
                        Log::error('فشل إرسال الإشعار عبر OneSignal');
                    } else {
                        Log::info('تم إرسال الإشعار بنجاح', $response);
                    }
                }
            }
            return $this->responseMsg('تم اضافة التنبيه بنجاح', LeaderAlertResource::make($newAlert));
        }

        return $this->responseMsg('هناك خطا في الاضافة حاول مره اخري', null, 422);
    }

    public function alertDetails($id)
    {
        $alert = $this->alert->where('id', $id)->first();

        if (!$alert) {
            return $this->responseMsg('هذا التنبيه غير موجود', null, 404);
        }

        return $this->responseMsg('تمت العملية بنجاح', LeaderAlertResource::make($alert));
    }


    public function storeFiles($files, $id)
    {
        if ($files instanceof \Symfony\Component\HttpFoundation\FileBag) {
            $files = $files->all();
        }

        if (!is_array($files)) {
            $files = [$files];
        }

        foreach ($files as $file) {
            if (!$file instanceof \Illuminate\Http\UploadedFile) {
                continue;
            }

            $filePath = $this->handleFile($file, 'alert');
            $this->media->create([
                'file' => $filePath,
                'file_type' => $file->getClientOriginalExtension(),
                'file_name' => $file->getClientOriginalName(),
                'model_type' => 'App\Models\Alert',
                'model_id' => $id
            ]);
        }
    }


    public function getMyViolationOrGeneralReports($request)
    {

        $user = Auth::guard('user')->user();
        if ($request->type == 0) {
            $myViolationReports = $this->generalReport->where('leader_id', $user->id)->get();
            return $this->responseMsg('تمت العملية بنجاح', BaseGeneralReportResource::collection($myViolationReports));
        }
        $myViolationReports = $this->violationReport->where('user_id', $user->id)->where('user_type', '1')->get();
        return $this->responseMsg('تمت العملية بنجاح', BaseViolationReportResource::collection($myViolationReports));
    }

    public function addViolationReport($request)
    {
        $validator = $this->apiValidator($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'violation_time' => 'required|date_format:H:i',
            'violation_date' => 'required|date_format:d-m-Y',
            'map_url' => 'required|url',
            'lat' => 'required',
            'long' => 'required',
            'plate_number' => 'required',
            'plate_letter_ar' => 'required|string',
            'plate_letter_en' => 'required|string',
            'plate_image' => 'nullable|image',
            'vehicle_type' => 'required|in:' . implode(',', array_map(fn($e) => $e->value, VehicleType::cases())),
            'violation_image' => 'nullable|image',
            'violation_video' => 'nullable|mimes:mp4,avi,mov',


        ]);

        if ($validator) {
            return $validator;
        }
        $user = Auth::guard('user')->user();
        $data = $request->all();
        $data['user_id'] = $user->id;
        $data['user_type'] = '1';
        $data['reference_number'] = $this->generateReferenceNumber(); // generate violation Reports reference_number

        if ($request->hasFile('plate_image')) {
            $data['plate_image'] = $this->handleFile($request->file('plate_image'), 'Violation_Report');
        }

        if ($request->hasFile('violation_image')) {
            $data['violation_image'] = $this->handleFile($request->file('violation_image'), 'Violation_Report');
        }

        if ($request->hasFile('violation_video')) {
            $data['violation_video'] = $this->handleFile($request->file('violation_video'), 'Violation_Report');
        }


        $obj = $this->violationReport->create($data);
        if ($obj) {

            // send notification
            $playerId[] = $user->fcm_token;
            $title = 'المخالفات';
            $message = 'تم رفع المحالفه الخاصه بك ';
            $data = [
                'notification_type' => 'violationReport',
                'user_type' => 'leader',  // leader  or  other
                'user_id' => $user->id
            ];
            $response = $this->sendNotificationToUser($playerId, $title, $message, null, $data);
            if (!$response) {
                Log::error('فشل إرسال الإشعار عبر OneSignal');
            } else {
                Log::info('تم إرسال الإشعار بنجاح', $response);
            }


            return $this->responseMsg('تمت العملية بنجاح', new  ViolationReportResource($obj));
        }

        return $this->responseMsg('حدث خطا ما', 404);
    }

    public function generateReferenceNumber()
    {
        $lastReference = $this->violationReport->max('reference_number');

        if (!$lastReference) {
            $newReference = date('Ymd') . '000001';
        } else {
            $newReference = intval($lastReference) + 1;
        }

        return $newReference;
    }

    public function getMyViolationGeneralReportDetails($request, $id)
    {
        $obj = $request->type == 0
            ? $this->generalReport->find($id)
            : $this->violationReport->find($id);

        if (!$obj) {
            return $this->responseMsg('لم يتم العثور على التقرير', null, 404);
        }

        $resource = $request->type == 0
            ? new GeneralReportResource($obj)
            : new ViolationReportResource($obj);

        return $this->responseMsg('تمت العملية بنجاح', $resource);
    }


    public function addGeneralReport($request)
    {
        $validator = $this->apiValidator($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'extra' => 'nullable',
            'files' => 'nullable|array',
            'files.*.*' => 'file',


        ]);

        if ($validator) {
            return $validator;
        }
        $user = Auth::guard('user')->user();
        $data = $request->all();
        $data['leader_id'] = $user->id;


        $obj = $this->generalReport->create($data);
        if ($obj) {
            if ($request->has('files')) {
                $this->storeGeneralReportFiles($request->file('files'), $obj->id);
            }
            // send notification
            $playerId[] = $user->fcm_token;
            $title = 'التقارير العامه';
            $message = 'تم رفع التقرير الخاصه بك ';
            $data = [
                'notification_type' => 'generalReport',
                'user_type' => 'leader',  // leader  or  other
                'user_id' => $user->id
            ];
            $response = $this->sendNotificationToUser($playerId, $title, $message, null, $data);
            if (!$response) {
                Log::error('فشل إرسال الإشعار عبر OneSignal');
            } else {
                Log::info('تم إرسال الإشعار بنجاح', $response);
            }
            return $this->responseMsg('تمت العملية بنجاح', new  GeneralReportResource($obj));
        }

        return $this->responseMsg('حدث خطا ما', 404);
    }

    public function storeGeneralReportFiles($files, $id)
    {
        if ($files instanceof \Symfony\Component\HttpFoundation\FileBag) {
            $files = $files->all();
        }

        if (!is_array($files)) {
            $files = [$files];
        }

        foreach ($files as $file) {
            if (!$file instanceof \Illuminate\Http\UploadedFile) {
                continue;
            }

            $filePath = $this->handleFile($file, 'general_report');
            $this->media->create([
                'file' => $filePath,
                'file_type' => $file->getClientOriginalExtension(),
                'file_name' => $file->getClientOriginalName(),
                'model_type' => 'App\Models\GeneralReport',
                'model_id' => $id
            ]);
        }
    }

    public function exportMultipleGeneralOrViolationReports($request)
    {
        $validator = $this->apiValidator($request->all(), [
            'ids' => 'required|array',
            'ids.*' => 'required|numeric',
            'type' => 'required|in:0,1'
        ]);

        if ($validator) {
            return $validator;
        }

        $ids = $request->ids;
        $type = $request->type;

        if ($type == 0) {
            $reports = $this->generalReport->whereIn('id', $ids)->get();
        } else {
            $reports = $this->violationReport->whereIn('id', $ids)->get();
        }

        $fileName = 'reports_' . time() . '.xlsx';
        $filePath = 'exports/' . $fileName;
        if (!file_exists(dirname(storage_path('app/public/' . $filePath)))) {
            mkdir(dirname(storage_path('app/public/' . $filePath)), 0777, true);
        }
        $this->exportReports($reports, $type, $filePath);
        $fullPathUrl = url('storage/' . $filePath);

        return $this->responseMsg('تمت العملية بنجاح', ['file' => $fullPathUrl]);
    }

    public function exportReports($reports, $type, $filePath)
    {
        $spreadsheet = new Spreadsheet();
        $sheetIndex = 0;

        foreach ($reports as $report) {
            if ($sheetIndex > 0) {
                $spreadsheet->createSheet();
            }
            $spreadsheet->setActiveSheetIndex($sheetIndex);
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle('Report ' . $report->id);

            $headers = [
                'ID',
                'Title',
                'Description',
                'Created At'
            ];

            if ($type == 1) {
                $headers = array_merge($headers, [
                    'Reference Number',
                    'Violation Time',
                    'Violation Date',
                    'Map URL',
                    'Latitude',
                    'Longitude',
                    'Plate Number',
                    'Plate Letter (AR)',
                    'Plate Letter (EN)',
                    'Vehicle Type',
                ]);
            }

            $sheet->fromArray([$headers], null, 'A1');

            $data = [
                $report->id,
                $report->title,
                $report->description,
                $report->created_at->format('d-m-Y H:i'),
            ];

            if ($type == 1) {
                $data = array_merge($data, [
                    $report->reference_number,
                    $report->violation_time,
                    $report->violation_date,
                    $report->map_url,
                    $report->lat,
                    $report->long,
                    $report->plate_number,
                    $report->plate_letter_ar,
                    $report->plate_letter_en,
                    $report->vehicle_type,
                ]);
            }

            $sheet->fromArray([$data], null, 'A2');

            $sheetIndex++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save(storage_path('app/public/' . $filePath));

        return $filePath;
    }


    public function getNotices($request)
    {
        $leader_id = auth('user')->user()->id;
        $notices = $this->notice->where('leader_id', $leader_id)
            ->when($request->has('status'), function ($q) use ($request) {
                return $q->where('status', $request->status);
            })
            ->latest()->get();
        return $this->responseMsg('تمت العملية بنجاح', NoticeResource::collection($notices));
    }

    public function storeNotice($request)
    {
        $validator = $this->validateNoticeRequest($request);
        if ($validator) {
            return $validator;
        }

        $checkPriority = isset($request->notice_type_id) ? $this->noticeType->where('id', $request->notice_type_id)->first() : null;



        if ($checkPriority && $checkPriority->priority == 'high') {
            $data = $this->prepareAdminNoticeData($request);
        } else {
            $data = $this->prepareNoticeData($request);
        }

        $obj = $this->notice->create(Arr::except($data, 'files'));

        if ($request->hasFile('files')) {
            $this->saveNoticeFiles($request->file('files'), $obj->id);
        }
        // send firestore Notice
        $this->firestoreService->addNotice($obj);

        // send notification
        if ($checkPriority && $checkPriority->priority == 'high') {
            $data = [
                'title' => 'البلاغات',
                'body' => 'تم رفع بلاغ عالي ألأهميه',
            ];
            $this->sendFcm($data);
        }

        return $obj ? $this->responseMsg('تمت العملية بنجاح', new NoticeResource($obj))

            : $this->responseMsg('حدث خطا ما', 404);
    }


    private function validateNoticeRequest($request)
    {
        return $this->apiValidator($request->all(), [
            'suggestion_title' => 'required_without:notice_type_id',
            'notice_type_id' => 'required_without:suggestion_title|exists:notice_types,id',
            'lat' => 'required',
            'description' => 'required',
            'long' => 'required',
            'notice_time' => 'nullable|date_format:H:i',
            'notice_date' => 'nullable|date_format:d-m-Y',
            'files' => 'nullable|array',
            'files.*.*' => 'file',
        ]);
    }

    private function prepareNoticeData($request)
    {
        $user = Auth::guard('user')->user();
        $data = $request->all();
        $data['user_id'] = $user->id;
        $data['status'] = '0';
        $data['is_up'] = 1;


        return $data;
    }

    private function prepareAdminNoticeData($request)
    {
        $user = auth()->guard('user')->user();
        $data = $request->all();
        $data['leader_id'] = $user->id;
        $data['status'] = '0';
        $data['is_up'] = 1;
        $data['admin_id'] = '1';

        return $data;
    }

    private function saveNoticeFiles($files, $noticeId)
    {
        foreach ($files as $file) {
            $this->media->create([
                'file' => $this->handleFile($file, 'notices'),
                'file_type' => $file->getClientOriginalExtension(),
                'file_name' => $file->getClientOriginalName(),
                'model_type' => 'App\Models\Notice',
                'model_id' => $noticeId
            ]);
        }
    }

    public function getMyNotices($request)
    {
        $notices = $this->notice->where('user_id', Auth::guard('user')->user()->id)
            ->where('status', $request->status)
            ->get();
        return $this->responseMsg('تمت العملية بنجاح', BaseNoticeResource::collection($notices));
    }

    public function getNotice($id)
    {
        return $this->responseMsg('تمت العملية بنجاح', new NoticeResource($this->notice->find($id)));
    } // end of getNotice

    public function actionNotice($request)
    {
        $validator = $this->apiValidator($request->all(), [
            'id' => 'required',
        ]);

        if ($validator) {
            return $validator;
        }

        $notice = $this->notice->find($request->id);
        $playerId = [$notice->user->fcm_token];
        $data = [
            'notification_type' => 'actionNotice',
            'user_type' => 'other',
            'user_id' => $notice->user_id
        ];

        if ($request->status == 2) {
            $this->handleRejectedNotice($notice, $request);
            $title = 'البلاغات';
            $message = 'نأسف لك، لقد تم رفض البلاغ';
        } else {
            $this->handleAcceptedNotice($notice);
            $title = 'البلاغات';
            $message = 'تم تصديق البلاغ';
        }

        $this->sendNotificationAndLog($playerId, $title, $message, $data);

        return $this->responseMsg('تمت العملية بنجاح', new NoticeResource($notice));
    }

    private function handleRejectedNotice($notice, $request)
    {
        $notice->status = '2';
        $notice->refuse_reason = $request->refuse_reason;
        $notice->refuse_notice = $request->refuse_notice;
        $notice->save();
    }

    private function handleAcceptedNotice($notice)
    {
        $notice->is_up = 1;
        $notice->status = '3';
        $notice->save();
        $this->firestoreService->updateNotice($notice);
    }

    private function sendNotificationAndLog($playerId, $title, $message, $data)
    {
        $response = $this->sendNotificationToUser($playerId, $title, $message, null, $data);

        if (!$response) {
            Log::error('فشل إرسال الإشعار عبر OneSignal');
        } else {
            Log::info('تم إرسال الإشعار بنجاح', $response);
        }
    }

    public function getBusReports()
    {
        $leader_id = auth('user')->user()->id;
        $buses = $this->busReport->where('user_id', $leader_id)
            ->latest()->get();
        return $this->responseMsg('تمت العملية بنجاح', BusReportResource::collection($buses));
    }

    public function addBusReport($request)
    {
        $validator = $this->apiValidator($request->all(), [
            'area_id' => 'required',
            'bus_count' => 'required',
            'end_time' => 'required',
        ]);

        if ($validator) {
            return $validator;
        }
        $user = Auth::guard('user')->user();
        $data = $request->all();
        $data['user_id'] = $user->id;
        $data['area_id'] = $request->area_id;
        $data['bus_count'] = $request->bus_count;
        $data['end_time'] = $request->end_time;
        $busReport = $this->busReport->create($data);
        return $this->responseMsg('تمت العملية بنجاح', new BusReportResource($busReport));
    }

    public function getAreas()
    {
        return $this->responseMsg('تمت العملية بنجاح', AreaResource::collection($this->area->get()));
    }

    /**
     * Summary of logout
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::guard('user')->logout();
        JWTAuth::invalidate(Auth::guard('user')->user()->jwt_token);
        return $this->responseMsg('تم تسجيل الخروج', null);
    }


    // suggestion
    public  function getSuggestions($request)
    {
        $leader_id = auth('user')->user()->id;
        $notices = $this->notice->where('user_id', $leader_id)
            ->whereNull('notice_type_id')
            ->when($request->has('status'), function ($q) use ($request) {
                return $q->where('status', $request->status);
            })
            ->latest()->get();
        return $this->responseMsg('تمت العملية بنجاح', NoticeResource::collection($notices));
    }

    public function getSuggestionsTypes()
    {
        $suggestionsTypes = $this->noticeType->where('priority', 'suggest')->get();
        return $this->responseMsg('تمت العملية بنجاح', NoticeTypeResource::collection($suggestionsTypes));
    }

    public function syncFirestoreNotices()
    {
        $notices = $this->notice->get();
        foreach ($notices as $notice) {
            $this->firestoreService->addNotice($notice);
        }
        return $this->responseMsg('تمت مزامنة البلاغات مع Firestore بنجاح', null);
    }
}
