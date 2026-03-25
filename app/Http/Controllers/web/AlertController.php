<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\DataTables\AlertManagementDataTable;
use App\Http\DataTables\NotificationManagementDataTable;
use App\Services\Web\AdminService;
use App\Services\Web\AlertService as ObjService;
use App\Services\Web\UserService;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    public function __construct(
        protected ObjService   $objService,
        protected AdminService $adminService,
        protected UserService  $userService,

    )
    {
    }

//    public function indexDatatable(AlertManagementDataTable $dataTable)
//    {
//        return $dataTable->render('web.alert_management.index');
//    }

    public function sendAlert(Request $request)
    {
        return $this->objService->sendAlert($request);
    }

    public function alertIndexDatatable(AlertManagementDataTable $dataTable)
    {
        return $this->objService->indexDatatable($dataTable);
    }

    public function notificationIndexDatatable(NotificationManagementDataTable $dataTable)
    {
        return $this->objService->indexDatatable($dataTable);
    }

    public function notificationShow($id)
    {
        $notificationUser = null;
        $notificationStatus = null;
        $notification = $this->objService->model->with(['alertUsers', 'alertLeaders'])->where('id', $id)->first();
        $notificationAdmin = $this->adminService->model->where('id', $notification->admin_id)->first();
//dd($notification->alertLeaders->first());
        if ($notification->alertLeaders->first()) {
            $notificationUser = $this->userService->model->where('id', $notification->alertLeaders->first()->leader_id)->first();
            $notificationStatus = $notification->alertLeaders->first()->seen == 1 ? 'مقروء' : 'جديد';
        } elseif ($notification->alertUsers->first()) {
            $notificationUser = $this->userService->model->where('id', $notification->alertUsers->first()->user_id)->first();
            $notificationStatus = $notification->alertUsers->first()->seen;
        }

        return view('web.alert_management.notificationDetails', ['notification' => $notification, 'notificationUser' => $notificationUser, 'notificationAdmin' => $notificationAdmin, 'notificationStatus' => $notificationStatus]);
    }

    public function alertShow($id)
    {
        $alert = $this->objService->model->with(['alertUsers', 'alertLeaders'])->where('id', $id)->first();
        $alertAdmin = $this->adminService->model->where('id', $alert->admin_id)->first();
//dd($alert->alertUsers->first());
        if ($alert->alertLeaders->first()) {
            $alertUser = $this->userService->model->where('id', $alert->alertLeaders->first()->leader_id)->first();
        } elseif ($alert->alertUsers->first()) {
            $alertUser = $this->userService->model->where('id', $alert->alertUsers->first()->user_id)->first();
        }
        return view('web.alert_management.alertDetails', ['alert' => $alert, 'alertAdmin' => $alertAdmin, 'alertUser' => $alertUser]);
    }


    public function index()
    {
        return $this->objService->index();
    }

    public function create()
    {
        return $this->objService->create();
    }

    public function store(Request $request)
    {
        return $this->objService->store($request);
    }


}
