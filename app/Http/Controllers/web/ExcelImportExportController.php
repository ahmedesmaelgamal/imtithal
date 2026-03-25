<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Services\Web\ExcelImportExportService as ObjService;
use Illuminate\Http\Request;

class ExcelImportExportController extends Controller
{
    public function __construct(

        protected ObjService $objService,

    )
    {
    }

    public function index()
    {
        return $this->objService->index();

    }

    public function exelImportExport(Request $request)
    {
        return $this->objService->exelImportExport($request);
    }

    public function export(Request $request)
    {
        return $this->objService->export($request);
    }


    public function example_import()
    {
        return $this->objService->example_import();

    }


}
