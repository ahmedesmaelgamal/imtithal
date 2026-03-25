<?php

namespace App\Services\Web;

use App\Models\AreaTeam as ObjdModel;

use App\Services\BaseService;

class AreaTeamService extends BaseService
{
//    protected string $folder = 'admin/admin';
//    protected string $route = 'adminHome';

    public function __construct(ObjdModel $objModel)
    {
        parent::__construct($objModel);
    }

    public function index()
    {
        return view('web.axes_management.index');
    }


}
