<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\web\TripRequest;
use App\Models\Trip;
use App\Services\Web\TripService;
use Illuminate\Http\Request;

class TripController extends Controller
{

    public function __construct(
        protected TripService $objService,
        protected Trip $userObj
    ) {}

    public function index()
    {
        return $this->objService->index();
    }
    public function indexDatatable()
    {
        return $this->objService->indexDatatable();
    }
    public function store(TripRequest $request)
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
    public function editStatus(Request $request,$id)
    {
        return $this->objService->editStatus($request,$id);
    }

    public function update(TripRequest $request,$id)
    {
        return $this->objService->update($request,$id);
    }

    public function delete($id)
    {
        return $this->objService->delete($id);
    }
    public function create()
    {
        return $this->objService->create();
    }

}
