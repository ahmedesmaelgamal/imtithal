<?php

namespace App\Services\Api\Leader;

use App\Http\Resources\Leaders\LeaderTasksAnswerResource;
use App\Http\Resources\Leaders\LeaderTasksResource;
use App\Http\Resources\Leaders\TeamResource;
use App\Models\TaskAnswer;
use App\Models\TaskAssign;
use App\Services\BaseService;

/**
 * Summary of LeaderService
 */
class TaskService extends BaseService
{
    /**
     * Summary of __construct
     * @param \App\Models\Task $objModel
     */
    public function __construct(TaskAssign $objModel, protected TaskAnswer $taskAnswer)
    {
        parent::__construct($objModel);
    }

    public function getTasks($request)
    {
        //0 => new , 1 => started, 2 => under review , 3=> need edit, 4 => completed
        $tasks = $this->model
            ->where('status', $request->status)
            ->when($request->search, function ($query) use ($request) {
                $query->whereHas('task', function ($query) use ($request) {
                    $query->where('title', 'like', '%' . $request->search . '%');
                });
            })
            ->when($request->date, function ($query) use ($request) {
                $query->whereDate('created_at', $request->date);
            })
            ->when($request->user_id, function ($query) use ($request) {
                $query->where('user_id', $request->user_id);
            })
            ->when($request->area_id, function ($query) use ($request) {
                $query->whereHas('user', function ($query) use ($request) {
                    $query->where('area_id', $request->area_id);
                });
            })
            ->latest()->get();
        return $this->responseMsg('تمت العملية بنجاح', LeaderTasksResource::collection($tasks));
    }

    public function taskDetails($id)
    {
        $task = $this->model->findOrFail($id);
        return $this->responseMsg('تمت العملية بنجاح', LeaderTasksResource::make($task));
    }

    public function actionQuestion($request)
    {
        $validated = $this->apiValidator($request->all(), [
            'task_answer_id' => 'required',
            'status' => 'required|in:0,1,2',
            'refuse_reason_id' => 'required_if:status,2',
            'refuse_reason_notes' => 'nullable|string',
        ]);
        if ($validated) {
            return $validated;
        }

        $task_assign_question = $this->taskAnswer->findOrFail($request->task_answer_id)->first();
        $task_assign_question->status = $request->status;
        $task_assign_question->refuse_reason_id = $request->status == 2 ? $request->refuse_reason_id : null;
        $task_assign_question->refuse_reason_notes = $request->status == 2 ? $request->refuse_reason_notes : null;
        $task_assign_question->save();
        return $this->responseMsg('تمت حفظ بيانات السؤال بنجاح', LeaderTasksAnswerResource::make($task_assign_question));
    }

    public function addTask($request)
    {
        $validated = $this->apiValidator($request->all(), [
            'user_id' => 'required|exists:users,id',
            'task_id' => 'required|exists:tasks,id',
            'area_id' => 'required|exists:areas,id',
            'deadline' => 'required|date',
        ]);
        if ($validated) {
            return $validated;
        }
        $inputs = $request->all();
        $inputs['leader_id'] = auth('leader')->user()->id;
        $task = $this->model->create($inputs);
        return $this->responseMsg('تمت اضافة المهمة بنجاح', LeaderTasksResource::make($task));
    }
}
