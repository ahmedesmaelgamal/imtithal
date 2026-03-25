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

    <div class="card-border-shape mt-16">
        <div class="row">
            <div class="col-md-6 col-12 mb-3">
                <div class="card-home">
                    <h2 class="text-primary fw-700">{{$numberOfAttendanceToday}}</h2>
                    <div class="d-flex justify-content-between">
                        <p class="fs-14 text-secondary">عدد الحاضريين اليوم</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12 mb-3">
                <div class="">
                    <h2 class="text-red fw-700">{{$numberOfAttendance}}</h2>
                    <div class="d-flex justify-content-between">
                        <p class="fs-14 text-secondary">عدد الغائبين اليوم</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-border mt-16">
        <div class="d-flex justify-content-between flex-wrap">
            <h5 class="text-primary">سجل الحضور و الانصراف</h5>

            <button type="button" class="btn-filter">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                    <path
                            d="M19.25 5.41992H4.75L9.31174 11.1221C9.59544 11.4767 9.75 11.9173 9.75 12.3715V18.9199C9.75 19.4722 10.1977 19.9199 10.75 19.9199H13.25C13.8023 19.9199 14.25 19.4722 14.25 18.9199V12.3715C14.25 11.9173 14.4046 11.4767 14.6883 11.1221L19.25 5.41992Z"
                            stroke="#857854" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>

        <hr class="hr-card">
        <div class="form-filter card-details mt-4 mb-4">
            <form class="row" action="{{ route('attendance.index') }}" method="get">

                <div class="col-md-6 col-12 mb-3">
                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary"> من
                        <span class="text-red">*</span>
                    </label>
                    <input type="date" style="background-color: white;"
                           name="from"
                           class="form-control fs-12 fw-400 text-secondary bg-gray" id="validationDefault03"
                           value="{{ request('from') }}"
                           >
                </div>

                <div class="col-md-6 col-12 mb-3">
                    <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary"> الي
                        <span class="text-red">*</span>
                    </label>
                    <input type="date" style="background-color: white;"
                           name="to"
                           class="form-control fs-12 fw-400 text-secondary bg-gray" id="validationDefault03"
                           value="{{ request('to') }}"
                            >
                </div>
                <div class="footer text-start">
                    <button type="submit" class="main-button">بحث</button>
                </div>
            </form>
        </div>
        <div class="scroll">
            <table id="example" class="data-table user-table" style="width:100%">
                <thead>
                <tr>
                    <td> قائمه المستخدمين</td>
                    <td> الدور</td>
                    <td> عدد ايام الحضور</td>

                   <td> عدد ايام الغياب</td>
{{--                    <td> ايام الغياب</td>--}}
                    <td></td>
                </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection

@section('js')

    <script>
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
                "ajax": {
                    "url": "{{ route('attendance.datatable') }}",
                    "type": "GET",
                    data: function (d) {
                        d.from = $('input[name=from]').val();
                        d.to = $('input[name=to]').val();

                    }
                },
                "columns": [
                    {
                        data: 'name',
                        name: 'name'
                    },

                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'numberOfAttendances',
                        name: 'numberOfAttendances'
                    },
                    {
                        data: 'numberOfAbsences',
                        name: 'numberOfAbsences'
                    },
                    // }, {
                    //     data: 'daysNameOfAbsences',
                    //     name: 'daysNameOfAbsences'
                    // },


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
