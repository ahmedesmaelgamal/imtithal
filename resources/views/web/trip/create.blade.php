@extends('web.layouts.master')
@section('content')
    <div class="breadcrumb mt-4 mb-4">
        <a href="{{route('adminHome')}}"><img class="h-24" src="{{asset('web/image/home.png')}}" alt="no-icon"></a>
        <img class="h-24 me-3 ms-3" src="{{asset('web/image/icon-breadcrumb.png')}}" alt="no-icon">
        <a class="link-breadcrumb" href="{{route('trips.index')}}">إدارة الرحلات</a>
        <img class="h-24 me-3 ms-3" src="{{asset('web/image/icon-breadcrumb.png')}}" alt="no-icon">
        <span class="fs-14 fw-400 text-secondary">إضافة رحلة جديدة</span>
    </div>

    <div class="card-border mt-16">
        <div class="d-flex flex-column align-items-start mb-4">
            <h5 class="text-primary fs-18">إضافة رحلة جديدة</h5>
            <p class="text-secondary fs-14 fw-400">يرجى إدخال بيانات الرحلة الجديدة</p>
        </div>
        <hr class="hr-card">
        <form id="addTripFormFull" class="row g-3" action="{{ route('trips.store') }}" method="POST">
            @csrf
            <div class="col-md-6 mb-3">
                <label class="form-label fs-14 fw-500 text-primary">رقم الرحلة <span class="text-red">*</span></label>
                <input name="trip_number" type="text" class="form-control" placeholder="أدخل رقم الرحلة" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fs-14 fw-500 text-primary">الناقل الجوي <span class="text-red">*</span></label>
                <input name="air_carrier" type="text" class="form-control" placeholder="أدخل الناقل الجوي" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fs-14 fw-500 text-primary">بلد المغادرة <span class="text-red">*</span></label>
                <input name="departure_country" type="text" class="form-control" placeholder="أدخل بلد المغادرة" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fs-14 fw-500 text-primary">رقم قائمة الجاهزية</label>
                <input name="readiness_list_number" type="text" class="form-control" placeholder="أدخل رقم القائمة">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fs-14 fw-500 text-primary">مقدم الخدمة</label>
                <input name="service_provider" type="text" class="form-control" placeholder="أدخل مقدم الخدمة">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fs-14 fw-500 text-primary">عدد حجاج المجموعات</label>
                <input name="hajj_groups_count" type="number" class="form-control" value="0">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fs-14 fw-500 text-primary">إجمالي عدد الحجاج</label>
                <input name="hajjis_count" type="number" class="form-control" value="0">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fs-14 fw-500 text-primary">المنطقة</label>
                <select name="area_id" class="form-select js-select2">
                    <option value="">اختر المنطقة</option>
                    @foreach($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fs-14 fw-500 text-primary">مدينة السكن</label>
                <input name="residence_city" type="text" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fs-14 fw-500 text-primary">تاريخ الوصول</label>
                <input name="arrival_date" type="date" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fs-14 fw-500 text-primary">وقت الوصول</label>
                <input name="arrival_time" type="time" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fs-14 fw-500 text-primary">جهة التنفيذ</label>
                <input name="executor" type="text" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fs-14 fw-500 text-primary">رقم العقد</label>
                <input name="contract_number" type="text" class="form-control">
            </div>
            </div>
            <div class="col-12 text-start mt-4">
                <button type="submit" class="main-button">حفظ البيانات</button>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('.js-select2').select2({ width: '100%' });
            $('input[type="date"]').on('click', function () {
                if (typeof this.showPicker === 'function') {
                    try {
                        this.showPicker();
                    } catch (e) {
                        console.error('showPicker failed:', e);
                    }
                }
            });
        });
    </script>
@endsection
