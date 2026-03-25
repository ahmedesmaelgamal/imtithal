<?php

namespace App\Services\Api;


use App\Http\Resources\Users\AxisResource;

use App\Models\Axis;
use App\Models\AxisQuestion;
use App\Models\QuestionAnswer;
use App\Services\BaseService;
use Illuminate\Http\Request;


/**
 * Summary of AuthService
 */
class AdvancedInquiriesService extends BaseService
{

    public function __construct(
        protected QuestionAnswer $questionAnswer,
        protected AxisQuestion   $axisQuestion,
        protected Axis           $axis,
        Axis                     $objModel
    )
    {
        parent::__construct($objModel);
    }

    public function getAllAxes()
    {
        return AxisResource::collection(Axis::all());
    }

    public function addQuestions($request)
    {
        $questionValidator=$this->apiValidator($request->all(), [
            'name' => 'required|string|max:255',
            'questions' => 'required|array|min:1',
            'questions.*.name' => 'required|string|max:255',
            'questions.*.answer_type' => 'required|in:0,1,2',
            'questions.*.require_file' => 'nullable|in:0,1',
            'questions.*.false_parent_id' => 'nullable|integer',
            'questions.*.true_parent_id' => 'nullable|integer',
        ]);
        if ($questionValidator) {
            return $questionValidator;
        }

        foreach ($request->input('questions') as $key => $question) {
            if ($question['answer_type'] == 1) {
                $answerValidator=$this->apiValidator($request->all(), [
                    "questions.$key.answer1" => 'required|string|max:255',
                    "questions.$key.answer2" => 'required|string|max:255',
                    "questions.$key.answer3" => 'required|string|max:255',
                    "questions.$key.answer4" => 'required|string|max:255',
                ]);
                if($answerValidator){
                    return $answerValidator;
                }
            }
        }

        try {
            $axis = new Axis();
            $axis->name = $request->name;
            $axis->save();

            $questions = $request->input('questions');
            foreach ($questions as $index => $question) {
                $newQuestion = new AxisQuestion();
                $newQuestion->question = $question['name'];
                $newQuestion->axis_id = $axis->id;
                $newQuestion->answer_type = $question['answer_type'];
                $newQuestion->false_parent_id = $question['false_parent_id'] ?? null;
                $newQuestion->true_parent_id = $question['true_parent_id'] ?? null;
                $newQuestion->order_number = $index + 1;
                $newQuestion->require_file = isset($question['require_file']) && $question['require_file'] ? 1 : 0;
                $newQuestion->save();

                if ($newQuestion->answer_type == 1) {
                    $newQuestion->answers()->create(['answer' => $question['answer1']]);
                    $newQuestion->answers()->create(['answer' => $question['answer2']]);
                    $newQuestion->answers()->create(['answer' => $question['answer3']]);
                    $newQuestion->answers()->create(['answer' => $question['answer4']]);
                } elseif ($newQuestion->answer_type == 2) {
                    $newQuestion->answers()->create(['answer' => 'نعم']);
                    $newQuestion->answers()->create(['answer' => 'لا']);
                }
            }

            return $this->responseMsg('تم إنشاء المحور و إضافة الأسئله بنجاح', null, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'msg' => 'حدث خطأ أثناء الحفظ',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
