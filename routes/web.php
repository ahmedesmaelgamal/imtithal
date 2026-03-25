<?php

use App\Http\Controllers\Admin\SeasonController;
use App\Http\Controllers\web\ActivityLogController;
use App\Http\Controllers\web\AdminController;
use App\Http\Controllers\web\AlertController;
use App\Http\Controllers\web\AreaController;
use App\Http\Controllers\web\AreaLocationController;
use App\Http\Controllers\web\AttendanceController;
use App\Http\Controllers\web\AuthController;
use App\Http\Controllers\web\AxisManagementController;
use App\Http\Controllers\web\BusReportController;
use App\Http\Controllers\web\DailyReportController;
use App\Http\Controllers\web\ExcelImportExportController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\NoticeController;
use App\Http\Controllers\web\SettingsController;
use App\Http\Controllers\web\SuggestionController;
use App\Http\Controllers\web\SupportController;
use App\Http\Controllers\web\TripController;
use App\Http\Controllers\web\UserController;
use App\Http\Controllers\web\ReportController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\SurveyManagementController;

Route::get('date', function () {
    return response()->json(Carbon\Carbon::now()->format('Y-m-d h:i:s'));
});
Route::get('checkQues`tions', [HomeController::class, 'checkQuestions'])->name('checkQuestions');
Route::get('addAnswerToQuestion/{id}', [HomeController::class, 'addAnswerToQuestion'])->name('checkQuestions');

