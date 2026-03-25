<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\DataTables\UserDataTable;
use App\Http\Requests\UserRequest as ObjRequest;
use App\Models\User;
use App\Services\Web\UserService as ObjService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function __construct(

        protected ObjService $objService,
        protected User $userObj

    )
    {
    }

    public function indexDatatable(UserDataTable $dataTable)
    {


        return $dataTable->render('web.user.index') ;
    }
    public function store(Request $request)
    {
        return $this->objService->store($request);
    }

    public function show($id)
    {
        return $this->objService->show($id);
    }
    public function edit($id)
    {
        return $this->objService->edit($id);
    }

    public function userReports($id)
    {
        return $this->objService->userReports($id);
    }
    public function editStatus(Request $request,$id)
    {
        return $this->objService->editStatus($request,$id);
    }

    public function printDailyReport(Request $request)
    {
        return $this->objService->printDailyReport($request->daily_report_id);
    }


    public function update(Request $request,$id)
    {
        return $this->objService->update($request,$id);

    }

    public function destroy($id)
    {
        return $this->objService->destroy($id);

    }
    public function create()
    {

    }

    //    public function index()
    //    {
    //        return $this->objService->index();
    //    }

    //    public function index(Request $request)
    //    {
    //        $axisId = $request->query('axis_id'); // Get the passed axis_id
    //        return view('web.area.index', compact('axisId'));
    //    }


    public function index()
    {
        return $this->objService->index();
    }
}
