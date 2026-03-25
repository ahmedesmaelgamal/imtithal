@extends('web.layouts.master')
@section('content')
    <div class="breadcrumb mt-4 mb-4">
        <a href="{{ route('adminHome') }}"><img class="h-24" src="{{ asset('web/image/home.png') }}" alt="no-icon"></a>
        <img class="h-24 me-3 ms-3" src="{{ asset('web/image/icon-breadcrumb.png') }}" alt="no-icon">
        <a class="link-breadcrumb" href="{{ route('survey.index') }}">إدارة الإستبيانات</a>
        <img class="h-24 me-3 ms-3" src="{{ asset('web/image/icon-breadcrumb.png') }}" alt="no-icon">
        <span class="fs-14 fw-400 text-secondary">تعديل إستبيان</span>
    </div>
    <div class="card-border mt-16">
        <form action="{{ route('surveyUpdate') }}" method="post" class="row g-3 form-group">
            @csrf
            <input type="hidden" name="id" value="{{ $survey->id }}">
            <div class="d-flex justify-content-between flex-wrap">
                <h5 class="text-primary">تعديل إستبيان</h5>
                <div class="d-flex">
                    <a href="{{ route('survey.index') }}" class="view border-0 me-3">إلغاء</a>
                    <button type="submit" class="main-button">تعديل وحفظ</button>
                </div>
            </div>
            <hr class="hr-card">
            <div>
                <div class="col-12">
                    <div class="change-direction">
                        <label class="form-label fs-14 fw-500 text-primary">اسم الإستبيان<span
                                class="text-red">*</span></label>
                        <input name="title" value="{{ $survey->title }}" type="text"
                            class="form-control fs-12 fw-400 text-secondary bg-gray" placeholder="أدخل اسم الإستبيان"
                            required>
                    </div>
                </div>
                <div class="col-12">
                    <div class="change-direction">
                        <label class="form-label fs-14 fw-500 text-primary">وصف الإستبيان<span
                                class="text-red">*</span></label>
                        <input name="description" value="{{ $survey->description }}" type="text"
                            class="form-control fs-12 fw-400 text-secondary bg-gray" placeholder="أدخل وصف الإستبيان"
                            required>
                    </div>
                </div>
                <div id="forms-container">
                    @foreach ($survey->surveyQuestions->sortBy('order_number') as $index => $question)
                        <div class="col-12 group" data-index="{{ $index }}">
                            <div class="p-2 drag-handle">
                                <div id="buttons-container" class="d-flex">
                                    <div class="drag-handle d-flex align-items-center" style="cursor: grab; padding: 10px;">
                                        <i class="fa-solid fa-grip-vertical"></i>
                                    </div>
                                    <button type="button" class="btn-ollapse btn-question d-flex justify-content-between w-100"
                                        data-bs-toggle="collapse" data-bs-target="#collapseExample{{ $index }}"
                                        aria-expanded="false" aria-controls="collapseExample">
                                        <div class="head-collapse d-flex question-label-div">
                                            <span class="status-accept" style="padding: 0 8px;">{{ $index + 1 }}</span>
                                            <h6 class="fw-400 me-2 lable-question">{{ $question->question }}</h6>
                                        </div>
                                        <div class="d-flex">
                                            <a class="delete-form">
                                                <img class="h-24" src="{{ asset('web/image/trash.png') }}" alt="no-image"></a>
                                            <div class="collapse-icon me-2">
                                                <i class="fa-solid fa-angle-down"></i>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                                <div class="row g-3">
                                    <div class="collapse me-3" id="collapseExample{{ $index }}">
                                        <div class="col-12">
                                            <div class="change-direction">
                                                <label class="form-label fs-14 fw-500 text-primary"> السؤال
                                                    <span class="text-red">*</span>
                                                </label>
                                                <input name="questions[{{ $index }}][name]" type="text"
                                                    value="{{ $question->question }}" data-index="{{ $index }}"
                                                    class="form-control fs-12 fw-400 text-secondary bg-gray input-question"
                                                    placeholder="أدخل السؤال" required>
                                                <input type="hidden" name="questions[{{ $index }}][id]"
                                                    value="{{ $question->id }}">
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex flex-column mt-3">
                                            <label class="form-label fs-14 fw-500 text-primary">نوع الإجابة<span
                                                    class="text-red">*</span></label>
                                            <select name="questions[{{ $index }}][answer_type]"
                                                class="form-select answer-type-select" required data-index="{{ $index }}">
                                                <option value="0" {{ $question->answer_type == 0 ? 'selected' : '' }}>مقالي
                                                </option>
                                                <option value="1" {{ $question->answer_type == 1 ? 'selected' : '' }}>اختيار متعدد
                                                </option>
                                                <option value="2" {{ $question->answer_type == 2 ? 'selected' : '' }}>نعم ولا
                                                </option>
                                                <!-- <option value="3" {{ $question->answer_type == 3 ? 'selected' : '' }}>تاريخ
                                                </option>
                                                <option value="4" {{ $question->answer_type == 4 ? 'selected' : '' }}>رقم</option> -->
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <div class="mt-2 change-check">
                                                <input class="form-check-input me-2"
                                                    name="questions[{{ $index }}][require_file]" type="checkbox" value="1" {{ $question->require_file ? 'checked' : '' }}>
                                                <label class="form-check-label fs-14">طلب رفع الأدلة والشواهد</label>
                                            </div>
                                        </div>

                                        <!-- Multiple choice answers - show when answer type is 1 -->
                                        <div class="col-12 div-multiple-answer mt-3 {{ $question->answer_type == 1 ? '' : 'd-none' }}"
                                            data-index="{{ $index }}">
                                            <div class="answers-container" data-index="{{ $index }}">
                                                @if($question->answer_type == 1)
                                                    @foreach($question->answers as $answerIndex => $answer)
                                                        <div class="row answer-row mb-2" data-answer-index="{{ $answerIndex + 1 }}">
                                                            <div class="col-2 mb-2 d-flex align-items-center">
                                                                <div class="view text-center w-100">الاجابة {{ $answerIndex + 1 }}</div>
                                                            </div>
                                                            <div class="col-9 mb-2">
                                                                <input type="text"
                                                                    class="form-control w-100 fs-12 fw-400 text-primary bg-gray"
                                                                    name="questions[{{ $index }}][answers][{{ $answerIndex + 1 }}]"
                                                                    value="{{ $answer->answer }}">
                                                            </div>
                                                            <div class="col-1 mb-2 d-flex align-items-center">
                                                                <button type="button" class="btn btn-danger remove-answer"
                                                                    data-index="{{ $index }}">
                                                                    <i class="fa fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <button type="button" class="add-answer-btn main-button blur mt-2"
                                                style="background-color: transparent; margin-right: 0; padding-right: 0;"
                                                data-index="{{ $index }}">
                                                <img class="h-16" src="{{ asset('web/image/plus.svg') }}" alt="no-icon">
                                                إضافة إجابة جديدة
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </form>
    </div>
    <button id="duplicate-question" class="main-button blur">
        <img class="h-16" src="{{ asset('web/image/plus.svg') }}" alt="no-icon"> إضافة سؤال آخر
    </button>
