@extends('web.layouts.master')
@section('content')

    <div class="card-border mt-16">
        <div class="d-flex justify-content-between">
            <h5 class="text-primary">إدارة التنبيهات</h5>
        </div>
        <div>
            <div class="tabs">
                <div class="tabs-list d-flex mt-4">
                    <div class="show" data-content=".content-one">مستلمة</div>
                    <div data-content=".content-two">مرسلة</div>
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
                                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">مرسل التنبيه
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
                                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">الاولية
                                        <span class="text-red">*</span>
                                    </label>
                                    <select class="form-control" name="priority" style="background-color: white">
                                        <option value="">الكل</option>
                                            <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>منخفضة</option>
                                            <option value="mid" {{ request('priority') == 'mid' ? 'selected' : '' }}>متوسطة</option>
                                            <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>عالية</option>
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
                                    <td style="width: 30%;">عنوان التنبيه</td>
                                    <td>مرسل التنبيه</td>
                                    <td>الأولوية</td>
                                    <td>تاريخ الارسال</td>
                                    <td>حالة التنبيه</td>
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
                                ارسال تنبيه
                            </button>
                        </div>
                        <div class="form-filter card-details mt-4 mb-4">
                            <form class="row" action="" method="get">
                                <input type="hidden" name="div" value="2">
                                <div class="col-md-6 col-12 mb-3">
                                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">مرسل التنبيه
                                        <span class="text-red">*</span>
                                    </label>
                                    <select class="form-control" name="user1" style="background-color: white">
                                        <option value="">الكل</option>
                                        @php
                                            $users = \App\Models\User::orderBy('full_name')->get();
                                        @endphp
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ request('user1') == $user->id ? 'selected' : '' }}>{{ $user->full_name }}</option>
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
                                           value="{{ request('date1') }}">
                                </div>
                                <div class="footer text-start">
                                    <button type="submit" class="main-button">بحث</button>
                                </div>
                            </form>
                        </div>
                        <div class="scroll">
                            <table id="example" class="data-table-1" style="width: 100%">
                                <thead>
                                <tr>
                                    <td>عنوان التنبيه</td>
                                    <td>مرسل الى</td>
                                    <td>تاريخ الارسال</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="medium-priority">
                                                <i class="fa-regular fa-bell fa-lg"></i>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <h6 class="name-table mb-2">
                                                    تأخر وصول الحافلة إلى الموقع
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <img
                                                class="image-table"
                                                src="image/image1.png"
                                                alt="no-image"
                                            />
                                            <h6 class="name-table d-flex align-items-center">
                                                محمود ابراهيم القحطاني
                                            </h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-info">12 مايو 2024</div>
                                    </td>
                                    <td>
                                        <a href="notification-details.html" class="view">
                                            <img
                                                class="h-24"
                                                src="image/eye-icon.png"
                                                alt="no-image"
                                            />
                                            عرض
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="medium-priority">
                                                <i class="fa-regular fa-bell fa-lg"></i>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <h6 class="name-table mb-2">
                                                    تأخر وصول الحافلة إلى الموقع
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <img
                                                class="image-table"
                                                src="image/image1.png"
                                                alt="no-image"
                                            />
                                            <h6 class="name-table d-flex align-items-center">
                                                محمود ابراهيم القحطاني
                                            </h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-info">12 مايو 2024</div>
                                    </td>
                                    <td>
                                        <a href="notification-details.html" class="view">
                                            <img
                                                class="h-24"
                                                src="image/eye-icon.png"
                                                alt="no-image"
                                            />
                                            عرض
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="medium-priority">
                                                <i class="fa-regular fa-bell fa-lg"></i>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <h6 class="name-table mb-2">
                                                    تأخر وصول الحافلة إلى الموقع
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <img
                                                class="image-table"
                                                src="image/image1.png"
                                                alt="no-image"
                                            />
                                            <h6 class="name-table d-flex align-items-center">
                                                محمود ابراهيم القحطاني
                                            </h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-info">12 مايو 2024</div>
                                    </td>
                                    <td>
                                        <a href="notification-details.html" class="view">
                                            <img
                                                class="h-24"
                                                src="image/eye-icon.png"
                                                alt="no-image"
                                            />
                                            عرض
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                        إرسال تنبيه جديد
                    </h5>
                    <p class="text-secondary fs-14 fw-400">يرجى إدخال بيانات التنبيه</p>
                </div>
                <div class="modal-body">
                    <form class="row g-3 sendAlert" action="{{route('sendAlert')}}" method="POST">
                        <div class="col-12">
                            <div class="change-direction">
                                <label
                                    for="validationDefault01"
                                    class="form-label fs-14 fw-500 text-primary"
                                >عنوان التنبيه
                                    <span class="text-red">*</span>
                                </label>
                                <input
                                    type="text"
                                    class="form-control fs-12 fw-400 text-secondary bg-gray"
                                    id="validationDefault01"
                                    placeholder="أدخل عنوان التنبيه"
                                    required
                                    name="title"
                                />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="change-direction">
                                <label
                                    for="validationTextarea"
                                    class="form-label fs-14 fw-500 text-primary"
                                >وصف التنبيه
                                    <span class="text-red">*</span>
                                </label>
                                <textarea
                                    class="form-control fs-12 fw-400 text-secondary bg-gray h-150"
                                    id="validationTextarea"
                                    placeholder="وصف التنبيه"
                                    required
                                    name="body"
                                ></textarea>
                            </div>
                        </div>
                        <div class="col-12 d-flex flex-column">
                            <label
                                for="validationDefault04"
                                class="form-label fs-14 fw-500 text-primary"
                            >ارسال التنبيه الى
                                <span class="text-red">*</span>
                            </label>
                            <select
                                class="form-select w-100 fs-12 fw-400 text-primary bg-gray"
                                required
                                id="selectRoleUser"
                            >
                                <option value="">اختر</option>
                                <option value="role">الي دور</option>
                                <option value="user">الي موظف</option>
                            </select>
                        </div>

                        <div class="col-12 d-flex flex-column d-none div-role">
                            <label
                                for="validationDefault04"
                                class="form-label fs-14 fw-500 text-primary">
                                ارسال الي دور معين
                            </label>
                            <select name="role_id" class="form-select w-100 fs-12 fw-400 text-primary bg-gray">
                                <option value="">اختر الدور</option>
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 d-flex flex-column div-user d-none">
                            <label
                                for="validationDefault04"
                                class="form-label fs-14 fw-500 text-primary"
                            >ارسال التنبيه الى
                                <span class="text-red">*</span>
                            </label>
                            {{--                        the user_id can either be user_id or leader_id   --}}
                            <select
                                name="user_ids[]"
                                class="form-select w-100 fs-12 fw-400 text-primary bg-gray"
                                id="js-example-basic-single" multiple
                            >
                                <option disabled>اختر الموظف</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">
                                        {{$user->full_name}}
                                    </option>
                                @endforeach
                            </select>
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
                            <button type="submit" class="main-button" id="submitBtn">
                                إرسال تنبيه جديد
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
        });

        $(document).ready(function () {
            // Initialize Select2 for the create modal
            $('#selectRoleUser').on('change', function () {
                if ($(this).val() === 'role') {
                    $('.div-role').removeClass('d-none');
                    $('.div-user').addClass('d-none');
                } else if ($(this).val() === 'user') {
                    $('.div-role').addClass('d-none');
                    $('.div-user').removeClass('d-none');
                }
            })

        })

    </script>



    @include('web.layouts.datatable')



    {{--  send an alert  --}}
    <script>
        $(document).ready(function () {
            $('.sendAlert').on('submit', function (e) {
                e.preventDefault(); // Prevent default form submission

                let form = $(this);
                let url = form.attr('action');
                let submitBtn = form.find('#submitBtn');
                let formData = {
                    _method: 'POST',
                    title: form.find('input[name="title"]').val(),
                    body: form.find('textarea[name="body"]').val(),
                    user_ids: form.find('select[name="user_ids[]"]').val(),
                    role_id: form.find('select[name="role_id"]').val(),
                    // priority: form.find('select[name="priority"]').val()
                };

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: JSON.stringify(formData),
                    contentType: 'application/json',  // Ensure JSON format
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'   // Laravel expects this for JSON requests
                    },
                    beforeSend: function () {
                        submitBtn.html('<span class="spinner-border spinner-border-sm mr-2"></span> <span style="margin-left: 4px;">جاري الإرسال ...</span>')
                            .attr('disabled', true);
                    },
                    success: function (response) {
                        if (response.status) {
                            // toastr.success(response.msg);
                            $('.modal').modal('hide');
                            $('#example').DataTable().ajax.reload();
                            $('.statusBtn').attr('disabled', true).css({
                                'background-color': '#ccc',
                                'color': '#666',
                                'cursor': 'not-allowed',
                                'opacity': '0.6',
                                'border-color': '#aaa',
                                'pointer-events': 'none' // Prevents clicks
                            });

                            toastr.success(response.msg);
                        } else {
                            toastr.error(response.msg);
                        }
                    },
                    error: function (xhr) {
                        let errorMessage = xhr.responseJSON && xhr.responseJSON.msg ? xhr.responseJSON.msg : 'حدث خطأ ما';
                        toastr.error(errorMessage);
                    },
                    complete: function () {
                        submitBtn.html('تأكيد الاعتماد').attr('disabled', false);
                    }
                });

            });
        });
    </script>







    <script>
        let columns = [
            {
                data: 'title',
                name: 'title'
            },
            {
                data: 'user',
                name: 'user',
                searchable: false,
            },
            {
                data: 'priority',
                name: 'priority'
            },
            {
                data: 'created_at',
                name: 'created_at',
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
            "url": "{{ route('notificationManagement.datatable') }}",
            "type": "GET",
            data: function (d) {
                d.user = $('select[name=user]').val();
                d.priority = $('select[name=priority]').val();
                d.date = $('input[name=date]').val();
            }
        };

        $('.data-table').DataTable({
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
            "ajax": ajax,
            "columns": columns,
            "error": function (xhr, error, thrown) {
                console.log('DataTables Ajax error:', xhr, error, thrown);
            },

        });

    </script>

    <script>
        let columns2 = [
            {
                data: 'title',
                name: 'title'
            },
            {
                data: 'user',
                name: 'user',
                searchable: false,
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
            "url": "{{ route('alertManagement.datatable') }}",
            "type": "GET",
            data: function (d) {
                d.user = $('select[name=user1]').val();
                d.date = $('input[name=date1]').val();
            }
        };

        $('.data-table-1').DataTable({
            "processing": true,
            "serverSide": false,
            "order": [[2, "desc"]],
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

