<?php

namespace App\Services\Web;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Role as ObjModel;
use App\Services\BaseService;

class RoleService extends BaseService
{
    public function __construct(protected ObjModel $objModel)
    {
        parent::__construct($objModel);
    }

    public function index()
    {
        return view('web.roles.index', [
            'permissions' => Permission::all()
        ]);
    }

    public function indexDatatable($dataTable)
    {
        return $dataTable->render('web.roles.index');
    }

    public function store($request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'guard_name' => 'required',
            'permissions' => 'required_if:guard_name,web|array',
            'permissions.*' => 'exists:permissions,name'
        ],[
            'name.required' => 'حقل الاسم مطلوب',
            'name.string' => 'يجب ان يكون الاسم نص',
            'name.max' => 'يجب ان لا يتجاوز الاسم 255 حرف',
            'name.unique' => 'الاسم مستخدم بالفعل',
            'permissions.required' => 'حقل الصلاحيات مطلوب',
            'permissions.*.exists' => 'الصلاحية :input غير موجودة',
        ]);

        try {
            if ($request->input('guard_name') == 'user') {
                $role = Role::create(['name' => $request->input('name'),'guard_name' => 'user']);
            }else{
                $role = Role::create(['name' => $request->input('name'),'guard_name' => 'web']);
            }

            // مزامنة الصلاحيات
            $role->syncPermissions($request->input('permissions'));


            return response()->json(['message' => 'تم إضافة الدور بنجاح'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'حدث خطأ أثناء إضافة الدور', 'error' => $e->getMessage()], 500);
        }
    }

    public function update($request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name'
        ],[
            'name.required' => 'حقل الاسم مطلوب',
            'name.string' => 'يجب ان يكون الاسم نص',
            'name.max' => 'يجب ان لا يتجاوز الاسم 255 حرف',
            'name.unique' => 'الاسم مستخدم بالفعل',
            'permissions.required' => 'حقل الصلاحيات مطلوب',
            'permissions.*.exists' => 'الصلاحية :input غير موجودة',
        ]);

        try {
            // العثور على الدور وتحديث الاسم
            $role = Role::findOrFail($id);
            $role->update(['name' => $request->input('name')]);

            // مزامنة الصلاحيات
            $role->syncPermissions($request->input('permissions'));

            return response()->json(['message' => 'تم تحديث الدور بنجاح'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'حدث خطأ أثناء تحديث الدور', 'error' => $e->getMessage()], 500);
        }
    }


}