@endsection

@section('js')
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        var questionForm = `
                    <div class="col-12 group">
                        <div class="p-2 drag-handle" data-index="0">
                            <div id="buttons-container" class="d-flex">
                                <div class="drag-handle d-flex align-items-center"
                                     style="cursor: grab; padding: 10px;">
                                    <i class="fa-solid fa-grip-vertical"></i>
                                </div>
                                <button type="button"
                                        class="btn-ollapse btn-question d-flex justify-content-between w-100"
                                        data-bs-toggle="collapse" data-bs-target="#collapseExample0"
                                        aria-expanded="false"
                                        aria-controls="collapseExample">
                                    <div class="head-collapse d-flex question-label-div">
                                        <span class="status-accept" style="padding: 0 8px;">1</span>
                                        <h6 class="fw-400 me-2 lable-question">صيغة السؤال</h6>
                                    </div>
                                    <div class="d-flex">
                                        <a class="delete-form"><img class="h-24"
                                                                    src="{{ asset('web/image/trash.png') }}"
                                                                    alt="no-image"></a>
                                        <div class="collapse-icon me-2">
                                            <i class="fa-solid fa-angle-down"></i>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <div class="row g-3">
                                <div class="collapse me-3" id="collapseExample0">
                                    <div class="col-12">
                                        <div class="change-direction">
                                            <label class="form-label fs-14 fw-500 text-primary"> السؤال
                                                <span class="text-red">*</span>
                                            </label>
                                            <input name="questions[0][name]" type="text" data-index="0"
                                                   class="form-control fs-12 fw-400 text-secondary bg-gray input-question"
                                                   placeholder="أدخل السؤال" required>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex flex-column mt-3">
                                        <label class="form-label fs-14 fw-500 text-primary">نوع الإجابة<span
                                                class="text-red">*</span></label>
                                        <select name="questions[0][answer_type]" data-index="0"
                                                class="form-select w-100 answer-type-select fs-12 fw-400 text-primary bg-gray"
                                                required>
                                            <option selected value="0">مقالي</option>
                                            <option value="1">اختيار متعدد</option>
                                            <option value="2">نعم ولا</option>
                                            <option value="3">تاريخ</option>
                                            <option value="4">رقم</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="mt-2 change-check">
                                            <input class="form-check-input me-2" name="questions[0][require_file]"
                                                   type="checkbox" value="1" id="flexCheckDefault1" checked>
                                            <label class="form-check-label fs-14" for="flexCheckDefault1">
                                                طلب رفع الادلة والشواهد
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 div-multiple-answer mt-3 d-none" data-index="0">
                                        <div class="answers-container" data-index="0">
                                            <!-- Answers will be added here dynamically -->
                                        </div>
                                        <button type="button" class="add-answer-btn main-button blur mt-2"
                                            style="background-color: transparent; margin-right: 0; padding-right: 0;"
                                            data-index="0">
                                            <img class="h-16" src="{{ asset('web/image/plus.svg') }}" alt="no-icon">
                                            إضافة إجابة جديدة
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

        $(document).ready(function () {
            // Initialize the sortable functionality
            $("#forms-container").sortable({
                handle: ".drag-handle",
                update: updateQuestionNumbers
            });

            // Initialize answer type fields for existing questions
            $('.answer-type-select').each(function () {
                var answerType = $(this).val();
                var questionContainer = $(this).closest('.collapse');
                var multipleAnswerDiv = questionContainer.find('.div-multiple-answer');

                if (answerType == '1') {
                    multipleAnswerDiv.removeClass('d-none');
                } else {
                    multipleAnswerDiv.addClass('d-none');
                }
            });
        });

        // Function to add a new answer field
        function addAnswerField(index) {
            const container = $(`.answers-container[data-index=${index}]`);
            const answerCount = container.children().length + 1;

            const answerHtml = `
                        <div class="row answer-row mb-2" data-answer-index="${answerCount}">
                            <div class="col-2 mb-2 d-flex align-items-center">
                                <div class="view text-center w-100">الاجابة ${answerCount}</div>
                            </div>
                            <div class="col-9 mb-2">
                                <input type="text" class="form-control w-100 fs-12 fw-400 text-primary bg-gray"
                                    name="questions[${index}][answers][${answerCount}]">
                            </div>
                            <div class="col-1 mb-2 d-flex align-items-center">
                                <button type="button" class="btn btn-danger remove-answer" data-index="${index}">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                    `;

            container.append(answerHtml);
        }

        // Handle adding new answers
        $(document).on('click', '.add-answer-btn', function () {
            const index = $(this).data('index');
            addAnswerField(index);
        });

        // Handle removing answers
        $(document).on('click', '.remove-answer', function () {
            const row = $(this).closest('.answer-row');
            const index = $(this).data('index');
            row.remove();

            // Re-number remaining answers
            $(`.answers-container[data-index=${index}] .answer-row`).each(function (i) {
                const newIndex = i + 1;
                $(this).attr('data-answer-index', newIndex);
                $(this).find('.view').text(`الاجابة ${newIndex}`);
                $(this).find('input').attr('name', `questions[${index}][answers][${newIndex}]`);
            });
        });

        // Handle answer type changes
        $(document).on('change', '.answer-type-select', function () {
            var answerType = $(this).val();
            var index = $(this).data('index');
            var multipleAnswerDiv = $(`.div-multiple-answer[data-index=${index}]`);

            if (answerType == '1') {
                multipleAnswerDiv.removeClass('d-none');
                // Initialize with 2 answers if empty
                if (multipleAnswerDiv.find('.answer-row').length === 0) {
                    addAnswerField(index);
                    addAnswerField(index);
                }
            } else {
                multipleAnswerDiv.addClass('d-none');
            }
        });

        // Clone question
        $(document).on("click", "#duplicate-question", function () {
            // Check if forms container exists - if not, create it
            if ($("#forms-container").length === 0) {
                // Create a forms container after the axis name input
                $(".card-border form .col-12:last").after('<div id="forms-container"></div>');
            }

            // Get the current number of questions for indexing
            var lastIndex = $("#forms-container .group").length;
            var newIndex = lastIndex;

            // If there are no existing forms, insert the template directly
            if (lastIndex === 0) {
                $("#forms-container").html(questionForm);
                // Show the first form
                $("#collapseExample0").addClass("show");
            } else {
                // Clone the last existing form
                var lastForm = $("#forms-container .group:last");
                var newForm = lastForm.clone();

                newForm.attr("data-index", newIndex);
                newForm.find("[data-index]").each(function () {
                    $(this).attr("data-index", newIndex);
                });

                // Update field names
                newForm.find("input, select, textarea").each(function () {
                    var name = $(this).attr("name");
                    if (name) {
                        var newName = name.replace(/\[\d+\]/, "[" + newIndex + "]");
                        $(this).attr("name", newName);
                    }
                    if ($(this).is("input[type='text'], textarea")) {
                        $(this).val("");
                    }
                });

                // Remove the id attribute from hidden input if exists
                newForm.find("input[name^='questions'][name$='[id]']").remove();

                // Clear answers container for the new question
                newForm.find(".answers-container").empty();

                // Update labels and IDs
                newForm.find(".lable-question").text("السؤال " + (newIndex + 1));
                newForm.find(".status-accept").text(newIndex + 1);

                // Update collapse ID
                var oldCollapseId = newForm.find(".collapse").attr("id");
                var newCollapseId = `collapseExample${newIndex}`;
                newForm.find(".collapse").attr("id", newCollapseId);
                newForm.find("[data-bs-target]").attr("data-bs-target", `#${newCollapseId}`);
                newForm.find("[aria-controls]").attr("aria-controls", newCollapseId);

                // Make sure the new form is shown (expanded)
                newForm.find(".collapse").addClass("show");

                // Add the new form after the last one
                $("#forms-container").append(newForm);
            }

            updateQuestionNumbers();

            // Refresh sortable if it's initialized
            if ($("#forms-container").hasClass("ui-sortable")) {
                $("#forms-container").sortable("refresh");
            }
        });

        // Delete question
        $(document).on("click", ".delete-form", function () {
            $(this).closest(".group").remove();
            updateQuestionNumbers();
        });

        // Update question numbers
        function updateQuestionNumbers() {
            $("#forms-container .group").each(function (index) {
                var newIndex = index;

                $(this).attr("data-index", newIndex);
                $(this).find("[data-index]").each(function () {
                    $(this).attr("data-index", newIndex);
                });

                // Update field names
                $(this).find("input, select, textarea").each(function () {
                    var name = $(this).attr("name");
                    if (name) {
                        var newName = name.replace(/\[\d+\]/, "[" + newIndex + "]");
                        $(this).attr("name", newName);
                    }
                });

                // Update visible numbers
                $(this).find(".status-accept").text(newIndex + 1);

                // Update collapse ID
                var newCollapseId = `collapseExample${newIndex}`;
                $(this).find(".collapse").attr("id", newCollapseId);
                $(this).find("[data-bs-target]").attr("data-bs-target", `#${newCollapseId}`);
                $(this).find("[aria-controls]").attr("aria-controls", newCollapseId);
            });
        }
    </script>
@endsection