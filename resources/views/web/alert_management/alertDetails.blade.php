@extends('web.layouts.master')
@section('content')
    <div class="breadcrumb mt-4 mb-4">
        <a href="{{route('adminHome')}}"><img class="h-24" src="{{asset('web/image/home.png')}}" alt="no-icon"></a>
        <img class="h-24 me-3 ms-3" src="{{asset('web/image/icon-breadcrumb.png')}}" alt="no-icon">
        <a class="link-breadcrumb" href="{{route('alert.index')}}">إدارة التنبيهات</a>
        <img class="h-24 me-3 ms-3" src="{{asset('web/image/icon-breadcrumb.png')}}" alt="no-icon">
        <span class="fs-14 fw-400 text-secondary">{{$alert->title}}</span>
    </div>
    <div class="card-border mt-16">
        <div class="d-flex justify-content-between">
            <h5 class="text-primary">{{$alert->title}}</h5>
        </div>
        <hr class="hr-card">
        <div class="card-details">
            <div>
                <h6 class="text-primary">تفاصيل التنبيه</h6>
            </div>
            <hr class="hr-card">
            <div class="row">
                <div class="col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">مرسل التنبيه </p>
                    <div class="d-flex">
                        <img class="image-table" src="{{getFile($alertUser->image,'assets/uploads/avatar.png')}}" alt="no-image">
                        <h6 class="name-table d-flex align-items-center">{{$alertUser->full_name}}</h6>
                    </div>
                </div>
{{--                <div class="col-lg-4 col-md-6 col-12 mb-3">--}}
{{--                    <p class="text-secondary fs-14 fw-400 mb-2"> الاولوية</p>--}}
{{--                    <div class="table-info text-red">--}}

{{--                        @if ($alert->priority == 'high')--}}
{{--                            <div class="table-info text-green"> عاليه </div>--}}
{{--                        @elseif ($alert->priority == 'mid')--}}
{{--                            <div class="table-info text-brown"> متوسطه </div>--}}
{{--                        @elseif ($alert->priority == 'low')--}}
{{--                            <div class="table-info text-red">منخفضه</div>--}}
{{--                        @else--}}
{{--                            <div class="table-info text-red">غير محدد</div>--}}
{{--                        @endif--}}


{{--                    </div>--}}
{{--                </div>--}}

                <div class="col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">تاريخ الارسال</p>
                    <p class="text-primary fs-14 fw-500">{{\Carbon\Carbon::parse($alert->created_at)->locale('ar')->translatedFormat('d F Y')}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card-details mt-16">
                    <div>
                        <h6 class="text-primary">وصف التنبيه</h6>
                    </div>
                    <hr class="hr-card">
                    <p class="text-secondary2 fs-14 fw-400 lh-lg">
                        {{$alert->body}}
                    </p>
                </div>
            </div>
        </div>
{{--        <div class="card-details mt-16">--}}
{{--            <div>--}}
{{--                <h6 class="text-primary">ملفات التنبيه</h6>--}}
{{--            </div>--}}
{{--            <hr class="hr-card">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-6 col-12 mb-2">--}}
{{--                    <div class="d-flex bg-white rounded p-2">--}}
{{--                        <img class="h-40 ms-2" src="{{asset('web/image/file.png')}}" alt="no-image">--}}
{{--                        <div>--}}
{{--                            <p class="text-primary fs-12 fw-400">الأدلة والشواهد الميدانية</p>--}}
{{--                            <p class="text-secondary fs-12 fw-400 mb-2">1,2MB</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-6 col-12 mb-2">--}}
{{--                    <div class="d-flex bg-white rounded p-2">--}}
{{--                        <img class="h-40 ms-2" src="{{asset('web/image/video.png')}}" alt="no-image">--}}
{{--                        <div>--}}
{{--                            <p class="text-primary fs-12 fw-400">الأدلة والشواهد الميدانية</p>--}}
{{--                            <p class="text-secondary fs-12 fw-400 mb-2">1,2MB</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-gray d-flex flex-column align-items-start">
                    <h5 class="text-primary fs-18" id="exampleModalLabel">رسالة رفض</h5>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center mb-3">
                        <img height="140" src="{{asset('web/image/refuse-image.png')}}" alt="no-image">
                    </div>
                    <h6 class="text-primary fs-18 fw-500 text-center mb-2">هل انت متاكد من رفض التقرير؟</h6>
                    <p class="text-secondary fs-14 fw-400 text-center mb-3">بمجرد تأكيد هذا الإجراء، لن تتمكن من
                        التراجع.</p>
                    <form class="row g-3">
                        <div class="col-12">
                            <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">سبب الرفض
                                <span class="text-red">*</span>
                            </label>
                            <select class="form-select w-100 fs-12 fw-400 text-primary bg-gray" id="validationDefault04"
                                    required>
                                <option selected disabled class="text-secondary" value="">اختر سبب الرفض</option>
                                <option>السبب 1</option>
                                <option>السبب 2</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="change-direction">
                                <label for="validationTextarea"
                                       class="form-label fs-14 fw-500 text-primary">ملاحظات </label>
                                <textarea class="form-control fs-12 fw-400 text-secondary bg-gray h-150"
                                          id="validationTextarea" placeholder=" أضف ملاحظات عن سبب رفض المهمة"
                                          required></textarea>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between border-top pt-3 mt-4">
                            <button type="button" class="view border-0" data-bs-dismiss="modal">الغاء</button>
                            <button type="submit" class="main-button">رفض التقرير</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-gray d-flex flex-column align-items-start">
                    <h5 class="text-primary fs-18" id="exampleModalLabel">رسالة تاكيد</h5>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center mb-3">
                        <img height="140" src="{{asset('web/image/accept-image.png')}}" alt="no-image">
                    </div>
                    <h6 class="text-primary fs-18 fw-500 text-center mb-2">هل انت متاكد من اعتماد التقرير؟</h6>
                    <p class="text-secondary fs-14 fw-400 text-center  mb-2">بمجرد تأكيد هذا الإجراء، لن تتمكن من
                        التراجع.</p>
                </div>
                <div class="modal-footer d-flex justify-content-between pt-3">
                    <button type="button" class="view border-0" data-bs-dismiss="modal">الغاء</button>
                    <button type="submit" class="main-button">تاكيد الاعتماد</button>
                </div>
            </div>
        </div>
    </div>
@endsection
