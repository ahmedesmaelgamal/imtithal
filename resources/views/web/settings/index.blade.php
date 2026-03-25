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

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container-fluid py-4">
    <div class="card mx-auto">
        <div class="card-header bg-gray text-start">
            <h5 class="text-primary fs-18 text-lg-end">ادارة اوقات العمل</h5>
        </div>
        <div class="card-body">
            <form id="updateSettingForm" class="row g-3" action="{{ route('settings.update') }}" method="POST">
                @csrf

                <div id="shifts-container">
                    @forelse($shifts as $index => $shift)
                        <div class="row g-3 shift-group" data-index="{{ $index }}">
                            <input type="hidden" name="shifts[{{ $index }}][id]" value="{{ $shift->id }}">
                            <input type="hidden" name="shifts[{{ $index }}][code]" value="{{ $shift->code }}">

                            <div class="col-12">
                                <label class="form-label text-primary">اسم الورديه <span class="text-red">*</span></label>
                                <input name="shifts[{{ $index }}][name]" type="text" class="form-control"
                                       value="{{ $shift->name }}" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label text-primary">بدايه تسجيل الحضور <span class="text-red">*</span></label>
                                <input name="shifts[{{ $index }}][checkin_date]" type="time" class="form-control"
                                       value="{{ date('H:i', strtotime($shift->checkin_date)) }}" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label text-primary">نهايه تسجيل الحضور <span class="text-red">*</span></label>
                                <input name="shifts[{{ $index }}][checkin_max_date]" type="time" class="form-control"
                                       value="{{ date('H:i', strtotime($shift->checkin_max_date)) }}" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label text-primary">بدايه تسجيل الانصراف <span class="text-red">*</span></label>
                                <input name="shifts[{{ $index }}][checkout_date]" type="time" class="form-control"
                                       value="{{ date('H:i', strtotime($shift->checkout_date)) }}" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label text-primary">نهايه تسجيل الانصراف <span class="text-red">*</span></label>
                                <input name="shifts[{{ $index }}][checkout_max_date]" type="time" class="form-control"
                                       value="{{ date('H:i', strtotime($shift->checkout_max_date)) }}" required>
                            </div>
                            <div class="col-12 text-end">
                                <button type="button" class="btn-refuse delete-shift">حذف الورديه</button>
                            </div>
                        </div>
                    @empty
                        <div class="row g-3 shift-group" data-index="0">
                            @php $uniqueCode = 'new_' . time(); @endphp
                            <input type="hidden" name="shifts[0][code]" value="{{ $uniqueCode }}">

                            <div class="col-12">
                                <label class="form-label text-primary">اسم الورديه <span class="text-red">*</span></label>
                                <input name="shifts[0][name]" type="text" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label text-primary">بدايه تسجيل الحضور <span class="text-red">*</span></label>
                                <input name="shifts[0][checkin_date]" type="time" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label text-primary">نهايه تسجيل الحضور <span class="text-red">*</span></label>
                                <input name="shifts[0][checkin_max_date]" type="time" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label text-primary">بدايه تسجيل الانصراف <span class="text-red">*</span></label>
                                <input name="shifts[0][checkout_date]" type="time" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label text-primary">نهايه تسجيل الانصراف <span class="text-red">*</span></label>
                                <input name="shifts[0][checkout_max_date]" type="time" class="form-control" required>
                            </div>
                            <div class="col-12 text-end">
                                <button type="button" class="btn-refuse delete-shift">حذف الورديه</button>
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="col-12 text-end">
                    <button type="button" id="add-shift-btn" class="main-button blur">اضافة ورديه</button>
                </div>

                <div class="col-12 d-flex justify-content-between border-top pt-3 mt-4">
                    <a href=""></a>
                    <button type="submit" id="settingButton" class="main-button">تحديث</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .shift-group {
        border-bottom: 1px dashed #ccc;
        padding-bottom: 20px;
        margin-bottom: 20px;
    }
    .btn-refuse {
        background: none;
        border: none;
        color: #dc3545;
        cursor: pointer;
    }
</style>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        let shiftIndex = {{ count($shifts) }};
        if (shiftIndex === 0) shiftIndex = 1;

        // Add new shift
        $('#add-shift-btn').click(function () {
            const html = `
                <div class="row g-3 shift-group" data-index="${shiftIndex}">
                    <input type="hidden" name="shifts[${shiftIndex}][code]" value="new_${Date.now()}">
                    <div class="col-12">
                        <label class="form-label text-primary">اسم الورديه <span class="text-red">*</span></label>
                        <input name="shifts[${shiftIndex}][name]" type="text" class="form-control" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label text-primary">بدايه تسجيل الحضور <span class="text-red">*</span></label>
                        <input name="shifts[${shiftIndex}][checkin_date]" type="time" class="form-control" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label text-primary">نهايه تسجيل الحضور <span class="text-red">*</span></label>
                        <input name="shifts[${shiftIndex}][checkin_max_date]" type="time" class="form-control" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label text-primary">بدايه تسجيل الانصراف <span class="text-red">*</span></label>
                        <input name="shifts[${shiftIndex}][checkout_date]" type="time" class="form-control" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label text-primary">نهايه تسجيل الانصراف <span class="text-red">*</span></label>
                        <input name="shifts[${shiftIndex}][checkout_max_date]" type="time" class="form-control" required>
                    </div>
                    <div class="col-12 text-end">
                        <button type="button" class="btn-refuse delete-shift">حذف الورديه</button>
                    </div>
                </div>`;
            
            $('#shifts-container').append(html);
            shiftIndex++;
        });

        // Delete shift
        $(document).on('click', '.delete-shift', function () {
            const shiftGroup = $(this).closest('.shift-group');
            const shiftCode = shiftGroup.find('input[name*="[code]"]').val();
            
            // If this is an existing shift (not new), mark it for deletion
            if (shiftCode && !shiftCode.startsWith('new_')) {
                shiftGroup.append(`<input type="hidden" name="shifts[${shiftGroup.data('index')}][_delete]" value="1">`);
                shiftGroup.hide();
            } else {
                // If it's a new shift, just remove it
                shiftGroup.remove();
            }
        });

        // Form submission
        $('#updateSettingForm').on('submit', function (e) {
            e.preventDefault();
            
            let formData = new FormData(this);
            let url = $(this).attr('action');

            // Clear previous errors
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();

            $.ajax({
                url: url,
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#settingButton').html('<span class="spinner-border spinner-border-sm mr-2"></span> جاري الإرسال ...').attr('disabled', true);
                },
                success: function (response) {
                    toastr.success(response.message);
                    $('#settingButton').html('تحديث').attr('disabled', false);
                    
                    // Reload the page to reflect changes
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                },
                error: function (xhr) {
                    $('#settingButton').html('تحديث').attr('disabled', false);
                    
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        
                        // Display validation errors
                        for (let field in errors) {
                            let fieldName = field.replace(/\./g, '][').replace(/\[(\d+)\]\[/, '[$1][');
                            let input = $(`[name="${fieldName}"]`);
                            
                            input.addClass('is-invalid');
                            input.after(`<div class="invalid-feedback">${errors[field][0]}</div>`);
                        }
                    } else {
                        toastr.error(xhr.responseJSON.message || 'حدث خطأ غير متوقع');
                    }
                }
            });
        });
    });
</script>
@endsection