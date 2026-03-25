@extends('web.layouts.master')
@section('content')
    <div class="breadcrumb mt-4 mb-4">
        <a href="{{route('adminHome')}}"><img class="h-24" src="{{asset('web/image/home.png')}}" alt="no-icon"></a>
        <img class="h-24 me-3 ms-3" src="{{asset('web/image/icon-breadcrumb.png')}}" alt="no-icon">
        <span class="fs-14 fw-400 text-secondary">إدارة المناطق</span>
    </div>

    <style>
        #locationMap,
        #editLocationMap {
            height: 300px;
            width: 100%;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
    </style>

    <div class="card-border mt-16">
        <div class="d-flex justify-content-between flex-wrap">
            <h5 class="text-primary">إدارة المناطق</h5>
            <div class="d-flex">
                <button type="button" class="main-button" data-bs-toggle="modal" data-bs-target="#addAreaModal">
                    إضافة منطقة
                </button>
            </div>
        </div>
        <hr class="hr-card">
        <div class="scroll">
            <table id="area-table" class="data-table" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">اسم المنطقة</th>
                        <th class="text-center">المنطقة الرئيسية</th>
                        <th class="text-center">المشرف</th>
                        <th class="text-center">الحالة</th>
                        <th class="text-center">العمليات</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Add Area Modal -->
    <div class="modal fade" id="addAreaModal" tabindex="-1" aria-labelledby="addAreaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gray d-flex flex-column align-items-start">
                    <h5 class="text-primary fs-18" id="addAreaModalLabel">إضافة منطقة جديدة</h5>
                </div>
                <div class="modal-body">
                    <form id="addAreaForm" class="row g-3">
                        @csrf
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">نوع التصنيف <span
                                    class="text-red">*</span></label>
                            <select id="add-category" class="form-select w-100">
                                <option value="airport">مطار</option>
                                <option value="residence">مسكن</option>
                            </select>
                        </div>
                        <div class="col-md-6" id="add-residence-type-container">
                            <label class="form-label fs-14 fw-500 text-primary">نوع المسكن <span
                                    class="text-red">*</span></label>
                            <select name="parent_id" id="add-residence-parent" class="form-select w-100">
                                <option value="" disabled>اختر المسكن الرئيسي</option>
                                <option value="1">مساكن مكه</option>
                                <option value="2">مساكن المدينه</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fs-14 fw-500 text-primary">اسم المنطقة <span
                                    class="text-red">*</span></label>
                            <input name="name" type="text" class="form-control" placeholder="أدخل الاسم" required>
                        </div>


                        <div class="col-md-12">
                            <label class="form-label fs-14 fw-500 text-primary">المشرف الميداني <span
                                    class="text-red">*</span></label>
                            <select name="leader_id" class="form-select w-100 js-select2" required>
                                <option value="">اختر المشرف</option>
                                @foreach($leaders as $leader)
                                    <option value="{{ $leader->id }}">{{ $leader->full_name }}</option>
                                @endforeach
                            </select>
                        </div>



                        <div class="col-md-12">
                            <label class="form-label fs-14 fw-500 text-primary">المراقبين</label>
                            <select name="team_ids[]" class="form-select w-100 js-select2" multiple>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->full_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fs-14 fw-500 text-primary">الموقع (العنوان)</label>
                            <input name="location" type="text" class="form-control" placeholder="أدخل العنوان">
                        </div>

                        <input name="latitude" id="add-latitude" type="hidden">
                        <input name="longitude" id="add-longitude" type="hidden">
                        <div class="col-12 mt-3">
                            <label class="form-label fs-14 fw-500 text-primary">تحديد الموقع على الخريطة</label>
                            <div id="locationMap"></div>
                        </div>
                        <div class="col-12 text-start mt-4">
                            <button type="submit" class="main-button">حفظ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Area Modal -->
    <div class="modal fade" id="editAreaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gray d-flex flex-column align-items-start">
                    <h5 class="text-primary fs-18">تعديل منطقة</h5>
                </div>
                <div class="modal-body">
                    <form id="editAreaForm" class="row g-3">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="edit-id">
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">نوع التصنيف <span
                                    class="text-red">*</span></label>
                            <select id="edit-category" class="form-select w-100">
                                <option value="airport">مطار</option>
                                <option value="residence">مسكن</option>
                            </select>
                        </div>
                        <!-- <div class="col-md-6" id="edit-residence-type-container" style="display: none;">
                            <label class="form-label fs-14 fw-500 text-primary">نوع المسكن <span
                                    class="text-red">*</span></label>
                            <select name="parent_id" id="edit-residence-parent" class="form-select w-100">
                                <option value="" disabled>اختر المسكن الرئيسي</option>
                            </select>
                        </div> -->
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary">اسم المنطقة <span
                                    class="text-red">*</span></label>
                            <input name="name" id="edit-name" type="text" class="form-control" required>
                        </div>


                        <div class="col-md-12">
                            <label class="form-label fs-14 fw-500 text-primary">المشرف الميداني <span
                                    class="text-red">*</span></label>
                            <select name="leader_id" id="edit-leader_id" class="form-select w-100 js-select2" required>
                                <option value="">اختر المشرف</option>
                                @foreach($leaders as $leader)
                                    <option value="{{ $leader->id }}">{{ $leader->full_name }}</option>
                                @endforeach
                            </select>
                        </div>



                        <div class="col-md-12">
                            <label class="form-label fs-14 fw-500 text-primary">المراقبين</label>
                            <select name="team_ids[]" id="edit-team_ids" class="form-select w-100 js-select2" multiple>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->full_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fs-14 fw-500 text-primary">الموقع (العنوان)</label>
                            <input name="location" id="edit-location" type="text" class="form-control">
                        </div>

                        <input name="latitude" id="edit-latitude" type="hidden">
                        <input name="longitude" id="edit-longitude" type="hidden">
                        <div class="col-12 mt-3">
                            <label class="form-label fs-14 fw-500 text-primary">تحديد الموقع على الخريطة</label>
                            <div id="editLocationMap"></div>
                        </div>
                        <div class="col-12 text-start mt-4">
                            <button type="submit" class="main-button">تحديث</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Link Survey Modal -->
    <div class="modal fade" id="linkSurveyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gray d-flex flex-column align-items-start">
                    <h5 class="text-primary fs-18">ربط الاستبيانات بالمنطقة</h5>
                </div>
                <div class="modal-body">
                    <form id="linkSurveyForm" class="row g-3">
                        @csrf
                        <input type="hidden" name="area_id" id="link-area-id">
                        
                        <div class="col-md-12">
                            <label class="form-label fs-14 fw-500 text-primary">الاستبيانات</label>
                            <select name="survey_ids[]" id="link-survey_ids" class="form-select w-100 js-select2" multiple>
                                @foreach($surveys as $survey)
                                    <option value="{{ $survey->id }}">{{ $survey->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-12 text-start mt-4">
                            <button type="submit" class="main-button">حفظ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('web.layouts.datatable')
    <script defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCK_HenDkNSugL5gakTqdIagO4y8KR-udc&callback=initMap&v=weekly"></script>
    <script>
        var mapAdd, markerAdd, mapEdit, markerEdit;

        function initMap() {
            const defaultCenter = { lat: 21.4225, lng: 39.8262 };

            // Add Map
            mapAdd = new google.maps.Map(document.getElementById("locationMap"), {
                center: defaultCenter,
                zoom: 13,
            });
            markerAdd = new google.maps.Marker({
                position: defaultCenter,
                map: mapAdd,
                draggable: true,
            });
            mapAdd.addListener("click", (e) => {
                markerAdd.setPosition(e.latLng);
                $('#add-latitude').val(e.latLng.lat().toFixed(6));
                $('#add-longitude').val(e.latLng.lng().toFixed(6));
            });
            markerAdd.addListener("dragend", (e) => {
                $('#add-latitude').val(e.latLng.lat().toFixed(6));
                $('#add-longitude').val(e.latLng.lng().toFixed(6));
            });

            // Edit Map
            mapEdit = new google.maps.Map(document.getElementById("editLocationMap"), {
                center: defaultCenter,
                zoom: 13,
            });
            markerEdit = new google.maps.Marker({
                position: defaultCenter,
                map: mapEdit,
                draggable: true,
            });
            mapEdit.addListener("click", (e) => {
                markerEdit.setPosition(e.latLng);
                $('#edit-latitude').val(e.latLng.lat().toFixed(6));
                $('#edit-longitude').val(e.latLng.lng().toFixed(6));
            });
            markerEdit.addListener("dragend", (e) => {
                $('#edit-latitude').val(e.latLng.lat().toFixed(6));
                $('#edit-longitude').val(e.latLng.lng().toFixed(6));
            });
        }

        $(document).ready(function () {
            // Initialize Select2
            $(".js-select2").select2({
                width: '100%',
                dropdownParent: $(".modal:visible .modal-content").length ? $(".modal:visible .modal-content") : null
            });

            // Support Select2 in Modals
            $('#addAreaModal, #editAreaModal, #linkSurveyModal').on('shown.bs.modal', function () {
                $(this).find(".js-select2").select2({
                    dropdownParent: $(this).find(".modal-content")
                });
            });

            let table = $('#area-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('area.datatable') }}",
                columns: [
                    { data: 'name', name: 'name', className: "text-center" },
                    { data: 'parent_id', name: 'parent_id', className: "text-center" },
                    { data: 'supervisors', name: 'supervisors' },
                    { data: 'status_toggle', name: 'status_toggle', orderable: false, searchable: false, className: "text-center" },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false, className: "text-center" }
                ]
            });

            // Resizing map when modal shown
            $('#addAreaModal').on('shown.bs.modal', function () {
                google.maps.event.trigger(mapAdd, 'resize');
                mapAdd.setCenter(markerAdd.getPosition());
            });

            $('#add-category, #edit-category').on('change', function () {
                let id = $(this).attr('id');
                let isAdd = id.startsWith('add');
                let prefix = isAdd ? 'add' : 'edit';

                let category = $(`#${prefix}-category`).val();
                let $select = $(`#${prefix}-residence-parent`);
                let currentValue = $select.val();

                $(`#${prefix}-residence-type-container`).show();

                if (category === 'airport') {
                    $select.html(`
                            <option value="" disabled>اختر المسكن الرئيسي</option>
                            <option value="1">مطارات مكه</option>
                            <option value="2">مطارات المدينه</option>
                        `);
                } else if (category === 'residence') {
                    $select.html(`
                            <option value="" disabled>اختر المسكن الرئيسي</option>
                            <option value="1">مساكن مكه</option>
                            <option value="2">مساكن المدينه</option>
                        `);
                }

                if (currentValue) {
                    $select.val(currentValue);
                }
            });

            $('#add-category').trigger('change');

            $('#addAreaForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('area.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function (res) {
                        $('#addAreaModal').modal('hide');
                        $('#addAreaForm')[0].reset();
                        table.ajax.reload();
                        refreshMainAreas();
                        toastr.success(res.msg);
                    },
                    error: function (xhr) {
                        toastr.error('حدث خطأ ما');
                    }
                });
            });

            // Edit
            $(document).on('click', '.edit', function () {
                let id = $(this).data('id');
                $.get("{{ route('area.edit', ':id') }}".replace(':id', id), function (data) {
                    $('#edit-id').val(data.id);
                    $('#edit-name').val(data.name);
                    $('#edit-parent_id').val(data.parent_id).trigger('change');
                    $('#edit-location').val(data.location);
                    $('#edit-latitude').val(data.latitude);
                    $('#edit-longitude').val(data.longitude);

                    $('#edit-leader_id').val(data.leader_id).trigger('change');
                    $('#edit-sub_leader_ids').val(data.sub_leader_ids).trigger('change');
                    $('#edit-team_ids').val(data.team_ids).trigger('change');

                    if (data.parent_id) {
                        $('#edit-category').val('residence').trigger('change');
                        $('#edit-residence-parent').val(data.parent_id);
                    } else {
                        if (data.name.includes('مطار')) {
                            $('#edit-category').val('airport').trigger('change');
                            $('#edit-residence-parent').val(data.parent_id);
                        } else {
                            $('#edit-category').val('residence').trigger('change');
                            $('#edit-residence-parent').val('');
                        }
                    }

                    if (data.latitude && data.longitude) {
                        let pos = { lat: parseFloat(data.latitude), lng: parseFloat(data.longitude) };
                        markerEdit.setPosition(pos);
                        mapEdit.setCenter(pos);
                    }

                    $('#editAreaModal').modal('show');

                    setTimeout(() => {
                        google.maps.event.trigger(mapEdit, "resize");
                        if (data.latitude && data.longitude) {
                            mapEdit.setCenter({ lat: parseFloat(data.latitude), lng: parseFloat(data.longitude) });
                        }
                    }, 300);
                });
            });

            $('#editAreaForm').on('submit', function (e) {
                e.preventDefault();
                let id = $('#edit-id').val();
                $.ajax({
                    url: "{{ route('area.update', ':id') }}".replace(':id', id),
                    method: "POST",
                    data: $(this).serialize(),
                    success: function (res) {
                        $('#editAreaModal').modal('hide');
                        table.ajax.reload();
                        refreshMainAreas();
                        toastr.success(res.msg);
                    },
                    error: function (xhr) {
                        toastr.error('حدث خطأ ما');
                    }
                });
            });

            // Link Survey
            $(document).on('click', '.link-survey', function () {
                let id = $(this).data('id');
                $('#link-area-id').val(id);
                
                $.get("{{ route('area.surveys', ':id') }}".replace(':id', id), function (data) {
                    $('#link-survey_ids').val(data).trigger('change');
                    $('#linkSurveyModal').modal('show');
                });
            });

            $('#linkSurveyForm').on('submit', function (e) {
                e.preventDefault();
                let params = $(this).serialize();
                $.ajax({
                    url: "{{ route('area.linkSurveys') }}",
                    method: "POST",
                    data: params,
                    success: function (res) {
                        $('#linkSurveyModal').modal('hide');
                        toastr.success(res.msg);
                    },
                    error: function (xhr) {
                        toastr.error('حدث خطأ ما');
                    }
                });
            });

            // Delete
            $(document).on('click', '.deleteArea', function (e) {
                e.preventDefault();
                let url = $(this).attr('href');
                if (confirm('هل أنت متأكد من الحذف؟')) {
                    $.ajax({
                        url: url,
                        method: "DELETE",
                        data: { _token: "{{ csrf_token() }}" },
                        success: function (res) {
                            table.ajax.reload();
                            toastr.success(res.msg);
                        }
                    });
                }
            });
        });

        function updateStatus(checkbox) {
            let id = $(checkbox).data('id');
            let status = checkbox.checked ? 1 : 0;
            $.ajax({
                url: "{{ route('area.editStatus', ':id') }}".replace(':id', id),
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    status: status
                },
                success: function (res) {
                    toastr.success(res.msg);
                }
            });
        }

        function refreshMainAreas() {
            $.get("{{ route('area.main') }}", function (data) {
                let html = '<option value="">اختر المنطقة الرئيسية</option>';
                data.forEach(function (main) {
                    html += `<option value="${main.id}">${main.name}</option>`;
                });
                $('#add-residence-parent, #edit-residence-parent').html(html);
            });
        }
    </script>
@endsection