@extends('web.layouts.master')
@section('content')
    <div class="breadcrumb mt-4 mb-4">
        <a href="{{route('adminHome')}}"><img class="h-24" src="{{asset('web/image/home.png')}}" alt="no-icon"></a>
        <img class="h-24 me-3 ms-3" src="{{asset('web/image/icon-breadcrumb.png')}}" alt="no-icon">
        <span class="fs-14 fw-400 text-secondary">إدارة المساكن</span>
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
            <h5 class="text-primary">إدارة المساكن</h5>
            <div class="d-flex">
                <button type="button" class="main-button" data-bs-toggle="modal" data-bs-target="#addAccommodationModal">
                    إضافة مسكن
                </button>
            </div>
        </div>
        <hr class="hr-card">
        <div class="scroll">
            <table id="accommodation-table" class="data-table" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">اسم المسكن</th>
                        <th class="text-center">المسكن الرئيسي</th>
                        <th class="text-center">الموقع</th>
                        <th class="text-center">الحالة</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Add Accommodation Modal -->
    <div class="modal fade" id="addAccommodationModal" tabindex="-1" aria-labelledby="addAccommodationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gray d-flex flex-column align-items-start">
                    <h5 class="text-primary fs-18" id="addAccommodationModalLabel">إضافة مسكن جديد</h5>
                </div>
                <div class="modal-body">
                    <form id="addAccommodationForm" class="row g-3">
                        @csrf
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary"> نوع المسكن</label>
                            <select id="add-type_toggle" class="form-select w-100">
                                <option value="airport">مطار</option>
                                <option value="accommodation">مسكن</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label id="add-name-label" class="form-label fs-14 fw-500 text-primary">اسم المطار <span
                                    class="text-red">*</span></label>
                            <input name="name" type="text" class="form-control" placeholder="أدخل الاسم" required>
                        </div>
                        <div class="col-md-6" id="add-parent-container" style="display: none;">
                            <label class="form-label fs-14 fw-500 text-primary">المسكن الرئيسي</label>
                            <select name="parent_id" class="form-select w-100">
                                <option value="">اختر المسكن الرئيسي</option>
                                @foreach($mainAccommodations as $main)
                                    @if(str_contains($main->name, 'مكه') || str_contains($main->name, 'مكة') || str_contains($main->name, 'المدينة') || str_contains($main->name, 'المدينه'))
                                        <option value="{{ $main->id }}">{{ $main->name }}</option>
                                    @endif
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

    <!-- Edit Accommodation Modal -->
    <div class="modal fade" id="editAccommodationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gray d-flex flex-column align-items-start">
                    <h5 class="text-primary fs-18">تعديل مسكن</h5>
                </div>
                <div class="modal-body">
                    <form id="editAccommodationForm" class="row g-3">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="edit-id">
                        <div class="col-md-6">
                            <label class="form-label fs-14 fw-500 text-primary"> نوع المسكن</label>
                            <select id="edit-type_toggle" class="form-select w-100">
                                <option value="airport">مطار</option>
                                <option value="accommodation">مسكن</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label id="edit-name-label" class="form-label fs-14 fw-500 text-primary">اسم المسكن <span
                                    class="text-red">*</span></label>
                            <input name="name" id="edit-name" type="text" class="form-control" required>
                        </div>
                        <div class="col-md-6" id="edit-parent-container">
                            <label class="form-label fs-14 fw-500 text-primary">المسكن الرئيسي</label>
                            <select name="parent_id" id="edit-parent_id" class="form-select w-100">
                                <option value="">اختر المسكن الرئيسي</option>
                                @foreach($mainAccommodations as $main)
                                    @if(str_contains($main->name, 'مكه') || str_contains($main->name, 'مكة') || str_contains($main->name, 'المدينة') || str_contains($main->name, 'المدينه'))
                                        <option value="{{ $main->id }}">{{ $main->name }}</option>
                                    @endif
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
@endsection

