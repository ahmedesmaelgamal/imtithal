<?php

namespace App\Http\Controllers\Api\Leader;

use App\Http\Controllers\Controller;
use App\Services\Api\Leader\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(protected TaskService $taskService) {}

    public function getTasks(Request $request)
    {
        try {
            return $this->taskService->getTasks($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function taskDetails($id)
    {
        try {
            return $this->taskService->taskDetails($id);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }
    public function actionQuestion(Request $request)
    {
        try {
            return $this->taskService->actionQuestion($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }


    public function addTask(Request $request)
    {
        try {
            return $this->taskService->addTask($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }
}
