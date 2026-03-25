@extends('web.layouts.master')
@section('content')

    <div class="breadcrumb mt-4 mb-4">
        <a href="{{route('adminHome')}}"><img class="h-24" src="{{asset('web/image/home.png')}}" alt="no-icon"></a>
        <img class="h-24 me-3 ms-3" src="{{asset('web/image/icon-breadcrumb.png')}}" alt="no-icon">
        <a class="link-breadcrumb" href="{{route('notice.index')}}">إدارة البلاغات</a>
        <img class="h-24 me-3 ms-3" src="{{asset('web/image/icon-breadcrumb.png')}}" alt="no-icon">
        <span class="fs-14 fw-400 text-secondary">{{$notice->noticeType->name??""}}</span>
    </div>
    <div class="card-border mt-16">
        <div class="d-flex justify-content-between flex-wrap">
            <h5 class="text-primary">{{$notice->noticeType->name??""}}</h5>
            @if($notice->status==0)

                <div class="d-flex">
                    <button type="button" class="btn-refuse ms-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        رفض
                        البلاغ
                    </button>
                    <button type="button" class="btn-accept" data-bs-toggle="modal" data-bs-target="#exampleModal1">حل
                        البلاغ
                    </button>
                </div>
            @endif
        </div>
        <hr class="hr-card">
        <div class="row">
            <div class="col-12">
                <div class="card-details">
                    <div>
                        <h6 class="text-primary">شرح البلاغ</h6>
                    </div>
                    <hr class="hr-card">
                    <p class="text-secondary2 fs-14 fw-400 lh-lg">{{$notice->description}} </p>
                </div>
            </div>
        </div>
        <div class="card-details mt-16">
            <div>
                <h6 class="text-primary">تفاصيل البلاغ</h6>
            </div>
            <hr class="hr-card">
            <div class="row">
                @if($notice->getLocationName())
                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <p class="text-secondary fs-14 fw-400 mb-2">موقع البلاغ</p>
                        <p class="text-primary fs-14 fw-500">{{$notice->getLocationName()}}</p>
                    </div>
                @endif
                @if($notice->user)
                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <p class="text-secondary fs-14 fw-400 mb-2">مرسل البلاغ </p>

                        <div class="d-flex">
                            <img class="image-table" src="{{getFile($notice->user->image,'web/image/image1.png')}}"
                                 alt="no-image">
                            <h6 class="name-table d-flex align-items-center">{{$notice->user->full_name}}</h6>
                        </div>
                    </div>
                @endif
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">درجة الأهمية</p>
                    <p class="text-red fs-14 fw-500">{{\App\Enum\NoticeTypePriorityEnum::from($notice->noticeType->priority)->lang() ??""}} </p>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">تاريخ ووقت الإبلاغ</p>
                    <p class="text-primary fs-14 fw-500">{{ $notice->getFormattedDate() }}</p>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">حالة البلاغ</p>
                    <span
                        class="{{ $notice->status == 0 ? 'status-new' : ($notice->status == 1 ? 'status-accept' : 'status-refuse') }}">
                        {{ \App\Enum\NoticeStatusEnum::from($notice->status)->lang() }}
                            </span>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">تاريخ الارسال</p>
                    <p class="text-primary fs-14 fw-500">{{ $notice->created_at->locale('ar')->translatedFormat('d F Y') }}</p>
                </div>
                @if($adminAction)
                    @if($adminAction->full_name)
                        <div class="col-lg-4 col-md-6 col-12 mb-3">
                            @if($notice->status == '1')
                                <p class="text-secondary fs-14 fw-400 mb-2">مدير النظام الذي إعتمد البلاغ</p>

                            @elseif($notice->status == '2')
                                <p class="text-secondary fs-14 fw-400 mb-2">مدير النظام الذي رفض البلاغ</p>
                                <p class="text-primary fs-14 fw-500">{{$adminAction->full_name}}</p>
                            @endif
                        </div>
                    @endif
                @endif
                @if($notice->status == '2')
                    <div class="col-md-6 col-12 mb-3">
                        <div class="card-refuse">
                            <div class="d-flex">
                                <img class="h-24" src="{{ asset('web/image/warning-triangle.png') }}" alt="no-image">
                                <div class="w-100">
                                    <h6 class="text-primary">{{ $rejectReason }}</h6>
                                    <hr class="hr-card">
                                </div>
                            </div>
                            <p class="text-secondary fs-14 mb-2">{{  $notice->refuse_notice }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="card-details mt-16">
            <div>
                <h6 class="text-primary">الأدلة والشواهد الميدانية</h6>
            </div>
            <hr class="hr-card">
            <div class="row">
                @forelse($notice->media as $media)
                    <a href="{{ getFile($media->file,'web/image/file.png') }}" target="_blank" class="col-lg-6 col-12 mb-2">
                        <div class="d-flex bg-white rounded p-2">
                            <img class="h-40 ms-2" src="{{getFile($media->file,'web/image/file.png')}}" alt="no-image">
                            <div>
                                <p class="text-primary fs-12 fw-400">{{$media->name}}</p>
                                <p class="text-secondary fs-12 fw-400 mb-2">{{getFileSizeInMB($media->file_name)}}</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-12">
                        <p class="text-secondary fs-14 fw-400 text-center">لا يوجد أدلة وشواهد ميدانية</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- END MAIN CONTENT -->

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
                    <form action="{{route('notice_status.update',$notice->id)}}" method="POST"
                          class="row g-3 updateStatus">
                        @csrf
                        @method('PUT')
                        <div class="col-12">
                            <input type="hidden" name="type" value="general" id="reportType">
                            <input type="hidden" name="status" value="refuse" id="reportStatus">
                            <label for="validationDefault04" class="form-label fs-14 fw-500 text-primary">سبب الرفض
                                <span class="text-red">*</span>
                            </label>
                            <select name="refuse_reason" class="form-select w-100 fs-12 fw-400 text-primary bg-gray"
                                    id="reportRefuseReason"
                                    required>
                                <option selected disabled class="text-secondary" value="">اختر سبب الرفض</option>
                                @foreach($refuse_reasons as $refuse_reason)
                                    <option value="{{ $refuse_reason->value }}">{{ $refuse_reason->lang() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="change-direction">
                                <label for="validationTextarea"
                                       class="form-label fs-14 fw-500 text-primary">ملاحظات </label>
                                <textarea name="refuse_notes"
                                          class="form-control fs-12 fw-400 text-secondary bg-gray h-150"
                                          id="reportRefuseNotes" placeholder=" أضف ملاحظات عن سبب رفض البلاغ"
                                          required></textarea>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between border-top pt-3 mt-4">
                            <button type="button" class="view border-0" data-bs-dismiss="modal">الغاء</button>
                            <button type="submit" class="main-button">رفض البلاغ</button>
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
                    <form action="{{route('notice_status.update',$notice->id)}}" method="POST"
                          class="row g-3 updateStatus">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="type" value="general" id="reportType">
                        <input type="hidden" name="status" value="accept" id="reportStatus">
                        <div class="d-flex justify-content-center mb-3 mt-5">
                            <img height="140" src="{{asset('web/image/accept-image.png')}}" alt="no-image">
                        </div>
                        <h6 class="text-primary fs-18 fw-500 text-center mb-2">هل انت متاكد من اعتماد البلاغ؟</h6>
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
@endsection
