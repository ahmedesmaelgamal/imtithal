@extends('web.layouts.master')
@section('content')
    <div class="breadcrumb mt-4 mb-4">
        <a href="{{route('adminHome')}}"><img class="h-24" src="{{asset('web/image/home.png')}}" alt="no-icon"></a>
        <img class="h-24 me-3 ms-3" src="{{asset('web/image/icon-breadcrumb.png')}}" alt="no-icon">

        <a class="link-breadcrumb" href="{{ route('report.index') }}">إدارة التقارير</a>
        <img class="h-24 me-3 ms-3" src="{{asset('web/image/icon-breadcrumb.png')}}" alt="no-icon">
        <span class="fs-14 fw-400 text-secondary">{{$report->title??""}}</span>
    </div>
    <div class="card-border mt-16">
        <div class="d-flex justify-content-between flex-wrap">
            <h5 class="text-primary d-flex align-items-center">{{$report->title??""}}</h5>
            @if($report->status==0)
                <div class="d-flex">
                    <button type="button" class="btn-refuse ms-3 statusBtn" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                        رفض
                        التقرير
                    </button>
                    <button type="button" class="btn-accept statusBtn" data-bs-toggle="modal"
                            data-bs-target="#exampleModal1">
                        اعتماد
                        التقرير
                    </button>
                </div>
            @endif
        </div>
        <hr class="hr-card">
        <div class="card-details">
            <div>
                <h6 class="text-primary">تفاصيل التقرير</h6>
            </div>
            <hr class="hr-card">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">رقم التقرير</p>
                    <p class="text-primary fs-14 fw-500">#{{$report->id}}</p>
                </div>
                @if($report->user)
                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <p class="text-secondary fs-14 fw-400 mb-2">مرسل التقرير </p>
                        <div class="d-flex">
                            <img class="image-table" src="{{getFile($report->user->image,'assets/uploads/avatar.png')}}"
                                 alt="no-image">
                            <h6 class="name-table d-flex align-items-center">{{$report->user->full_name}}</h6>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <p class="text-secondary fs-14 fw-400 mb-2">دور المرسل</p>
                        <p class="text-primary fs-14 fw-500">{{$report->user->getroleNames()[0]}} </p>
                    </div>
                @endif
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">نوع التقرير</p>
                    <p class="text-primary fs-14 fw-500"> مخالفة</p>
                </div>


                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">حالة التقرير</p>
                    @if ($report->status=='1')
                        <span class="status-accept">
                            معتمد
                         </span>

                    @elseif ($report->status=='2')
                        <span class="status-refuse">
                                        مرفوضة
                              </span>

                    @else
                        <span class="status-new">
                            معلق
                         </span>
                    @endif

                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">تاريخ الارسال</p>
                    <p class="text-primary fs-14 fw-500">{{\Carbon\Carbon::parse($report->created_at)->locale('ar')->translatedFormat('d F Y')}}</p>
                </div>
                @if($adminAction)
                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        @if($report->status=='1')
                            <p class="text-secondary fs-14 fw-400 mb-2"> مدير النظام الذي إعتمد التقرير</p>
                        @elseif($report->status=='2')
                            <p class="text-secondary fs-14 fw-400 mb-2"> مدير النظام الذي رفض التقرير</p>
                        @endif
                        <p class="text-primary fs-14 xfw-500">{{$adminAction->full_name}}</p>

                    </div>
                @endif
                @if($report->status== '2')
                    <div class="col-md-6 col-12 mb-3">
                        <div class="card-refuse">
                            <div class="d-flex">
                                <img class="h-24" src="{{ asset('web/image/warning-triangle.png') }}" alt="no-image">
                                <div class="w-100">
                                    <h6 class="text-primary">{{ $report->refuse_reason ? \App\Enum\DailyReportRejectReasonEnum::tryFrom($report->refuse_reason)?->lang() : null }}</h6>
                                    <hr class="hr-card">
                                </div>
                            </div>
                            <p class="text-secondary fs-14 mb-2">{{  $report->refuse_notes }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card-details mt-16">
                    <div>
                        <h6 class="text-primary">تفاصيل المخالفة الاساسية</h6>
                    </div>
                    <hr class="hr-card">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-12 mb-3">
                            <p class="text-secondary fs-14 fw-400 mb-2">رقم المرجع للادخال</p>
                            <p class="text-primary fs-14 fw-500">{{$report->reference_number}}</p>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12 mb-3">
                            <p class="text-secondary fs-14 fw-400 mb-2">وقت المخالفة </p>
                            <p class="text-primary fs-14 fw-500">{{ str_replace(['ص', 'م'], ['صباحًا', 'مساءً'],\Carbon\Carbon::parse($report->violation_date)->locale('ar')->translatedFormat('h:i A'))}}</p>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12 mb-3">
                            <p class="text-secondary fs-14 fw-400 mb-2">تاريخ المخالفة</p>
                            <p class="text-primary fs-14 fw-500">{{\Carbon\Carbon::parse($report->violation_date)->locale('ar')->translatedFormat('d F Y')}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card-details mt-16">
                    <div>
                        <h6 class="text-primary">موقع المخالفة</h6>
                    </div>
                    <hr class="hr-card">
                    <div class="row">
                        <div class="col-md-4 col-12 mb-3">
                            <p class="text-secondary fs-14 fw-400 mb-2">رابط موقع المخالفة</p>
                            <p class="text-primary fs-14 fw-500">{{$report->map_url}}</p>
                        </div>
                        <div class="col-md-8 col-12 mb-3">
                            <p class="text-secondary fs-14 fw-400 mb-2">إحداثيات موقع المخالفة</p>
                            <p class="text-primary fs-14 fw-500">خط العرض: {{$report->lat}}، خط
                                الطول: {{$report->long}}</p>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12 mb-3">
                            <p class="text-secondary fs-14 fw-400 mb-2">خريطة موقع المخالفة</p>
                            {{--                            <img class="h-150 w-100" src="{{$report->}}" alt="no-image">--}}
                            <div class="col-12">
                                {{--                                <label class="form-label fs-14 fw-500 text-primary">إحداثيات الموقع</label>--}}
                                <div id="maps-container">
                                    <div class="map-wrapper">
                                        <div id="map" style="height: 300px;"></div>
                                        <input type="hidden" name="latitude" id="latitude">
                                        <input type="hidden" name="longitude" id="longitude">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card-details mt-16">
                    <div>
                        <h6 class="text-primary">بيانات المركبة</h6>
                    </div>
                    <hr class="hr-card">
                    <div class="row">
                        <div class="col-md-6 col-12 mb-3">
                            <p class="text-secondary fs-14 fw-400 mb-2">رقم لوحة المركبة المخالفة</p>
                            <p class="text-primary fs-14 fw-500">{{$report->plate_number}}</p>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <p class="text-secondary fs-14 fw-400 mb-2">نوع المركبة</p>
                            @if($report->vehicle_type)
                                <p class="text-primary fs-14 fw-500">{{  \App\Enum\VehicleType::tryfrom((int)$report->vehicle_type)->lang() }}</p>
                            @else
                                <p class="text-primary fs-14 fw-500">{{'نوع المركبه غير متوفر'}}</p>

                            @endif
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <p class="text-secondary fs-14 fw-400 mb-2">حروف لوحة المركبة المخالفة (بالإنجليزية)</p>
                            <p class="text-primary fs-14 fw-500">{{$report->plate_letter_en}}</p>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <p class="text-secondary fs-14 fw-400 mb-2">حروف لوحة المركبة المخالفة (بالعربية)</p>
                            <p class="text-primary fs-14 fw-500">{{$report->plate_letter_ar}}</p>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <p class="text-secondary fs-14 fw-400 mb-2">صورة لوحة المركبة المخالفة</p>
                            @if($report->plate_image)
                                <a target="_blank" class="d-flex bg-white rounded p-2"
                                   href="{{getFile($report->plate_image)}}">
                                    <img class="h-40 ms-2" src="{{getFile($report->plate_image)}}" alt="no-image">
                                    <div>
                                        <p class="text-primary fs-12 fw-400">الأدلة والشواهد الميدانية</p>
                                        <p class="text-secondary fs-12 fw-400 mb-2">{{ getFileSizeInMB($report->plate_image) }}</p>
                                    </div>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-details mt-16">
            <div>
                <h6 class="text-primary">الادالة المرفقة</h6>
            </div>
            <hr class="hr-card">
            <div class="row">
                <div class="col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">شرح مفصل لنوع المخالفة:</p>
                    <p class="text-primary fs-14 fw-500">{!!$report->description??'لايوجد' !!}  </p>
                </div>
                @if($report->violation_image)
                    <a href="{{getFile($report->violation_image)}}" target="_blank" class="col-lg-6 col-12 mb-2">
                        <p class="text-secondary fs-14 fw-400 mb-2">صورة للمخالفة</p>
                        <div class="d-flex bg-white rounded p-2">
                            <img class="h-40 ms-2" src="{{getFile($report->violation_image)}}" alt="no-image">
                            <div>
                                <p class="text-primary fs-12 fw-400">الأدلة والشواهد الميدانية</p>
                                <p class="text-secondary fs-12 fw-400 mb-2">{{ getFileSizeInMB($report->violation_image) }}</p>
                            </div>
                        </div>
                    </a>
                @endif
                @if($report->violation_video)
                    <a href="{{getFile($report->violation_video)}}" target="_blank" class="col-lg-6 col-12 mb-2">
                        <p class="text-secondary fs-14 fw-400 mb-2">فيديو للمخالفة</p>
                        <div class="d-flex bg-white rounded p-2">
                            <img class="h-40 ms-2" src="{{getFile($report->violation_video)}}" alt="no-image">
                            <div>
                                <p class="text-primary fs-12 fw-400">الأدلة والشواهد الميدانية</p>
                                <p class="text-secondary fs-12 fw-400 mb-2">{{ getFileSizeInMB($report->violation_video) }}</p>
                            </div>
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
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
                    <form action="{{route('report_status.update',$report->id)}}" method="POST"
                          class="row g-3 updateStatus">
                        @csrf
                        @method('PUT')
                        <div class="col-12">
                            <input type="hidden" name="type" value="violation" id="reportType">
                            <input type="hidden" name="status" value="refuse" id="reportStatus">
                            <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">سبب الرفض
                                <span class="text-red">*</span>
                            </label>
                            <select name="refuse_reason" class="form-select w-100 fs-12 fw-400 text-primary bg-gray"
                                    id="reportRefuseReason"
                                    required>
                                <option selected disabled class="text-secondary" value="">اختر سبب الرفض</option>
                                @foreach($refuse_reasons as $refuse_reason)
                                    <option value="{{$refuse_reason->value}}">{{$refuse_reason->lang()}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="change-direction">
                                <label for="validationTextarea"
                                       class="form-label fs-14 fw-500 text-primary">ملاحظات </label>
                                <textarea name="refuse_notes"
                                          class="form-control fs-12 fw-400 text-secondary bg-gray h-150"
                                          id="reportRefuseNotes" placeholder=" أضف ملاحظات عن سبب رفض المهمة"
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <input type="hidden" name="status" value="accept">
                <div class="modal-header bg-gray d-flex flex-column align-items-start">
                    <h5 class="text-primary fs-18" id="exampleModalLabel">رسالة تاكيد</h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('report_status.update',$report->id)}}" method="POST"
                          class="row g-3 updateStatus">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="type" value="violation" id="reportType">
                        <input type="hidden" name="status" value="accept" id="reportStatus">
                        <div class="d-flex justify-content-center mb-3 mt-5">
                            <img height="140" src="{{asset('web/image/accept-image.png')}}" alt="no-image">
                        </div>
                        <h6 class="text-primary fs-18 fw-500 text-center mb-2">هل انت متاكد من اعتماد التقرير؟</h6>
                        <p class="text-secondary fs-14 fw-400 text-center  mb-5">بمجرد تأكيد هذا الإجراء، لن تتمكن من
                            التراجع.</p>
                        <div class="modal-footer d-flex justify-content-between pt-3">
                            <button type="button" class="view border-0" data-bs-dismiss="modal">الغاء</button>
                            <button type="submit" class="main-button ">تاكيد الاعتماد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

    {{-- for status update --}}
    <script>
        $(document).ready(function () {
            $('.updateStatus').on('submit', function (e) {
                e.preventDefault(); // Prevent default form submission

                let form = $(this);
                let url = form.attr('action');
                let submitBtn = form.find('#submitBtn');

                let formData = {
                    _method: 'PUT',
                    type: form.find('input[name="type"]').val(),
                    status: form.find('input[name="status"]').val(),
                    refuse_reason: form.find('select[name="refuse_reason"]').val() || null,
                    refuse_notes: form.find('textarea[name="refuse_notes"]').val(),
                };

                $.ajax({
                    url: url,
                    method: 'PUT',
                    data: JSON.stringify(formData),
                    contentType: 'application/json',  // Ensure JSON format
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'   // Laravel expects this for JSON requests
                    },
                    beforeSend: function () {
                        submitBtn.html('<span class="spinner-border spinner-border-sm mr-2"></span> <span style="margin-left: 4px;">جاري الإرسال ...</span>')
                            .attr('disabled', true);
                    },
                    success: function (response) {
                        if (response.success) {
                            toastr.success(response.message);
                            $('.modal').modal('hide');
                            $('#example').DataTable().ajax.reload();
                            $('.statusBtn').attr('disabled', true).css({
                                'background-color': '#ccc',
                                'color': '#666',
                                'cursor': 'not-allowed',
                                'opacity': '0.6',
                                'border-color': '#aaa',
                                'pointer-events': 'none' // Prevents clicks
                            });
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function (xhr) {
                        let errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'حدث خطأ ما';
                        toastr.error(errorMessage);
                    },
                    complete: function () {
                        submitBtn.html('تأكيد الاعتماد').attr('disabled', false);
                    }
                });

            });
        });

    </script>






    <script defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCK_HenDkNSugL5gakTqdIagO4y8KR-udc&callback=initMap&v=weekly">
    </script>

    <script>
        function initMap() {
            var defaultLocation = {lat: {{$report->lat}}, lng: {{$report->long}}}; // Default location (Riyadh, KSA)
            var map = new google.maps.Map(document.getElementById('map'), {
                center: defaultLocation,
                zoom: 12
            });

            var marker = new google.maps.Marker({
                position: defaultLocation,
                map: map,
                draggable: true
            });

            // Update input fields with default location
            document.getElementById('latitude').value = defaultLocation.lat;
            document.getElementById('longitude').value = defaultLocation.lng;

            // Click event to place marker at clicked location
            map.addListener('click', function (event) {
                marker.setPosition(event.latLng);
                document.getElementById('latitude').value = event.latLng.lat().toFixed(6);
                document.getElementById('longitude').value = event.latLng.lng().toFixed(6);
            });

            // Drag event to update input fields when marker is moved
            marker.addListener('dragend', function (event) {
                document.getElementById('latitude').value = event.latLng.lat().toFixed(6);
                document.getElementById('longitude').value = event.latLng.lng().toFixed(6);
            });
        }
    </script>

@endsection
