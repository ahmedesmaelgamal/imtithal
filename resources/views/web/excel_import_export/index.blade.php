@extends('web.layouts.master')
@section('content')
    <style>
        .toast-custom {
            background-color: #857854 !important;
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
        <div class="d-flex justify-content-between">
            <h5 class="text-primary">الاستيراد والتصدير </h5>
            <a href="{{route('example_import')}}" class="main-button">مثال للاستيراد المستخدمين</a>

        </div>
        <hr class="hr-card">

        <form class="row" id="ExelImportExportForm">
            <div class="col-12 mb-4" id="dropify-container" style="display: none;">
                <input name="file" type="file" class="dropify" data-height="200" />
            </div>
            <div class="col-lg-6 col-md-3 col-12 mb-3">
                <select class="form-select" id="import-export-select" name="type" aria-label="Default select example" required>
                    <option value=""  selected>النوع </option>
                    <option value="import">استيراد</option>
                    <option value="export">تصدير</option>
                </select>
            </div>
            <div class="col-lg-6 col-md-3 col-12 mb-3">
                <select class="form-select" id="table-select" name="table" aria-label="Default select example" required>
                    <option value="" selected disabled>الجدول</option>
                    @foreach($modelMapTranslated as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>

            </div>

            <div class="col-12">
                <button type="submit" class="main-button" id="ExelImportExportButton">
                    إضافة
                </button>
            </div>
        </form>

    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $("select").select2();
            $('.dropify').dropify();

            // تأكد من أن dropify مخفية عند تحميل الصفحة
            $('#dropify-container').hide();

            // تحكم في إظهار أو إخفاء Dropify والخيارات عند تغيير الاختيار
            $('#import-export-select').on('change', function () {
                let selectedValue = $(this).val();
                let tableSelect = $('#table-select');

                if (selectedValue === "import") {
                    $('#dropify-container').slideDown();

                    // إخفاء جميع الخيارات ما عدا "المستخدمين"
                    tableSelect.find('option').not('[value="users"]').remove();
                    tableSelect.val("users").trigger("change"); // تحديد "المستخدمين" تلقائيًا
                } else {
                    $('#dropify-container').slideUp();

                    // إعادة تحميل الخيارات الأصلية عند اختيار "تصدير"
                    tableSelect.html(`
                <option value="" selected disabled>الجدول</option>
                @foreach($modelMapTranslated as $key => $value)
                    <option value="{{$key}}">{{$value}}</option>
                @endforeach
                    `);
                    tableSelect.val("").trigger("change"); // إعادة التحديد إلى الافتراضي
                }
            });

            // ضبط القيمة الافتراضية لمنع الاختيار التلقائي
            $('#import-export-select').val("").trigger("change");
            $('#table-select').val("").trigger("change");
        });

    </script>

    <script>
        $('#ExelImportExportForm').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            let Url = "{{ route('excel_import_export.store') }}";
            let type = $('#import-export-select').val();

            $.ajax({
                url: Url,
                method: "POST",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#ExelImportExportButton').html('<span class="spinner-border spinner-border-sm mr-2"></span> جاري الإرسال ...').attr('disabled', true);
                },
                success: function (response) {
                    if (response.status === 200) {
                        toastr.success(response.msg || 'تمت العملية بنجاح', '', {
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


                        if (type === "export") {
                            // عند نجاح التصدير، حمل الملف مباشرة
                            window.location.href = response.file_url;
                        }

                        $('#ExelImportExportButton').html('إضافة').attr('disabled', false);
                    } else {
                        toastr.error(response.msg || 'حدث خطأ غير متوقع', '', {
                            "progressBar": true,
                            "timeOut": "5000",
                            "positionClass": "toast-top-right"
                        });
                        $('#ExelImportExportButton').html('إضافة').attr('disabled', false);
                    }
                },
                error: function (xhr) {
                    $('#ExelImportExportButton').html('إضافة').attr('disabled', false);

                    if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.msg) {
                        toastr.error(xhr.responseJSON.msg, '', {
                            "progressBar": true,
                            "timeOut": "5000",
                            "positionClass": "toast-top-right"
                        });
                    } else {
                        toastr.error('حدث خطأ غير متوقع', '', {
                            "progressBar": true,
                            "timeOut": "5000",
                            "positionClass": "toast-top-right"
                        });
                    }
                }
            });
        });

    </script>
@endsection
