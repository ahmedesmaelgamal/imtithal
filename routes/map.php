<?php

use App\Http\Controllers\Api\MapController;
use App\Http\Middleware\MapJwtMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1/map'], function () {
    Route::post('login', [MapController::class, 'login']);

});

Route::group(['prefix' => 'v1/map','middleware' => MapJwtMiddleware::class], function () {
//Route::group(['prefix' => 'v1/map'], function () {
        Route::get('getAreas/{axis_id}', [MapController::class, 'getAreas']);
        Route::get('getAreasWithoutAxis', [MapController::class, 'getAreasWithoutAxis']);
        Route::get('getAxes', [MapController::class, 'getAxes']);

        Route::get('getAxisDetails/{id}', [MapController::class, 'getAxisDetails']);
        Route::get('getAreaDetails/{id}', [MapController::class, 'getAreaDetails']);
        Route::get('getLeaderDetails/{id}', [MapController::class, 'getLeaderDetails']);
        Route::get('getUserDetails/{id}', [MapController::class, 'getUserDetails']);
        Route::get('getNoticeDetails/{id}', [MapController::class, 'getNoticeDetails']);
        Route::get('getAlerts', [MapController::class, 'getAlerts']);
        Route::get('getNotice', [MapController::class, 'getNotice']);
        Route::get('getRoles', [MapController::class, 'getRoles']);
        Route::get('getBusesTimes/{area_id}', [MapController::class, 'getBusesTimes']);
        Route::get('getDailyReportDetails/{id}', [MapController::class, 'getDailyReportDetails']);

        // new route

        Route::get('getFilterObjects', [MapController::class, 'getFilterObjects']);
        Route::get('getDetailsForParent0', [MapController::class, 'getDetailsForParent0']);
        Route::get('getDetailsForParent1', [MapController::class, 'getDetailsForParent1']);
        Route::get('getDetailsForParent2', [MapController::class, 'getDetailsForParent2']);
        Route::get('getDetailsForParent3', [MapController::class, 'getDetailsForParent3']);
        Route::get('getDetailsForParent4', [MapController::class, 'getDetailsForParent4']);
        Route::get('getDetailsForParent5', [MapController::class, 'getDetailsForParent5']);
        Route::get('getDetailsForParent6', [MapController::class, 'getDetailsForParent6']);
        Route::get('getDetailsForParent7', [MapController::class, 'getDetailsForParent7']);


        //store fcm token
        Route::post('storeFcm', [MapController::class, 'storeFcm']);


        //logout
    Route::post('logout', [MapController::class, 'logout']);


});
