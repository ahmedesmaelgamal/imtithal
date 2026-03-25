<?php

namespace App\Services\Web;

use App\Mail\RegisterMail;
use App\Models\DailyReportAssignUser;
use App\Models\Setting;
use App\Models\User;
use App\Models\User as ObjdModel;
use App\Models\UserSetting;
use App\Services\BaseService;
use App\Services\FirestoreService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserService extends BaseService
{

    public function __construct(
        protected ObjdModel        $objModel,
        protected Role             $role,
        protected FirestoreService $firestoreService,
        protected DailyReportAssignUser $dailyReportAssignUser,
        protected Setting $setting,
        protected UserSetting $userSetting,
    )
    {
        parent::__construct($objModel);
    }

    public function index()
    {
        $users = $this->model->get();
        $roles = $this->role->where(
            'guard_name', 'user'
        )->get();
        $shifts= $this->setting->all();

        return view('web.user.index', [
            'users', $users,
            'roles' => $roles,
            'shifts' => $shifts,

        ]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|unique:users,phone|string|max:15',
            'national_id' => 'required|regex:/^\d{10}$/|unique:users,national_id',
            'role' => 'required|string|exists:roles,name',
            'setting_ids'=>'required|array',
            'setting_ids.*'=>'exists:settings,id',
        ], [
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'يجب أن يكون البريد الإلكتروني صالحًا',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل',
            'full_name.required' => 'الاسم الكامل مطلوب',
            'full_name.string' => 'يجب أن يكون الاسم الكامل نصًا',
            'full_name.max' => 'يجب ألا يتجاوز الاسم الكامل 255 حرفًا',
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.string' => 'يجب أن يكون رقم الهاتف نصًا',
            'phone.unique' => 'رقم الهاتف مستخدم بالفعل',

            'phone.max' => 'يجب ألا يتجاوز رقم الهاتف 15 حرفًا',
            'national_id.required' => 'رقم الهوية الوطنية مطلوب',
            'national_id.regex' => 'يجب أن يكون رقم الهوية الوطنية مكونًا من 10 أرقام',
            'national_id.unique' => 'رقم الهوية الوطنية مستخدم بالفعل',
            'role.required' => 'الدور مطلوب',
            'role.string' => 'يجب أن يكون الدور نصًا',
            'role.exists' => 'الدور المحدد غير موجود',
            'setting_ids.required' => 'الوردية مطلوبة',
            'setting_ids.array' => 'الوردية يجب أن تكون مصفوفة',
            'setting_ids.*.exists' => 'الوردية المحددة غير موجودة',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'يرجى مراجعة البيانات وإعادة المحاولة',
                'errors' => $validator->errors()
            ], 422);
        }

