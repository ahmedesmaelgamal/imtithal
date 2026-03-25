<?php

namespace App\Http\Controllers\Api\Support;

use App\Http\Controllers\Controller;
use App\Services\Api\Map\MapService;
use App\Services\Api\Support\SupportService;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function __construct(protected SupportService $supportService)
    {
    }

    public function getTickets()
    {
        try {
            return $this->supportService->getTickets();
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function getReplies($id)
    {
        try {
            return $this->supportService->getReplies($id);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function addTicket(Request $request)
    {
        try {
            return $this->supportService->addTicket($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function addReply(Request $request)
    {
        try {
            return $this->supportService->addReply($request);
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }

    public function updateActive()
    {
        try {
            return $this->supportService->updateActive();
        } catch (\Exception $e) {
            return self::ExeptionResponse();
        }
    }


}
