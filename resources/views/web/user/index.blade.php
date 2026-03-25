@extends('web.layouts.master')
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <div class="card-border mt-16">
        <div class="d-flex justify-content-between flex-wrap">
            <h5 class="text-primary">إدارة الموظفين</h5>
            <div class="d-flex">
                <button type="button" class="main-button" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    إضافة موظف
                </button>

            </div>
        </div>
        <hr class="hr-card">
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
                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">رقم الهوية
                        <span class="text-red">*</span>
                    </label>
                    <input type="text" class="form-control" name="national" style="background-color: white"
                           placeholder="ادخل رقم الهوية" value="{{ request('national') }}">
                </div>
                <div class="col-md-6 col-12 mb-3">
                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">الدور
                        <span class="text-red">*</span>
                    </label>
                    <select class="form-control" name="role" style="background-color: white">
                        <option value="">الكل</option>
                        @foreach(\Spatie\Permission\Models\Role::where('guard_name','user')->latest()->get() as $role)
                            <option
                                value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 col-12 mb-3">
                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">الموقع
                        <span class="text-red">*</span>
                    </label>
                    <select class="form-control" name="area" style="background-color: white">
                        <option value="">الكل</option>
                        @foreach(\App\Models\Area::get() as $area)
                            <option
                                value="{{ $area->id }}" {{ request('area') == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 col-12 mb-3">
                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">حالة الموظف
                        <span class="text-red">*</span>
                    </label>
                    <select class="form-control" name="status" style="background-color: white">
                        <option value="all">الكل</option>
                        <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>مفعل</option>
                        <option value="0" {{ request()->has('status') ? (request('status') == 0 ? 'selected' : '') :'' }}>غير مفعل</option>
                    </select>
                </div>
                <div class="col-md-6 col-12 mb-3">
                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">الوردية
                        <span class="text-red">*</span>
                    </label>
                    <select class="form-control" name="setting_id" style="background-color: white">
                        <option value="">الكل</option>
                        @foreach($shifts as $shift)
                            <option
                                value="{{ $shift->id }}" {{ request('setting_id') == $shift->id ? 'selected' : '' }}>{{ $shift->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="footer d-flex justify-content-start align-items-center">
                    <a href="{{ route('users.index') }}" class="btn-reset-filter text-secondary fs-14 fw-500 mx-3 text-decoration-none">إعادة تعيين الفلتر</a>
                    <button type="submit" class="main-button">بحث</button>
                </div>
            </form>
        </div>
        <div class="scroll">
            <table id="example" class="data-table user-table" style="width:100%">
                <thead>
                <tr>
                    <td> الاسم / الجنسية</td>
                    <td> رقم الهوية</td>
                    <td> الدور</td>
                    <td style="width: 30%;"> المواقع</td>
                    <td> تاريخ الاضافة</td>
                    <td> حالة الموظف</td>
                    <td></td>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gray d-flex flex-column align-items-start">
                    <h5 class="text-primary fs-18" id="addUserModalLabel">إضافة موظف جديد</h5>
                    <p class="text-secondary fs-14 fw-400">يرجى إدخال بيانات الموظف الجديد لإضافته إلى النظام</p>

                </div>
                <div class="modal-body">
                    <form id="addUserForm" class="row g-3" action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="col-12">
                            <label for="full_name" class="form-label fs-14 fw-500 text-primary">الاسم الكامل <span
                                    class="text-red">*</span></label>
                            <input name="full_name" type="text" class="form-control" id="full_name"
                                   placeholder="أدخل الاسم الكامل" required>
                            <div class="invalid-feedback" id="error-full_name"></div>
                        </div>

                        <div class="col-12">
                            <label for="national_id" class="form-label fs-14 fw-500 text-primary">رقم الهوية <span
                                    class="text-red">*</span></label>
                            <input name="national_id" type="text" class="form-control" id="national_id"
                                   placeholder="أدخل رقم الهوية" required maxlength="10">
                            <div class="invalid-feedback" id="error-national_id"></div>
                        </div>

                        <div class="col-6">
                            <label for="phone" class="form-label fs-14 fw-500 text-primary">رقم الجوال <span
                                    class="text-red">*</span></label>
                            <div class="input-group">
                                <input name="phone" type="number" class="form-control" id="phone" pattern="[0-9]*"
                                       placeholder="أدخل رقم الجوال" required>
                                <span class="input-group-text border-0 fs-12 fw-400 text-primary bg-gray">+966</span>
                                <div class="invalid-feedback" id="error-phone"></div>
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="email" class="form-label fs-14 fw-500 text-primary">البريد الإلكتروني <span
                                    class="text-red">*</span></label>
                            <input name="email" type="email" class="form-control" id="email"
                                   placeholder="أدخل البريد الإلكتروني" required>
                            <div class="invalid-feedback" id="error-email"></div>
                        </div>

                        <div class="col-6">
                            <label for="role" class="form-label fs-14 fw-500 text-primary">دور الموظف <span
                                    class="text-red">*</span></label>
                            <select name="role" class="form-select w-100" id="role" required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="error-role"></div>
                        </div>
                        <div class="col-6">
                            <label  class="form-label fs-14 fw-500 text-primary">ورديات الموظف <span
                                    class="text-red">*</span></label>
                            <select name="setting_ids[]" class="form-select w-100" id="js-example-basic-single" multiple required>
                                @foreach ($shifts as $shift)
                                    <option value="{{ $shift->id }}"  >{{ $shift->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 d-flex justify-content-between border-top pt-3 mt-4">
                            <button type="button" class="view border-0" data-bs-dismiss="modal">إلغاء</button>
                            <button type="submit" id="AddUser" class="main-button">إرسال دعوة</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gray d-flex flex-column align-items-start">
                    <h5 class="text-primary fs-18" id="editUserModalLabel">تعديل الموظف</h5>
                    <p class="text-secondary fs-14 fw-400">يرجى إدخال بيانات الموظف الجديد لإضافته إلى النظام</p>

                </div>
                <div class="modal-body">
                    <form id="editUserForm" class="row g-3">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="editUserId">

                        <div class="col-12">
                            <label for="editFullName" class="form-label fs-14 fw-500 text-primary">الاسم الكامل <span
                                    class="text-red">*</span></label>
                            <input name="full_name" type="text" class="form-control" id="editfull_name" required>
                            <div class="invalid-feedback" id="error-editfull_name"></div>
                        </div>

                        <div class="col-12">
                            <label for="editNationalId" class="form-label fs-14 fw-500 text-primary">رقم الهوية <span
                                    class="text-red">*</span></label>
                            <input name="national_id" type="text" class="form-control" id="editnational_id" required
                                   maxlength="10">
                            <div class="invalid-feedback" id="error-editnational_id"></div>
                        </div>

                        <div class="col-6">
                            <label for="editPhone" class="form-label fs-14 fw-500 text-primary">رقم الجوال <span
                                    class="text-red">*</span></label>
                            <div class="input-group">
                                <input name="phone" type="text" class="form-control" id="editphone" required>
                                <span class="input-group-text border-0 fs-12 fw-400 text-primary bg-gray">+966</span>
                                <div class="invalid-feedback" id="error-editphone"></div>
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="editEmail" class="form-label fs-14 fw-500 text-primary">البريد الإلكتروني <span
                                    class="text-red">*</span></label>
                            <input name="email" type="email" class="form-control" id="editemail" required>
                            <div class="invalid-feedback" id="error-editemail"></div>
                        </div>

                        <div class="col-12">
                            <label for="editRole" class="form-label fs-14 fw-500 text-primary">دور الموظف <span
                                    class="text-red">*</span></label>
                            <select name="role" class="form-select w-100" id="editRole" required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="error-editRole"></div>
                        </div>

                        
                        <div class="col-12">
                            <label for="setting_ids" class="form-label fs-14 fw-500 text-primary">ورديات الموظف <span
                                    class="text-red">*</span></label>
                            <select name="setting_ids[]" class="form-select w-100" id="setting_ids" required>
                                @foreach ($shifts as $shift)
                                    <option value="{{ $shift->id }}">{{ $shift->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="error-editRole"></div>
                        </div>

                        <div class="col-12 d-flex justify-content-between border-top pt-3 mt-4">
                            <button type="button" class="view border-0" data-bs-dismiss="modal">إلغاء</button>
                            <button type="submit" id="submitUpdate" class="main-button">حفظ التعديلات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="showUserReportModal" tabindex="-1" aria-labelledby="editUserModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gray d-flex flex-column align-items-start">
                    <h5 class="text-primary fs-18" id="editUserModalLabel">طباعة التقرير اليومي للموظف</h5>
                    <p class="text-secondary fs-14 fw-400">يرجي اختيار التقرير اليومي لطباعته</p>

                </div>
                <div class="modal-body">
                    <form id="UserReportForm" class="row g-3">

                        <div class="col-12">
                            <label for="daily_assign_report_id" class="form-label fs-14 fw-500 text-primary">اختيار
                                التقرير
                                <span
                                    class="text-red">*</span></label>
                            <select name="daily_assign_report_id" class="form-select w-100" id="daily_assign_report_id"
                                    required>

                            </select>
                        </div>

                        <div class="col-12 d-flex justify-content-between border-top pt-3 mt-4">
                            <button type="button" class="view border-0" data-bs-dismiss="modal">إلغاء</button>
                            <button type="submit" id="submitUpdate" class="main-button">طباعة التقرير</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <style>
        .toast-custom {
            background-color: #857854 !important;
        }
        .btn-reset-filter:hover {
            color: var(--bs-primary) !important;
            text-decoration: underline !important;
        }
    </style>
@endsection

@section('js')

    <script>
             $("#js-example-basic-single").select2({
                dropdownParent: $("#addUserModal .modal-content"),
            });
        $(document).ready(function () {

            $(document).on('click', '.deleteUser', function (e) {
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
                            $('.data-table').DataTable().ajax.reload();
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
            $('#addUserForm').on('submit', function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                let url = $(this).attr('action');

                $('.invalid-feedback').text('');
                $('.form-control, .form-select').removeClass('is-invalid');

                $.ajax({
                    url: url,
                    method: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#AddUser').html('<span class="spinner-border spinner-border-sm mr-2"></span> جاري الإرسال ...').attr('disabled', true);
                    },
                    success: function (response) {
                        toastr.success(response.message, '', {
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
                        $('#addUserModal').modal('hide');
                        $('#addUserForm')[0].reset();
                        $('#example').DataTable().ajax.reload();
                        $('#AddUser').html('إرسال دعوة').attr('disabled', false);
                    },
                    error: function (xhr) {
                        $('#AddUser').html('إرسال دعوة').attr('disabled', false);

                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;
                            for (let key in errors) {
                                $(`#${key}`).addClass('is-invalid');
                                $(`#error-${key}`).text(errors[key][0]).show();
                            }
                        } else {
                            toastr.error(xhr.responseJSON.message || 'حدث خطأ غير متوقع');
                        }
                    }
                });
            });


            $('#editUserForm').on('submit', function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                let updateUrl = "{{ route('users.update', ':id') }}".replace(':id', $('#editUserId').val());

                $('.invalid-feedback').text('');
                $('.form-control, .form-select').removeClass('is-invalid');

                $.ajax({
                    url: updateUrl,
                    method: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#submitUpdate').html('<span class="spinner-border spinner-border-sm mr-2"></span> جاري الإرسال ...').attr('disabled', true);
                    },
                    success: function (response) {
                        toastr.success(response.message, '', {
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
                        $('#editUserModal').modal('hide');
                        $('#editUserForm')[0].reset();
                        $('#example').DataTable().ajax.reload();
                        $('#submitUpdate').html('حفظ التعديلات').attr('disabled', false);

                    },
                    error: function (xhr) {
                        $('#submitUpdate').html('حفظ التعديلات').attr('disabled', false);

                        if (xhr.status == 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;
                            for (let key in errors) {
                                console.log(key);
                                $(`#edit${key}`).addClass('is-invalid');
                                $(`#error-edit${key}`).text(errors[key][0]).show();
                            }
                        } else {
                            toastr.error(xhr.responseJSON.message || 'حدث خطأ غير متوقع');
                        }

                    }
                });
            });

            function capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }
        });

    </script>

    <script>
        $(document).ready(function () {
            $('#addUserModal').on('hidden.bs.modal', function () {
                $(this).find('form')[0].reset();
                $('.invalid-feedback').text('');
                $('.form-control, .form-select').removeClass('is-invalid');
            });

        });

    </script>

    {{-- for the update status --}}
    <script>
        function updateStatus(element) {
            var userId = element.getAttribute('data-id');
            var status = element.checked ? 1 : 0;

            let url = "{{ route('users.updateStatus', ':id') }}".replace(':id', userId);

            $.ajax({
                url: url,
                method: 'PUT',
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: JSON.stringify({
                    status: status
                }),
                success: function (response) {
                    toastr.success(response.message, '', {
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
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>



    {{-- for the edit modal --}}
    <script>
        $(document).ready(function () {
            $(document).on('click', '.edit', function () {
                let userId = $(this).data('id');
                let url = "{{ route('users.edit', ':id') }}".replace(':id', userId);
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function (data) {
                        $('#editUserId').val(data.id);
                        $('#editUserEmail').val(data.email);
                        $('#editfull_name').val(data.full_name);
                        $('#editnational_id').val(data.national_id);
                        $('#editphone').val(data.phone);
                        $('#editemail').val(data.email);
                        $('#setting_ids').val(data.setting_ids).trigger('change'); // Fix for Select2
                        $('#setting_ids').select2({
                            dropdownParent: $("#editUserModal .modal-content"),
                            multiple: true
                        });
                        $('#editRole').val(data.role).trigger('change'); // Fix for Select2
                        $('#submitUpdate').attr('data-id', data.id); // Fix for Select2
                        $('#editUserModal').modal('show');

                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching user data:', error);
                    }
                });
            });
        });


        $(document).ready(function () {
            $(document).on('click', '.reportUser', function () {
                let userId = $(this).data('id');
                let url = "{{ route('userReports', ':id') }}".replace(':id', userId);
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function (data) {
                        let options = {};
                        let reportData = data.reports;
                        if (reportData.length === 0) {
                            $('#daily_assign_report_id').html(`
                                <option value="" disabled selected>لا يوجد تقارير</option>
                            `);
                            $('#showUserReportModal').modal('show');
                            return;
                        }
                        reportData.forEach(function (report) {
                            let reportId = report.id;
                            let reportName = report.daily_report.title;
                            options[reportId] = reportName;
                        })

                        $('#daily_assign_report_id').html(`
                            <option value="" disabled selected>اختر التقرير</option>
                            ${Object.keys(options).map(function (key) {
                            return `<option value="${key}">${options[key]}</option>`;
                        })}
                        `);

                        $('#showUserReportModal').modal('show');
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching user data:', error);
                    }
                });
            });

            $('#UserReportForm').on('submit', function (e) {
                e.preventDefault();
                var form = $(this);
                var url = "{{ route('printDailyReport') }}" + "?daily_report_id=" + $('#daily_assign_report_id').val();
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (response) {
                        if (response.status) {
                            var printWindow = window.open('', '_blank');
                            printWindow.document.write(response.html);
                        }
                    },
                    error: function (xhr) {
                        toastr.error(xhr.responseJSON.msg);
                    }
                });
            })
        });
    </script>



    {{-- for the phone number (add +699 before the number) --}}
    <script>
        $(document).ready(function () {
            // Handle button click to populate modal content
            $(document).on('click', '.view', function () {
                let areasJson = $(this).attr("data-areas"); // Get the areas JSON safely

                try {
                    let areas = JSON.parse(areasJson); // Convert JSON to array

                    if (!Array.isArray(areas)) {
                        console.error("Parsed data is not an array:", areas);
                        return;
                    }

                    let content = "";
                    areas.forEach((area, index) => {
                        content += `
                    <div class="col-md-6 col-12 mb-3">
                        <p class="text-secondary fs-14 fw-400 mb-2">موقع ${index + 1}</p>
                        <p class="text-primary fs-14 fw-500">${area}</p>
                    </div>
                `;
                    });

                    $("#modalBodyContent").html(content); // Insert content into modal
                } catch (error) {
                    console.error("Error parsing JSON:", error);
                    console.log("Raw data-areas content:", areasJson);
                }
            });

            // Prepend +966 to phone number on form submit
            $('form').on('submit', function () {
                let phoneInput = $('#validationDefaultUsername');
                let phoneValue = phoneInput.val();
                if (!phoneValue.startsWith('+966')) {
                    phoneInput.val('+966' + phoneValue);
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            // Handle button click to populate modal content
            $(document).on('click', '.view', function () {
                let areasJson = $(this).attr("data-areas"); // Get the areas JSON safely

                try {
                    let areas = JSON.parse(areasJson); // Convert JSON to array

                    if (!Array.isArray(areas)) {
                        console.error("Parsed data is not an array:", areas);
                        return;
                    }

                    let content = "";
                    areas.forEach((area, index) => {
                        content += `
                        <div class="col-md-6 col-12 mb-3">
                            <p class="text-secondary fs-14 fw-400 mb-2">موقع ${index + 1}</p>
                            <p class="text-primary fs-14 fw-500">${area}</p>
                        </div>
                    `;
                    });

                    $("#modalBodyContent").html(content); // Insert content into modal
                } catch (error) {
                    console.error("Error parsing JSON:", error);
                    console.log("Raw data-areas content:", areasJson);
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
                data: 'national_id',
                name: 'national_id'
            },
            {
                data: 'role',
                name: 'role'
            },
            {
                data: 'area_location',
                name: 'area_location'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false
            }
        ];

        let ajax = {
            "url": "{{ route('users.datatable') }}",
            "type": "GET",
            data: function (d) {
                d.national = $('input[name="national"]').val();
                d.role = $('select[name="role"]').val();
                d.area = $('select[name="area"]').val();
                d.status = $('select[name="status"]').val();
                d.setting_id = $('select[name="setting_id"]').val();
            }
        };

        $(document).ready(function () {
            $('.user-table').DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "الكل"]
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
                "processing": true,
                "serverSide": false,
                "ajax": ajax,
                "columns": columns,
                "order": [[6, 'desc']],
                "error": function (xhr, error, thrown) {
                    console.log('DataTables Ajax error:', xhr, error, thrown);
                },
            });
        });
    </script>
@endsection
