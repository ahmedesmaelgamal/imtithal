<?php

namespace App\Imports;

use App\Models\Survey;
use App\Models\SurveyQuestion;
use App\Models\SurveyQuestionAnswer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SurveyReportImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $dataRows = $rows->slice(3);
        $lastSurveyTitle = null;

        foreach ($dataRows as $row) {
            $surveyTitle = trim($row[0] ?? '');
            $questionText = trim($row[1] ?? '');

            if (empty($surveyTitle) && $lastSurveyTitle) {
                $surveyTitle = $lastSurveyTitle;
            }

            if (empty($surveyTitle) || empty($questionText))
                continue;

            $lastSurveyTitle = $surveyTitle;
            $survey = Survey::firstOrCreate(
                ['title' => $surveyTitle],
                ['description' => $surveyTitle] // Set a temp description since it's required
            );

            $typeText = trim($row[2] ?? '');
            $answerType = 0;
            $isTrueFalse = false;

            if ($typeText == 'نعم - لا') {
                $answerType = 2; // In Survey model logic, 2 is TRUE_FALSE
                $isTrueFalse = true;
            } elseif ($typeText == 'اختيار من متعدد') {
                $answerType = 1; // 1 is MULTIPLE
            }

            $question = SurveyQuestion::create([
                'survey_id' => $survey->id,
                'question' => $questionText,
                'answer_type' => $answerType,
                'order_number' => SurveyQuestion::where('survey_id', $survey->id)->count() + 1
            ]);

            if ($isTrueFalse) {
                SurveyQuestionAnswer::create([
                    'survey_question_id' => $question->id,
                    'answer' => 'نعم'
                ]);
                SurveyQuestionAnswer::create([
                    'survey_question_id' => $question->id,
                    'answer' => 'لا'
                ]);
            }
        }
    }
}
