<?php

namespace App\Services\Web;

use App\Models\Trip;
use App\Services\BaseService;
use Illuminate\Http\JsonResponse;

class TripService extends BaseService
{
    public function __construct(Trip $model)
    {
        parent::__construct($model);
    }

    public function index()
    {
        $areas = \App\Models\Area::all();
        $airCarriers = $this->model->distinct()->pluck('air_carrier')->filter();
        $serviceProviders = $this->model->distinct()->pluck('service_provider')->filter();
        return view('web.trip.index', compact('areas', 'airCarriers', 'serviceProviders'));
    }

    public function indexDatatable()
    {
        $data = $this->model->with('area')
            ->when(request('trip_number'), function ($q) {
                return $q->where('trip_number', 'like', '%' . request('trip_number') . '%');
            })
            ->when(request('air_carrier'), function ($q) {
                return $q->where('air_carrier', request('air_carrier'));
            })
            ->when(request('service_provider'), function ($q) {
                return $q->where('service_provider', request('service_provider'));
            })
            ->when(request('area_id'), function ($q) {
                return $q->where('area_id', request('area_id'));
            })
            ->when(request('arrival_date'), function ($q) {
                return $q->whereDate('arrival_date', request('arrival_date'));
            })
            ->latest()->get();
        return datatables()->of($data)
            ->addColumn('actions', function ($obj) {
                return '
                    <div class="table-info d-flex justify-content-center">
                        <div class="dropdown">
                            <button class="btn-menu dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item edit" href="javascript:void(0)" data-bs-toggle="modal" data-id="' . $obj->id . '">
                                        <img class="" src="' . asset('web/image/edit-icon.png') . '" alt="edit" style="width:18px;">
                                        تعديل
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="' . route('trips.show', $obj->id) . '">
                                        <img class="" src="' . asset('web/image/eye-icon.png') . '" alt="show" style="width:18px;">
                                        عرض
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item deleteTrip" href="' . route('trips.destroy', $obj->id) . '" data-id="' . $obj->id . '">
                                        <img class="" src="' . asset('web/image/trash.png') . '" alt="delete" style="width:18px;">
                                        حذف
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>';
            })
            ->addColumn('status', function ($obj) {
                $checked = $obj->status == 1 ? 'checked' : '';
                return '
                    <div class="form-check form-switch d-flex align-items-center justify-content-center">
                        <label class="form-check-label ms-2" for="flexSwitchCheckDefault' . $obj->id . '"></label>
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault' . $obj->id . '" ' . $checked . ' data-id="' . $obj->id . '" onclick="updateStatus(this)">
                    </div>';
            })
            ->editColumn('areas', function ($obj) {
                return $obj->area->name ?? "-";
            })
            ->rawColumns(['actions', 'status'])
            ->make(true);
    }

    public function create()
    {
        $areas = \App\Models\Area::all();
        return view('web.trip.create', compact('areas'));
    }

    public function show($id)
    {
        $obj = $this->model->with('area')->find($id);
        return view('web.trip.show', compact('obj'));
    }
    public function store($request)
    {
        $data = $request->validated();
        $this->model->create($data);
        return response()->json(['status' => true, 'msg' => 'تم إضافة الرحلة بنجاح']);
    }

    public function edit($id)
    {
        $trip = $this->model->find($id);
        if (request()->ajax()) {
            return response()->json($trip);
        }
        $areas = \App\Models\Area::all();
        return view('web.trip.edit', compact('trip', 'areas'));
    }

    public function editStatus($request, $id)
    {
        $trip = $this->model->find($id);
        $trip->update([
            'status' => $request->status
        ]);
        return response()->json(['status' => true, 'msg' => 'تم تحديث حالة الرحلة بنجاح']);
    }

    public function update($request, $id)
    {
        $data = $request->validated();
        $trip = $this->model->find($id);
        $trip->update($data);
        return response()->json(['status' => true, 'msg' => 'تم تحديث الرحلة بنجاح']);
    }

    public function delete(int $id): JsonResponse
    {
        $trip = $this->model->find($id);
        if ($trip) {
            $trip->delete();
            return response()->json(['status' => true, 'msg' => 'تم حذف الرحلة بنجاح']);
        }
        return response()->json(['status' => false, 'msg' => 'الرحلة غير موجودة'], 404);
    }
}
