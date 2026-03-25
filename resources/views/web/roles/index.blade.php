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
            <h5 class="text-primary">إدارة الأدوار و الصلاحيات</h5>
            <div class="d-flex">
                <button type="button" class="main-button" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                    إضافة دور جديد
                </button>
            </div>
        </div>
        <hr class="hr-card">
        <div class="scroll">
            <table id="example" class="data-table user-table" style="width:100%">
                <thead>
                <tr>
                    <td> اسم الدور</td>
                    <td> عدد الصلاحيات</td>
                    <td> تاريخ الاضافة</td>
                    <td>العمليات</td>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gray d-flex flex-column align-items-start">
                    <h5 class="text-primary fs-18" id="addRoleModelLabel">إضافة دور جديد</h5>
                </div>
                <div class="modal-body">

                    <form id="addRoleForm" class="row g-3" action="{{ route('role.store') }}" method="POST">
                        @csrf
                        <div class="col-12">
                            <label for="name" class="form-label fs-14 fw-500 text-primary">اسم الدور <span
                                    class="text-red">*</span></label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="أدخل اسم الدور"
                                   required>
                            <div class="invalid-feedback" id="error-name"></div>
                        </div>

                        <input hidden name="guard_name" value="web">
                        <div class="col-12">
                            <div class="mt-2 change-check">
                                <input class="form-check-input me-2" name="guard_name" type="checkbox"
                                       value="user" id="defaultCheck">
                                <label class="form-check-label fs-14"
                                       for="defaultCheck">دور اساسي</label>
                            </div>
                        </div>

                        <div class="permissionDiv">
                            <hr>
                            <h4>الصلاحيات</h4>
                            <div class="row">
                                @foreach($permissions as $permission)
                                    <div class="col-6">
                                        <div class="mt-2 change-check">
                                            <input class="form-check-input me-2" name="permissions[]" type="checkbox"
                                                   value="{{ $permission->name }}" id="flexCheck{{ $loop->index }}">
                                            <label class="form-check-label fs-14"
                                                   for="flexCheck{{ $loop->index }}">{{ \App\Enum\PermissionEnum::from($permission->name)->lang() }}</label>
                                        </div>
                                        <div class="invalid-feedback" id="error-permissions"></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>


                        <div class="col-12 d-flex justify-content-between border-top pt-3 mt-4">
                            <button type="button" class="view border-0" data-bs-dismiss="modal">إلغاء</button>
                            <button type="submit" id="AddRole" class="main-button">إضافة الدور</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gray d-flex flex-column align-items-start">
                    <h5 class="text-primary fs-18" id="editUserModalLabel">تعديل الدور</h5>
                </div>
                <div class="modal-body">
                    <form id="editRoleForm" class="row g-3">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="role_id" id="roleId">

                        @csrf
                        <div class="col-12">
                            <label for="name" class="form-label fs-14 fw-500 text-primary">اسم الدور <span
                                    class="text-red">*</span></label>
                            <input name="name" type="text" class="form-control" id="edit-name"
                                   placeholder="أدخل اسم الدور"
                                   required>
                            <div class="invalid-feedback" id="error-edit-name"></div>
                        </div>

                        <div class="row">
                            @foreach($permissions as $permission)
                                <div class="col-6">
                                    <div class="mt-2 change-check">
                                        <input class="form-check-input me-2" name="permissions[]" type="checkbox"
                                               value="{{ $permission->name }}" id="flexCheck{{ $loop->index }}">
                                        <label class="form-check-label fs-14"
                                               for="flexCheck{{ $loop->index }}">{{ \App\Enum\PermissionEnum::from($permission->name)->lang() }}</label>
                                    </div>
                                    <div class="invalid-feedback" id="error-edit-permissions"></div>
                                </div>
                            @endforeach
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

    <style>
        .toast-custom {
            background-color: #857854 !important;
        }
    </style>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('input[name="guard_name"]').on('change', function () {
                if (this.checked == true) {
                    $('.permissionDiv').addClass('d-none');
                }else{
                    $('.permissionDiv').removeClass('d-none');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            // add Role Form
            $('#addRoleForm').on('submit', function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                let url = $(this).attr('action');

                $('.invalid-feedback').text('');
                $('.form-control, .form-select').removeClass('is-invalid');

                $.ajax({
                    url: url,
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('#AddRole').html('<span class="spinner-border spinner-border-sm mr-2"></span> جاري الإرسال ...').attr('disabled', true);
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
                        $('#addRoleModal').modal('hide');
                        $('#addRoleForm')[0].reset();
                        $('#example').DataTable().ajax.reload();
                        $('#AddRole').html('إضافة الدور').attr('disabled', false);
                    },
                    error: function (xhr) {
                        $('#AddRole').html('إضافة الدور').attr('disabled', false);

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

            $(document).on('click', '.edit', function () {
                let id = $(this).data('id');
                let name = $(this).data('name');
                let permissions = JSON.parse($(this).attr('data-permissions')); // استخدم attr بدلًا من data لتجنب التحويل التلقائي

                $('#editRoleModal #roleId').val(id);
                $('#editRoleModal input[name="name"]').val(name);

                $('#editRoleModal input[name="permissions[]"]').prop('checked', false);

                if (Array.isArray(permissions)) {
                    permissions.forEach(function (permission) {
                        $('#editRoleModal input[name="permissions[]"][value="' + permission + '"]').prop('checked', true);
                    });
                }

                $('#editRoleModal').modal('show');
            });

            // Edit Role Form
            $('#editRoleForm').on('submit', function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                let updateUrl = "{{ route('role.update', ':id') }}".replace(':id', $('#roleId').val());

                $('.invalid-feedback').text('');
                $('.form-control, .form-select').removeClass('is-invalid');

                $.ajax({
                    url: updateUrl,
                    method: "POST",
                    data: formData,
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
                        $('#editRoleModal').modal('hide');
                        $('#editRoleForm')[0].reset();
                        $('#example').DataTable().ajax.reload();
                        $('#submitUpdate').html('حفظ التعديلات').attr('disabled', false);

                    },
                    error: function (xhr) {
                        $('#submitUpdate').html('حفظ التعديلات').attr('disabled', false);

                        if (xhr.status == 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;
                            for (let key in errors) {
                                console.log(key);
                                $(`#edit-${key}`).addClass('is-invalid');
                                $(`#error-edit-${key}`).text(errors[key][0]).show();
                            }
                        } else {
                            toastr.error(xhr.responseJSON.message || 'حدث خطأ غير متوقع');
                        }

                    }
                });
            });

            // Delete Role
            $(document).on('click', '.delete', function () {
                let id = $(this).data('id');
                let deleteUrl = "{{ route('role.destroy', ':id') }}".replace(':id', id);
                Swal.fire({
                    icon: 'warning',
                    title: 'هل انت متاكد من حذف هذا الدور؟',
                    showCancelButton: true,
                    confirmButtonText: 'نعم',
                    cancelButtonText: 'لا',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: deleteUrl,
                            method: 'DELETE',
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
                                $('#example').DataTable().ajax.reload();
                            },
                            error: function (xhr) {
                                toastr.error(xhr.responseJSON.message || 'حدث خطأ غير متوقع');
                            }
                        });
                    }
                })
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#addRoleModel').on('hidden.bs.modal', function () {
                $(this).find('form')[0].reset();
                $('.invalid-feedback').text('');
                $('.form-control, .form-select').removeClass('is-invalid');
            });

        });

    </script>


    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "الكل"]
                ],
                "order":[
                    [3,"asc"]
                ],
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
                    "url": "{{ route('role.datatable') }}",
                    "type": "GET"
                },
                "columns": [
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'permissions_count',
                        name: 'permissions_count'
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
                    }
                ],
                "error": function (xhr, error, thrown) {
                    console.log('DataTables Ajax error:', xhr, error, thrown);
                },
            });
        });
    </script>
@endsection
