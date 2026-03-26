@extends('web.layouts.master')
@section('content')

    <style>
        .toast-custom {
            background-color: #857854 !important;
        }
        .dropify-wrapper .dropify-message p {
            font-size: 16px !important;
        }
    </style>

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
            <h5 class="text-primary">إدارة الرحلات</h5>
            <div class="d-flex">
                <button type="button" class="main-button me-2" data-bs-toggle="modal" data-bs-target="#addTripModal">
                    إضافة رحلة
                </button>
                <button type="button" class="main-button me-2" data-bs-toggle="modal" data-bs-target="#importExcelModal">
                    استيراد
                </button>
                <button type="button" class="main-button" id="exportExcelBtn">
                    تصدير
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
        <div class="form-filter card-details mt-4 mb-4" style="display: none;">
            <form class="row" action="" method="get">
                <div class="col-md-4 col-12 mb-3">
                    <label class="form-label fs-14 fw-500 text-primary">رقم الرحلة</label>
                    <input type="text" class="form-control" name="trip_number" style="background-color: white"
                           placeholder="ادخل رقم الرحلة" value="{{ request('trip_number') }}">
                </div>
                <div class="col-md-4 col-12 mb-3">
                    <label class="form-label fs-14 fw-500 text-primary">الناقل الجوي</label>
                    <select class="form-select select2-filter" name="air_carrier">
                        <option value="">الكل</option>
                        @foreach($airCarriers as $carrier)
                            <option value="{{ $carrier }}">{{ $carrier }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-12 mb-3">
                    <label class="form-label fs-14 fw-500 text-primary">مقدم الخدمة</label>
                    <select class="form-select select2-filter" name="service_provider">
                        <option value="">الكل</option>
                        @foreach($serviceProviders as $provider)
                            <option value="{{ $provider }}">{{ $provider }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-12 mb-3">
                    <label class="form-label fs-14 fw-500 text-primary">المنطقة</label>
                    <select class="form-select select2-filter" name="area_id">
                        <option value="">الكل</option>
                        @foreach($mainAreas as $acc)
                            <option value="{{ $acc->id }}">{{ $acc->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-12 mb-3">
                    <label class="form-label fs-14 fw-500 text-primary">المنطقة</label>
                    <select class="form-select select2-filter" name="area_id">
                        <option value="">الكل</option>
                        @foreach($subAreas as $acc)
                            <option value="{{ $acc->id }}">{{ $acc->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-12 mb-3">
                    <label class="form-label fs-14 fw-500 text-primary">تاريخ الوصول</label>
                    <input type="date" class="form-control" name="arrival_date">
                </div>
                <div class="footer text-start">
                    <button type="submit" class="main-button">بحث</button>
                    <button type="reset" class="view border-0 ms-2" onclick="window.location.href='{{route('trips.index')}}'">إعادة ضبط</button>
                </div>
            </form>
        </div>
        <div class="scroll">
            <table id="trip-table" class="data-table" style="width:100%">
                <thead>
                <tr>
                    <th class="text-center">رقم الرحلة</th>
                    <th class="text-center">الناقل الجوي</th>
                    <th class="text-center">بلد المغادرة</th>
                    <th class="text-center">عدد الحجاج</th>
                    <th class="text-center">المنطقة</th>
                    <th class="text-center">مدينة السكن</th>
                    <th class="text-center">تاريخ الوصول</th>
                    <th class="text-center">وقت الوصول</th>
                    <th class="text-center"></th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Add Trip Modal -->
    <div class="modal fade" id="addTripModal" tabindex="-1" aria-labelledby="addTripModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gray d-flex flex-column align-items-start">
                    <h5 class="text-primary fs-18" id="addTripModalLabel">إضافة رحلة جديدة</h5>
                    <p class="text-secondary fs-14 fw-400">يرجى إدخال بيانات الرحلة الجديدة</p>
                </div>
                <div class="modal-body">
                    <form id="addTripForm" class="row g-3" action="{{ route('trips.store') }}" method="POST">
                        @csrf
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">رقم الرحلة <span class="text-red">*</span></label>
                            <input name="trip_number" type="text" class="form-control" placeholder="أدخل رقم الرحلة" required>
                            <div class="invalid-feedback" id="error-trip_number"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">الناقل الجوي <span class="text-red">*</span></label>
                            <input name="air_carrier" type="text" class="form-control" placeholder="أدخل الناقل الجوي" required>
                            <div class="invalid-feedback" id="error-air_carrier"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">بلد المغادرة <span class="text-red">*</span></label>
                            <input name="departure_country" type="text" class="form-control" placeholder="أدخل بلد المغادرة" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">رقم قائمة الجاهزية</label>
                            <input name="readiness_list_number" type="text" class="form-control" placeholder="أدخل رقم القائمة">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">مقدم الخدمة</label>
                            <input name="service_provider" type="text" class="form-control" placeholder="أدخل مقدم الخدمة">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">عدد حجاج المجموعات</label>
                            <input name="hajj_groups_count" type="number" class="form-control" value="0">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">إجمالي عدد الحجاج</label>
                            <input name="hajjis_count" type="number" class="form-control" value="0">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">المنطقة</label>
                            <select name="area_id" class="form-select select2-modal">
                                <option value="">اختر المنطقة</option>
                                @foreach($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">مدينة السكن</label>
                            <input name="residence_city" type="text" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">تاريخ الوصول</label>
                            <input name="arrival_date" type="date" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">وقت الوصول</label>
                            <input name="arrival_time" type="time" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">جهة التنفيذ</label>
                            <input name="executor" type="text" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">رقم العقد</label>
                            <input name="contract_number" type="text" class="form-control">
                        </div>
                        <div class="col-12 d-flex justify-content-between border-top pt-3 mt-4">
                            <button type="button" class="view border-0" data-bs-dismiss="modal">إلغاء</button>
                            <button type="submit" id="addTripBtn" class="main-button">حفظ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Trip Modal -->
    <div class="modal fade" id="editTripModal" tabindex="-1" aria-labelledby="editTripModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gray d-flex flex-column align-items-start">
                    <h5 class="text-primary fs-18" id="editTripModalLabel">تعديل رحلة</h5>
                    <p class="text-secondary fs-14 fw-400">يرجى تعديل بيانات الرحلة</p>
                </div>
                <div class="modal-body">
                    <form id="editTripForm" class="row g-3">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="editTripId">
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">رقم الرحلة <span class="text-red">*</span></label>
                            <input name="trip_number" type="text" class="form-control" id="editTripNumber" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">الناقل الجوي <span class="text-red">*</span></label>
                            <input name="air_carrier" type="text" class="form-control" id="editAirCarrier" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">بلد المغادرة <span class="text-red">*</span></label>
                            <input name="departure_country" type="text" class="form-control" id="editDepartureCountry" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">رقم قائمة الجاهزية</label>
                            <input name="readiness_list_number" type="text" class="form-control" id="editReadinessNumber">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">مقدم الخدمة</label>
                            <input name="service_provider" type="text" class="form-control" id="editServiceProvider">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">عدد حجاج المجموعات</label>
                            <input name="hajj_groups_count" type="number" class="form-control" id="editHajjGroupsCount">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">إجمالي عدد الحجاج</label>
                            <input name="hajjis_count" type="number" class="form-control" id="editHajjisCount">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">المنطقة</label>
                            <select name="area_id" id="editAreaId" class="form-select select2-modal">
                                <option value="">اختر المنطقة</option>
                                @foreach($areas as $area)
                                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">مدينة السكن</label>
                            <input name="residence_city" type="text" class="form-control" id="editResidenceCity">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">تاريخ الوصول</label>
                            <input name="arrival_date" type="date" class="form-control" id="editArrivalDate">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">وقت الوصول</label>
                             <input name="arrival_time" type="time" class="form-control" id="editArrivalTime">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">جهة التنفيذ</label>
                            <input name="executor" type="text" class="form-control" id="editExecutor">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">رقم العقد</label>
                            <input name="contract_number" type="text" class="form-control" id="editContractNumber">
                        </div>
                        <div class="col-12 d-flex justify-content-between border-top pt-3 mt-4">
                            <button type="button" class="view border-0" data-bs-dismiss="modal">إلغاء</button>
                            <button type="submit" id="submitEditTripBtn" class="main-button">حفظ التعديلات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Excel Import Modal -->
    <div class="modal fade" id="importExcelModal" tabindex="-1" aria-labelledby="importExcelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-gray d-flex flex-column align-items-start">
                    <h5 class="text-primary fs-18" id="importExcelModalLabel">استيراد من اكسيل</h5>
                    <p class="text-secondary fs-14 fw-400">اختر ملف الاكسيل لاستيراد الرحلات</p>
                </div>
                <div class="modal-body">
                    <form id="importExcelForm">
                        @csrf
                        <input type="hidden" name="type" value="import">
                        <input type="hidden" name="table" value="trips">
                        <div class="col-12 mb-4">
                            <input name="file" type="file" class="dropify" data-height="200" required />
                        </div>
                        <div class="col-12 d-flex justify-content-between border-top pt-3 mt-4">
                            <button type="button" class="view border-0" data-bs-dismiss="modal">إلغاء</button>
                            <button type="submit" id="submitImportExcelBtn" class="main-button">استيراد</button>
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
            $('.dropify').dropify();
            $('.select2-modal').select2({
                width: '100%',
                dropdownParent: $('#addTripModal, #editTripModal')
            });

            // DataTable Initialization
            let tripTable = $('#trip-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                width: '100%',
                ajax: {
                    url: "{{ route('trips.datatable') }}",
                    data: function (d) {
                        d.trip_number = $('input[name="trip_number"]').val();
                        d.air_carrier = $('select[name="air_carrier"]').val();
                        d.service_provider = $('select[name="service_provider"]').val();
                        d.area_id = $('select[name="area_id"]').val();
                        d.arrival_date = $('input[name="arrival_date"]').val();
                    }
                },
                columnDefs: [
                    { targets: "_all", className: "text-center" }
                ],
                columns: [
                    { data: 'trip_number', name: 'trip_number' },
                    { data: 'air_carrier', name: 'air_carrier' },
                    { data: 'departure_country', name: 'departure_country' },
                    { data: 'hajjis_count', name: 'hajjis_count' },
                    { data: 'areas', name: 'areas' },
                    { data: 'residence_city', name: 'residence_city' },
                    { data: 'arrival_date', name: 'arrival_date' },
                    { data: 'arrival_time', name: 'arrival_time' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ],
                language: {
                    "sProcessing": "جاري تحميل البيانات...",
                    "sZeroRecords": "لم يتم العثور على نتائج",
                    "sEmptyTable": "لا توجد بيانات متاحة في الجدول",
                    "sInfo": "عرض _START_ إلى _END_ من أصل _TOTAL_ سجل",
                    "sInfoEmpty": "عرض 0 إلى 0 من أصل 0 سجل",
                    "sSearch": "بحث:",
                    "oPaginate": {
                        "sFirst": "الأول",
                        "sLast": "الأخير",
                        "sNext": "التالي",
                        "sPrevious": "السابق"
                    }
                }
            });

            // Filter Search
            $('.form-filter form').on('submit', function(e) {
                e.preventDefault();
                tripTable.ajax.reload();
            });

            // Add Trip Form
            $('#addTripForm').on('submit', function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    beforeSend: function () {
                        $('#addTripBtn').html('<span class="spinner-border spinner-border-sm mr-2"></span> جاري الحفظ...').attr('disabled', true);
                    },
                    success: function (response) {
                        toastr.success(response.msg, '', { "progressBar": true, "toastClass": "toast toast-custom" });
                        $('#addTripModal').modal('hide');
                        $('#addTripForm')[0].reset();
                        tripTable.ajax.reload();
                        $('#addTripBtn').html('حفظ').attr('disabled', false);
                    },
                    error: function (xhr) {
                        $('#addTripBtn').html('حفظ').attr('disabled', false);
                        toastr.error(xhr.responseJSON.msg || 'حدث خطأ ما');
                    }
                });
            });

            // Edit Action
            $(document).on('click', '.edit', function () {
                let id = $(this).data('id');
                $.get("{{ route('trips.edit', ':id') }}".replace(':id', id), function (data) {
                    $('#editTripId').val(data.id);
                    $('#editTripNumber').val(data.trip_number);
                    $('#editAirCarrier').val(data.air_carrier);
                    $('#editDepartureCountry').val(data.departure_country);
                    $('#editReadinessNumber').val(data.readiness_list_number);
                    $('#editServiceProvider').val(data.service_provider);
                    $('#editHajjGroupsCount').val(data.hajj_groups_count);
                    $('#editHajjisCount').val(data.hajjis_count);
                    $('#editAreaId').val(data.area_id).trigger('change');
                    $('#editResidenceCity').val(data.residence_city);
                    $('#editArrivalDate').val(data.arrival_date);
                    $('#editArrivalTime').val(data.arrival_time);
                    $('#editExecutor').val(data.executor);
                    $('#editContractNumber').val(data.contract_number);
                    $('#editTripModal').modal('show');
                });
            });

            // Update Trip Form
            $('#editTripForm').on('submit', function (e) {
                e.preventDefault();
                let id = $('#editTripId').val();
                let formData = new FormData(this);
                $.ajax({
                    url: "{{ route('trips.update', ':id') }}".replace(':id', id),
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    beforeSend: function () {
                        $('#submitEditTripBtn').html('<span class="spinner-border spinner-border-sm mr-2"></span> جاري الحفظ...').attr('disabled', true);
                    },
                    success: function (response) {
                        toastr.success(response.msg, '', { "progressBar": true, "toastClass": "toast toast-custom" });
                        $('#editTripModal').modal('hide');
                        tripTable.ajax.reload();
                        $('#submitEditTripBtn').html('حفظ التعديلات').attr('disabled', false);
                    },
                    error: function (xhr) {
                        $('#submitEditTripBtn').html('حفظ التعديلات').attr('disabled', false);
                    }
                });
            });

            // Delete Trip
            $(document).on('click', '.deleteTrip', function (e) {
                e.preventDefault();
                if (confirm('هل أنت متأكد من حذف هذه الرحلة؟')) {
                    let url = $(this).attr('href');
                    $.ajax({
                        url: url,
                        method: "DELETE",
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        success: function (response) {
                            if (response.status) {
                                toastr.success(response.msg, '', { "progressBar": true, "toastClass": "toast toast-custom" });
                                tripTable.ajax.reload();
                            }
                        }
                    });
                }
            });

            // Excel Import
            $('#importExcelForm').on('submit', function (e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    url: "{{ route('excel_import_export.store') }}",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    beforeSend: function () {
                        $('#submitImportExcelBtn').html('<span class="spinner-border spinner-border-sm mr-2"></span> جاري الاستيراد...').attr('disabled', true);
                    },
                    success: function (response) {
                        if (response.status === 200) {
                            toastr.success(response.msg, '', { "progressBar": true, "toastClass": "toast toast-custom" });
                            $('#importExcelModal').modal('hide');
                            tripTable.ajax.reload();
                        } else {
                            toastr.error(response.msg);
                        }
                        $('#submitImportExcelBtn').html('استيراد').attr('disabled', false);
                    },
                    error: function (xhr) {
                        $('#submitImportExcelBtn').html('استيراد').attr('disabled', false);
                        toastr.error('حدث خطأ أثناء الاستيراد');
                    }
                });
            });

            // Excel Export
            $('#exportExcelBtn').on('click', function () {
                $.ajax({
                    url: "{{ route('excel_import_export.store') }}",
                    method: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        type: 'export',
                        table: 'trips'
                    },
                    beforeSend: function () {
                        $('#exportExcelBtn').html('<span class="spinner-border spinner-border-sm mr-2"></span> جاري التصدير...').attr('disabled', true);
                    },
                    success: function (response) {
                        if (response.status === 200) {
                            toastr.success(response.msg, '', { "progressBar": true, "toastClass": "toast toast-custom" });
                            window.location.href = response.file_url;
                        } else {
                            toastr.error(response.msg);
                        }
                        $('#exportExcelBtn').html('تصدير').attr('disabled', false);
                    },
                    error: function (xhr) {
                        $('#exportExcelBtn').html('تصدير').attr('disabled', false);
                        toastr.error('حدث خطأ أثناء التصدير');
                    }
                });
            });
        });

        function updateStatus(element) {
            let id = $(element).data('id');
            let status = element.checked ? 1 : 0;
            $.ajax({
                url: "{{ route('trips.updateStatus', ':id') }}".replace(':id', id),
                method: 'PUT',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data: JSON.stringify({ status: status }),
                contentType: 'application/json',
                success: function (response) {
                    toastr.success(response.msg, '', { "progressBar": true, "toastClass": "toast toast-custom" });
                }
            });
        }

        $(document).on('click', 'input[type="date"]', function () {
            if (typeof this.showPicker === 'function') {
                try {
                    this.showPicker();
                } catch (e) {
                    console.error('showPicker failed:', e);
                }
            }
        });
    </script>
@endsection