// generate password

        // $randomPassword = rand(10000000, 99999999);
        $randomPassword = 123456789;
        $request['password'] = Hash::make($randomPassword);
        $request['status'] = 1;
        $userDate=$request->all();
        unset($userDate['setting_ids']);
        
        $user = User::create($userDate);
        $user->assignRole($request->role);

        // assign shift
        foreach ($request->setting_ids as $setting_id) {
            $this->userSetting->create([
                'setting_id' => $setting_id,
                'user_id' => $user->id,
            ]);
        }
        $dataUser = [
            'name' => $user->full_name,
            'email' => $user->email,
            'user_id'=>$user->id,
            'image' => getFile($user->image),
            'national_id' => $user->national_id,
            'lat' => '21.3891',
            'long' => '39.8579',
            'role' => $user->getRoleNames()->first(),
        ];

        $this->firestoreService->addUser($dataUser);
        $user['randomPassword'] = $randomPassword;

        // send email to user
        Mail::to($request->email)->send(new RegisterMail($user));

        return response()->json(['success' => true, 'message' => 'تم إنشاء الموظف بنجاح'], 200);
    }

    public function show($id)
    {
        $user = $this->model->with(['roles', 'setting.setting', 'areas.area'])->findOrFail($id);
        return view('web.user.show', compact('user'));
    }

    public function edit($id)
    {

        $user = $this->model->with('roles')->find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json([
            'id' => $user->id,
            'full_name' => $user->full_name,
            'national_id' => $user->national_id,
            'phone' => str_replace('+966', '', $user->phone),
            'email' => $user->email,
            'role' => $user->roles->pluck('name')->first(),
            'setting_ids' => $user->setting()->pluck('setting_id')->toArray(),

        ]);

    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'national_id' => 'required|regex:/^\d{10}$/|unique:users,national_id,' . $id,
            'role' => 'nullable|string|exists:roles,name',
            'email' => 'required|email|unique:users,email,' . $id,
            'setting_ids' => 'nullable|array',
            'setting_ids.*' => 'exists:settings,id',
        ], [
            'full_name.required' => 'الاسم الكامل مطلوب',
            'full_name.string' => 'يجب أن يكون الاسم الكامل نصًا',
            'full_name.max' => 'يجب ألا يتجاوز الاسم الكامل 255 حرفًا',
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.string' => 'يجب أن يكون رقم الهاتف نصًا',
            'phone.max' => 'يجب ألا يتجاوز رقم الهاتف 15 حرفًا',
            'national_id.required' => 'رقم الهوية الوطنية مطلوب',
            'national_id.regex' => 'يجب أن يكون رقم الهوية الوطنية مكونًا من 10 أرقام',
            'national_id.unique' => 'رقم الهوية الوطنية مستخدم بالفعل',
            'role.required' => 'الدور مطلوب',
            'role.string' => 'يجب أن يكون الدور نصًا',
            'role.exists' => 'الدور المحدد غير موجود',
            'email.required' => 'البريد الألكتروني مطلوب',
            'email.email' => 'يجب ان يكون البريد الالكتروني صالح',
            'email.unique' => 'البريد الألكتروني مستخدم بالفعل',
            'setting_ids.required' => 'الوردية مطلوبة',
            'setting_ids.array' => 'الوردية يجب أن تكون مصفوفة',
            'setting_ids.*.exists' => 'الوردية المحددة غير موجودة',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'يرجى مراجعة البيانات وإعادة المحاولة',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::findOrFail($id);
        $user->update($request->only(['full_name', 'phone', 'national_id', 'email']));
        // assign shift
        foreach ($user->setting as $setting) {
            $setting->delete();
        }
        if ($request->has('setting_ids')) {
            foreach ($request->setting_ids as $setting_id) {
                $this->userSetting->create([
                    'setting_id' => $setting_id,
                    'user_id' => $user->id,
                ]);
            }
        }

        if ($request->has('role')) {
            $user->syncRoles([$request->role]);
        }

        $dataUser = [
            'name' => $user->full_name,
            'email' => $user->email,
            'image' => getFile($user->image),
            'national_id' => $user->national_id,
            'role' => $user->getRoleNames()->first(),
        ];

        $this->firestoreService->addUser($dataUser);


        return response()->json(['success' => true, 'message' => 'تم تعديل الموظف بنجاح'], 200);
    }


    public function userReports($id)
    {

        $user = $this->model->find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }


        $data['reports'] = $user->userDailyReports()
            ->with('answers',
                'questions',
                'dailyReport',
                'user',
                'axis',
                'area',
                'leader')
            ->orderBy('created_at', 'desc')->get();
        $data['user'] = $user;


        return response()->json($data);
    }

    public function printDailyReport($id)
    {

        $data = $this->dailyReportAssignUser->where('id', $id)
            ->with('answers',
                'questions',
                'dailyReport',
                'user',
                'axis',
                'area',
                'leader')
            ->orderBy('created_at', 'desc')->first();

        $data = view('web.user.report_print', ['data' => $data])->render();

        return response()->json(['html'=>$data,'status'=>true]);
    }


    public function editStatus(Request $request, $id)
    {
        try {
            $user = $this->model->find($id);

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'تغذر تعديل هذا الموظف',
                ], 500);
            }

            $user->update(['status' => $request->status]);

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

    public function destroy($id)
    {
        $user = $this->objModel->where('id', $id)->first();
        if ($user) {
            $user->delete();
            return $this->responseMsg('تم حذف المستخدم بنجاح', null, 200);
        } else {
            return $this->responseMsg('حدث خطأ أثناء حذف المستخدم', null, 500);
        }
    }
}
