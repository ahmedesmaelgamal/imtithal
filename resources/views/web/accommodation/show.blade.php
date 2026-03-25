@extends('web.layouts.master')
@section('content')
    <div class="breadcrumb mt-4 mb-4">
        <a href="{{route('adminHome')}}"><img class="h-24" src="{{asset('web/image/home.png')}}" alt="no-icon"></a>
        <img class="h-24 me-3 ms-3" src="{{asset('web/image/icon-breadcrumb.png')}}" alt="no-icon">
        <a class="link-breadcrumb" href="{{route('accommodations.index')}}">إدارة المساكن</a>
        <img class="h-24 me-3 ms-3" src="{{asset('web/image/icon-breadcrumb.png')}}" alt="no-icon">
        <span class="fs-14 fw-400 text-secondary">عرض المسكن</span>
    </div>

    <style>
        #locationMap {
            height: 400px;
            width: 100%;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
    </style>

    <div class="card-border mt-16">
        <div class="d-flex justify-content-between flex-wrap">
            <h5 class="text-primary">{{$obj->name}}</h5>
            <div class="d-flex">
                <span class="{{ $obj->status == 1 ? 'status-new' : 'status-refuse' }}">
                    {{ $obj->status == 1 ? 'نشط' : 'غير نشط' }}
                </span>
            </div>
        </div>
        <hr class="hr-card">
        <div class="card-details">
            <div>
                <h6 class="text-primary">تفاصيل المسكن</h6>
            </div>
            <hr class="hr-card">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">اسم المسكن</p>
                    <p class="text-primary fs-14 fw-500">{{$obj->name}}</p>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">نوع المسكن</p>
                    <p class="text-primary fs-14 fw-500">{{$obj->parent_id ? 'مسكن فرعي' : 'مسكن رئيسي'}}</p>
                </div>
                @if($obj->parent)
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">المسكن الرئيسي</p>
                    <p class="text-primary fs-14 fw-500">{{$obj->parent->name}}</p>
                </div>
                @endif
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">الموقع (العنوان)</p>
                    <p class="text-primary fs-14 fw-500">{{$obj->location ?: 'غير محدد'}}</p>
                </div>
                @if($obj->season)
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">الموسم</p>
                    <p class="text-primary fs-14 fw-500">{{$obj->season->name}}</p>
                </div>
                @endif
            </div>
        </div>

        @if($obj->latitude && $obj->longitude)
        <div class="card-details mt-16">
            <div>
                <h6 class="text-primary">الموقع على الخريطة</h6>
            </div>
            <hr class="hr-card">
            <div id="locationMap"></div>
        </div>
        @endif

        @if(!$obj->parent_id && $obj->children->count() > 0)
        <div class="card-details mt-16">
            <div>
                <h6 class="text-primary">المساكن الفرعية</h6>
            </div>
            <hr class="hr-card">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th class="text-center">اسم المسكن</th>
                            <th class="text-center">الموقع</th>
                            <th class="text-center">الحالة</th>
                            <th class="text-center">العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($obj->children as $child)
                        <tr>
                            <td>{{$child->name}}</td>
                            <td>{{$child->location ?: 'غير محدد'}}</td>
                            <td>
                                <span class="{{ $child->status == 1 ? 'status-new' : 'status-refuse' }}">
                                    {{ $child->status == 1 ? 'نشط' : 'غير نشط' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{route('accommodations.show', $child->id)}}">
                                    <img src="{{asset('web/image/eye-icon.png')}}" alt="show" style="width:18px;">
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
@endsection

@section('js')
    @if($obj->latitude && $obj->longitude)
    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCK_HenDkNSugL5gakTqdIagO4y8KR-udc&callback=initMap&v=weekly"></script>
    <script>
        function initMap() {
            const pos = { lat: {{ (float)$obj->latitude }}, lng: {{ (float)$obj->longitude }} };
            const map = new google.maps.Map(document.getElementById("locationMap"), {
                center: pos,
                zoom: 15,
            });
            new google.maps.Marker({
                position: pos,
                map: map,
                title: "{{$obj->name}}"
            });
        }
    </script>
    @endif
@endsection
