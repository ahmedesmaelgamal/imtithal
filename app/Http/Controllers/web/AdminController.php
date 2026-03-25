<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\DataTables\AdminDataTable;
use App\Models\Admin;
use App\Services\Web\AdminService as ObjService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(

        protected ObjService $objService,
        protected Admin $userObj

    )
    {
    }

    public function indexDatatable(AdminDataTable $dataTable)
    {
        return $dataTable->render('web.admin.index');
    }
    public function store(Request $request)
    {
        return $this->objService->store($request);
    }

    public function show()
    {

    }
    public function edit($id)
    {
        return $this->objService->edit($id);
    }
    public function editStatus(Request $request,$id)
    {
        return $this->objService->editStatus($request,$id);
    }



    public function update(Request $request,$id)
    {
        return $this->objService->update($request,$id);

    }

    public function delete()
    {

    }
    public function create()
    {

    }



    public function index()
    {
        return $this->objService->index();
    }
}
