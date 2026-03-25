<?php

namespace App\Services\Web;

use App\Models\AxisQuestion as ObjdModel;

use App\Services\BaseService;

class AxisQuestionService extends BaseService
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
