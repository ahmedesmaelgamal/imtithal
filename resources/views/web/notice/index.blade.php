@extends('web.layouts.master')
@section('content')

    <div class="card-border-shape mt-16">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12 mb-3">
                <div class="card-home">
                    <h2 class="text-primary fw-700">{{ \App\Models\Notice::count() }}</h2>
                    <div class="d-flex justify-content-between">
                        <p class="fs-14 text-secondary">عدد البلاغات</p>
                        @php $rate = checkRate('notices'); @endphp
                        <div class="{{ $rate > 0 ? 'status-true' : ($rate < 0 ? 'status-false' : 'status-normal') }}">
                            <img class="h-16"
                                 src="{{ $rate == 0 ? asset('web/image/arrow-right.png') : ($rate > 0 ? asset('web/image/arrow-up-right.png') : asset('web/image/arrow-down-right.png')) }}">
                            <p>{{ number_format($rate,1) }}%</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-3">
                <div class="card-home">
                    <h2 class="text-brown fw-700">{{ \App\Models\Notice::whereDate('created_at', now())->where('status', '0')->count() }}</h2>
                    <div class="d-flex justify-content-between">
                        <p class="fs-14 text-secondary">عدد البلاغات الجديدة</p>
                        @php $rate2 = checkRate('notices', 'status', '0'); @endphp
                        <div class="{{ $rate2 > 0 ? 'status-true' : ($rate2 < 0 ? 'status-false' : 'status-normal') }}">
                            <img class="h-16"
                                 src="{{ $rate2 == 0 ? asset('web/image/arrow-right.png') : ($rate2 > 0 ? asset('web/image/arrow-up-right.png') : asset('web/image/arrow-down-right.png')) }}">
                            <p>{{ number_format($rate2,1) }}%</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-3">
                <div class="card-home">
                    <h2 class="text-red fw-700">{{ \App\Models\Notice::where('status', '2')->count() }}</h2>
                    <div class="d-flex justify-content-between">
                        <p class="fs-14 text-secondary">عدد البلاغات المرفوضة</p>
                        @php $rate3 = checkRate('notices', 'status', '2'); @endphp
                        <div class="{{ $rate3 > 0 ? 'status-true' : ($rate3 < 0 ? 'status-false' : 'status-normal') }}">
                            <img class="h-16"
                                 src="{{ $rate3 == 0 ? asset('web/image/arrow-right.png') : ($rate3 > 0 ? asset('web/image/arrow-up-right.png') : asset('web/image/arrow-down-right.png')) }}">
                            <p>{{ number_format($rate3,1) }}%</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 mb-3">
                <div class="card-home">
                    <h2 class="text-green fw-700">{{ \App\Models\Notice::where('status', '1')->count() }}</h2>
                    <div class="d-flex justify-content-between">
                        <p class="fs-14 text-secondary">عدد البلاغات التي تم حلها</p>
                        @php $rate4 = checkRate('notices', 'status', '1'); @endphp
                        <div class="{{ $rate4 > 0 ? 'status-true' : ($rate4 < 0 ? 'status-false' : 'status-normal') }}">
                            <img class="h-16"
                                 src="{{ $rate4 == 0 ? asset('web/image/arrow-right.png') : ($rate4 > 0 ? asset('web/image/arrow-up-right.png') : asset('web/image/arrow-down-right.png')) }}">
                            <p>{{ number_format($rate4,1) }}%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    <div class="shape"></div>--}}

    <div class="card-border mt-16">
        <div class="d-flex justify-content-between">
            <h5 class="text-primary"> البلاغات</h5>
        </div>
        <div>
            <div class="tabs">
                <div class="tabs-list d-flex mt-4">
                    <div class="show" data-content=".content-one">قائمة البلاغات</div>
                    <div data-content=".content-two">ادارة البلاغات</div>
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
                                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">مرسل البلاغ
                                        <span class="text-red">*</span>
                                    </label>
                                    <select class="form-control" name="user" style="background-color: white">
                                        <option value="">الكل</option>
                                        @php
                                            $users = \App\Models\User::orderBy('full_name')->get();
                                        @endphp
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ request('user') == $user->id ? 'selected' : '' }}>{{ $user->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">درجة الأهمية
                                        <span class="text-red">*</span>
                                    </label>
                                    <select class="form-control" name="priority" style="background-color: white">
                                        <option value="">الكل</option>
                                        <option value="suggest" {{ request('priority') == 'suggest' ? 'selected' : '' }}>اقتراح</option>
                                        <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>منخفضة</option>
                                        <option value="mid" {{ request('priority') == 'mid' ? 'selected' : '' }}>متوسطة</option>
                                        <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>مرتفعة</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">حالة البلاغ
                                        <span class="text-red">*</span>
                                    </label>
                                    <select class="form-control" name="status" style="background-color: white">
                                        <option value="">الكل</option>
                                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>مقبول</option>
                                        <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>مرفوض</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">تاريخ الارسال
                                        <span class="text-red">*</span>
                                    </label>
                                    <input type="date" style="background-color: white;"
                                           class="form-control fs-12 fw-400 text-secondary bg-gray"
                                           name="date"
                                           value="{{ request('date') }}">
                                </div>
                                <div class="footer text-start">
                                    <button type="submit" class="main-button">بحث</button>
                                </div>
                            </form>
                        </div>
                        <div class="scroll">
                            <table id="example1" class="data-table" style="width: 100%">
                                <thead>
                                <tr>
                                    <td style="width: 30%;">اسم البلاغ</td>
                                    <td>مرسل البلاغ</td>
                                    <td>درجة الأهمية</td>
                                    <td>حالة البلاغ</td>
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
                            <button
                                type="button"
                                class="main-button"
                                data-bs-toggle="modal"
                                data-bs-target="#exampleModal"
                            >
                                اضافة نوع بلاغ
                            </button>
                        </div>
                        <div class="form-filter card-details mt-4 mb-4">
                            <form class="row" action="" method="get">
                                <input type="hidden" name="div" value="2">
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">مستوى الأهمية
                                        <span class="text-red">*</span>
                                    </label>
                                    <select class="form-control" name="priority1" style="background-color: white">
                                        <option value="">الكل</option>
                                        <option value="suggest" {{ request('priority1') == 'suggest' ? 'selected' : '' }}>اقتراح</option>
                                        <option value="low" {{ request('priority1') == 'low' ? 'selected' : '' }}>منخفضة</option>
                                        <option value="mid" {{ request('priority1') == 'mid' ? 'selected' : '' }}>متوسطة</option>
                                        <option value="high" {{ request('priority1') == 'high' ? 'selected' : '' }}>مرتفعة</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">مدة التصعيد التلقائى (بالدقائق)
                                        <span class="text-red">*</span>
                                    </label>
                                    <input type="number" style="background-color: white;"
                                           class="form-control fs-12 fw-400 text-secondary bg-gray"
                                           name="period"
                                           value="{{ request('period') }}">
                                </div>
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">تاريخ الانشاء
                                        <span class="text-red">*</span>
                                    </label>
                                    <input type="date" style="background-color: white;"
                                           class="form-control fs-12 fw-400 text-secondary bg-gray"
                                           name="created"
                                           value="{{ request('created') }}">
                                </div>
                                <div class="footer text-start">
                                    <button type="submit" class="main-button">بحث</button>
                                </div>
                            </form>
                        </div>
                        <div class="scroll">
                            <table id="example1" class="data-table-1" style="width: 100%">
                                <thead>
                                <tr>
                                    <td style="width: 30%;">نوع البلاغ</td>
                                    <td>مستوى الأهمية</td>
                                    <td>التصعيد التلقائى</td>
                                    {{--                                    <td>امكانية التصعيد</td>--}}
                                    <td>تاريخ الانشاء</td>
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

    <!-- Modal -->
    <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div
                    class="modal-header bg-gray d-flex flex-column align-items-start"
                >
                    <h5 class="text-primary fs-18" id="exampleModalLabel">
                        إنشاء نوع بلاغ
                    </h5>
                    <p class="text-secondary fs-14 fw-400">يرجى إدخال بيانات البلاغ </p>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="addNoticeTypeForm" action="{{route('notice_type.store')}}" method="POST">
                        @csrf
                        <div class="col-12">
                            <div class="change-direction">
                                <label
                                    for="validationDefault01"
                                    class="form-label fs-14 fw-500 text-primary"
                                >اسم البلاغ
                                    <span class="text-red">*</span>
                                </label>
                                <input
                                    type="text"
                                    class="form-control fs-12 fw-400 text-secondary bg-gray"
                                    id="validationDefault01"
                                    name="name"
                                    placeholder="ادخل الاسم"
                                    required
                                />
                            </div>
                        </div>
                        <div class="col-12 d-flex flex-column">
                            <label
                                for="validationDefault04"
                                class="form-label fs-14 fw-500 text-primary"
                            >مستوى الأهمية
                                <span class="text-red">*</span>
                            </label>
                            <select
                                class="form-select w-100 fs-12 fw-400 text-primary bg-gray"
                                id="js-example-basic-single2"
                                required
                                name="priority"
                            >
                                <option value="suggest">
                                    إقتراح
                                </option>
                                <option value="low">
                                    منخفض
                                </option>
                                <option value="mid">
                                    متوسط
                                </option>
                                <option value="high">
                                    عالي
                                </option>
                            </select>
                        </div>
                        <div class="col-12 d-flex flex-column">
                            <label
                                for="validationDefault04"
                                class="form-label fs-14 fw-500 text-primary"
                            >مدة التصعيد التلقائى (بالدقائق)
                                <span class="text-red">*</span>
                            </label>
                            <input
                                type="text"
                                class="form-control fs-12 fw-400 text-secondary bg-gray"
                                name="period"
                                placeholder="ادخل مدة التصعيد"
                                required
                            />
                        </div>
                        <div
                            class="col-12 d-flex justify-content-between border-top pt-3 mt-4"
                        >
                            <button
                                type="button"
                                class="view border-0"
                                data-bs-dismiss="modal"
                            >
                                الغاء
                            </button>
                            <button id="addButton" type="submit" class="main-button">
                                تفعيل البلاغ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>










    <!-- Modal -->
    <div
        class="modal fade"
        id="exampleModal1"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div
                    class="modal-header bg-gray d-flex flex-column align-items-start"
                >
                    <h5 class="text-primary fs-18" id="exampleModalLabel">
                        تعديل نوع البلاغ
                    </h5>
                    <p class="text-secondary fs-14 fw-400">يرجى إدخال بيانات البلاغ </p>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="editNoticeTypeForm">
                        @csrf
                        <div class="col-12">
                            <div class="change-direction">
                                <label
                                    for="name"
                                    class="form-label fs-14 fw-500 text-primary"
                                >اسم البلاغ
                                    <span class="text-red">*</span>
                                </label>
                                <input
                                    type="text"
                                    class="form-control fs-12 fw-400 text-secondary bg-gray .editName"
                                    id="editName"
                                    name="name"
                                    placeholder="ادخل الاسم"
                                    required


                                />
                            </div>
                        </div>
                        <div class="col-12 d-flex flex-column">
                            <label
                                for="priority"
                                class="form-label fs-14 fw-500 text-primary"
                            >مستوى الأهمية
                                <span class="text-red">*</span>
                            </label>
                            <select
                                class="form-select w-100 fs-12 fw-400 text-primary bg-gray editPriority"
                                id="editPriority"
                                required
                                name="priority"
                            >
                                <option value="suggest">
                                    إقتراح
                                </option>
                                <option value="low">
                                    منخفض
                                </option>
                                <option value="mid">
                                    متوسط
                                </option>
                                <option value="high">
                                    عالي
                                </option>
                            </select>
                        </div>
                        <div class="col-12 d-flex flex-column">
                            <label
                                for="period"
                                class="form-label fs-14 fw-500 text-primary"
                            >مدة التصعيد التلقائى (بالدقائق)
                                <span class="text-red">*</span>
                            </label>
                            <input
                                type="text"

                                class="form-control fs-12 fw-400 text-secondary bg-gray editPeriod"
                                name="period"
                                id="editPeriod"
                                placeholder="ادخل مدة التصعيد"
                                required
                            />
                        </div>
                        <div
                            class="col-12 d-flex justify-content-between border-top pt-3 mt-4"
                        >
                            <button
                                type="button"
                                class="view border-0"
                                data-bs-dismiss="modal"
                            >
                                الغاء
                            </button>
                            <button id="editButton" type="submit" class="main-button">
                                تعديل نوع البلاغ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        // In your Javascript (external .js resource or <script> tag)
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
            $("#editPeriod").select2({
                dropdownParent: $(".modal-content"),
            });
            $("#editPriority").select2({
                dropdownParent: $(".modal-content"),
            });
            $("#editLevel").select2({
                dropdownParent: $(".modal-content"),
            });
        });

    </script>




    @section('js')

        @include('web.layouts.datatable')



        <script>
            $(document).ready(function () {

                $(document).on('click', '.deleteNoticeType', function (e) {
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
                                $('.data-table-1').DataTable().ajax.reload();
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

                $(document).on('click', '.deleteNotice', function (e) {
                    e.preventDefault();
                    let url = $(this).attr('href');

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
                                // $('.data-table').DataTable().ajax.reload();
                                // $('.data-table-1').DataTable().ajax.reload(null, false);
                                location.reload()
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
            $(document).on('submit', '#addNoticeTypeForm', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                console.log(formData);
                var url = $('#addNoticeTypeForm').attr('action');
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
                        $('#editNoticeTypeForm')[0].reset();
                        $('.data-table-1').DataTable().ajax.reload();
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

            $(document).on('click', '.updateNoticeType', function () {
                let id = $(this).data('id');
                let name = $(this).data('name');
                let priority = $(this).data('priority');
                let period = $(this).data('period');

                // Fill the modal with the selected data
                $('#editName').val(name);
                $('#editPriority').val(priority).trigger('change');
                $('#editPeriod').val(period);

                // Store ID inside a hidden input field or a data attribute
                $('#editNoticeTypeForm').data('id', id);
            });

            // Handle form submission
            $(document).on('submit', '#editNoticeTypeForm', function (e) {
                e.preventDefault();

                let form = $(this);
                let id = form.data('id'); // Get stored ID
                let url = "{{ route('notice_type.update', ':id') }}".replace(':id', id);

                let formData = {
                    _method: 'PUT',
                    name: $('#editName').val(),
                    priority: $('#editPriority').val(),
                    period: $('#editPeriod').val()
                };
                console.log(formData);

                $.ajax({
                    url: url,
                    type: 'PUT',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function () {
                        $('#editButton').html('<span class="spinner-border spinner-border-sm mr-2"></span> جاري الإرسال...')
                            .attr('disabled', true);
                    },
                    success: function (response) {
                        if (response.status) {
                            toastr.success(response.msg);
                            $('#exampleModal1').modal('hide');
                            $('.data-table-1').DataTable().ajax.reload();
                        } else {
                            toastr.error(response.msg);
                        }
                        $('#editButton').html('تعديل نوع البلاغ').attr('disabled', false);
                    },
                    error: function (xhr) {
                        toastr.error(xhr.responseJSON.msg || 'حدث خطأ ما');
                        $('#editButton').html('تعديل نوع البلاغ').attr('disabled', false);
                    }
                });
            });
        </script>

        <script>
            let columns = [
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'user',
                    name: 'user',
                    searchable: false
                },
                {
                    data: 'priority',
                    name: 'priority',
                    searchable: false
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ];

            let ajax = {
                "url": "{{ route('notice.datatable') }}",
                "type": "GET",
                data: function (d) {
                    d.user = $('select[name="user"]').val();
                    d.priority = $('select[name="priority"]').val();
                    d.status = $('select[name="status"]').val();
                    d.date = $('input[name="date"]').val();
                }
            };

            $('.data-table').DataTable({
                "processing": true,
                "serverSide": false,
                "order": [[4, "desc"]],
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
                "ajax": ajax,
                "columns": columns,
                "error": function (xhr, error, thrown) {
                    console.log('DataTables Ajax error:', xhr, error, thrown);
                },

            });

            // showData(columns, ajax, '.data-table');
        </script>

        <script>
            let columns2 = [
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'priority',
                    name: 'priority'
                },
                {
                    data: 'period',
                    name: 'period'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ];

            let ajax2 = {
                "url": "{{ route('notice_type.datatable') }}",
                "type": "GET",
                data: function (d) {
                    d.priority1 = $('select[name="priority1"]').val();
                    d.period = $('input[name="period"]').val();
                    d.created = $('input[name="created"]').val();
                }
            };

            $('.data-table-1').DataTable({
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
            // showData1(columns2, ajax2, '.data-table-1');
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
