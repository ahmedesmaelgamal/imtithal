<?php

namespace App\Services\Web;

use App\Models\Admin as ObjModel;

use App\Models\Alert;
use App\Services\BaseService;

class HomeService extends BaseService
{
//    protected string $folder = 'admin/admin';
//    protected string $route = 'adminHome';

    public function __construct(ObjModel $objModel,protected Alert $alert)
    {
        parent::__construct($objModel);
    }

    public function index()
    {
        $alerts=$this->alert->get();
        return view('web.home.index',[
            'alerts'=>$alerts
        ]);
    }


}
