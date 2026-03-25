<?php

namespace App\Services\Api\Support;

use App\Http\Resources\TicketReplyResource;
use App\Http\Resources\TicketResource;
use App\Models\SupportTicket;
use App\Models\SupportTicketReply;
use App\Services\BaseService;
use App\Services\FirestoreService;

class SupportService extends BaseService
{
    public function __construct(protected SupportTicket $supportTicket,protected SupportTicketReply $supportTicketReply,protected FirestoreService $firestoreService)
    {
        parent::__construct($supportTicket);
    }

    public function getTickets(): \Illuminate\Http\JsonResponse
    {
        $tickets = $this->supportTicket->query()->where('user_id', auth()->guard('user')->user()->id)->get();
        return $this->responseMsg('تم تحميل البيانات بنجاح', TicketResource::collection($tickets));
    }

    public function getReplies($id): \Illuminate\Http\JsonResponse
    {
        $replies = $this->supportTicketReply->query()->where('support_ticket_id',$id)->get();
        return $this->responseMsg('تم تحميل البيانات بنجاح',TicketReplyResource::collection($replies));
    }

    public function addTicket($request): \Illuminate\Http\JsonResponse
    {
        $validator = $this->apiValidator($request->all(), [
            'priority' => 'required|in:low,medium,high',
            'subject' => 'required',
            'message' => 'required',
        ]);

        if ($validator) {
            return $validator;
        }

        $newTicket = new $this->model();
        $newTicket->user_id = auth('user')->user()->id;
        $newTicket->priority = $request->priority;
        $newTicket->subject = $request->subject;
        $newTicket->message = $request->message;
        $newTicket->save();
        return $this->responseMsg('تم اضافة تذكرة الدعم بنجاح', TicketResource::make($newTicket));
    }

    public function addReply($request): \Illuminate\Http\JsonResponse
    {
        $validator = $this->apiValidator($request->all(), [
            'support_ticket_id' => 'required|exists:support_tickets,id',
            'reply' => 'required',
        ]);

        if ($validator) {
            return $validator;
        }

        $newReply = new $this->supportTicketReply();
        $newReply->user_id = auth('user')->user()->id;
        $newReply->support_ticket_id = $request->support_ticket_id;
        $newReply->reply = $request->reply;
        $newReply->save();

        return $this->responseMsg('تم اضافة رد علي تذكرة الدعم بنجاح');
    }

    public function updateActive()
    {
        $user = auth('user')->user();
        $user->is_active = !$user->is_active;
        $user->save();

        $this->firestoreService->updateIsActiveUser($user->toArray());

        return $this->responseMsg('تم تحديث حالة المستخدم بنجاح');
    }
}



