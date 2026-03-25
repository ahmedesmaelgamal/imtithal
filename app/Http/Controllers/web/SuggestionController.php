<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\DataTables\SuggestionDataTable;
use App\Http\DataTables\SuggestionTypeDataTable;
use App\Services\Web\SuggestionService as ObjService;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    public function __construct(protected ObjService $objService)
    {
    }

    public function index()
    {
        return $this->objService->index();
    }

    public function suggestionIndexDatatable(SuggestionDataTable $dataTable)
    {
        return $this->objService->indexDatatable($dataTable);
    }

    public function suggestionTypeIndexDatatable(SuggestionTypeDataTable $dataTable)
    {
        return $this->objService->indexDatatable($dataTable);
    }

    public function show($id)
    {
        return $this->objService->show($id);
    }

    public function create()
    {
        return $this->objService->create();
    }

    public function storeSuggestionType(Request $request)
    {
        return $this->objService->storeSuggestionType($request);

    }

    public function updateSuggestionStatus(Request $request, $id)
    {
        return $this->objService->updateSuggestionStatus($request, $id);
    }

    public function deleteSuggestionType($id)
    {
        return $this->objService->deleteSuggestionType($id);

    }

    public function deleteSuggestion($id)
    {
        return $this->objService->deleteSuggestion($id);

    }

    public function updateSuggestionType($id, Request $request)
    {
        return $this->objService->updateSuggestionType($id, $request);

    }
}
