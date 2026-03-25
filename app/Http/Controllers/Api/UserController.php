<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserResource $userResource) {}
    public function getAllEmployees()
    {
        return $this->userResource->getAllEmployees();
    }
}
