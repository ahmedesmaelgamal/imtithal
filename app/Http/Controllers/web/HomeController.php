<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\AxisQuestion;
use App\Services\Web\HomeService as ObjService;
use Kreait\Firebase;

class HomeController extends Controller
{
    public function __construct(protected ObjService $objService)
    {
    }

    public function index()
    {
        return $this->objService->index();
    }

    public function checkQuestions()
    {
        $questions = AxisQuestion::with('answers')->orderByDesc('id')->get();

        return response()->json($questions);
    }

    public function addAnswerToQuestion($id)
    {
        $question = AxisQuestion::find($id);
        $question->answer_type = '2';
        $question->save();

        $question->answers()->create([
            'answer'=>'نعم'
        ]);

        $question->answers()->create([
            'answer'=>'لا'
        ]);
    }
}
