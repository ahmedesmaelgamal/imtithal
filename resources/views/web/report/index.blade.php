@extends('web.layouts.master')
@section('content')

    <div class="card-border-shape mt-16">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12 mb-3">
                <div class="card-home">
                    <h2 class="text-primary fw-700">{{ \App\Models\ViolationReport::count() + \App\Models\GeneralReport::count() }}</h2>
                    <div class="d-flex justify-content-between">
                        <p class="fs-14 text-secondary">عدد التقارير</p>
                        @php $rate = checkRate('violation_reports', 'general_reports'); @endphp
                        <div class="{{ $rate >= 0 ? 'status-true' : 'status-false' }} {{ $rate == 0 ? 'status-normal' : '' }}">
                            <img class="h-16"
                                 src="{{ $rate == 0 ? asset('web/image/arrow-right.png') : ($rate > 0 ? asset('web/image/arrow-up-right.png') : asset('web/image/arrow-down-right.png')) }}">
                            <p>{{ number_format($rate) }}%</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-3">
                <div class="card-home">
                    <h2 class="text-brown fw-700">{{ \App\Models\ViolationReport::whereDate('created_at', now())->where('status', '0')->count() + \App\Models\GeneralReport::whereDate('created_at', now())->where('status', '0')->count() }}</h2>
                    <div class="d-flex justify-content-between">
                        <p class="fs-14 text-secondary">عدد التقارير الجديدة</p>
                        @php $rate2 = checkRate('violation_reports', 'general_reports'); @endphp
                        <div class="{{ $rate2 >= 0 ? 'status-true' : 'status-false' }}  {{ $rate2 == 0 ? 'status-normal' : '' }}">
                            <img class="h-16"
                                 src="{{ $rate2 == 0 ? asset('web/image/arrow-right.png') : ($rate2 > 0 ? asset('web/image/arrow-up-right.png') : asset('web/image/arrow-down-right.png')) }}">
                            <p>{{ number_format($rate2) }}%</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-3">
                <div class="card-home">
                    <h2 class="text-red fw-700">{{ \App\Models\ViolationReport::where('status', '2')->count() + \App\Models\GeneralReport::where('status', '2')->count() }}</h2>
                    <div class="d-flex justify-content-between">
                        <p class="fs-14 text-secondary">عدد التقارير المرفوضة</p>
                        @php $rate3 = checkRate('violation_reports', 'general_reports', 'status', '0'); @endphp
                        <div class="{{ $rate3 >= 0 ? 'status-true' : 'status-false' }}  {{ $rate3 == 0 ? 'status-normal' : '' }}">
                            <img class="h-16"
                                 src="{{ $rate3 == 0 ? asset('web/image/arrow-right.png') : ($rate3 > 0 ? asset('web/image/arrow-up-right.png') : asset('web/image/arrow-down-right.png')) }}">
                            <p>{{ number_format($rate3) }}%</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-3">
                <div class="card-home">
                    <h2 class="text-green fw-700">{{ \App\Models\ViolationReport::where('status', '1')->count() + \App\Models\GeneralReport::where('status', '1')->count() }}</h2>
                    <div class="d-flex justify-content-between">
                        @php $rate4 = checkRate('violation_reports', 'general_reports', 'status', '1'); @endphp
                        <p class="fs-14 text-secondary">عدد التقارير المعتمدة</p>
                        <div class="status-normal">
                            <img class="h-16" src="{{ asset('web/image/arrow-right.png') }}" alt="no-icon">
                            <p>{{ number_format($rate4)  }}%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    <div class="shape"></div>--}}

    <div class="card-border mt-16">
        <div class="d-flex justify-content-between">
            <h5 class="text-primary">قائمة التقارير</h5>
        </div>
        <div>
            <div class="tabs">
                <div class="tabs-list d-flex mt-4">
                    <div class="show" data-content=".content-one">قائمة تقارير المخالفات</div>
                    <div data-content=".content-two">قائمة تقارير المشرفين (العامه)</div>
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
                                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">مرسل التقرير
                                        <span class="text-red">*</span>
                                    </label>
                                    <select class="form-control" name="leader" style="background-color: white">
                                        <option value="">الكل</option>
                                        @php
                                            $leaders = \App\Models\User::orderBy('full_name')->get();
                                        @endphp
                                        @foreach($leaders as $leader)
                                            <option value="{{ $leader->id }}" {{ request('leader') == $leader->id ? 'selected' : '' }}>{{ $leader->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">الدور
                                        <span class="text-red">*</span>
                                    </label>
                                    <select class="form-control" name="role" style="background-color: white">
                                        <option value="">الكل</option>
                                        @php
                                            $roles = \Spatie\Permission\Models\Role::get()
                                        @endphp
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">تاريخ الارسال
                                        <span class="text-red">*</span>
                                    </label>
                                    <input type="date" style="background-color: white;"
                                           class="form-control fs-12 fw-400 text-secondary bg-gray"
                                           name="date"
                                           value="{{ request('date') }}"
                                           placeholder="أدخل تاريخ الارسال" >
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">حالة التقرير
                                        <span class="text-red">*</span>
                                    </label>
                                    <select class="form-control" name="status" style="background-color: white">
                                        <option value="">الكل</option>
                                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>معلق</option>
                                        <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>مرفوض</option>
                                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>معتمد</option>
                                    </select>
                                </div>

                                <div class="footer text-start">
                                    <button type="submit" class="main-button">بحث</button>
                                </div>
                            </form>
                        </div>
                        <div class="scroll">
                            <table id="example" class="data-table violation_report_table" style="width:100%">
                                <thead>
                                <tr>
                                    <td style="width: 30%;">اسم التقرير</td>
                                    <td>مرسل التقرير</td>
                                    <td>الدور</td>
                                    {{--                                    <td>نوع التقرير</td>--}}
                                    <td>حالة التقرير</td>
                                    <td>تاريخ الارسال</td>
                                    <td></td>
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
                        </div>
                        <div class="form-filter card-details mt-4 mb-4">
                            <form class="row" action="" method="get">
                                <input type="hidden" name="div" value="2">
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">مرسل التقرير
                                        <span class="text-red">*</span>
                                    </label>
                                    <select class="form-control" name="leader1" style="background-color: white">
                                        <option value="">الكل</option>
                                        @php
                                            $leaders = \App\Models\User::whereHas('roles',function ($q){
                                                $q->where('name','مشرف');
                                            })->orderBy('full_name')->get();
                                        @endphp
                                        @foreach($leaders as $leader)
                                            <option value="{{ $leader->id }}" {{ request('leader1') == $leader->id ? 'selected' : '' }}>{{ $leader->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">الدور
                                        <span class="text-red">*</span>
                                    </label>
                                    <select class="form-control" name="role1" style="background-color: white">
                                        <option value="">الكل</option>
                                        @php
                                            $roles = \Spatie\Permission\Models\Role::get()
                                        @endphp
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}" {{ request('role1') == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">تاريخ الارسال
                                        <span class="text-red">*</span>
                                    </label>
                                    <input type="date" style="background-color: white;"
                                           class="form-control fs-12 fw-400 text-secondary bg-gray"
                                           name="date1"
                                           value="{{ request('date1') }}"
                                           placeholder="أدخل تاريخ الارسال" >
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">حالة التقرير
                                        <span class="text-red">*</span>
                                    </label>
                                    <select class="form-control" name="status1" style="background-color: white">
                                        <option value="">الكل</option>
                                        <option value="0" {{ request('status1') == '0' ? 'selected' : '' }}>معلق</option>
                                        <option value="2" {{ request('status1') == '2' ? 'selected' : '' }}>مرفوض</option>
                                        <option value="1" {{ request('status1') == '1' ? 'selected' : '' }}>معتمد</option>
                                    </select>
                                </div>

                                <div class="footer text-start">
                                    <button type="submit" class="main-button">بحث</button>
                                </div>
                            </form>
                        </div>
                        <div class="scroll">
                            <table id="example1" class="data-table general_report_table" style="width:100%">
                                <thead>
                                <tr>
                                    <td style="width: 30%;">اسم التقرير</td>
                                    <td>مرسل التقرير</td>
                                    {{--                                    <td>نوع التقرير</td>--}}
                                    <td>حالة التقرير</td>
                                    <td>تاريخ الارسال</td>
                                    <td></td>
                                </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('.violation_report_table').DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "الكل"]
                ],
                "order": [[4, "desc"]],
                "serverSide": false,
                "language": {
                    "sProcessing": "جاري تحميل البيانات...",
                    "sZeroRecords": "لم يتم العثور على نتائج",
                    "sEmptyTable": "لا توجد بيانات متاحة في الجدول",
                    "sInfo": "عرض _START_ إلى _END_ من أصل _TOTAL_ سجل",
                    "sInfoEmpty": "عرض 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ سجل)",
                    "sSearch": "بحث:",
                },
                "processing": true,
                "ajax": {
                    "url": "{{ route('violation_report.datatable') }}",
                    "type": "GET",
                    "data": function (d) {
                        d.leader = $('select[name=leader]').val();
                        d.role = $('select[name=role]').val();
                        d.date = $('input[name=date]').val();
                        d.status = $('select[name=status]').val();
                    }
                },
                "columns": [
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'user',
                        name: 'user'
                    },

                    {
                        data: 'role',
                        name: 'role'
                    },

                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ],
                "error": function (xhr, error, thrown) {
                    console.log('DataTables Ajax error:', xhr, error, thrown);
                },
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.general_report_table').DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "الكل"]
                ],
                "order": [[3, "desc"]],
                "serverSide": false,
                "language": {
                    "sProcessing": "جاري تحميل البيانات...",
                    "sZeroRecords": "لم يتم العثور على نتائج",
                    "sEmptyTable": "لا توجد بيانات متاحة في الجدول",
                    "sInfo": "عرض _START_ إلى _END_ من أصل _TOTAL_ سجل",
                    "sInfoEmpty": "عرض 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ سجل)",
                    "sSearch": "بحث:",
                },
                "processing": true,
                "ajax": {
                    "url": "{{ route('general_report.datatable') }}",
                    "type": "GET",
                    "data": function (d) {
                        d.leader = $('select[name=leader1]').val();
                        d.role = $('select[name=role1]').val();
                        d.date = $('input[name=date1]').val();
                        d.status = $('select[name=status1]').val();
                    }
                },
                "columns": [

                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'user',
                        name: 'user'
                    },

                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ],
                "error": function (xhr, error, thrown) {
                    console.log('DataTables Ajax error:', xhr, error, thrown);
                },
            });
        });
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
        $(document).on('submit', '#dailyReportForm', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = $('#dailyReportForm').attr('action');
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
                    $('#dailyReportForm')[0].reset();

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

