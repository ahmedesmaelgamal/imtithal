<?php

namespace App\Http\Controllers\Api\Leader;

use App\Http\Controllers\Controller;
use App\Services\Api\Leader\TeamService;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function __construct(protected TeamService $taskService)
    {
    }

    public function getTeam(Request $request)
    {
        try {
            return $this->taskService->getTeam($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function getAttendances($id, Request $request)
    {
        try {
        return $this->taskService->getAttendances($id, $request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }
    public function getTeamDetails($id)
    {
        try {
        return $this->taskService->getTeamDetails($id);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }
}
