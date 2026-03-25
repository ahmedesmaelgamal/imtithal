@extends('web.layouts.master')
@section('content')
    <div class="card-border mt-16">
        <div class="d-flex justify-content-between">
            <h5 class="text-primary">سجلات عمليات النظام </h5>
            <div class="d-flex">
{{--                <button type="button" class="btn-filter">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">--}}
{{--                        <path--}}
{{--                            d="M19.25 5.41992H4.75L9.31174 11.1221C9.59544 11.4767 9.75 11.9173 9.75 12.3715V18.9199C9.75 19.4722 10.1977 19.9199 10.75 19.9199H13.25C13.8023 19.9199 14.25 19.4722 14.25 18.9199V12.3715C14.25 11.9173 14.4046 11.4767 14.6883 11.1221L19.25 5.41992Z"--}}
{{--                            stroke="#857854" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                    </svg>--}}
{{--                </button>--}}
            </div>
        </div>
        <hr class="hr-card">
        <div class="scroll">
            <table id="example" class="data-table user-table" style="width:100%">
                <thead>
                <tr>
                    <td>الإجراء</td>
                    <td>الإجراء بواسطة</td>
                    <td>تاريخ الإجراء</td>
{{--                    <td>causer_id</td>--}}
{{--                    <td>actions</td>--}}
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

                "serverSide": true,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "processing": true,
                "ajax": {
                    "url": "{{ route('activity_logs.datatable') }}",
                    "type": "GET"
                },
                "columns": [

                    {
                        data: 'description',
                        name: 'description',
                        orderable: false,
                        searchable: true
                    },

                    {
                        data: 'admin_id',
                        name: 'admin_id'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    }
                ],
                "error": function (xhr, error, thrown) {
                    console.log('DataTables Ajax error:', xhr, error, thrown);
                },
            });
        });
    </script>
@endsection

