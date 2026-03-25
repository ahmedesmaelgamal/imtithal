<?php

namespace App\Services\Web;

use App\Models\Area;
use App\Models\AreaLocation as ObjdModel;

use App\Services\BaseService;

class AreaLocationService extends BaseService
{
//    protected string $folder = 'admin/admin';
//    protected string $route = 'adminHome';

    public function __construct(
        ObjdModel                 $objModel,
        protected AreaTeamService   $areaTeamService,
        protected AreaService     $areaService,
        protected Area           $area,
        protected UserService     $userService,
    )
    {
        parent::__construct($objModel);
    }


    public function indexDatatable($request,$dataTable)
    {
        $area_id = $request->input('area_id');
        return $dataTable->with('id', $area_id)->render('web.area_location.index');

    }


    public function index($request)
    {
        $areaId = $request->id;
        $areaTeam = $this->areaTeamService->model->where('area_id', $areaId)->get();
        $area = $this->areaService->model->where('id', $areaId)->first();
        $UsersNotInTeam = $this->userService->model->whereNotIn('id', $areaTeam->pluck('user_id'))->whereHas('roles', function($q) { $q->where('name', '!=','مشرف'); })->get();
        $supervisorUsers = $this->userService->model
            ->whereIn('id', $this->areaTeamService->model
                ->where('area_id', $areaId)
                ->where('type', '1')
                ->pluck('user_id')->toArray())
            ->get();
        return view('web.area_location.index', compact('areaTeam', 'area', 'UsersNotInTeam','supervisorUsers'));
    }

    public function storeNewMember($request)
    {


   foreach ($request->user_ids as $user_id) {
            $this->areaTeamService->model->create([
                'area_id' => $request->area_id,
                'user_id' => $user_id,
                'type' => '0'
            ]);
        }

   return response()->json([
       'status'=>true,
       'message' => 'تمت الاضافة بنجاح'
   ]);
    }


    public function deleteMember($id)
    {
        $this->areaTeamService->model->where('id', $id)->delete();
        return response()->json([
            'status'=>true,
            'message' => 'تم الحذف بنجاح'
        ]);


    }


}
