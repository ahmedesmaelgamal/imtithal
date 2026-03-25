<?php

namespace App\Http\Controllers\Api\Leader;

use App\Http\Controllers\Controller;
use App\Services\Api\Leader\DailyReportService;
use Illuminate\Http\Request;

class DailyReportController extends Controller
{
    public function __construct(protected DailyReportService $dailyReportService)
    {
    }

    public function getDailyReports(Request $request)
    {
//        try {
            return $this->dailyReportService->getDailyReports($request);
//        } catch (\Exception $e) {
//            return self::ExeptionResponse();
//        }
    }

    public function dailyReportDetails(Request $request, $id)
    {
//        try {
            return $this->dailyReportService->dailyReportDetails($request,$id);
//        } catch (\Exception $e) {
//            return self::ExeptionResponse();
//        }
    } public function dailyReportDetailsOnly( $id)
    {
//        try {
            return $this->dailyReportService->dailyReportDetailsOnly($id);
//        } catch (\Exception $e) {
//            return self::ExeptionResponse();
//        }
    }

    public function actionQuestion(Request $request)
    {
//        try {
            return $this->dailyReportService->actionQuestion($request);
//        } catch (\Exception $e) {
//            return self::ExeptionResponse();
//        }
    }


    public function addDailyReportAssign(Request $request)
    {
        try {
            return $this->dailyReportService->addDailyReportAssign($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function DailyReportRejectReason()
    {
        try {
            return $this->dailyReportService->DailyReportRejectReason();
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }


}
