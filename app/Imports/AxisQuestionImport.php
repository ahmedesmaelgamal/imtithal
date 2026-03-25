<?php

namespace App\Imports;

use App\Models\AxisQuestion;
use App\Enum\TaskQuestionEnum;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AxisQuestionImport implements ToCollection
{
    protected $axisId;

    public function __construct($axisId)
    {
        $this->axisId = $axisId;
    }

    public function collection(Collection $rows)
    {
        // Data starts from row 5 (index 4)
        $dataRows = $rows->slice(4);

        foreach ($dataRows as $row) {
            if (empty($row[1])) continue; // Skip if question text is empty

            $answerType = $this->mapAnswerType($row[2]);

            AxisQuestion::create([
                'axis_id'     => $this->axisId,
                'question'    => $row[1],
                'answer_type' => $answerType,
                'order_number' => AxisQuestion::where('axis_id', $this->axisId)->count() + 1
            ]);
        }
    }

    protected function mapAnswerType($text)
    {
        $text = trim($text);
        if ($text == 'نعم - لا') {
            return 2; // TRUE_FALSE
        }
        if ($text == 'اختيار من متعدد') {
            return 1; // MULTIPLE
        }
        return 0; // TEXT / ESSAY default
    }
}
