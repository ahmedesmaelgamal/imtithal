<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\DataTables\AreaDataTable;
use App\Http\DataTables\AreaDetailsDataTable;
use App\Services\Web\AreaLocationService as ObjService;
use App\Services\Web\AreaTeamService;
use App\Services\Web\UserService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AreaLocationController extends Controller
{
    public function __construct(

        protected ObjService      $objService,
        protected AreaTeamService $areaTeamService,
        protected UserService     $userService
    ){}


    // الصح اننا كنا ندخل علي تفاصيل الموقع مش هنا


    public function areaTeamDatatable(Request $request, AreaDetailsDataTable $dataTable)
    {
       return $this->objService->indexDatatable($request,$dataTable);
    }


    public function index(Request $request)
    {
        return $this->objService->index($request);
    }

    public function storeNewMember(Request $request)
    {
        return $this->objService->storeNewMember($request);
    }

    public function deleteMember($id)
    {
        return $this->objService->deleteMember($id);
    }

    public function areaReportPrint(Request $request)
    {
        return $this->objService->areaReportPrint($request);
    }

}
