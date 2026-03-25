<?php

use App\Http\Controllers\Agora\AgoraController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Support\SupportController;
use App\Http\Controllers\OneSignal\OneSignalController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Api\Users\{TaskController, UserController};
use App\Http\Controllers\Api\Leader\{
    DailyReportController,
    LeaderController,
    DailyReportController as LeaderTaskController,
    TeamController
};
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\Route;


// using jwt auth


Route::group(['prefix' => 'v1'], function () {
    Route::get('addAllUserToFcm', [\App\Http\Controllers\Api\FcmController::class, 'addUsersToFirestore']);
    Route::post('addMessage', [\App\Http\Controllers\Api\FcmController::class, 'addMessage']);
    Route::get('updateStatsFirestore', [\App\Http\Controllers\Api\FcmController::class, 'updateStatsFirestore']);


    // one signal
    Route::post('onesignal/send-to-user', [OneSignalController::class, 'sendToUser']);
    Route::post('onesignal/send-to-all', [OneSignalController::class, 'sendToAll']);

    Route::post('login', [AuthController::class, 'login']);


    Route::get('getAllAreas', [\App\Http\Controllers\Api\AreaController::class, 'getAllAreas']);


    //auth
    Route::post('sendOtp', [AuthController::class, 'sendOtp']);
    Route::post('checkOtp', [AuthController::class, 'checkOtp']);
    Route::post('sendOtp', [AuthController::class, 'sendOtp']);
    Route::post('updatePassword', [AuthController::class, 'updatePassword']);

    Route::group(['middleware' => JwtMiddleware::class], function () {

        // agora
        Route::post('agora/getProjects', [AgoraController::class, 'getProjects']);
        Route::post('agora/getToken', [AgoraController::class, 'getToken']);
        Route::get('/agora/getAllChannels', [AgoraController::class, 'getAllChannels']);


        Route::get('authData', [AuthController::class, 'authData']);
        Route::get('getPrivacyPolicy', [AuthController::class, 'getPrivacyPolicy']);
        Route::get('getUserNotificationsOrAlerts', [AuthController::class, 'getUserNotificationsOrAlerts']);
        Route::post('MarkAsRead', [AuthController::class, 'MarkAsRead']);
        Route::get('logout', [AuthController::class, 'logout']);
        Route::post('deleteAccount', [AuthController::class, 'deleteAccount']);
        Route::post('updateProfile', [AuthController::class, 'updateProfile']);
        Route::get('deleteImage', [AuthController::class, 'deleteImage']);
        Route::get('getDeleteReasons', [AuthController::class, 'getDeleteReasons']);

        Route::get('getAxesByAuth', [AuthController::class, 'getAxesByAuth']);
        Route::get('getAreaByAxis/{id}', [AuthController::class, 'getAreaByAxis']);
        Route::get('getTeamByArea/{id}', [AuthController::class, 'getTeamByArea']);
        Route::get('getDailyReportByAxis/{id}', [AuthController::class, 'getDailyReportByAxis']);


        // Support Tickets
        Route::get('getTickets', [SupportController::class, 'getTickets']);
        Route::get('getReplies/{id}', [SupportController::class, 'getReplies']);
        Route::post('addTicket', [SupportController::class, 'addTicket']);
        Route::post('addReply', [SupportController::class, 'addReply']);
        Route::get('updateActive', [SupportController::class, 'updateActive']);


    });


    // Leader App Routes
    Route::group(['prefix' => 'leader'], function () {
        Route::group(['middleware' => JwtMiddleware::class], function () {

            Route::get('home', [LeaderController::class, 'home']);
            Route::get('getDailyReports', [DailyReportController::class, 'getDailyReports']);
            Route::get('dailyReportDetails/{id}', [DailyReportController::class, 'dailyReportDetails']);
            Route::get('dailyReportDetailsOnly/{id}', [DailyReportController::class, 'dailyReportDetailsOnly']);
            Route::post('addDailyReportAssign', [DailyReportController::class, 'addDailyReportAssign']);
            Route::post('actionQuestion', [DailyReportController::class, 'actionQuestion']);
            Route::get('DailyReportRejectReason', [DailyReportController::class, 'DailyReportRejectReason']);

            Route::get('getTeam', [TeamController::class, 'getTeam']);
            Route::get('getTeamDetails/{id}', [TeamController::class, 'getTeamDetails']);
            Route::get('getAttendances/{id}', [TeamController::class, 'getAttendances']);


            Route::get('getAlerts', [LeaderController::class, 'getAlerts']);
            Route::post('addAlert', [LeaderController::class, 'addAlert']);
            Route::get('alertDetails/{id}', [LeaderController::class, 'alertDetails']);

            Route::post('storeNotice', [LeaderController::class, 'storeNotice']);

            Route::get('getNotices', [LeaderController::class, 'getNotices']);
            Route::get('getNotice/{id}', [LeaderController::class, 'getNotice']);
            Route::post('actionNotice', [LeaderController::class, 'actionNotice']);

            Route::post('storeFcm', [LeaderController::class, 'storeFcm']);
            Route::get('getMyViolationOrGeneralReports', [LeaderController::class, 'getMyViolationOrGeneralReports']);
            Route::post('addViolationReport', [LeaderController::class, 'addViolationReport']);
            Route::get('getMyViolationGeneralReportDetails/{id}', [LeaderController::class, 'getMyViolationGeneralReportDetails']);

            Route::post('addGeneralReport', [LeaderController::class, 'addGeneralReport']);
            Route::post('exportMultipleGeneralOrViolationReports', [LeaderController::class, 'exportMultipleGeneralOrViolationReports']);

            // bus report
            Route::get('getAreas', [LeaderController::class, 'getAreas']);
            Route::get('getBusReports', [LeaderController::class, 'getBusReports']);
            Route::post('addBusReport', [LeaderController::class, 'addBusReport']);

            //suggestions
            Route::get('get-suggestions-types', [LeaderController::class, 'getSuggestionsTypes']);
            Route::post('store-suggestions', [LeaderController::class, 'storeNotice']);
            Route::get('get-suggestions', [LeaderController::class, 'getSuggestions']);
            Route::get('get-suggestion-details/{id}', [LeaderController::class, 'getNotice']);
            Route::post('action-suggestion', [LeaderController::class, 'actionNotice']);


        });
    });


    // User App Routes
    Route::group(['prefix' => 'user'], function () {
        Route::group(['middleware' => JwtMiddleware::class], function () {
            Route::get('logout', [UserController::class, 'logout']);
            Route::get('myAreas', [UserController::class, 'myAreas']);
            Route::post('storeFcm', [UserController::class, 'storeFcm']);
            Route::post('checkIn', [UserController::class, 'checkIn']);
            Route::post('checkOut', [UserController::class, 'checkOut']);
            Route::get('UserTasks', [TaskController::class, 'UserTasks']);
            Route::get('home', [UserController::class, 'home']);
            Route::get('getAllMyDailyReports', [UserController::class, 'getAllMyDailyReports']);
            Route::get('getDailyReportWithFilter', [UserController::class, 'getDailyReportWithFilter']);
            Route::get('getMyDailyReportsWithSearch', [UserController::class, 'getMyDailyReportsWithSearch']);
            Route::get('MyDailyReportsDetails/{id}', [UserController::class, 'MyDailyReportsDetails']);

            Route::post('storeAnswersInDailyReport', [UserController::class, 'storeAnswersInDailyReport']);

            Route::get('getAllMyQuestionnaires', [UserController::class, 'getAllMyQuestionnaires']);
            Route::get('getMyQuestionnairesWithFilter', [UserController::class, 'getMyQuestionnairesWithFilter']);
            Route::get('myQuestionnaireDetails/{id}', [UserController::class, 'myQuestionnaireDetails']);
            Route::post('StoreOrUpdateAnswerQuestionInQuestionnaire', [UserController::class, 'StoreOrUpdateAnswerQuestionInQuestionnaire']);
            Route::get('getMyProfile', [UserController::class, 'getMyProfile']);
            Route::post('UpdateOrDeleteMyProfileImage', [UserController::class, 'UpdateOrDeleteMyProfileImage']);
            Route::get('getMyAttendances', [UserController::class, 'getMyAttendances']);


            // in new version

            Route::post('addViolationReport', [UserController::class, 'addViolationReport']);
            Route::get('getMyViolationReports', [UserController::class, 'getMyViolationReports']);
            Route::get('getMyViolationReportDetails/{id}', [UserController::class, 'getMyViolationReportDetails']);
            Route::post('exportMultipleViolationReports', [UserController::class, 'exportMultipleViolationReports']);
            Route::get('getMyTeamMembers', [UserController::class, 'getMyTeamMembers']);
            Route::get('getNoticeTypes', [UserController::class, 'getNoticeTypes']);
            Route::post('storeNotice', [UserController::class, 'storeNotice']);
            Route::get('getMyNotices', [UserController::class, 'getMyNotices']);
            Route::get('getMyNoticeDetails/{id}', [UserController::class, 'getMyNoticeDetails']);
            Route::get('getMyLeaders', [UserController::class, 'getMyLeaders']);

            //suggestions
            //         انا عارف انها شبه الnotice في كل حاجه بس الفلاتر الي عايز كده معلش //
            Route::get('get-suggestions-types', [UserController::class, 'getSuggestionsTypes']);
            Route::post('store-suggestions', [UserController::class, 'storeNotice']);
            Route::get('get-my-suggestions', [UserController::class, 'getMySuggestions']);
            Route::get('get-suggestion-details/{id}', [UserController::class, 'getMyNoticeDetails']);
        });
    });


});


Route::get('/clear', function () {

    Artisan::call('cache:clear');
    Artisan::call('key:generate');
    Artisan::call('config:clear');
    Artisan::call('optimize:clear');
    return response()->json(['status' => 'success', 'code' => 1000000000]);
});

Route::get('syncFirestoreNotices',[LeaderController::class, 'syncFirestoreNotices']);

require 'map.php';
