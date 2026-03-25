@extends('web.layouts.master')
@section('content')
    <style>
        /* تحسين مظهر العنصر أثناء السحب */
        .select2-selection__choice.sorting {
            opacity: 0.8;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            transform: rotate(2deg);
        }

        /* تحسين زر الحذف */
        .select2-selection__choice__remove {    
            cursor: pointer !important;
        }
    </style>
    <div class="card-border mt-16">
        <div class="d-flex justify-content-between flex-wrap">
            <h5 class="text-primary">إدارة الإستبيانات </h5>
            <div class="d-flex">
                <button type="button" class="btn-filter">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                        <path
                            d="M19.25 5.41992H4.75L9.31174 11.1221C9.59544 11.4767 9.75 11.9173 9.75 12.3715V18.9199C9.75 19.4722 10.1977 19.9199 10.75 19.9199H13.25C13.8023 19.9199 14.25 19.4722 14.25 18.9199V12.3715C14.25 11.9173 14.4046 11.4767 14.6883 11.1221L19.25 5.41992Z"
                            stroke="#857854" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <a href="{{ route('survey.create') }}" class="main-button">
                    إضافة إستبيان وأسئلته
                </a>
                <button type="button" class="main-button blur" data-bs-toggle="modal" data-bs-target="#importReportsModal">
                    استيراد إستبيانات
                </button>
                <button type="button" class="main-button" data-bs-toggle="modal" data-bs-target="#surveyReportModal">
                    طباعة الإستبيانات
                </button>
            </div>
        </div>
        <hr class="hr-card">
        <div class="form-filter card-details mt-4 mb-4">
            <form class="row" action="{{ route('survey.store') }}" method="get">
                <div class="col-md-6 col-12 mb-3">
                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">اسم التقرير
                        <span class="text-red">*</span>
                    </label>
                    <input type="text" style="background-color: white;"
                        class="form-control fs-12 fw-400 text-secondary bg-gray" name="name"
                        value="{{ request('name') }}" placeholder="أدخل اسم التقرير">
                </div>
                <div class="col-md-6 col-12 mb-3">
                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">عدد الأسئلة
                        <span class="text-red">*</span>
                    </label>
                    <input type="text" style="background-color: white;"
                        class="form-control fs-12 fw-400 text-secondary bg-gray" name="num_of_questions"
                        value="{{ request('num_of_questions') }}" placeholder="أدخل عدد الأسئلة">
                </div>
                <div class="col-md-6 col-12 mb-3">
                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary"> تاريخ الانشاء
                        <span class="text-red">*</span>
                    </label>
                    <input type="date" style="background-color: white;" name="date"
                        class="form-control fs-12 fw-400 text-secondary bg-gray" id="validationDefault03"
                        value="{{ request('date') }}" placeholder="أدخل تاريخ الانشاء">
                </div>
                <div class="col-md-6 col-12 mb-3">
                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">اسم الموقع
                        <span class="text-red">*</span>
                    </label>
                    <input type="text" style="background-color: white;"
                        class="form-control fs-12 fw-400 text-secondary bg-gray" name="num_of_areas"
                        value="{{ request('num_of_areas') }}" placeholder="أدخل اسم مواقع">
                </div>
                <div class="footer text-start">
                    <button type="submit" class="main-button">بحث</button>
                </div>
            </form>
        </div>
        <div class="scroll">
            <table id="example" class="data-table surveyManagement-table data-table" style="width:100%">
                <thead>
                    <tr>
                        <td style="width: 30%">اسم الإستبيان</td>
                        <td>وصف الإستبيان</td>
                        <td>عدد الأسئلة</td>
                        <!-- <td>عدد المواقع</td> -->
                        <!-- <td> الموظفين</td>
                        <td>المشرفين</td> -->
                    </tr>
                </thead>
            </table>
        </div>

    </div>

    <!-- Import Reports Modal -->
    <div class="modal fade" id="importReportsModal" tabindex="-1" aria-labelledby="importReportsLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gray d-flex flex-column align-items-start">
                    <h5 class="text-primary fs-18" id="importReportsLabel">
                        استيراد تقارير من إكسيل
                    </h5>
                    <p class="text-secondary fs-14 fw-400">سيتم إنشاء التقارير (المحاور) والأسئلة الخاصة بها وتعيينها للمشرف الحالي</p>
                </div>
                <div class="modal-body">
                    <form id="ImportReportsForm" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12 mb-4">
                            <input name="file" type="file" class="dropify" data-height="200" required />
                        </div>
                        <div class="col-12 d-flex justify-content-between border-top pt-3 mt-4">
                            <button type="button" class="view border-0" data-bs-dismiss="modal">
                                الغاء
                            </button>
                            <button type="submit" class="main-button" id="importReportsSubmitBtn">
                                بدء الاستيراد
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Survey Report Modal -->
    <div class="modal fade" id="surveyReportModal" tabindex="-1" aria-labelledby="surveyReportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="surveyReportModalLabel">طباعة التقارير</h5>
                </div>
                <div class="modal-body">
                    <select class="form-select" name="survey_id" id="surveySelect" multiple>
                        @foreach ($surveys as $survey)
                            <option value="{{ $survey->id }}">{{ $survey->title }}</option>
                        @endforeach
                    </select>
                    <small class="text-secondary">يمكنك ترتيب التقارير عن طريق سحبها وإفلاتها في الترتيب المطلوب.</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                    <button type="button" class="main-button" id="printSurveysReportBtn">طباعة</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).on('click', '.surveyReportPrint', function(e) {
            e.preventDefault();
            var form = $(this);
            var url = "{{ route('surveyReportPrint') }}" + "?survey_id=" + $(this).data('id');
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response.status) {
                        var printWindow = window.open('', '_blank');
                        printWindow.document.write(response.html);
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseJSON.message)
                    toastr.error(xhr.responseJSON.message);
                }
            });
        });
    </script>
    @include('web.layouts.datatable')

    <script>
        let columns = [{
                data: 'title',
                name: 'title'
            },
            {
                data: 'description',
                name: 'description'
            },
            {
                data: 'number_of_questions',
                name: 'number_of_questions',
                searchable: false
            },
            // {
            //     data: 'area_count',
            //     name: 'area_count',
            //     searchable: false
            // },
            // {
            //     data: 'employees',
            //     name: 'employees'
            // },
            // {
            //     data: 'supervisors',
            //     name: 'supervisors'
            // },
            {
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false
            }
        ];

        let ajax = {
            "url": "{{ route('survey.datatable') }}",
            "type": "GET",
            data: function(d) {
                d.name = $('input[name=name]').val();
                d.num_of_questions = $('input[name=num_of_questions]').val();
                d.date = $('input[name=date]').val();
                d.num_of_areas = $('input[name=num_of_areas]').val();
            }
        };

        showData(columns, ajax);
    </script>

    {{-- ImportReportsForm submit --}}
    <script>
        $('#ImportReportsForm').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            let url = "{{ route('survey.importReports') }}";
            
            $.ajax({
                url: url,
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#importReportsSubmitBtn').html('<span class="spinner-border spinner-border-sm mr-2"></span> جاري الاستيراد ...').attr('disabled', true);
                },
                success: function (response) {
                    if (response.status) {
                        toastr.success(response.msg);
                        $('#importReportsModal').modal('hide');
                        $('#example').DataTable().ajax.reload();
                        $('#importReportsSubmitBtn').html('بدء الاستيراد').attr('disabled', false);
                    } else {
                        toastr.error(response.msg || 'حدث خطأ ما');
                        $('#importReportsSubmitBtn').html('بدء الاستيراد').attr('disabled', false);
                    }
                },
                error: function (xhr) {
                    let msg = (xhr.responseJSON && xhr.responseJSON.msg) ? xhr.responseJSON.msg : 'حدث خطأ أثناء الاستيراد';
                    toastr.error(msg);
                    $('#importReportsSubmitBtn').html('بدء الاستيراد').attr('disabled', false);
                }
            });
        });
    </script>

    <script>

        $(document).on('click', '#printSurveysReportBtn', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var selectedSurveys = $('#surveySelect').val();

            if (!selectedSurveys || selectedSurveys.length === 0) {
                toastr.warning('يرجى اختيار تقرير واحد على الأقل');
                return;
            }

            $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> جاري الطباعة...');

            $.ajax({
                url: "{{ route('surveyReportPrint') }}",
                type: 'GET',
                data: {
                    survey_id: selectedSurveys,
                    order: $('#surveySelect').val() // إرسال الترتيب الحالي
                },
                success: function(response) {
                    if (response.status) {
                        var printWindow = window.open('', '_blank');
                        printWindow.document.open();
                        printWindow.document.write(response.html);
                        printWindow.document.close();

                        setTimeout(() => {
                            printWindow.print();
                        }, 500);
                    } else {
                        toastr.error(response.message || 'حدث خطأ أثناء الطباعة');
                    }
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON?.message || 'حدث خطأ أثناء الطباعة');
                },
                complete: function() {
                    $btn.prop('disabled', false).html('<i class="fas fa-print"></i> طباعة');
                }
            });
        });
    </script>



    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
            // تهيئة Select2
            var $select = $("#surveySelect").select2({
                dropdownParent: $(".modal-content"),
                placeholder: ' اختر التقارير ',
                width: '100%',
                dir: 'rtl'
            });

            // إضافة تنسيق مخصص للعنصر المختار لجعل الـ placeholder لليمين مع حشوة
            $('.select2-selection--multiple').css({
                'text-align': 'right',
                'padding-right': '12px'
            });

            // جعل العناصر قابلة للترتيب
            initSortableSelect2();

            // إعادة تهيئة الترتيب عند اختيار/إزالة عنصر
            $select.on('select2:select select2:unselect', function() {
                setTimeout(initSortableSelect2, 100);
            });
        });

        function initSortableSelect2() {
            var $select = $("#surveySelect");
            var $container = $select.next('.select2-container').find('ul.select2-selection__rendered');

            // إزالة أي sortable سابق
            if ($container.hasClass('ui-sortable')) {
                $container.sortable('destroy');
            }

            // تهيئة sortable جديدة
            $container.sortable({
                items: 'li.select2-selection__choice',
                tolerance: 'pointer',
                containment: 'parent',
                cursor: 'move',
                helper: 'clone',
                start: function(event, ui) {
                    ui.item.addClass('sorting');
                },
                stop: function(event, ui) {
                    ui.item.removeClass('sorting');
                    updateSelectOrder();
                }
            });

            // إضافة معالج الحذف هنا فقط
            $container.off('click', '.select2-selection__choice__remove').on('click', '.select2-selection__choice__remove',
                function(e) {
                    e.stopPropagation();
                    var $choice = $(this).closest('.select2-selection__choice');
                    var title = $choice.attr('title');

                    // العثور على العنصر وإزالته
                    $select.find('option').each(function() {
                        if ($(this).text().trim() === title.trim()) {
                            $(this).prop('selected', false);
                            return false;
                        }
                    });

                    $select.trigger('change');
                });
        }

        function updateSelectOrder() {
            var $select = $("#surveySelect");
            var $container = $select.next('.select2-container').find('ul.select2-selection__rendered');
            var newOrder = [];

            // جمع العناصر حسب الترتيب الجديد
            $container.find('li.select2-selection__choice').each(function() {
                var title = $(this).attr('title');
                if (title) {
                    // البحث عن القيمة المقابلة للنص
                    $select.find('option').each(function() {
                        if ($(this).text().trim() === title.trim()) {
                            newOrder.push($(this).val());
                            return false;
                        }
                    });
                }
            });

            // تحديث القيم بدون إعادة تهيئة Select2
            $select.val(newOrder);

            // تحديث ترتيب العناصر في DOM الأصلي
            var $originalSelect = $select;
            var selectedOptions = [];

            // جمع العناصر المختارة بالترتيب الجديد
            newOrder.forEach(function(value) {
                var $option = $originalSelect.find('option[value="' + value + '"]');
                if ($option.length) {
                    selectedOptions.push($option.clone());
                }
            });

            // إعادة ترتيب العناصر في الـ select الأصلي
            $originalSelect.find('option:selected').remove();
            selectedOptions.forEach(function($option) {
                $option.prop('selected', true);
                $originalSelect.append($option);
            });

            console.log('الترتيب الجديد:', newOrder);
        }
    </script>
@endsection
