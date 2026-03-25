<?php

namespace App\Services\Web;

use App\Models\Alert as ObjdModel;
use App\Models\AlertLeader;
use App\Models\AlertUser;
use App\Models\Axis;
use App\Models\QuestionAnswer;
use App\Models\User;
use App\Services\BaseService;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class AlertService extends BaseService
{
    //    protected string $folder = 'admin/admin';
    //    protected string $route = 'adminHome';

    public function __construct(
        protected ObjdModel   $objModel,
        protected UserService $userService,
        protected AlertUser   $alertUser,
        protected AlertLeader $alertLeader,
    )
    {
        parent::__construct($objModel);
    }

    public function index()
    {
        /*
         * old code for only leaders
         *
            $users = $this->userService->model->whereHas('roles', function ($query) {
                $query->where('name', '=', 'مشرف');
            })->get();
         * */
        $users = $this->userService->getAll();
        $roles = Role::where('guard_name', 'user')->get();
        return view('web.alert_management.index', ['users' => $users, 'roles' => $roles]);
    }

    public function indexDatatable($dataTable)
    {
        return $dataTable->render('web.alert_management.index');
    }


    public function sendAlert($request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'body' => 'nullable|string',
                'user_ids' => 'nullable|array',
                'role_id' => 'required',
            ]);


            if ($request->role_id) {
                $users = User::whereHas('roles', function ($query) use ($request) {
                    $query->where('id', '=', $request->role_id);
                })->get();
                foreach ($users as $user) {
                    $alert = $this->objModel->create([
                        'admin_id' => auth()->user()->id,
                        'title' => $request->title,
                        'body' => $request->body ?? "لا يوجد وصف",
                        'type' => 'alert',
                        'leader_id' => $user->id
                    ]);

                    $this->alertUser->create([
                        'user_id' => $user->id,
                        'alert_id' => $alert->id,
                        'seen' => 0,
                    ]);
                }
            }

            foreach ($request->user_ids as $user_id) {
                $alert = $this->objModel->create([
                    'admin_id' => auth()->user()->id,
                    'title' => $request->title,
                    'body' => $request->body ?? "لا يوجد وصف",
                    'type' => 'alert',
                    'to' => '2',
                    'leader_id' => $user_id
                ]);

                $this->alertUser->create([
                    'user_id' => $user_id,
                    'alert_id' => $alert->id,
                    'seen' => 0,
                ]);
            }

            return response()->json([
                'msg' => 'تم إرسال التنبيه بنجاح',
                'status' => true,
            ], 200);

        } catch
        (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage(),
                'status' => false,
            ], 500);
        }
    }

}
