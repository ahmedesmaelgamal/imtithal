@extends('web.layouts.master')
@section('content')

    <div class="card-border mt-16">
        <div class="d-flex justify-content-between">
            <h5 class="text-primary"> التقارير اليومية</h5>
        </div>
        <div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="tabs">
                <div class="tabs-list d-flex mt-4">
                    <div class="show" data-content=".content-one">قائمة التقارير اليومية</div>
                    <div data-content=".content-two">ادارة التقارير اليومية</div>
                </div>

                <hr class="hr-card"/>
                <div class="content-list">
                    <div class="content-one">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn-filter">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25"
                                     fill="none">
                                    <path
                                        d="M19.25 5.41992H4.75L9.31174 11.1221C9.59544 11.4767 9.75 11.9173 9.75 12.3715V18.9199C9.75 19.4722 10.1977 19.9199 10.75 19.9199H13.25C13.8023 19.9199 14.25 19.4722 14.25 18.9199V12.3715C14.25 11.9173 14.4046 11.4767 14.6883 11.1221L19.25 5.41992Z"
                                        stroke="#857854" stroke-width="1.6" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <div class="form-filter card-details mt-4 mb-4">
                            <form class="row" action="" method="get">
                                <input type="hidden" name="div" value="1">
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">المشرف
                                        <span class="text-red">*</span>
                                    </label>
                                    <select class="form-control" name="leader" style="background-color: white">
                                        <option value="">الكل</option>
                                        @php
                                            $leaders = \App\Models\User::whereHas('roles',function ($q){
                                                $q->where('name','مشرف');
                                            })->orderBy('full_name')->get();
                                        @endphp
                                        @foreach($leaders as $leader)
                                            <option value="{{ $leader->id }}" {{ request('leader') == $leader->id ? 'selected' : '' }}>{{ $leader->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">الموظف
                                        <span class="text-red">*</span>
                                    </label>
                                    <select class="form-control" name="user" style="background-color: white">
                                        <option value="">الكل</option>
                                        @php
                                            $users = \App\Models\User::whereHas('roles',function ($q){
                                                $q->where('name','!=','مشرف');
                                            })->orderBy('full_name')->get();
                                        @endphp
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ request('user') == $user->id ? 'selected' : '' }}>{{ $user->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">تاريخ التقرير
                                        <span class="text-red">*</span>
                                    </label>
                                    <input type="date" style="background-color: white;"
                                           class="form-control fs-12 fw-400 text-secondary bg-gray"
                                           name="date"
                                           value="{{ request('date') }}">
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">حالة التقرير
                                        <span class="text-red">*</span>
                                    </label>
                                    <select class="form-control" name="status">
                                        <option value="">الكل</option>
                                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>تم البدء</option>
                                        <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>تحت المراجعه</option>
                                        <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>تحتاج للتعديل</option>
                                        <option value="4" {{ request('status') == '4' ? 'selected' : '' }}>منتهه</option>
                                    </select>
                                </div>

                                <div class="footer text-start">
                                    <button type="submit" class="main-button">بحث</button>
                                </div>
                            </form>
                        </div>
                        <div class="scroll">
                            <table id="example1" class="data-table  daily_report_assign_user_table" style="width: 100%">
                                <thead>
                                <tr>
                                    <td style="width: 30%;">عنوان التقرير اليومى</td>
                                    <td>الموظف</td>
                                    <td>المشرف</td>
                                    <td>تاريخ التقرير اليومى</td>
                                    <td style="width: 15%;">حالة التقرير اليومى</td>
                                    <td>التفاصيل</td>
                                </tr>
                                </thead>

                            </table>
                        </div>
                    </div>


                    <div class="content-two">
                        <div class="d-flex justify-content-end mb-3">
                            <button type="button" class="btn-filter">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25"
                                     fill="none">
                                    <path
                                        d="M19.25 5.41992H4.75L9.31174 11.1221C9.59544 11.4767 9.75 11.9173 9.75 12.3715V18.9199C9.75 19.4722 10.1977 19.9199 10.75 19.9199H13.25C13.8023 19.9199 14.25 19.4722 14.25 18.9199V12.3715C14.25 11.9173 14.4046 11.4767 14.6883 11.1221L19.25 5.41992Z"
                                        stroke="#857854" stroke-width="1.6" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <button type="button" class="main-button" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                اضافة تقرير يومى
                            </button>
                        </div>
                        <div class="form-filter card-details mt-4 mb-4">
                            <form class="row" action="" method="get">
                                <input type="hidden" name="div" value="2">
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">المحور
                                        <span class="text-red">*</span>
                                    </label>
                                    <select class="form-control" name="axis" style="background-color: white">
                                        <option value="">الكل</option>
                                        @php
                                            $axes = \App\Models\Axis::get();
                                        @endphp
                                        @foreach($axes as $axis)
                                            <option value="{{ $axis->id }}" {{ request('axis') == $axis->id ? 'selected' : '' }}>{{ $axis->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">نوع الرصد
                                        <span class="text-red">*</span>
                                    </label>
                                    <select class="form-control" name="monitor_type" style="background-color: white">
                                        <option value="">الكل</option>
                                        @foreach (\App\Enum\monitorType::cases() as $monitorType)
                                            <option value="{{ $monitorType->value }}" {{ request('monitor_type') == $monitorType->value ? 'selected' : '' }}>
                                                {{ $monitorType->lang() }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">الجهة ذات علاقة
                                        <span class="text-red">*</span>
                                    </label>
                                    <select class="form-control" name="side_type" style="background-color: white">
                                        <option value="">الكل</option>
                                        @foreach (\App\Enum\SideType::cases() as $sideType)
                                            <option value="{{ $sideType->value }}" {{ request('side_type') == $sideType->value ? 'selected' : '' }}>{{ $sideType->lang() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">الموعد النهائي لتسليم التقرير
                                        <span class="text-red">*</span>
                                    </label>
                                    <input type="date" style="background-color: white;"
                                           class="form-control fs-12 fw-400 text-secondary bg-gray"
                                           name="deadline"
                                           value="{{ request('deadline') }}"
                                           placeholder="أدخل تاريخ الارسال" >
                                </div>

                                <div class="footer text-start">
                                    <button type="submit" class="main-button">بحث</button>
                                </div>
                            </form>
                        </div>
                        <div class="scroll">
                            <table id="example" class="data-table daily_report_table" style="width: 100%">
                                <thead>
                                <tr>
                                    <td style="width: 30%;">عنوان التقرير اليومي</td>
                                    <td style="width: 40%;">وصف التقرير اليومي</td>
                                    <td>تاريخ إضافة التقرير اليومي</td>
                                    <td>التفاصيل</td>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gray d-flex flex-column align-items-start">
                    <h5 class="text-primary fs-18" id="exampleModalLabel">
                        إضافة تقرير يومي
                    </h5>
                    <p class="text-secondary fs-14 fw-400">يرجى إدخال بيانات التقرير اليومي لإضافته إلى النظام</p>
                </div>
                <div class="modal-body">
                    <form class="row" id="addDailyReportForm" action="{{ route('daily_report.store') }}">
                        @csrf
                        <div class="col-12">
                            <div class="change-direction">
                                <label for="validationDefault01" class="form-label fs-14 fw-500 text-primary">عنوان
                                    التقرير
                                    اليومي
                                    <span class="text-red">*</span>
                                </label>
                                <input type="text" class="form-control fs-12 fw-400 text-secondary bg-gray"
                                       id="validationDefault01" name="title" placeholder="ادخل العنوان" required/>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="change-direction">
                                <label for="validationTextarea" class="form-label fs-14 fw-500 text-primary">وصف التقرير
                                    اليومى
                                    <span class="text-red">*</span>
                                </label>
                                <textarea class="form-control fs-12 fw-400 text-secondary bg-gray h-150"
                                          id="validationTextarea" name="description"
                                          placeholder="وصف التنبيه" required></textarea>
                            </div>
                        </div>
                        <div class="col-12 d-flex flex-column">
                            <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">المحور
                                <span class="text-red">*</span>
                            </label>
                            <select class="form-select w-100 fs-12 fw-400 text-primary bg-gray"
                                    {{--                                id="js-example-basic-single" --}}
                                    required name="axis_id">
                                @foreach ($axes as $axis)
                                    <option value="{{ $axis->id }}">{{ $axis->name }}</option>
                                @endforeach


                            </select>
                        </div>
                        <div class="col-md-6 col-12 d-flex flex-column">
                            <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">نوع الرصد
                                <span class="text-red">*</span>
                            </label>
                            <select class="form-select w-100 fs-12 fw-400 text-primary bg-gray" name="monitor_type"
                                    {{--                                id="js-example-basic-single" --}} required>
                                <option selected disabled value="">
                                    اختر نوع الرصد
                                </option>
                                @foreach (\App\Enum\monitorType::cases() as $monitorType)
                                    <option value="{{ $monitorType->value }}">
                                        {{ $monitorType->lang() }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-md-6 col-12 d-flex flex-column">
                            <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">الجهة ذات
                                علاقة
                                <span class="text-red">*</span>
                            </label>
                            <select class="form-select w-100 fs-12 fw-400 text-primary bg-gray" name="side_type"
                                    required>
                                <option selected disabled value="">
                                    اختر الجهة ذات علاقة
                                </option>

                                @foreach (\App\Enum\SideType::cases() as $sideType)
                                    <option value="{{ $sideType->value }}">{{ $sideType->lang() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 d-flex flex-column">
                            <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">الموعد النهائي
                                لتسليم التقرير
                                <span class="text-red">*</span>
                            </label>
                            <input type="date" name="deadline" min="{{ \Carbon\Carbon::today()->toDateString() }}"
                                   class="form-select w-100 fs-12 fw-400 text-primary bg-gray" required>

                        </div>
                        <div class="col-12 d-flex justify-content-between border-top pt-3 mt-4">
                            <button type="button" class="view border-0" data-bs-dismiss="modal">
                                الغاء
                            </button>
                            <button type="submit" id="addButton" class="main-button">
                                ارسال
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="editDailyReport" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gray d-flex flex-column align-items-start">
                    <h5 class="text-primary fs-18" id="exampleModalLabel">
                        تعديل التقرير يومي
                    </h5>
                    <p class="text-secondary fs-14 fw-400">يرجى إدخال بيانات التقرير اليومي </p>
                </div>
                <div class="modal-body">
                    <form class="row" id="editDailyReportForm" action="{{ route('daily_report.update',':id') }}"
                          method="POST">
                        @csrf
                        {{--                        @method('PUT')--}}
                        <input type="hidden" name="id" id="editDailyReportId">

                        <div class="col-12">
                            <div class="change-direction">
                                <label for="validationDefault01" class="form-label fs-14 fw-500 text-primary">عنوان
                                    التقرير
                                    اليومي
                                    <span class="text-red">*</span>
                                </label>
                                <input type="text" class="form-control fs-12 fw-400 text-secondary bg-gray"
                                       id="editDailyReportTitle" name="title" placeholder="ادخل العنوان" required/>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="change-direction">
                                <label for="validationTextarea" class="form-label fs-14 fw-500 text-primary">وصف التقرير
                                    اليومى
                                    <span class="text-red">*</span>
                                </label>
                                <textarea class="form-control fs-12 fw-400 text-secondary bg-gray h-150"
                                          id="editDailyReportDescription" name="description"
                                          placeholder="وصف التنبيه" required></textarea>
                            </div>
                        </div>
                        <div class="col-12 d-flex flex-column">
                            <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">المحور
                                <span class="text-red">*</span>
                            </label>
                            <select class="form-select w-100 fs-12 fw-400 text-primary bg-gray" id="editDailyReportAxis"
                                    required name="axis_id">
                                @foreach ($axes as $axis)
                                    <option value="{{ $axis->id }}">{{ $axis->name }}</option>
                                @endforeach


                            </select>
                        </div>
                        <div class="col-md-6 col-12 d-flex flex-column">
                            <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">نوع الرصد
                                <span class="text-red">*</span>
                            </label>
                            <select class="form-select w-100 fs-12 fw-400 text-primary bg-gray" name="monitor_type"
                                    {{--                                id="js-example-basic-single" --}} required>
                                <option selected disabled value="">
                                    اختر نوع الرصد
                                </option>
                                @foreach (\App\Enum\monitorType::cases() as $monitorType)
                                    <option value="{{ $monitorType->value }}">
                                        {{ $monitorType->lang() }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-md-6 col-12 d-flex flex-column">
                            <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">الجهة ذات
                                علاقة
                                <span class="text-red">*</span>
                            </label>
                            <select class="form-select w-100 fs-12 fw-400 text-primary bg-gray" name="side_type"
                                    required>
                                <option selected disabled value="">
                                    اختر نوع الرصد
                                </option>

                                @foreach (\App\Enum\SideType::cases() as $sideType)
                                    <option value="{{ $sideType->value }}">{{ $sideType->lang() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 d-flex flex-column">
                            <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">الموعد النهائي
                                لتسليم التقرير
                                <span class="text-red">*</span>
                            </label>
                            <input type="date" name="deadline"
                                   class="form-select w-100 fs-12 fw-400 text-primary bg-gray" required
                                   value="{{ old('deadline', \Carbon\Carbon::parse($dailyReport->deadline ?? now())->format('Y-m-d')) }}">

                        </div>
                        <div class="col-12 d-flex justify-content-between border-top pt-3 mt-4">
                            <button type="button" class="view border-0" data-bs-dismiss="modal">
                                الغاء
                            </button>
                            <button type="submit" id="submitUpdate" class="main-button">
                                ارسال التعديل
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--        model--}}
@endsection
@section('js')
    @include('web.layouts.datatable')

    <script>
        let columns1 = [
            {data: 'title', name: 'title'},
            {data: 'description', name: 'description'},
            {data: 'created_at', name: 'created_at'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false}
        ];

        let ajax1 = {
            "url": "{{ route('daily_report.datatable') }}",
            "type": "GET",
            data: function (d) {
                d.axis = $('select[name=axis]').val();
                d.monitor_type = $('select[name=monitor_type]').val();
                d.side_type = $('select[name=side_type]').val();
                d.deadline = $('input[name=deadline]').val();
            }
        };

        $(document).ready(function () {
            showData(columns1, ajax1, '.daily_report_table');
        });
    </script>



    <script>
        let columns2 = [
            {
                data: 'title',
                name: 'title'
            },
            {data: 'user_id', name: 'user_id'},
            {data: 'leader_id', name: 'leader_id'},
            {data: 'deadline', name: 'deadline'},
            {data: 'status', name: 'status', orderable: false, searchable: false},
            {data: 'actions', name: 'actions', orderable: false, searchable: false}
        ];

        let ajax2 = {
            "url": "{{ route('daily_report_assign_user.datatable') }}",
            "type": "GET",
            data: function (d) {
                d.leader = $('select[name=leader]').val();
                d.user = $('select[name=user]').val();
                d.date = $('input[name=date]').val();
                d.status = $('select[name=status]').val();
            }

        };

        $('.daily_report_assign_user_table').DataTable({
            "processing": true,
            "serverSide": false,
            "order": [[3, "desc"]],
            "lengthMenu": [
                [10, 50, 100, 500, -1],
                [10, 50, 100, 500, "الكل"]
            ],
            "language": {
                "sProcessing": "جاري تحميل البيانات...",
                "sZeroRecords": "لم يتم العثور على نتائج",
                "sEmptyTable": "لا توجد بيانات متاحة في الجدول",
                "sInfo": "عرض _START_ إلى _END_ من أصل _TOTAL_ سجل",
                "sInfoEmpty": "عرض 0 إلى 0 من أصل 0 سجل",
                "sInfoFiltered": "(منتقاة من مجموع _MAX_ سجل)",
                "sSearch": "بحث:",
            },
            "ajax": ajax2,
            "columns": columns2,
            "error": function (xhr, error, thrown) {
                console.log('DataTables Ajax error:', xhr, error, thrown);
            },

        });

        // $(document).ready(function () {
        // showData(columns2, ajax2, '.daily_report_assign_user_table');
        // });
    </script>











    <script>
        $(document).ready(function () {
            $("#js-example-basic-single").select2({
                dropdownParent: $(".modal-content"),
            });
            $("#js-example-basic-single1").select2({
                dropdownParent: $(".modal-content"),
            });
            $("#js-example-basic-single2").select2({
                dropdownParent: $(".modal-content"),
            });
        });
    </script>


    <script>
        $(document).on('submit', '#addDailyReportForm', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = $('#addDailyReportForm').attr('action');
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                beforeSend: function () {
                    $('#addButton').html('<span class="spinner-border spinner-border-sm mr-2" ' +
                        ' ></span> <span style="margin-left: 4px;">جاري الارسال ...</span>'
                    ).attr('disabled', true);
                },
                success: function (data) {

                    $('#exampleModal').modal('hide');

                    // Reset the form fields
                    $('#addDailyReportForm')[0].reset();

                    // Reload the DataTable
                    $('.daily_report_table').DataTable().ajax.reload();

                    // Restore the submit button
                    $('#addButton').html('إرسال').attr('disabled', false);
                },
                error: function (data) {
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
    </script>

    <script>
        $(document).on('click', '.edit', function (event) {
            var reportId = $(this).data('id');
            // Replace placeholder with the actual ID in the route
            var url = "{{ route('daily_report.edit', ':id') }}".replace(':id', reportId);
            $.ajax({
                url: url,
                method: 'GET',
                success: function (data) {
                    $('#editDailyReportId').val(data.id);
                    $('#editDailyReportTitle').val(data.title);
                    $('#editDailyReportDescription').val(data.description);
                    $("select[name='axis_id']").val(data.axis_id);
                    $("select[name='monitor_type']").val(data.monitor_type);
                    $("select[name='side_type']").val(data.side_type);
                    $("input[name='deadline']").val(data.deadline);

                    $('#editDailyReport').modal('show');
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching report data:', error);
                    alert("حدث خطأ أثناء جلب البيانات، يرجى المحاولة مرة أخرى.");
                }
            });
        });

        $('#editDailyReportForm').on('submit', function (e) {
            e.preventDefault();

            var reportId = $('#editDailyReportId').val();
            var url = "{{ route('daily_report.update', ':id') }}".replace(':id', reportId);

            $.ajax({
                url: url,
                method: 'POST', // Laravel allows PUT, but using POST for AJAX
                data: $(this).serialize(), // Serialize form data
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success: function (response) {
                    toastr.success(response.msg, '', {
                        "progressBar": true,
                        "timeOut": "5000",
                        "positionClass": "toast-top-right",
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut",
                        "toastClass": "toast toast-custom"
                    });
                    $('#editDailyReport').modal('hide');
                    $('#editDailyReportForm')[0].reset();
                    $('.daily_report_table').DataTable().ajax.reload();
                    $('#submitUpdate').html('حفظ التعديلات').attr('disabled', false);

                },
                error: function (xhr) {
                    $('#submitUpdate').html('حفظ التعديلات').attr('disabled', false);

                    if (xhr.status == 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        let errors = xhr.responseJSON.errors;
                    } else {
                        toastr.error(xhr.responseJSON.message || 'حدث خطأ غير متوقع');
                    }

                }
            });
        });

        // Ensure modal resets on close
        $('#editDailyReport').on('hidden.bs.modal', function () {
            $('#editDailyReportForm')[0].reset();
            $('#editDailyReportId').val('');
        });
    </script>
    <script>
        $(document).ready(function () {

            $(document).on('click', '.deleteDailyReportAssignUser', function (e) {
                e.preventDefault();
                let url = $(this).attr('href');
                let questionId = $(this).data('id');

                $.ajax({
                    url: url,
                    method: "DELETE",
                    contentType: 'application/json',  // Ensure JSON format
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'   // Laravel expects this for JSON requests
                    },
                    data: {
                        {{--                        'csrf-token': '{{ csrf_token() }}'--}}
                        _token: '{{ csrf_token() }}'

                    },
                    success: function (response) {
                        if (response.status) {
                            toastr.success(response.msg, '', {
                                "progressBar": true,
                                "timeOut": "5000",
                                "positionClass": "toast-top-right",
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut",
                                "toastClass": "toast toast-custom"
                            });
                            $('.daily_report_assign_user_table').DataTable().ajax.reload();
                        } else {
                            toastr.error(response.msg);
                        }
                    },
                    error: function (xhr) {
                        toastr.error(xhr.responseJSON.msg);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function () {

            $(document).on('click', '.deleteDailyReport', function (e) {
                e.preventDefault();
                let url = $(this).attr('href');
                let questionId = $(this).data('id');

                $.ajax({
                    url: url,
                    method: "DELETE",
                    contentType: 'application/json',  // Ensure JSON format
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'   // Laravel expects this for JSON requests
                    },
                    data: {
                        {{--                        'csrf-token': '{{ csrf_token() }}'--}}
                        _token: '{{ csrf_token() }}'

                    },
                    success: function (response) {
                        if (response.status) {
                            toastr.success(response.msg, '', {
                                "progressBar": true,
                                "timeOut": "5000",
                                "positionClass": "toast-top-right",
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut",
                                "toastClass": "toast toast-custom"
                            });
                            $('.daily_report_table').DataTable().ajax.reload();
                        } else {
                            toastr.error(response.msg);
                        }
                    },
                    error: function (xhr) {
                        toastr.error(xhr.responseJSON.msg);
                    }
                });
            });
        });
    </script>

    <script>
        let divRequest = '{{ request('div', '') }}'; // Default to empty string if not set

        $(document).ready(function () {
            if (divRequest === '1') {
                $('div[data-content=".content-one"]').trigger('click');
            } else if (divRequest === '2') {
                $('div[data-content=".content-two"]').trigger('click');
            }
        });
    </script>
@endsection
