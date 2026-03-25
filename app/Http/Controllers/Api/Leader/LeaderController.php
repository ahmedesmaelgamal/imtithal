<?php

namespace App\Http\Controllers\Api\Leader;

use App\Http\Controllers\Controller;
use App\Services\Api\Leader\LeaderService;
use Illuminate\Http\Request;

class LeaderController extends Controller
{

    public function __construct(protected LeaderService $leaderService)
    {
    }

    public function home()
    {
        try {
            return $this->leaderService->home();
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function storeFcm(Request $request)
    {
        try {
            return $this->leaderService->storeFcm($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }


    public function getAlerts()
    {
        try {
            return $this->leaderService->getAlerts();
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function addAlert(Request $request)
    {
        try {
            return $this->leaderService->addAlert($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function alertDetails($id)
    {
        try {
            return $this->leaderService->alertDetails($id);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function getNotices(Request $request)
    {
        try {
            return $this->leaderService->getNotices($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function storeNotice(Request $request)
    {
//        try {
            return $this->leaderService->storeNotice($request);
//        } catch (\Exception $e) {
//            return self::ExeptionResponse();
//        }
    }

    public function getNotice($id)
    {
        try {
            return $this->leaderService->getNotice($id);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }



    public function actionNotice(Request $request)
    {
        try {
            return $this->leaderService->actionNotice($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }


    public function logout()
    {
        try {
            return $this->leaderService->logout();
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function getMyViolationOrGeneralReports(Request $request)
    {
        try {
            return $this->leaderService->getMyViolationOrGeneralReports($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }

    }

    public function addViolationReport(Request $request)
    {
        try {
            return $this->leaderService->addViolationReport($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function getMyViolationGeneralReportDetails(Request $request, $id)
    {
        try {

            return $this->leaderService->getMyViolationGeneralReportDetails($request, $id);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }

    }

    public function addGeneralReport(Request $request)
    {
        try {
            return $this->leaderService->addGeneralReport($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function exportMultipleGeneralOrViolationReports(Request $request)
    {
        try {
            return $this->leaderService->exportMultipleGeneralOrViolationReports($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function getBusReports()
    {
        try {
            return $this->leaderService->getBusReports();
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function addBusReport(Request $request)
    {
        try {
            return $this->leaderService->addBusReport($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function getAreas()
    {
        try {
            return $this->leaderService->getAreas();
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    //suggestion
    public function getSuggestions(Request $request)
    {
        try {
            return $this->leaderService->getSuggestions($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function getSuggestionsTypes()
    {
        try {
            return $this->leaderService->getSuggestionsTypes();
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function syncFirestoreNotices()
    {
        try {
            return $this->leaderService->syncFirestoreNotices();
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

}


