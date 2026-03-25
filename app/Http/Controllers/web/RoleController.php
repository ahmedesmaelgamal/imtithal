<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\DataTables\RoleDataTable;
use App\Services\Web\RoleService as ObjService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(protected ObjService $objService)
    {
    }

    public function index()
    {
        return $this->objService->index();
    }

    public function roleIndexDatatable(RoleDataTable $dataTable)
    {
        return $this->objService->indexDatatable($dataTable);
    }

    public function store(Request$request)
    {
        return $this->objService->store($request);
    }

    public function update(Request $request, $id)
    {
        return $this->objService->update($request, $id);
    }
}
