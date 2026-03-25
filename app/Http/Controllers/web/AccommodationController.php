<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\web\AccommodationRequest;
use App\Services\Web\AccommodationService;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    public function __construct(protected AccommodationService $service)
    {
    }

    public function index()
    {
        return $this->service->index();
    }

    public function indexDatatable()
    {
        return $this->service->indexDatatable();
    }

    public function getMainAccommodations()
    {
        return $this->service->getMainAccommodations();
    }

    public function create()
    {
        return $this->service->create();
    }

    public function store(AccommodationRequest $request)
    {
        return $this->service->store($request);
    }

    public function show($id)
    {
        return $this->service->show($id);
    }

    public function edit($id)
    {
        return $this->service->edit($id);
    }

    public function update(AccommodationRequest $request, $id)
    {
        return $this->service->update($request, $id);
    }

    public function editStatus(Request $request, $id)
    {
        return $this->service->editStatus($request, $id);
    }

    public function destroy($id)
    {
        return $this->service->delete($id);
    }
}
