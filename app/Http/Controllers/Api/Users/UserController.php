<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Services\Api\Users\UserService as userService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected userService $service)
    {


    }

    public function checkIn(Request $request)
    {
        return $this->service->checkIn($request);

    }

    public function checkOut(Request $request)
    {
        return $this->service->checkOut($request);

    }

    public function home()
    {
        return $this->service->home();

    }

    public function getAllMyDailyReports(Request $request)
    {
        return $this->service->getAllMyDailyReports($request);

    }

//    public function getDailyReportWithFilter(Request $request)
//    {
//        return $this->service->getDailyReportWithFilter($request);
//
//    }
//
//    public function getMyDailyReportsWithSearch(Request $request)
//    {
//        return $this->service->getMyDailyReportsWithSearch($request);
//
//    }

    public function MyDailyReportsDetails($id)
    {
        return $this->service->MyDailyReportsDetails($id);

    }

    public function storeAnswersInDailyReport(Request $request)
    {
        return $this->service->storeAnswersInDailyReport($request);

    }

    public function getAllMyQuestionnaires()
    {
        return $this->service->getAllMyQuestionnaires();

    }

    public function getMyQuestionnairesWithFilter(Request $request)
    {
        return $this->service->getMyQuestionnairesWithFilter($request);

    }


    public function myQuestionnaireDetails($id)
    {
        return $this->service->myQuestionnaireDetails($id);

    }

    public function StoreOrUpdateAnswerQuestionInQuestionnaire(Request $request)
    {

        return $this->service->StoreOrUpdateAnswerQuestionInQuestionnaire($request);


    }


    public function getMyProfile()
    {
        return $this->service->getMyProfile();

    }

    public function UpdateOrDeleteMyProfileImage(Request $request)
    {
        return $this->service->UpdateOrDeleteMyProfileImage($request);

    }

    public function getMyAttendances(Request $request)
    {
        return $this->service->getMyAttendances($request);

    }


    public function addViolationReport(Request $request)
    {
        return $this->service->addViolationReport($request);

    }

    public function getMyViolationReports( )
    {
        return $this->service->getMyViolationReports();

    }


    public function getMyViolationReportDetails($id)
    {
        return $this->service->getMyViolationReportDetails($id);

    }


    public function exportMultipleViolationReports(Request $request)
    {
        return $this->service->exportMultipleViolationReports($request);
    }


    public function getMyTeamMembers(Request $request)
    {
        return $this->service->getMyTeamMembers($request);

    }

    public function getNoticeTypes(Request $request)
    {
        return $this->service->noticeTypes($request);

    }

    public function storeNotice(Request $request)

    {
        return $this->service->storeNotice($request);

    }

    public function getMyNotices(Request $request)
    {

        return $this->service->getMyNotices($request);



    }

    public function getMyNoticeDetails($id)
    {

        return $this->service->getMyNoticeDetails($id);

    }

    public function getMyLeaders()
    {
        return $this->service->getMyLeaders();

    }


    public function storeFcm(Request $request)
    {
        return $this->service->storeFcm($request);
    }

    public function myAreas(Request $request)
    {
        return $this->service->myAreas($request);
    }

    public function logout()
    {
        return $this->service->logout();
    }

    // suggestions
    public function getSuggestionsTypes()
    {
        return $this->service->getSuggestionsTypes();
    }

    public function getMySuggestions(Request $request)
    {
        return $this->service->getMySuggestions($request);

    }

}