@section('js')
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
            let table = $('#accommodation-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                width: '100%',
                ajax: "{{ route('accommodations.datatable') }}",
                columnDefs: [
                    { targets: "_all", className: "text-center" }
                ],
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'parent_id', name: 'parent_id' },
                    { data: 'location', name: 'location' },
                    { data: 'status', name: 'status' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ]
            });

            // Add
            $('#addAccommodationModal').on('shown.bs.modal', function () {
                google.maps.event.trigger(mapAdd, 'resize');
                mapAdd.setCenter(markerAdd.getPosition());
            });

            $('#add-type_toggle, #edit-type_toggle').on('change', function () {
                let isAdd = $(this).attr('id') === 'add-type_toggle';
                let type = $(this).val();
                let prefix = isAdd ? 'add' : 'edit';
                
                if (type === 'airport') {
                    $(`#${prefix}-name-label`).html('اسم المطار <span class="text-red">*</span>');
                    $(`#${prefix}-parent-container`).hide().find('select').val('');
                } else {
                    $(`#${prefix}-name-label`).html('اسم المسكن الفرعي <span class="text-red">*</span>');
                    $(`#${prefix}-parent-container`).show();
                }
            });
            
            // Trigger initial state for Add modal
            $('#add-type_toggle').val('airport').trigger('change');

            $('#addAccommodationForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('accommodations.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function (res) {
                        $('#addAccommodationModal').modal('hide');
                        $('#addAccommodationForm')[0].reset();
                        table.ajax.reload();
                        refreshMainAccommodations();
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
                $.get("{{ route('accommodations.edit', ':id') }}".replace(':id', id), function (data) {
                    $('#edit-id').val(data.id);
                    $('#edit-name').val(data.name);
                    $('#edit-parent_id').val(data.parent_id);
                    $('#edit-location').val(data.location);
                    $('#edit-latitude').val(data.latitude);
                    $('#edit-longitude').val(data.longitude);

                    if (data.parent_id) {
                        $('#edit-type_toggle').val('accommodation').trigger('change');
                    } else {
                        $('#edit-type_toggle').val('airport').trigger('change');
                    }

                    if (data.latitude && data.longitude) {
                        let pos = { lat: parseFloat(data.latitude), lng: parseFloat(data.longitude) };
                        markerEdit.setPosition(pos);
                        mapEdit.setCenter(pos);
                    }

                    $('#editAccommodationModal').modal('show');

                    // Resize map after modal is shown to ensure it displays correctly
                    setTimeout(() => {
                        google.maps.event.trigger(mapEdit, "resize");
                        if (data.latitude && data.longitude) {
                            mapEdit.setCenter({ lat: parseFloat(data.latitude), lng: parseFloat(data.longitude) });
                        }
                    }, 300);
                });
            });

            $('#editAccommodationForm').on('submit', function (e) {
                e.preventDefault();
                let id = $('#edit-id').val();
                $.ajax({
                    url: "{{ route('accommodations.update', ':id') }}".replace(':id', id),
                    method: "POST",
                    data: $(this).serialize(),
                    success: function (res) {
                        $('#editAccommodationModal').modal('hide');
                        table.ajax.reload();
                        refreshMainAccommodations();
                        toastr.success(res.msg);
                    },
                    error: function (xhr) {
                        toastr.error('حدث خطأ ما');
                    }
                });
            });

            // Delete
            $(document).on('click', '.deleteAccommodation', function (e) {
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
                url: "{{ route('accommodations.updateStatus', ':id') }}".replace(':id', id),
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

        function refreshMainAccommodations() {
            $.get("{{ route('accommodations.main') }}", function (data) {
                let html = '<option value="">اختر المسكن الرئيسي</option>';
                data.forEach(function (main) {
                    if (main.name.includes('مكه') || main.name.includes('مكة') || main.name.includes('المدينة') || main.name.includes('المدينه')) {
                        html += `<option value="${main.id}">${main.name}</option>`;
                    }
                });
                $('#add-parent_id, #edit-parent_id').html(html);
            });
        }
    </script>
@endsection