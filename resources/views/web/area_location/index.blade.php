@extends('web.layouts.master')
@section('content')
    <div class="breadcrumb mt-4 mb-4">
        <a href="{{route('adminHome')}}"><img class="h-24" src="{{ asset('web/image/home.png') }}" alt="no-icon"></a>
        <img class="h-24 me-3 ms-3" src="{{ asset('web/image/icon-breadcrumb.png') }}" alt="no-icon">
        <a class="link-breadcrumb" href="{{ route('area') }}">إدارة المناطق</a>
        <img class="h-24 me-3 ms-3" src="{{ asset('web/image/icon-breadcrumb.png') }}" alt="no-icon">
        <span class="fs-14 fw-400 text-secondary"> {{ $area->name }}</span>
    </div>
    <div class="card-border mt-16">
        <div class="d-flex justify-content-between flex-wrap">
            <h5 class="text-primary">{{ $area->name }}</h5>
            <div class="d-flex">
                <button type="button" class="btn-refuse" data-bs-toggle="modal" data-bs-target="#deleteModel">
                    حذف الموقع
                </button>
            </div>
        </div>
        <hr class="hr-card">
        <div class="card-details">
            <h5 class="text-primary"> المشرف</h5>
            <div class="bg-white" style="border-radius: 10px; padding: 16px">
                <div class="row">
                    @if (isset($supervisorUsers))
                        @foreach($supervisorUsers as $leader)

                            <div class="col-lg-4">
                                <div class="d-flex">
                                    <div>
                                        <img class="image-table"
                                             src="{{ getFile($leader->image ,'assets/uploads/avatar.png') }}"
                                             alt="no-image">

                                            <h6 class="name-table d-flex align-items-center">{{ $leader->full_name }}
                                            </h6>

                                        <p class="fs-12 fw-400 text-secondary">سعودي</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="table-info">{{ $leader->national_id }}</div>
                            </div>
                            <div class="col-lg-2">
                                <div class="table-info">{{$leader->getRoleNames()->first()}}</div>
                            </div>
                            <div class="col-lg-2">
                                <div class="table-info">
                                    {{ \Carbon\Carbon::parse($leader->created_at)->locale('ar')->translatedFormat('d F Y') }}
                                </div>
                            </div>
                            <div class="col-lg-2 d-flex justify-content-end">
                                {{--                            <a class="view">--}}
                                {{--                                <img class="h-24" src="{{ asset('web/image/user-cross.svg') }}" alt="no-image">--}}
                                {{--                                تغيير--}}
                                {{--                            </a>--}}
                            </div>
                        @endforeach
                    @else
                        لا يوجد مشرفين
                    @endif
                </div>
            </div>
        </div>
        <div class="card-details mt-3">
            <div class="d-flex justify-content-between flex-wrap">
                <h5 class="text-primary">الفريق الميدانى</h5>
                <div class="d-flex">
{{--                    <button type="button" class="btn-filter change-color">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25"--}}
{{--                             fill="none">--}}
{{--                            <path--}}
{{--                                d="M19.25 5.41992H4.75L9.31174 11.1221C9.59544 11.4767 9.75 11.9173 9.75 12.3715V18.9199C9.75 19.4722 10.1977 19.9199 10.75 19.9199H13.25C13.8023 19.9199 14.25 19.4722 14.25 18.9199V12.3715C14.25 11.9173 14.4046 11.4767 14.6883 11.1221L19.25 5.41992Z"--}}
{{--                                stroke="#857854" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                        </svg>--}}
{{--                    </button>--}}
                    <button type="button" class="main-button" data-bs-toggle="modal" data-bs-target="#addModal">
                        اضافة
                    </button>
                </div>
            </div>
            <div class="bg-white mt-4" style="border-radius: 10px;">
                <div class="scroll">
                    <table id="example" class="data-table areaTeam-table" style="width:100%">
                        <thead>
                        <tr>
                            <td> الاسم / الجنسية</td>
                            <td> رقم الهوية</td>
                            <td> الدور</td>
                            <td> تاريخ الاضافة</td>
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



    <!-- delete Modal -->
    <div class="modal fade" id="deleteModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gray d-flex flex-column align-items-start">
                    <h5 class="text-primary fs-18" id="exampleModalLabel">
                        حذف الموقع
                    </h5>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{ route('area.delete', ['id' => $area->id]) }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $area->id }}">
                        <p class="text-danger fs-20 fw-600"> هل تريد حذف الموقع ؟</p>

                        <div class="col-12 d-flex justify-content-between border-top pt-3 mt-4">
                            <button type="button" class="view border-0" data-bs-dismiss="modal">
                                الغاء
                            </button>
                            <button type="submit" class="btn-refuse">
                                حذف
                            </button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- delete Modal -->

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div id="modal-content-2" class="modal-content">
                <div class="modal-header bg-gray d-flex flex-column align-items-start">
                    <h5 class="text-primary fs-18" id="exampleModalLabel">
                        إضافة عضو جديد
                    </h5>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="addNewUserAreaTeam" action="{{ route('areaTeam.storeNewMember') }}" method="post">
                        @csrf
                        <div class="col-12 d-flex flex-column">
                            <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">الفريق
                                الميداني
                                <span class="text-red">*</span>
                            </label>
                            <input type="hidden" name="area_id" value="{{ $area->id }}">

                            <select class="form-select w-100 fs-12 fw-400 text-primary bg-gray" name="user_ids[]"
                                    id="js-example-basic-single" multiple required>
                                @foreach($UsersNotInTeam as $UserNotInTeam)
                                    <option value="{{$UserNotInTeam->id}}">
                                        {{$UserNotInTeam->full_name}}
                                    </option>


                                @endforeach

                            </select>
                        </div>

                        <div class="col-12 d-flex justify-content-between border-top pt-3 mt-4">
                            <button type="button" class="view border-0" data-bs-dismiss="modal">
                                الغاء
                            </button>
                            <button type="submit" id="addNewUserAreaTeamButton" class="main-button">
                                إضافة عضو
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
<style>
    .toast-custom {
        background-color: #857854 !important;
    }
