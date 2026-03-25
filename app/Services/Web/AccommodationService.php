<?php

namespace App\Services\Web;

use App\Models\Accommodation;
use App\Services\BaseService;
use Illuminate\Http\JsonResponse;

class AccommodationService extends BaseService
{
    public function __construct(Accommodation $model)
    {
        parent::__construct($model);
    }

    public function index()
    {
        $mainAccommodations = $this->model->main()->get();
        return view('web.accommodation.index', compact('mainAccommodations'));
    }

    public function getMainAccommodations()
    {
        return response()->json($this->model->main()->get());
    }

    public function indexDatatable()
    {
        $data = $this->model->latest()->get();
        return datatables()->of($data)
            ->editColumn('parent_id', function ($obj) {
                return $obj->parent ? $obj->parent->name : 'رئيسي';
            })
            ->addColumn('actions', function ($obj) {
                return '
                    <div class="table-info d-flex justify-content-center">
                        <div class="dropdown">
                            <button class="btn-menu dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item edit" href="javascript:void(0)" data-bs-toggle="modal" data-id="'.$obj->id.'">
                                        <img class="" src="'.asset('web/image/edit-icon.png').'" alt="edit" style="width:18px;">
                                        تعديل
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="'.route('accommodations.show', $obj->id).'">
                                        <img class="" src="'.asset('web/image/eye-icon.png').'" alt="show" style="width:18px;">
                                        عرض
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item deleteAccommodation" href="'.route('accommodations.destroy', $obj->id).'" data-id="'.$obj->id.'">
                                        <img class="" src="'.asset('web/image/trash.png').'" alt="delete" style="width:18px;">
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
            ->rawColumns(['actions', 'status'])
            ->make(true);
    }

    public function create()
    {
        $mainAccommodations = $this->model->main()->get();
        return view('web.accommodation.create', compact('mainAccommodations'));
    }

    public function show($id)
    {
        $obj = $this->model->with(['children', 'parent', 'season'])->find($id);
        return view('web.accommodation.show', compact('obj'));
    }

    public function store($request)
    {
        $data = $request->validated();
        $data['type'] = $data['parent_id'] ? 'sub' : 'main';
        $this->model->create($data);
        return response()->json(['status' => true, 'msg' => 'تم إضافة المسكن بنجاح']);
    }

    public function edit($id)
    {
        $accommodation = $this->model->find($id);
        if (request()->ajax()) {
            return response()->json($accommodation);
        }
        $mainAccommodations = $this->model->main()->where('id', '!=', $id)->get();
        return view('web.accommodation.edit', compact('accommodation', 'mainAccommodations'));
    }

    public function update($request, $id)
    {
        $data = $request->validated();
        $data['type'] = $data['parent_id'] ? 'sub' : 'main';
        $this->model->find($id)->update($data);
        return response()->json(['status' => true, 'msg' => 'تم تحديث المسكن بنجاح']);
    }

    public function editStatus($request, $id)
    {
        $accommodation = $this->model->find($id);
        $accommodation->update(['status' => $request->status]);
        return response()->json(['status' => true, 'msg' => 'تم تحديث الحالة بنجاح']);
    }

    public function delete($id): JsonResponse
    {
        $obj = $this->model->find($id);
        if ($obj) {
            $obj->delete();
            return response()->json(['status' => 200, 'msg' => 'تم الحذف بنجاح']);
        }
        return response()->json(['status' => 404, 'msg' => 'غير موجود']);
    }
}
