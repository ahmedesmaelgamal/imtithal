<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\AdvancedInquiriesService;
use Illuminate\Http\Request;

class AdvancedInquiriesController extends Controller
{
    public function __construct(

        protected AdvancedInquiriesService $advancedInquiriesService,
    )
    {
    }


    public function getAllAxes()
    {

        return $this->advancedInquiriesService->getAllAxes();
    }

    public function addQuestions(Request $request)
    {
        return $this->advancedInquiriesService->addQuestions($request);
    }

}
