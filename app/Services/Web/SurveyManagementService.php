<?php

namespace App\Services\Web;

use App\Models\Area;
use App\Models\AreaTeam;
use App\Models\Survey as ObjModel;

use App\Models\SurveyQuestion;
use App\Models\BusReport;
use App\Models\DailyReport;
use App\Models\DailyReportAssignUser;
use App\Models\Notice;
use App\Models\NoticeType;
use App\Models\QuestionAnswer;
use App\Models\User;
use App\Models\ViolationReport;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class SurveyManagementService extends BaseService
{
    //    protected string $folder = 'admin/admin';
    //    protected string $route = 'adminHome';

    public function __construct(
        ObjModel $objModel,
        protected SurveyQuestion $surveyQuestion,
        protected QuestionAnswer $questionAnswer,
        protected DailyReport $dailyReport,
        protected DailyReportAssignUser $dailyReportAssignUser
    ) {
        parent::__construct($objModel);
    }

    public function index()
    {
        $surveys = $this->model->select('id', 'title', 'description')->get();
        return view('web.survey_management.index', [
            'surveys' => $surveys
        ]);
    }

    public function edit($id)
    {
        $survey = $this->model->with('surveyQuestions')->find($id);
        //        dd($survey);
        return view('web.survey_management.edit', compact('survey'));
    }

    public function create()
    {
        return view('web.survey_management.create');
    }

    public function store($request)
    {
        try {
            $questions = $request->input('questions');
            $survey = new $this->model();
            $survey->title = $request->title;
            $survey->description = $request->description;
            $survey->save();

            foreach ($questions as $index => $question) {
                $newQuestion = new $this->surveyQuestion();
                $newQuestion->question = $question['name'];
                $newQuestion->survey_id = $survey->id;
                $newQuestion->answer_type = $question['answer_type'] == '0' ? '0' : $question['answer_type'];
                $newQuestion->order_number = $index + 1;
                if (isset($question['require_file'])) {
                    $newQuestion->require_file = $question['require_file'] == null ? '0' : '1';
                }
                $newQuestion->save();

                if ($newQuestion->answer_type == '1') {
                    foreach ($question['answers'] as $answer) {
                        $newQuestion->answers()->create([
                            'answer' => $answer,
                        ]);
                    }
                } elseif ($newQuestion->answer_type == '2') {
                    $newQuestion->answers()->create([
                        'answer' => 'نعم',
                    ]);
                    $newQuestion->answers()->create([
                        'answer' => 'لا',
                    ]);
                }
            }
            return redirect()->route('survey.index')->with('success', 'تم الحفظ بنجاح');
        } catch (\Exception $e) {
            return redirect()->route('survey.index')->with('error', 'هناك خطا ما');
        }
    }

    public function update($request)
    {
        try {
            $survey = $this->model->find($request->id);
            $survey->title = $request->title;
            $survey->description = $request->description;
            $survey->save();

            // Handle questions if they exist in the request
            if ($request->has('questions')) {
                $questions = $request->input('questions');
                $processedQuestionIds = [];

                foreach ($questions as $index => $questionData) {
                    // If question has ID, update it
                    if (isset($questionData['id'])) {
                        $question = $this->surveyQuestion->find($questionData['id']);

                        // Only update if question exists and belongs to this axis
                        if ($question && $question->survey_id == $survey->id) {
                            $question->question = $questionData['name'];
                            $question->answer_type = $questionData['answer_type'];
                            $question->order_number = $index + 1;
                            $question->require_file = isset($questionData['require_file']) ? '1' : '0';
                            $question->save();

                            // Handle answers based on answer type
                            if ($question->answer_type == '1') { // Multiple choice
                                // Delete existing answers
                                $question->answers()->delete();

                                // Add new answers if they exist in the request
                                if (isset($questionData['answers']) && is_array($questionData['answers'])) {
                                    foreach ($questionData['answers'] as $answerText) {
                                        if (!empty(trim($answerText))) {
                                            $question->answers()->create(['answer' => $answerText]);
                                        }
                                    }
                                }
                            } elseif ($question->answer_type == '2') { // Yes/No
                                // Delete existing answers and create standard yes/no
                                $question->answers()->delete();
                                $question->answers()->create(['answer' => 'نعم']);
                                $question->answers()->create(['answer' => 'لا']);
                            } else {
                                // For essay type, delete any existing answers
                                $question->answers()->delete();
                            }

                            $processedQuestionIds[] = $question->id;
                        }
                    } else {
                        // Create new question
                        $newQuestion = new $this->surveyQuestion();
                        $newQuestion->question = $questionData['name'];
                        $newQuestion->survey_id = $survey->id;
                        $newQuestion->answer_type = $questionData['answer_type'];
                        $newQuestion->order_number = $index + 1;
                        $newQuestion->require_file = isset($questionData['require_file']) ? '1' : '0';
                        $newQuestion->save();

                        // Handle answers based on answer type
                        if ($newQuestion->answer_type == '1') { // Multiple choice
                            if (isset($questionData['answers']) && is_array($questionData['answers'])) {
                                foreach ($questionData['answers'] as $answerText) {
                                    if (!empty(trim($answerText))) {
                                        $newQuestion->answers()->create(['answer' => $answerText]);
                                    }
                                }
                            }
                        } elseif ($newQuestion->answer_type == '2') { // Yes/No
                            $newQuestion->answers()->create(['answer' => 'نعم']);
                            $newQuestion->answers()->create(['answer' => 'لا']);
                        }

                        $processedQuestionIds[] = $newQuestion->id;
                    }
                }

                // Delete questions that weren't in the request (removed by user)
                $this->surveyQuestion->where('survey_id', $survey->id)
                    ->whereNotIn('id', $processedQuestionIds)
                    ->get()
                    ->each(function ($question) {
                        $question->answers()->delete(); // Delete related answers
                        $question->delete(); // Delete the question
                    });
            }

            return redirect()->route('surveyManagement')->with('success', 'تم الحفظ بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'هناك خطا ما: ' . $e->getMessage());
        }
    }

    public function deleteSurveyQuestion($id)
    {
        $question = $this->surveyQuestion->find($id);

        if (!$question) {
            return response()->json(['status' => false, 'msg' => 'السؤال غير موجود']);
        }

        // Delete related answers if they exist
        if ($question->answers()->exists()) {
            $question->answers()->delete();
        }

        // Delete the question
        $question->delete();

        return response()->json(['status' => true, 'msg' => 'تم الحذف بنجاح']);
    }

    public function deleteSurvey($id)
    {
        $survey = $this->model->find($id);

        if (!$survey) {
            return response()->json(['status' => false, 'msg' => 'الاستبيان غير موجود']);
        }

        // Delete the survey (related questions will be deleted via cascade or relationships)
        $survey->delete();

        return response()->json(['status' => true, 'msg' => 'تم الحذف بنجاح']);
    }

    public function axisReportPrint($request)
    {
        $axis_ids = (array) $request->axis_id;

        $axes = $this->model
            ->whereIn('id', $axis_ids)
            ->get() // ⬅️ يجب أن تسبق sortBy
            ->sortBy(function ($axis) use ($axis_ids) {
                return array_search($axis->id, $axis_ids);
            })
            ->values(); // لإعادة فهرسة المفاتيح من 0

        $result = $axes->map(function ($axis) {
            // Get areas belonging to the current axis
            $axis_areas = Area::where('axis_id', $axis->id)->pluck('id')->toArray();

            // Get team members in areas belonging to the axis
            $axis_users = AreaTeam::whereIn('area_id', $axis_areas)->pluck('user_id')->toArray();
            $users = User::whereIn('id', $axis_users)->get();

            // Current axis statistics
            $notices_count = Notice::whereIn('user_id', $axis_users)->count();
            $notices = Notice::whereIn('user_id', $axis_users)->get();
            $bus_reports_count = BusReport::whereIn('area_id', $axis_areas)->sum('bus_count');

            DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
            // Get the most frequent notice type in this axis with type name
            $top_notice_type = Notice::whereIn('user_id', $axis_users)
                ->select('notice_type_id', DB::raw('count(*) as total'))
                ->groupBy('notice_type_id')
                ->orderByDesc('total') // Remove any other order by clauses
                ->with('noticeType')
                ->first();
            DB::statement("SET SESSION sql_mode=CONCAT('ONLY_FULL_GROUP_BY,', @@sql_mode);");


            return [
                'axis' => $axis,
                'notices_count' => $notices_count,
                'notices' => $notices,
                'bus_reports_count' => $bus_reports_count,
                'top_notice_type' => $top_notice_type ? [
                    'type_id' => $top_notice_type->notice_type_id,
                    'type_name' => $top_notice_type->noticeType->name ?? 'Unknown',
                    'count' => $top_notice_type->total
                ] : null,
                'users_count' => count(array_unique($axis_users)),
                'areas_count' => count($axis_areas),
                'users' => $users
            ];
        });


        $axesHtml = view(
            'web.axes_management.print',
            [
                'axes_data' => $result,
            ]
        )->render();

        return response()->json(['html' => $axesHtml, 'status' => true]);
    }
}
