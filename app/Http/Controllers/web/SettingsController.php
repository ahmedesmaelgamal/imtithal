<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Web\SettingsService as ObjService;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct(

        protected ObjService $objService,
        protected User $userObj

    )
    {
    }

    public function index()
    {
        return $this->objService->index();
    }

    public function update(Request $request)
    {

        return $this->objService->update($request);
    }


}
