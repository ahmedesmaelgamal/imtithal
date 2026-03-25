<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\DataTables\SeasonDataTable;
use App\Http\Requests\SeasonRequest as ObjRequest;
use App\Services\Admin\SeasonService as ObjService;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    public function __construct(protected ObjService $objService)
    {
    }


    public function indexDatatable(SeasonDataTable $dataTable)
    {

        return $this->objService->indexDatatable($dataTable);
    }

    public function index()
    {
        return $this->objService->index();
    }

    public function create()
    {
        return $this->objService->create();
    }

    public function store(ObjRequest $data)
    {

        $data = $data->validated();
        return $this->objService->store($data);
    }

    public function edit($id)
    {
        return $this->objService->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->objService->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->objService->destory($id);
    }

    public function editStatus(Request $request)
    {
        return $this->objService->editStatus($request);
    }

    public function show()
    {


    }

}