</style>
@section('js')
    <script>
        $(document).ready(function () {
            $("#js-example-basic-single").select2({
                dropdownParent: $("#modal-content-2"),
            });
            // $("#js-example-basic-single1").select2({
            //     dropdownParent: $("#"),
            // });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('.areaTeam-table').DataTable({
                "serverSide": false,
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
                "ajax": {
                    "url": "{{ route('areaTeam.datatable') }}",
                    "type": "GET",
                    "data": {
                        "area_id": "{{ $area->id }}"
                    }

                },
                "columns": [
                    {
                        data: 'user_id',
                        name: 'user_id'
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

    <script>
$('#addNewUserAreaTeam').on('submit', function (e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var type = form.attr('method');
            var data = form.serialize();

            $.ajax({
                url: url,
                data: data,
                type: type,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {
                    $('#addNewUserAreaTeamButton').html('<span class="spinner-border spinner-border-sm mr-2"></span> جاري الإرسال ...').attr('disabled', true);
                },
                success: function (response) {
                    if (response.status == true) {
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
                        toastr.success(response.message);
                        $('#addModal').modal('hide');
                        $('.areaTeam-table').DataTable().ajax.reload();
                        $('#addNewUserAreaTeamButton').html('إضافة عضو').attr('disabled', false);
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                }
            });
        });

    </script>

    <script>
$(document).on('click', '.deleteAreaTeamMember', function (e) {
    e.preventDefault();

    var url = $(this).attr('href');

    $.ajax({
        url: url,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.status === true) {
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
                $('.areaTeam-table').DataTable().ajax.reload();
            } else {
                toastr.error(response.message);
            }
        }
    });
});
    </script>

@endsection
