<?php

namespace App\Services\Web;

use App\Models\SupportTicket as ObjModel;

use App\Services\BaseService;

class SupportService extends BaseService
{

    public function __construct(
        protected ObjModel $objModel)
    {
        parent::__construct($objModel);
    }

    public function show($id)
    {
        $ticket=  $this->model->find($id);
        return view('web.ticket.show',compact('ticket'));
    }

    public function addReply($request)
    {
        $ticket = $this->model->find($request->support_ticket_id);
        $ticket->replies()->create([
            'reply' => $request->reply,
            'admin_id'=>auth()->user()->id,
        ]);
        $ticket->update([
            'status' => 1
        ]);
       return response()->json(['status' => true,'msg' => 'تم الرد على التذكرة بنجاح']);
    }

    public function index()
    {
        return view('web.ticket.index');
    }
}
