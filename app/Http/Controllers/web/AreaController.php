<?php

namespace App\Http\Controllers\web;

use App\Enum\AreaTypeEnum;
use App\Http\Controllers\Controller;
use App\Services\Web\AreaService as ObjService;
use App\Services\Web\AreaTeamService;
use App\Services\Web\UserService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AreaController extends Controller
{
    public function __construct(

        protected ObjService      $objService,
        protected AreaTeamService $areaTeamService,
        protected UserService     $userService
    )
    {
    }

    public function indexDatatable()
    {
        return $this->objService->indexDatatable();
    }

    public function getMainAreas()
    {
        return $this->objService->getMainAreas();
    }

    public function index(Request $request)
    {
        return $this->objService->index($request);
    }

    public function store(Request $request)
    {
        return $this->objService->store($request);
    }

    public function edit($id)
    {
        return $this->objService->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->objService->update($request, $id);
    }

    public function editStatus(Request $request, $id)
    {
        return $this->objService->editStatus($request, $id);
    }

    public function delete($id)
    {
        return $this->objService->delete($id);
    }

    public function areaReportPrint(Request $request)
    {
        return $this->objService->areaReportPrint($request);
    }
}

?>
