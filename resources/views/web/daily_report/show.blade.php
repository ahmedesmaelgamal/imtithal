@extends('web.layouts.master')
@section('content')
    <div class="breadcrumb mt-4 mb-4">
        <a href="{{route('adminHome')}}"><img class="h-24" src="{{asset('web/image/home.png')}}" alt="no-icon"></a>
        <img class="h-24 me-3 ms-3" src="{{asset('web/image/icon-breadcrumb.png')}}" alt="no-icon">
        <a class="link-breadcrumb" href="{{route('daily_report.index')}}">إدارة التقارير اليومية</a>
        <img class="h-24 me-3 ms-3" src="{{asset('web/image/icon-breadcrumb.png')}}" alt="no-icon">
        <span class="fs-14 fw-400 text-secondary">عرض التقرير اليومى</span>
    </div>
    <div class="card-border mt-16">
        <div class="d-flex justify-content-between flex-wrap">
            <h5 class="text-primary">{{$obj->title}}</h5>
            <div class="d-flex">
                        <span class="status-new">
@php
    $assignUser = $obj->dailyReportAssignUser->where('daily_report_id', $obj->id)->first();
    $status = $assignUser ? \App\Enum\LeaderDailyReportAssignUserStatusEnum::from($assignUser->status)->lang() : 'لم يتم اسناد هذا التقرير لموظف';
@endphp
<span class="status-new">{{ $status }}</span>
                        </span>
            </div>
        </div>
        <hr class="hr-card">
        <div class="card-details">
            <div>
                <h6 class="text-primary">تفاصيل التقرير اليومى</h6>
            </div>
            <hr class="hr-card">
            <div class="row">

                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">تاريخ التقرير اليومى</p>
                    <p class="text-primary fs-14 fw-500">{{$obj->created_at->locale('ar')->translatedFormat('d F Y')}}</p>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">نوع الرصد</p>
                    <p class="text-primary fs-14 fw-500">{{\App\Enum\monitorType::from($obj->monitor_type)->lang()}} </p>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2"> الجهة ذات علاقة</p>
                    <p class="text-primary fs-14 fw-500">{{\App\Enum\SideType::from($obj->side_type)->lang()}}</p>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <p class="text-secondary fs-14 fw-400 mb-2">اسم المحور</p>
                    <p class="text-primary fs-14 fw-500">{{$obj->axis->name}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card-details mt-16">
                    <div>
                        <h6 class="text-primary">وصف التقرير اليومى</h6>
                    </div>
                    <hr class="hr-card">
                    <p class="text-secondary2 fs-14 fw-400 lh-lg">
                        {{$obj->description}}
                    </p>
                </div>
            </div>
        </div>
 <div class="card-details mt-16">
     <div>
         <h6 class="text-primary">اسئلة المحور</h6>
     </div>
     <hr class="hr-card">


     <div>
         @foreach($obj->axis->axisQuestions->sortBy('order_number') as $index => $axisQuestion)
             <div class="mt-3">
                 <button class="btn-ollapse d-flex justify-content-between w-100" data-bs-toggle="collapse"
                         data-bs-target="#collapseExample{{ $index }}" aria-expanded="false"
                         aria-controls="collapseExample{{ $index }}">
                     <div class="head-collapse d-flex">
                         <span class="status-accept" style="padding: 0 8px;">{{$axisQuestion->order_number}}</span>
                         <h6 class="fw-400 me-2">{{$axisQuestion->question}} </h6>
                     </div>
                     <div class="d-flex">
                         <div class="collapse-icon me-2">
                             <i class="fa-solid fa-angle-down"></i>
                         </div>
                     </div>
                 </button>
                 <div class="collapse me-3" id="collapseExample{{ $index }}">
                     <h6 class="fw-400 mt-3 bg-white p-2" style="border-radius: 8px;">{{$axisQuestion->question}}</h6>
                     @if($axisQuestion->answer_type !== 0)
                         <h6 class="fw-400 mt-3">الاجابات </h6>
                         @foreach($axisQuestion->answers as $answer)
                             <p class="fw-400 mt-3 bg-white p-2" style="border-radius: 8px;">{{$answer->answer}}</p>
                         @endforeach
                     @else
                         <p class="fw-400 mt-3 bg-white p-2" style="border-radius: 8px;">يترك تقيم للمشرف</p>
                     @endif
                 </div>
             </div>
         @endforeach
     </div>
 </div>

@endsection
