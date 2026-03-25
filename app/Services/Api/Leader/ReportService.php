<?php

/**
 * Summary of namespace App\Services\Api\Leader
 */

namespace App\Services\Api\Leader;

use App\Models\GeneralReport;

use App\Models\ViolationReport;
use App\Services\BaseService;

/**
 * Summary of LeaderService
 */
class ReportService extends BaseService
{

    public function __construct(
        $objModel,
        protected GeneralReport $generalReport,
        protected ViolationReport $violationReport,
    )
    {
        parent::__construct($objModel);
    }

    public function getReports()
    {
        $user = auth()->guard('user')->user();

        return $this->objModel->where('leader_id', $user->id)->get();
    }

    public function index()
    {

    }

}
