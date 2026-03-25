<?php

namespace App\Services\Web;

use App\Models\SupportTicket as ObjModel;

use App\Services\BaseService;

class BusReportService extends BaseService
{

    public function __construct(
        protected ObjModel $objModel)
    {
        parent::__construct($objModel);
    }
    public function index()
    {
        return view('web.bus.index');
    }
}
