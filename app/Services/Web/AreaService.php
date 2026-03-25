<?php

namespace App\Services\Web;

use App\Enum\AreaTypeEnum;
use App\Models\Area as ObjdModel;
use App\Models\Axis;
use App\Models\QuestionAnswer;
use App\Models\User;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AreaService extends BaseService
{


    public function __construct(
        ObjdModel                $objModel,
        protected User           $user,
        protected QuestionAnswer $questionAnswer,
    )
    {
        parent::__construct($objModel);
    }

    public function index($request)
    {
        $mainAreas = $this->model->main()->get();
        $teams = $this->user->whereHas('roles', function ($query) {
            $query->where('name', '!=', 'مشرف');
        })->get();

        $leaders = $this->user->whereHas('roles', function ($query) {
            $query->where('name', '=', 'مشرف');
        })->get();

        $surveys = \App\Models\Survey::all();

        return view('web.area.index', [
            'mainAreas' => $mainAreas,
            'teams' => $teams,
            'leaders' => $leaders,
            'surveys' => $surveys,
        ]);
    }

    public function getMainAreas()
    {
        return response()->json($this->model->main()->get());
    }

    public function indexDatatable()
    {
        $data = $this->model->with(['parent', 'season', 'leaderTeam.user'])->latest()->get();
        return datatables()->of($data)
            ->editColumn('parent_id', function ($obj) {
                return $obj->parent ? $obj->parent->name : 'رئيسي';
            })
            ->addColumn('supervisors', function ($query) {
                $areaSupervisor = $query->leaderTeam()->where('primary_leader', 1)->first();
                $supervisor = $areaSupervisor ? $areaSupervisor->user : null;

                if ($supervisor) {
                    return '  <div class="d-flex">
                                  <img class="image-table" src="' . getFile($supervisor->image, 'assets/uploads/avatar.png') . '" alt="no-image">
                                  <h6 class="name-table d-flex align-items-center">' . $supervisor->full_name . '</h6>
                              </div>';
                }
                return 'لا يوجد مشرفين لهذه المنطقه';
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
                                    <a class="dropdown-item link-survey" href="javascript:void(0)" data-bs-toggle="modal" data-id="' . $obj->id . '">
                                        <i class="fa-solid fa-link" style="width:18px; margin-left: 5px;"></i>
                                        ربط استبيان
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item edit" href="javascript:void(0)" data-bs-toggle="modal" data-id="' . $obj->id . '">
                                        <img class="" src="' . asset('web/image/edit-icon.png') . '" alt="edit" style="width:18px;">
                                        تعديل
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="' . route('areaLocation', ['id' => $obj->id]) . '">
                                        <img class="" src="' . asset('web/image/eye-icon.png') . '" alt="show" style="width:18px;">
                                        عرض
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item deleteArea" href="' . route('area.delete', $obj->id) . '" data-id="' . $obj->id . '">
                                        <img class="" src="' . asset('web/image/trash.png') . '" alt="delete" style="width:18px;">
                                        حذف
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>';
            })
            ->addColumn('status_toggle', function ($obj) {
                $checked = $obj->status == 1 ? 'checked' : '';
                return '
                    <div class="form-check form-switch d-flex align-items-center justify-content-center">
                        <input class="form-check-input" type="checkbox" role="switch" id="status' . $obj->id . '" ' . $checked . ' data-id="' . $obj->id . '" onclick="updateStatus(this)">
                    </div>';
            })
            ->rawColumns(['supervisors', 'actions', 'status_toggle'])
            ->make(true);
    }

    public function store($request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'parent_id' => 'nullable|exists:areas,id',
                'location' => 'nullable|string',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'status' => 'nullable|in:0,1',
                'leader_id' => 'nullable|exists:users,id',
                'team_ids' => 'nullable|array',
                'team_ids.*' => 'exists:users,id',
                'sub_leader_ids' => 'nullable|array',
                'sub_leader_ids.*' => 'exists:users,id',
            ]);

            $data['type'] = !empty($data['parent_id']) ? 'sub' : 'main';

            DB::beginTransaction();

            $newArea = $this->model->create($data);

            if ($request->filled('team_ids')) {
                foreach ($request->team_ids as $team) {
                    $newArea->team()->create(['user_id' => $team, 'type' => '0']);
                }
            }

            if ($request->filled('sub_leader_ids')) {
                foreach ($request->sub_leader_ids as $sub_leader) {
                    $newArea->team()->create(['user_id' => $sub_leader, 'type' => '1', 'primary_leader' => 0]);
                }
            }

            if ($request->filled('leader_id')) {
                $newArea->team()->create(['user_id' => $request->leader_id, 'type' => '1', 'primary_leader' => 1]);
            }

            DB::commit();

            return response()->json(['status' => true, 'msg' => 'تم إضافة المنطقة بنجاح']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' => $exception->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        $area = $this->model->with(['leaderTeam', 'memberTeam', 'parent'])->find($id);

        if (!$area) {
            return response()->json(['error' => 'المنطقة غير موجودة'], 404);
        }

        if (request()->ajax()) {
            $leader = $area->leaderTeam()->where('primary_leader', 1)->first();
            $teamIds = $area->memberTeam()->pluck('user_id')->toArray();
            $subLeaderIds = $area->leaderTeam()->where('primary_leader', 0)->pluck('user_id')->toArray();

            return response()->json(array_merge($area->toArray(), [
                'leader_id' => $leader ? $leader->user_id : null,
                'team_ids' => $teamIds,
                'sub_leader_ids' => $subLeaderIds
            ]));
        }

        $mainAreas = $this->model->main()->where('id', '!=', $id)->get();
        return view('web.area.edit', compact('area', 'mainAreas'));
    }

    public function update($request, $id = null)
    {
        try {
            $id = $id ?? $request->id;
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'parent_id' => 'nullable|exists:areas,id',
                'location' => 'nullable|string',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'status' => 'nullable|in:0,1',
                'leader_id' => 'nullable|exists:users,id',
                'team_ids' => 'nullable|array',
                'sub_leader_ids' => 'nullable|array',
            ]);

            $data['type'] = !empty($data['parent_id']) ? 'sub' : 'main';

            DB::beginTransaction();

            $area = $this->model->findOrFail($id);
            $area->update($data);

            // Sync Teams
            $area->team()->delete();

            if ($request->filled('team_ids')) {
                foreach ($request->team_ids as $teamId) {
                    $area->team()->create(['user_id' => $teamId, 'type' => '0']);
                }
            }

            if ($request->filled('sub_leader_ids')) {
                foreach ($request->sub_leader_ids as $subLeaderId) {
                    $area->team()->create(['user_id' => $subLeaderId, 'type' => '1', 'primary_leader' => 0]);
                }
            }

            if ($request->filled('leader_id')) {
                $area->team()->create(['user_id' => $request->leader_id, 'type' => '1', 'primary_leader' => 1]);
            }

            DB::commit();

            return response()->json(['status' => true, 'msg' => 'تم تحديث المنطقة بنجاح']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' => $exception->getMessage()], 500);
        }
    }

    public function editStatus($request, $id)
    {
        $area = $this->model->find($id);
        if ($area) {
            $area->update(['status' => $request->status]);
            return response()->json(['status' => true, 'msg' => 'تم تحديث الحالة بنجاح']);
        }
        return response()->json(['status' => false, 'msg' => 'المنطقة غير موجودة'], 404);
    }

    public function areaReportPrint($request)
    {
        $area_id = $request->area_id;
        $data = $this->model->where('id', $area_id)->first();
        $html = view('web.axes_management.print', ['data' => $data])->render();
        return response()->json(['html' => $html, 'status' => true]);
    }

    public function getAreaSurveys($id)
    {
        $area = $this->model->find($id);
        if (!$area) {
            return response()->json([]);
        }
        return response()->json($area->surveys->pluck('id')->toArray());
    }

    public function linkSurveys($request)
    {
        try {
            $request->validate([
                'area_id' => 'required|exists:areas,id',
                'survey_ids' => 'nullable|array',
                'survey_ids.*' => 'exists:surveys,id',
            ]);
            
            $area = $this->model->findOrFail($request->area_id);
            $area->surveys()->sync($request->survey_ids ?? []);
            
            return response()->json(['status' => true, 'msg' => 'تم ربط الاستبيانات بنجاح']);
        } catch (\Exception $exception) {
            return response()->json(['status' => false, 'msg' => $exception->getMessage()], 500);
        }
    }
}
