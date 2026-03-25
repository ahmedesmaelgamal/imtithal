<?php

namespace App\Imports;

use App\Models\Axis;
use App\Models\AxisQuestion;
use App\Models\QuestionAnswer;
use App\Enum\TaskQuestionEnum;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ReportImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $dataRows = $rows->slice(3);
        $lastReportName = null;

        foreach ($dataRows as $row) {
            $reportName = trim($row[0] ?? '');
            $questionText = trim($row[1] ?? '');

            if (empty($reportName) && $lastReportName) {
                $reportName = $lastReportName;
            }

            if (empty($reportName) || empty($questionText)) continue;

            $lastReportName = $reportName;
            $axis = Axis::firstOrCreate(['name' => $reportName]);

            $typeText = trim($row[2] ?? '');
            $answerType = 0; 
            $isTrueFalse = false;

            if ($typeText == 'نعم - لا') {
                $answerType = 1; 
                $isTrueFalse = true;
            } elseif ($typeText == 'اختيار من متعدد') {
                $answerType = 1;
            }

            $question = AxisQuestion::create([
                'axis_id'     => $axis->id,
                'question'    => $questionText,
                'answer_type' => $answerType,
                'order_number' => AxisQuestion::where('axis_id', $axis->id)->count() + 1
            ]);

            if ($isTrueFalse) {
                QuestionAnswer::create([
                    'axis_question_id' => $question->id,
                    'answer'           => 'نعم'
                ]);
                QuestionAnswer::create([
                    'axis_question_id' => $question->id,
                    'answer'           => 'لا'
                ]);
            }
        }
    }
}