Route::get('/check', function () {
    return view('task-details');
});
Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('login', [AuthController::class, 'index'])->name('admin.login');
    Route::POST('login', [AuthController::class, 'login'])->name('admin.login');
    Route::POST('sendOtp', [AuthController::class, 'sendOtp'])->name('admin.sendOtp');
    Route::get('forget_password', [AuthController::class, 'forgetPassword'])->name('admin.forget_password');
    Route::POST('new_password', [AuthController::class, 'newPassword'])->name('admin.new_password');
    Route::POST('updatePassword', [AuthController::class, 'updatePassword'])->name('admin.update_password');
    Route::POST('checkOtp', [AuthController::class, 'checkOtp'])->name('admin.checkOtp');
    // dashboard elements
    Route::group(['middleware' => AdminMiddleware::class], function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('adminHome');
        Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
        Route::get('trips/index-datatable', [TripController::class, 'indexDatatable'])->name('trips.datatable');
        Route::put('/trips/{id}/edit-status', [TripController::class, 'editStatus'])->name('trips.updateStatus');
        Route::resource('trips', TripController::class);
        
        Route::get('/axes-management', [AxisManagementController::class, 'index'])->name('axesManagement');
        Route::get('/axes-edit/{id}', [AxisManagementController::class, 'edit'])->name('axesEdit');
        Route::post('/axes-update', [AxisManagementController::class, 'update'])->name('axesUpdate');
        Route::get('/deleteAxis/{id}', [AxisManagementController::class, 'delete'])->name('axisDelete');
        Route::get('/area_location/{id}', [AreaLocationController::class, 'index'])->name('areaLocation');

        Route::get('/axes-management/index-datatable', [AxisManagementController::class, 'indexDatatable'])->name('axesManagement.datatable');
        Route::get('axisReportPrint', [AxisManagementController::class, 'axisReportPrint'])->name('axisReportPrint');
        Route::get('areaReportPrint', [AreaController::class, 'areaReportPrint'])->name('areaReportPrint');
        // _------------------------------------------------------------------------------------------------------------------------------------------
        Route::get('users/index-datatable', [UserController::class, 'indexDatatable'])->name('users.datatable');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/admin/users/{id}/edit-status', [UserController::class, 'editStatus'])->name('users.updateStatus');
        Route::resource('users', UserController::class)->except('edit');
        Route::get('/users/{id}/reports', [UserController::class, 'userReports'])->name('userReports');
        Route::get('printDailyReport', [UserController::class, 'printDailyReport'])->name('printDailyReport');
        // ------------------------------------------------------------------------------------------------------------------------------------------

        // _------------------------------------------------------------------------------------------------------------------------------------------
        Route::get('admins/index-datatable', [AdminController::class, 'indexDatatable'])->name('admins.datatable');
        Route::get('/admins/{id}/edit', [AdminController::class, 'edit'])->name('admins.edit');
        Route::put('/admins/users/{id}/edit-status', [AdminController::class, 'editStatus'])->name('admins.updateStatus');
        Route::resource('admins', AdminController::class)->except('edit');
        // ------------------------------------------------------------------------------------------------------------------------------------------

        Route::get('supports/index-datatable', [SupportController::class, 'indexDatatable'])->name('supports.datatable');
        Route::resource('supports', SupportController::class)->except(['edit', 'update']);
        Route::get('/supports/{id}', [SupportController::class, 'show'])->name('supports.show');
        Route::post('/supports/addReply', [SupportController::class, 'addReply'])->name('supports.addReply');

        Route::get('buses/index-datatable', [BusReportController::class, 'indexDatatable'])->name('buses.datatable');
        Route::resource('buses', BusReportController::class)->except(['edit', 'update']);


        Route::get('/area/index-datatable', [AreaController::class, 'indexDatatable'])->name('area.datatable');
        Route::get('/area/main', [AreaController::class, 'getMainAreas'])->name('area.main');
        Route::get('/area', [AreaController::class, 'index'])->name('area');
        Route::post('/area', [AreaController::class, 'store'])->name('area.store');
        Route::get('/area/edit/{id}', [AreaController::class, 'edit'])->name('area.edit');
        Route::put('/area/update/{id}', [AreaController::class, 'update'])->name('area.update');
        Route::put('/area/{id}/edit-status', [AreaController::class, 'editStatus'])->name('area.editStatus');
        Route::delete('/area/delete/{id}', [AreaController::class, 'delete'])->name('area.delete');
        Route::get('/area/surveys/{id}', [AreaController::class, 'getAreaSurveys'])->name('area.surveys');
        Route::post('/area/link-surveys', [AreaController::class, 'linkSurveys'])->name('area.linkSurveys');

        Route::get('/area-team/datatable', [AreaLocationController::class, 'areaTeamDatatable'])->name('areaTeam.datatable');
        Route::post('/area-team/store/member', [AreaLocationController::class, 'storeNewMember'])->name('areaTeam.storeNewMember');
        Route::post('/area-team/delete/member/{id}', [AreaLocationController::class, 'deleteMember'])->name('areaTeamMember.delete');

        Route::get('/area_location/{id}', [AreaLocationController::class, 'index'])->name('areaLocation');
        Route::get('/axes-management/create', [AxisManagementController::class, 'create'])->name('axesManagement.create');
        Route::post('/axes-management', [AxisManagementController::class, 'store'])->name('axesManagement.store');
        Route::GET('/deleteAxisQuestion/{id}', [AxisManagementController::class, 'deleteAxisQuestion'])->name('deleteAxisQuestion');



        Route::get('survey/index-datatable', [SurveyManagementController::class, 'indexDatatable'])->name('survey.datatable');
        Route::get('survey/create', [SurveyManagementController::class, 'create'])->name('survey.create');
        Route::get('survey/index', [SurveyManagementController::class, 'index'])->name('survey.index');
        Route::post('survey', [SurveyManagementController::class, 'store'])->name('survey.store');
        Route::get('survey/{id}', [SurveyManagementController::class, 'show'])->name('survey.show');
        Route::get('survey/{id}/edit', [SurveyManagementController::class, 'edit'])->name('survey.edit');
        Route::put('survey/{id}', [SurveyManagementController::class, 'update'])->name('survey.update');
        Route::delete('survey/{id}', [SurveyManagementController::class, 'delete'])->name('survey.delete');
        // Route::get('survey/report/print/{id}', [SurveyManagementController::class, 'surveyReportPrint'])->name('surveyReportPrint');
        Route::get('surveyReportPrint', [SurveyManagementController::class, 'surveyReportPrint'])->name('surveyReportPrint');
        Route::post('survey/import-reports', [SurveyManagementController::class, 'importReports'])->name('survey.importReports');
        Route::get('/deleteSurvey/{id}', [SurveyManagementController::class, 'delete'])->name('surveyDelete');
        Route::get('/survey-edit/{id}', [SurveyManagementController::class, 'edit'])->name('surveyEdit');
        Route::post('/survey-update', [SurveyManagementController::class, 'update'])->name('surveyUpdate');
        Route::get('/deleteSurvey/{id}', [SurveyManagementController::class, 'delete'])->name('surveyDelete');



        //        Route::get('/report-details', [ReportController::class, 'index'])->name('report.index');

        Route::post('/axes-management/import-questions', [AxisManagementController::class, 'importQuestions'])->name('axesManagement.importQuestions');
        Route::post('/axes-management/import-reports', [AxisManagementController::class, 'importReports'])->name('axesManagement.importReports');
        Route::post('sendAlert', [AlertController::class, 'sendAlert'])->name('sendAlert');
        Route::get('/alert/{alert_id}', [AlertController::class, 'alertShow'])->name('alert.show');
        Route::get('/notification/{notification_id}', [AlertController::class, 'notificationShow'])->name('notification.show');
        Route::get('/alert-management/index-datatable', [AlertController::class, 'alertIndexDatatable'])->name('alertManagement.datatable');
        Route::get('/notification-management/index-datatable', [AlertController::class, 'notificationIndexDatatable'])->name('notificationManagement.datatable');
        Route::resource('/alert', AlertController::class);


        //        Route::get('/axes-management/index-datatable', [AxisManagementController::class, 'indexDatatable'])->name('axesManagement.datatable');
        Route::get('/area', [AreaController::class, 'index'])->name('area');
        Route::post('area', [AreaController::class, 'store'])->name('area.store');
        Route::get('/area/index-datatable', [AreaController::class, 'indexDatatable'])->name('area.datatable');
        //        Route::get('/activities', [ActivityController::class, 'index'])->name('activity.index');


        // daily report routes
        Route::get('/daily_report/index-datatable', [DailyReportController::class, 'indexDatatable'])->name('daily_report.datatable');
        Route::get('/daily_report_assign_user/index-datatable', [DailyReportController::class, 'index2Datatable'])->name('daily_report_assign_user.datatable');

        Route::get('/daily_report/{daily_report_id}', [DailyReportController::class, 'show'])->name('daily_report.show');
        Route::get('/daily_report_assign_user/{daily_report_assign_user_id}', [DailyReportController::class, 'showDailyReportAssignUser'])->name('daily_report_assign_user.show');
        Route::delete('/daily_report_assign_user/{id}', [DailyReportController::class, 'destroyDailyReportAssignUser'])->name('daily_report_assign_user.destroy_daily_report_assign_user');

        Route::get('/daily_report', [DailyReportController::class, 'index'])->name('daily_report.index');
        Route::post('/daily_report/store', [DailyReportController::class, 'store'])->name('daily_report.store');
        Route::delete('/daily_report/{id}', [DailyReportController::class, 'destroy'])->name('daily_report.destroy');
        Route::get('/daily_report/{id}/edit', [DailyReportController::class, 'edit'])->name('daily_report.edit');
        Route::post('/daily_report/{id}', [DailyReportController::class, 'update'])->name('daily_report.update');
        // daily report routes

        //reports (violation/general)
        Route::get('/general_report/index-datatable', [ReportController::class, 'generalReportIndexDatatable'])->name('general_report.datatable');
        Route::get('/violation_report/index-datatable', [ReportController::class, 'violationReportIndexDatatable'])->name('violation_report.datatable');
        Route::get('/general_report/{general_report_id}', [ReportController::class, 'generalReportShow'])->name('general_report.show');
        Route::get('/violation_report/{violation_report_id}', [ReportController::class, 'violationReportShow'])->name('violation_report.show');
        Route::get('/report', [ReportController::class, 'index'])->name('report.index');
        Route::put('/report/{report_id}/update_status', [ReportController::class, 'updateReportStatus'])->name('report_status.update');


        //notice البلاغات
        Route::get('/notice/index-datatable', [NoticeController::class, 'noticeIndexDatatable'])->name('notice.datatable');
        Route::get('/notice_type/index-datatable', [NoticeController::class, 'noticeTypeIndexDatatable'])->name('notice_type.datatable');
        Route::delete('/notice_type/{id}', [NoticeController::class, 'deleteNoticeType'])->name('notice_type.delete');
        Route::delete('/notice/{id}', [NoticeController::class, 'deleteNotice'])->name('notice.destroy');
        Route::put('/notice_type/{id}', [NoticeController::class, 'updateNoticeType'])->name('notice_type.update');

        Route::post('/notice_type', [NoticeController::class, 'storeNoticeType'])->name('notice_type.store');
        Route::resource('/notice', NoticeController::class)->except('destroy');
        Route::put('/notice/{notice_id}/update_status', [NoticeController::class, 'updateNoticeStatus'])->name('notice_status.update');


        //        الاقتراحات هي هي البلاغات بس هنفصل النوع الي اسمه اقتراح لوحده بس كده

        Route::get('/suggestion/index-datatable', [SuggestionController::class, 'suggestionIndexDatatable'])->name('suggestion.datatable');
        Route::get('/suggestion_type/index-datatable', [SuggestionController::class, 'suggestionTypeIndexDatatable'])->name('suggestion_type.datatable');
        Route::delete('/suggestion_type/{id}', [SuggestionController::class, 'deleteSuggestionType'])->name('suggestion_type.delete');
        Route::delete('/suggestion/{id}', [SuggestionController::class, 'deleteSuggestion'])->name('suggestion.destroy');
        Route::put('/suggestion_type/{id}', [SuggestionController::class, 'updateSuggestionType'])->name('suggestion_type.update');

        Route::post('/suggestion_type', [SuggestionController::class, 'storeSuggestionType'])->name('suggestion_type.store');
        Route::resource('/suggestion', SuggestionController::class)->except('destroy');
        Route::put('/suggestion/{suggestion_id}/update_status', [SuggestionController::class, 'updateSuggestionStatus'])->name('suggestion_status.update');


        Route::get('/role/index-datatable', [\App\Http\Controllers\web\RoleController::class, 'roleIndexDatatable'])->name('role.datatable');
        Route::resource('/role', \App\Http\Controllers\web\RoleController::class);

        //activity log
        Route::get('activity_logs/index-datatable', [ActivityLogController::class, 'indexDatatable'])->name('activity_logs.datatable');
        Route::get('activity_logs', [ActivityLogController::class, 'index'])->name('activity_logs.index');
        Route::delete('activity_logs/{id}', [ActivityLogController::class, 'destroy'])->name('activity_logs.destroy');

        //settings
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');

        //excel_import_export
        Route::get('/excel_import_export', [ExcelImportExportController::class, 'index'])->name('excel_import_export.index');
        Route::post('/excel_import_export/import', [ExcelImportExportController::class, 'exelImportExport'])->name('excel_import_export.store');

        Route::get('/example_import', [ExcelImportExportController::class, 'example_import'])->name('example_import');


        //attendance
        Route::get('/attendance/index-datatable', [AttendanceController::class, 'indexDatatable'])->name('attendance.datatable');
        Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
        Route::get('/attendance/show/{id}', [AttendanceController::class, 'show'])->name('attendance.show');


        //seasons
        Route::get('/season/index-datatable', [SeasonController::class, 'indexDatatable'])->name('season.datatable');

        Route::resource('/seasons', SeasonController::class);
        Route::post('/seasons/edit-status', [SeasonController::class, 'editStatus'])->name('seasons.updateStatus');





    });

});


