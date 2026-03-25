@extends('web.layouts.master')
@section('content')
    <div class="breadcrumb mt-4 mb-4">
        <a href="{{route('adminHome')}}"><img class="h-24" src="{{asset('web/image/home.png')}}" alt="no-icon"></a>
        <img class="h-24 me-3 ms-3" src="{{asset('web/image/icon-breadcrumb.png')}}" alt="no-icon">
        <a class="link-breadcrumb" href="{{route('supports.index')}}">الدعم الفني</a>
        <img class="h-24 me-3 ms-3" src="{{asset('web/image/icon-breadcrumb.png')}}" alt="no-icon">
        <span class="fs-14 fw-400 text-secondary">تفاصيل التذكرة</span>
    </div>
    <div class="card-border mt-16">
        <div class="d-flex justify-content-between flex-wrap">
            <h5 class="text-primary">موضوع التذكرة : {{$ticket->subject}}</h5>
            <div class="d-flex">
                <button type="button" class="btn-accept ms-3 statusBtn" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                    اضافة رد
                </button>
            </div>
        </div>
        <hr class="hr-card">
        <div class="card-details">
            <div>
                <h6 class="text-primary">تفاصيل التذكرة</h6>
            </div>
            <hr class="hr-card">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">تاريخ التذكرة</p>
                    <p class="text-primary fs-14 fw-500">{{$ticket->created_at->locale('ar')->translatedFormat('d F Y')}}</p>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">حالة التذكرة</p>
                    <p class="text-primary fs-14 fw-500">{{$ticket->status ? 'تم الرد' : 'لم يتم الرد'}}</p>
                </div>
                <div class="col-lg-12 col-md-12 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">التذكرة</p>
                    <p class="text-primary fs-14 fw-500"> {{$ticket->message}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card-border mt-16">
        <div class="d-flex justify-content-between flex-wrap">
            <h5 class="text-primary">الردود</h5>
        </div>
        <hr class="hr-card">
        @foreach($ticket->replies as $reply)
            <div class="card-details mt-3">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 mb-3">
                        <p class="text-secondary fs-14 fw-400 mb-2">من</p>
                        @if($reply->admin)
                            <p class="text-primary fs-14 fw-500">{{ $reply->admin->full_name }}
                                ( {{ $reply->admin->getRoleNames()[0] }} )</p>
                        @else
                            <p class="text-primary fs-14 fw-500"> {{ $reply->user->full_name }}
                                ( {{ $reply->user->getRoleNames()[0] }} )</p>
                        @endif
                    </div>
                    <div class="col-lg-12 col-md-12 col-12 mb-3">
                        <p class="text-secondary fs-14 fw-400 mb-2">الرد</p>
                        <p class="text-primary fs-14 fw-500"> {{$reply->reply}}</p>
                    </div>
                    <small>{{ $reply->created_at->locale('ar')->translatedFormat('d F Y h:i a') }}</small>
                </div>
            </div>
        @endforeach
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <input type="hidden" name="status" value="accept">
                <div class="modal-header bg-gray d-flex flex-column align-items-start">
                    <h5 class="text-primary fs-18" id="exampleModalLabel">اضافة رد</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('supports.addReply')}}" id="addReplyForm"
                          class="row g-3">
                        @csrf
                        <input type="hidden" name="support_ticket_id" value="{{ $ticket->id }}">
                        <input type="hidden" name="admin_id" value="{{ auth()->user()->id  }}">
                        <textarea name="reply" class="form-control fs-12 fw-400 text-secondary bg-gray h-150"
                                  placeholder="اكتب ردك هنا"></textarea>
                        <div class="modal-footer d-flex justify-content-between pt-3">
                            <button type="button" class="view border-0" data-bs-dismiss="modal">الغاء</button>
                            <button type="submit" class="main-button ">ارسال</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $('#addReplyForm').submit(function (e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var type = form.attr('method');
            var data = form.serialize();
            $.ajax({
                url: url,
                type: type,
                data: data,
                beforeSend: function () {
                    $('#addButton').html('<span class="spinner-border spinner-border-sm mr-2" ' +
                        ' ></span> <span style="margin-left: 4px;">جاري الارسال ...</span>'
                    ).attr('disabled', true);
                },
                success: function (data) {
                    if (data.status) {
                        $('#exampleModal').modal('hide');
                        $('#example').DataTable().ajax.reload();
                        $('#addReplyForm')[0].reset();
                        toastr.success(data.msg);
                        setTimeout(e=>{
                            window.location.reload();
                        },2000)
                    } else {
                        toastr.error(data.msg);
                    }
                },
                error: function (xhr) {
                    let errorMessage = xhr.responseJSON && xhr.responseJSON.msg ? xhr.responseJSON.msg : 'حدث خطاء ما';
                    console.log(errorMessage);
                },
                complete: function () {
                    $('#addButton').html('ارسال').attr('disabled', false);
                }
            });
        });
    </script>
@endsection
