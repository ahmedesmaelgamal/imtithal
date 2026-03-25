<?php

namespace App\Services\Api\Users;

use App\Http\Resources\Leaders\LeaderTasksResource;
use Assign;
use App\Services\BaseService;

/**
 * Summary of LeaderService
 */
class TaskService extends BaseService
{
    /**
     * Summary of __construct
     * @param \ $objModel
     */
    public function __construct(TaskAssign $objModel)
    {
        parent::__construct($objModel);
    }

    public function UserTasks()
    {
        //0 => new , 1 => started, 2 => under review , 3=> need edit, 4 => completed
        $tasks = $this->getAll();
        return $this->responseMsg('تمت العملية بنجاح', LeaderTasksResource::collection($tasks));
    }
}
