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
            <h5 class="text-primary">تقارير انتهاء الذروة</h5>
        </div>
        <hr class="hr-card">
        <div class="scroll">
            <table id="example1" class="data-table ticket-table" style="width:100%">
                <thead>
                <tr>
                    <td>الموقع</td>
                    <td>عدد الحافلات</td>
                    <td>تاريخ الانتهاء</td>
                    <td>المشرف</td>
                </tr>
                </thead>
            </table>
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
            $('.ticket-table').DataTable({
                "serverSide": false,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "الكل"]
                ],
                "order": [[2, "desc"]],
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
                    "url": "{{ route('buses.datatable') }}",
                    "type": "GET"
                },
                "columns": [
                    {
                        data: 'area_id',
                        name: 'area_id'
                    },
                    {
                        data: 'bus_count',
                        name: 'bus_count'
                    },
                    {
                        data: 'end_time',
                        name: 'end_time'
                    },
                    {
                        data: 'user_id',
                        name: 'user_id'
                    }
                ],
                "error": function (xhr, error, thrown) {
                    console.log('DataTables Ajax error:', xhr, error, thrown);
                },
            });
        });
    </script>
@endsection
