@extends('web.layouts.master')
@section('content')
    <div class="breadcrumb mt-4 mb-4">
        <a href="{{route('adminHome')}}"><img class="h-24" src="{{asset('web/image/home.png')}}" alt="no-icon"></a>
        <img class="h-24 me-3 ms-3" src="{{asset('web/image/icon-breadcrumb.png')}}" alt="no-icon">
        <a class="link-breadcrumb" href="{{route('users.index')}}">إدارة الموظفين</a>
        <img class="h-24 me-3 ms-3" src="{{asset('web/image/icon-breadcrumb.png')}}" alt="no-icon">
        <span class="fs-14 fw-400 text-secondary">عرض الموظف</span>
    </div>
    <div class="card-border mt-16">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="d-flex align-items-center">
                <img class="image-table me-3" src="{{ getFile($user->image, 'assets/uploads/avatar.png') }}" style="width: 60px; height: 60px; border-radius: 50%;" alt="no-image">
                <h5 class="text-primary mb-0">{{ $user->full_name }}</h5>
            </div>
            <div class="d-flex align-items-center">
                <span class="{{ $user->status == 1 ? 'text-success' : 'text-danger' }} fs-14 fw-500">
                    {{ $user->status == 1 ? 'مفعل' : 'غير مفعل' }}
                </span>
            </div>
        </div>
        <hr class="hr-card">
        <div class="card-details">
            <div>
                <h6 class="text-primary">بيانات الموظف</h6>
            </div>
            <hr class="hr-card">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">الاسم الكامل</p>
                    <p class="text-primary fs-14 fw-500">{{ $user->full_name }}</p>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">رقم الهوية</p>
                    <p class="text-primary fs-14 fw-500">{{ $user->national_id }}</p>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">رقم الجوال</p>
                    <p class="text-primary fs-14 fw-500">{{ $user->phone }}</p>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">البريد الإلكتروني</p>
                    <p class="text-primary fs-14 fw-500">{{ $user->email }}</p>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">الدور / الرتبة</p>
                    <p class="text-primary fs-14 fw-500">{{ $user->getRoleNames()->first() ?? 'لا يوجد' }}</p>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">تاريخ الإضافة</p>
                    <p class="text-primary fs-14 fw-500">{{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d') }}</p>
                </div>
            </div>

            <div class="mt-4">
                <h6 class="text-primary">الورديات (Shifts)</h6>
            </div>
            <hr class="hr-card">
            <div class="row">
                @forelse($user->setting as $userSetting)
                    <div class="col-lg-3 col-md-6 col-12 mb-3">
                        <div class="p-2 border rounded bg-light">
                            <p class="text-primary fs-14 fw-500 mb-0">{{ $userSetting->setting->name ?? 'غير معروف' }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-secondary fs-14 fw-400">لا يوجد ورديات مسجلة</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                <h6 class="text-primary">المواقع المعينة (Assigned Sites/Areas)</h6>
            </div>
            <hr class="hr-card">
            <div class="row">
                @forelse($user->areas as $areaTeam)
                    <div class="col-lg-3 col-md-6 col-12 mb-3">
                        <div class="p-2 border rounded">
                            <p class="text-secondary fs-12 fw-400 mb-1">موقع</p>
                            <p class="text-primary fs-14 fw-500 mb-0">{{ $areaTeam->area->name ?? 'غير معروف' }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-secondary fs-14 fw-400">لا يوجد مواقع معينة</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
