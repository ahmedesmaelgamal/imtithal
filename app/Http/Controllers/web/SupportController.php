<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\DataTables\SupportDataTable;
use App\Services\Web\SupportService as ObjService;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function __construct(protected ObjService $objService)
    {
    }

    public function index()
    {
        return $this->objService->index();
    }

    public function show($id)
    {
        return $this->objService->show($id);
    }

    public function addReply(Request $request)
    {
        return $this->objService->addReply($request);
    }

    public function indexDatatable(SupportDataTable $dataTable)
    {
        return $dataTable->render('web.ticket.index');
    }
}
