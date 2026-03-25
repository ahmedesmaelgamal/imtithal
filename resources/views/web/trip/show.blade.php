@extends('web.layouts.master')
@section('content')
    <div class="breadcrumb mt-4 mb-4">
        <a href="{{route('adminHome')}}"><img class="h-24" src="{{asset('web/image/home.png')}}" alt="no-icon"></a>
        <img class="h-24 me-3 ms-3" src="{{asset('web/image/icon-breadcrumb.png')}}" alt="no-icon">
        <a class="link-breadcrumb" href="{{route('trips.index')}}">إدارة الرحلات</a>
        <img class="h-24 me-3 ms-3" src="{{asset('web/image/icon-breadcrumb.png')}}" alt="no-icon">
        <span class="fs-14 fw-400 text-secondary">عرض الرحلة</span>
    </div>
    <div class="card-border mt-16">
        <div class="d-flex justify-content-between flex-wrap">
            <h5 class="text-primary">رحلة رقم: {{$obj->trip_number}}</h5>
            <!-- <div class="d-flex">
                <span class="status-new">
                    {{ $obj->status == 1 ? 'ننشط' : 'غير نشط' }}
                </span>
            </div> -->
        </div>
        <hr class="hr-card">
        <div class="card-details">
            <div>
                <h6 class="text-primary">تفاصيل الرحلة</h6>
            </div>
            <hr class="hr-card">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">رقم الرحلة</p>
                    <p class="text-primary fs-14 fw-500">{{$obj->trip_number}}</p>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">الناقل الجوي</p>
                    <p class="text-primary fs-14 fw-500">{{$obj->air_carrier}}</p>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">بلد المغادرة</p>
                    <p class="text-primary fs-14 fw-500">{{$obj->departure_country}}</p>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">رقم قائمة الجاهزية</p>
                    <p class="text-primary fs-14 fw-500">{{$obj->readiness_list_number}}</p>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">مقدم الخدمة</p>
                    <p class="text-primary fs-14 fw-500">{{$obj->service_provider}}</p>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">عدد حجاج المجموعات</p>
                    <p class="text-primary fs-14 fw-500">{{$obj->hajj_groups_count}}</p>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">إجمالي الحجاج</p>
                    <p class="text-primary fs-14 fw-500">{{$obj->hajjis_count}}</p>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">المنطقة</p>
                    <p class="text-primary fs-14 fw-500">{{$obj->area ? $obj->area->name : 'غير محدد'}}</p>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">موقع المنطقة</p>
                    <p class="text-primary fs-14 fw-500">{{$obj->area ? $obj->area->location : 'غير محدد'}}</p>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">مدينة السكن</p>
                    <p class="text-primary fs-14 fw-500">{{$obj->residence_city}}</p>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">تاريخ الوصول</p>
                    <p class="text-primary fs-14 fw-500">{{$obj->arrival_date}}</p>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">وقت الوصول</p>
                    <p class="text-primary fs-14 fw-500">{{$obj->arrival_time}}</p>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">جهة التنفيذ</p>
                    <p class="text-primary fs-14 fw-500">{{$obj->executor}}</p>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">رقم العقد</p>
                    <p class="text-primary fs-14 fw-500">{{$obj->contract_number}}</p>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
