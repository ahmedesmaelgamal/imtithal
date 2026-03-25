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
            <h5 class="text-primary">إدارة المواسم</h5>
            <div class="d-flex">
                <button type="button" class="main-button" data-bs-toggle="modal" data-bs-target="#addSeasonModal">
                    أضافه موسم
                </button>

            </div>
        </div>
        <hr class="hr-card">

        <div class="scroll">
            <table id="example" class="data-table season-table" style="width:100%">
                <thead>
                <tr>
                    <td> اسم الموسم</td>
                    <td> الحالة</td>
                    <td></td>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="modal fade" id="addSeasonModal" tabindex="-1" aria-labelledby="addSeasonModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gray d-flex flex-column align-items-start">
                    <h5 class="text-primary fs-18" id="addSeasonModalLabel">إضافة موسم</h5>
                    <p class="text-secondary fs-14 fw-400">يرجى إدخال بيانات الموسم الجديد لإضافته إلى النظام</p>

                </div>
                <div class="modal-body">
                    <form id="addSeasonForm" class="row g-3" action="{{ route('seasons.store') }}" method="POST">
                        @csrf
                        <div class="col-12">
                            <label for="full_name" class="form-label fs-14 fw-500 text-primary">اسم الموسم <span
                                        class="text-red">*</span></label>
                            <input name="name" type="text" class="form-control" id="name"
                                   placeholder="أدخل موسم جديد" required>
                            <div class="invalid-feedback" id="error_name"></div>
                        </div>


                        <div class="col-12 d-flex justify-content-between border-top pt-3 mt-4">
                            <button type="button" class="view border-0" data-bs-dismiss="modal">إلغاء</button>
                            <button type="submit" id="addSeason" class="main-button"> إضافة</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editSeasonModal" tabindex="-1" aria-labelledby="editSeasonModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gray d-flex flex-column align-items-start">
                    <h5 class="text-primary fs-18" id="editSeasonModalLabel">تعديل موسم</h5>
                    <p class="text-secondary fs-14 fw-400">يرجى إدخال بيانات الموسم الجديد لإضافته إلى النظام</p>

                </div>
                <div class="modal-body">
                    <form id="editSeasonForm" class="row g-3">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="editSeasonId">

                        <div class="col-12">
                            <label for="name" class="form-label fs-14 fw-500 text-primary">اسم الموسم <span
                                        class="text-red">*</span></label>
                            <input name="name" type="text" class="form-control" id="edit_name"
                                   required>
                            <div class="invalid-feedback" id="error_name"></div>
                        </div>


                        <div class="col-12 d-flex justify-content-between border-top pt-3 mt-4">
                            <button type="button" class="view border-0" data-bs-dismiss="modal">إلغاء</button>
                            <button type="submit" id="submitUpdate" class="main-button">حفظ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>

        $(document).ready(function () {

            $(document).on('click', '.deleteSeason', function (e) {
                e.preventDefault();
                let url = $(this).attr('href');
                let Id = $(this).data('id');

                $.ajax({
                    url: url,
                    method: "DELETE",
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: Id

                    },
                    success: function (response) {
                        if (response.status) {
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
                            $('.data-table').DataTable().ajax.reload();
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function (xhr) {
                        toastr.error(xhr.responseJSON.message);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#addSeasonForm').on('submit', function (e) {
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
                        $('#addSeason').html('<span class="spinner-border spinner-border-sm mr-2"></span> جاري الإرسال ...').attr('disabled', true);
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
                        $('#addSeasonModal').modal('hide');
                        $('#addSeasonForm')[0].reset();
                        $('#example').DataTable().ajax.reload();
                        $('#addSeason').html('إرسال دعوة').attr('disabled', false);
                    },
                    error: function (xhr) {
                        $('#addSeason').html('إرسال دعوة').attr('disabled', false);

                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;
                            for (let key in errors) {
                                $(`#${key}`).addClass('is-invalid');
                                $(`#error_${key}`).text(errors[key][0]).show();
                            }
                        } else {
                            toastr.error(xhr.responseJSON.message || 'حدث خطأ غير متوقع');
                        }
                    }
                });
            });


            $('#editSeasonForm').on('submit', function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                let updateUrl = "{{ route('seasons.update', ':id') }}".replace(':id', $('#editSeasonId').val());

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
                        console.log(response);
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
                        $('#editSeasonModal').modal('hide');
                        $('#editSeasonForm')[0].reset();
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
                                $(`#error_edit${key}`).text(errors[key][0]).show();
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
            $('#addSeasonModal').on('hidden.bs.modal', function () {
                $(this).find('form')[0].reset();
                $('.invalid-feedback').text('');
                $('.form-control, .form-select').removeClass('is-invalid');
            });

        });

    </script>

    {{-- for the update status --}}
    <script>
        function updateStatus(element) {
            var Id = element.getAttribute('data-id');
            var status = element.checked ? 1 : 0;

            console.log(Id, status);


            let url = "{{ route('seasons.updateStatus') }}";

            $.ajax({
                url: url,
                method: 'POST',
                contentType: 'application/json',
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: JSON.stringify({
                    status: status,
                    id: Id
                }),
                success: function (response) {
                    if (response.redirect) {
                        toastr.success(response.message, '', {
                            "progressBar": true,
                            "timeOut": "3000",
                            "positionClass": "toast-top-right",
                        });

                        setTimeout(() => {
                            window.location.href = response.redirect;
                        }, 2500);

                        return;
                    }

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

                    $('.data-table').DataTable().ajax.reload();
                },

                error: function (xhr) {
                    //make status button checked again
                    element.checked = !element.checked;
                    toastr.error(xhr.responseJSON.message || 'حدث خطأ غير متوقع');
                }
            });
        }
    </script>



    {{-- for the edit modal --}}
    <script>
        $(document).ready(function () {
            $(document).on('click', '.edit', function () {
                let Id = $(this).data('id');
                let url = "{{ route('seasons.edit', ':id') }}".replace(':id', Id);
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function (data) {
                        console.log(data);
                        $('#editSeasonId').val(data.id);
                        $('#edit_name').val(data.name);

                        $('#editSeasonModal').modal('show');

                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching user data:', error);
                    }
                });
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
            "url": "{{ route('season.datatable') }}",
            "type": "GET",

        };

        $(document).ready(function () {
            $('.season-table').DataTable({
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
                "serverSide": true,
                "ajax": ajax,
                "columns": columns,
                "error": function (xhr, error, thrown) {
                    console.log('DataTables Ajax error:', xhr, error, thrown);
                },
            });
        });
    </script>
@endsection
