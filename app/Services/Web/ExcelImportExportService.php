<?php

namespace App\Services\Web;

use App\Exports\DynamicModelExport;
use App\Imports\DynamicModelImport;
use App\Models\Admin;
use App\Models\Alert;
use App\Models\Area;
use App\Models\Axis;
use App\Models\Notice;
use App\Models\NoticeType;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User as ObjModel;

use App\Services\BaseService;
use App\Services\FirestoreService;
use Spatie\Permission\Models\Role;

class ExcelImportExportService extends BaseService
{

    public function __construct(
        protected ObjModel        $objModel,
        protected Role             $role,
        protected FirestoreService $firestoreService,
        protected Admin $admin,
        protected Alert $alert,
        protected Area $area,
        protected Axis $axis,
        protected Notice $notice,
        protected NoticeType $noticeType
    ) {
        parent::__construct($objModel);
    }

    public function index()
    {


        return view('web.excel_import_export.index', [
            'modelMapTranslated' => $this->modelMapTranslated
        ]);
    }


    protected $modelMapTranslated = [
        'admins' => 'مدراء النظام',
        'alerts' => 'التنبيهات',
//        'alert_leaders' => 'تنبيهات المشرفين',
//        'alert_users' => 'تنبيهات المستخدمين',
        'area_locations' => 'مواقع المناطق',
        'area_teams' => 'الفريق الميداني',
        'areas' => 'المناطق',
        'axes' => 'المحاور',
        'axis_questions' => 'اسئلة المحور',
        'daily_reports' => 'التقارير اليومية',
        'notice_types' => 'انواع البلاغات',
        "notices" => "البلاغات",
        'users' => 'المستخدمين',
        'trips' => 'الرحلات',
        'bus_reports' => 'تقارير انتهاء الذروة',
        'violation_reports' => 'تقارير المخالفات',
        'general_reports' => ' التقارير العامة للمشرفين ' ,
        'attendances' => 'تقارير الحضور والانصراف',
    ];
    protected $modelMap = [
        'admins' => \App\Models\Admin::class,
        'alerts' => \App\Models\Alert::class,
        'alert_leaders' => \App\Models\AlertLeader::class,
        'alert_users' => \App\Models\AlertUser::class,
        'area_locations' => \App\Models\AreaLocation::class,
        'area_teams' => \App\Models\AreaTeam::class,
        'areas' => \App\Models\Area::class,
        'axes' => \App\Models\Axis::class,
        'axis_questions' => \App\Models\AxisQuestion::class,
        'daily_reports' => \App\Models\DailyReport::class,
        'notice_types' => \App\Models\NoticeType::class,
        'users' => \App\Models\User::class,
        'trips' => \App\Models\Trip::class,
        'notices' => \App\Models\Notice::class,
        'bus_reports' => \App\Models\BusReport::class,
        'violation_reports' => \App\Models\ViolationReport::class,
        'general_reports' => \App\Models\GeneralReport::class,
        'attendances' => \App\Models\Attendance::class,
    ];


    protected $uniqueIdentifierMap = [

        'admins' => 'email',
        'alerts' => 'title',
        'alert_leaders' => 'id',
        'alert_users' => 'id',
        'area_locations' => 'area_id',
        'area_teams' => 'id',
        'areas' => 'name',
        'axes' => 'name',
        'axis_questions' => 'id',
        'daily_reports' => 'id',
        'notice_types' => 'id',
        'users' => 'national_id',
        'trips' => 'trip_number',
    ];


    public function exelImportExport($data)
    {
        $validator = \Validator::make($data->all(), [
            'type' => 'required|string|in:import,export',
            'table' => 'required|string|in:' . implode(',', array_keys($this->modelMap)),
            'file' => 'required_if:type,import|mimes:xlsx,csv,xls',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'msg' => $validator->errors()->first(),
                'data' => null,
                'status' => 422
            ]);
        }

        return $data->type == 'import' ? $this->import($data) : $this->export($data);
    }

    public function import($data)
    {
        $data->validate([
            'file' => 'required|mimes:xlsx,csv,xls',
            'table' => 'required|string|in:' . implode(',', array_keys($this->modelMap)),
        ]);

        $modelClass = $this->modelMap[$data->input('table')] ?? null;
        $uniqueIdentifier = $this->uniqueIdentifierMap[$data->input('table')] ?? null;


        if (!$modelClass) {
            return response()->json([
                'msg' => 'خطاء في اسم الجدول',
                'data' => null,
                'status' => 422
            ]);
        }

        try {
            Excel::import(new DynamicModelImport($modelClass, $uniqueIdentifier), $data->file('file'));
            return response()->json([
                'msg' => 'تم الاستيراد بنجاح',
                'data' => null,
                'status' => 200
            ]);
        } catch (\Exception $e) {
            \Log::error('Import failed: ' . $e->getMessage());
            return response()->json([
                'msg' => $e->getMessage(),
                'data' => null,
                'status' => 500
            ]);
        }
    }


    public function example_import()
    {
        $filePath = public_path('example/example_user_import.xlsx');

        if (file_exists($filePath)) {
            return Response::download($filePath, 'example_user_import.xlsx');
        }

        return back()->with('error', 'الملف غير موجود!');
    }

    public function export($request)
    {
        $table = $request->input('table');

        $modelClass = $this->modelMap[$table] ?? null;

        if (!$modelClass) {
            return response()->json([
                'msg' => 'Invalid table',
                'status' => 400
            ]);
        }

        try {
            // تحديد اسم الملف
            $fileName = $table . '_export_' . now()->format('Y-m-d_H-i-s') . '.xlsx';

            // تحديد المسار الصحيح داخل `storage/app/public/exports/`
            $filePath = 'exports/' . $fileName; // احفظ داخل exports فقط بدون public/private

            // التأكد من أن المجلد موجود
            if (!file_exists(storage_path('app/public/exports'))) {
                mkdir(storage_path('app/public/exports'), 0755, true);
            }

            // تصدير البيانات إلى `storage/app/public/exports/`
            Excel::store(new DynamicModelExport($modelClass,$this->admin,$this->alert,$this->objModel,$this->area,$this->axis,$this->notice,$this->noticeType), $filePath, 'public');

            return response()->json([
                'msg' => 'تم تصدير البيانات بنجاح',
                'file_url' => asset('storage/' . $filePath), // استخدم الرابط الصحيح
                'status' => 200
            ]);
        } catch (\Exception $e) {
            \Log::error('Export failed: ' . $e->getMessage());
            return response()->json([
                'msg' => 'Export failed: ' . $e->getMessage(),
                'status' => 500
            ]);
        }
    }
}
