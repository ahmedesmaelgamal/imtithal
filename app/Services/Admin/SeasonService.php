<?php

namespace App\Services\Admin;

use App\Models\Admin;
use App\Models\Season as ObjModel;
use App\Services\BaseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SeasonService extends BaseService
{
    protected string $folder = 'web/seasons';
    protected string $route = 'seasons';

    public function __construct(ObjModel $objModel)
    {
        parent::__construct($objModel);
    }

    public function index()
    {
        return view("{$this->folder}.index");
    }

    public function indexDatatable($dataTable)
    {
        return $dataTable->render('web.season.index');

    }

    public function create()
    {
        return view("{$this->folder}/parts/create", [
            'storeRoute' => route("{$this->route}.store"),
        ]);
    }

    public function store($data)
    {
        try {
            $this->model->create($data);
            return response()->json(['status' => 200, 'message' => 'تمت العملية بنجاح ']);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => 'حدث خطاء', 'error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {

        $obj = $this->model->withoutGlobalScopes()->find($id);

        if (!$obj) {
            return response()->json(['status' => 404, 'message' => 'الموسم غير موجود']);
        }


        return response()->json([
            'id' => $obj->id,
            'name' => $obj->name,
        ]);

    }

    public function update($data, $id)
    {
        $validator = $this->apiValidator($data->all(), [
            'name' => 'required|string|max:255|unique:seasons,name,' . $id,
        ]);
        if ($validator && method_exists($validator, 'fails') && $validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ], 422);
        }

        try {
            $this->model->withoutGlobalScopes()->where('id', $id)->update([
                'name' => $data['name'],
            ]);

            return response()->json([
                'status' => true,
                'message' => 'تم التحديث بنجاح',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'حدث خطأ ما أثناء التحديث',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function editStatus($request)
    {

        try {
            $obj = $this->model->withoutGlobalScopes()->find($request->id);

            if (!$obj) {
                return response()->json([
                    'success' => false,
                    'message' => 'الموسم غير موجود',
                ], 500);
            }

            // test

            // check if no active season and the request status is unactive to prevent unactive season
            if ($request->status == 0 && $this->model->withoutGlobalScopes()->where('id', '!=', $request->id)->where('status', 1)->count() == 0) {

                return response()->json([
                    'success' => false,
                    'message' => 'لا يمكن إلغاء تفعيل الموسم لأنه هو الوحيد النشط',
                ], 500);
            }

            if ($request->status == 1) {
                $admin = Admin::where('id', 1)->first();
                $admin->season_id = $obj->id;
                $admin->save();
                auth('web')->logout();
                $obj->update(['status' => $request->status]);
                $this->model->withoutGlobalScopes()->where('id', '!=', $request->id)->update(['status' => 0]);


                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'redirect' => url('/'),
                        'message' => 'تم تفعيل الموسم بنجاح، يرجى تسجيل الدخول مرة أخرى لتحديث بيانات الجلسة.'
                    ]);
                }

                return redirect('/')->with('success', 'تم تفعيل الموسم بنجاح، يرجى تسجيل الدخول مرة أخرى لتحديث بيانات الجلسة.');
            }


            $obj->update(['status' => $request->status]);
            // make else is unactive
            $this->model->withoutGlobalScopes()->where('id', '!=', $request->id)->update(['status' => 0]);


            return response()->json([
                'success' => true,
                'message' => 'تم تحديث الحالة بنجاح',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ ما',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destory($id)
    {
        $obj = $this->model->withoutGlobalScopes()->find($id);
        if ($obj && $obj->status == 0) {

            $obj->delete();
            return response()->json(['status' => 200, 'message' => 'تم حذف الموسم بنجاح']);
        } else {
            return response()->json(['status' => 500, 'message' => 'لا يمكن حذف الموسم لأنه مفعل أو غير موجود']);
        }
    }
}