@extends('web.layouts.master')
@section('content')
    <div class="breadcrumb mt-4 mb-4">
        <a href="{{ route('adminHome') }}">
            <img class="h-24" src="{{ asset('web/image/home.png') }}" alt="no-icon">
        </a>
        <img class="h-24 me-3 ms-3" src="{{ asset('web/image/icon-breadcrumb.png') }}" alt="no-icon">
        <a class="link-breadcrumb" href="{{ route('attendance.index') }}">سجل الحضور و الانصراف</a>
        <img class="h-24 me-3 ms-3" src="{{ asset('web/image/icon-breadcrumb.png') }}" alt="no-icon">
        <span class="fs-14 fw-400 text-secondary">سجل الحضور و الانصراف ل {{ $user->full_name }}</span>
    </div>

    <div class="card-border mt-16">
        <div class="d-flex justify-content-between flex-wrap">
            <h5 class="text-primary">سجل الحضور و الانصراف</h5>

        </div>
        <hr class="hr-card">

        <!-- User Details -->
        <div class="card-details">
            <h5 class="mb-3" style="font-size: 14px; color: #929A9F;">اسم ال {{ $user->getRoleNames()->first() }}</h5>
            <div class="d-flex">
                <img class="image-table" src="{{ getFile($user->image, 'assets/uploads/avatar.png') }}" alt="no-image">
                <div>
                    <h6 class="name-table d-flex align-items-center">{{ $user->full_name }}</h6>
                </div>
            </div>
        </div>

        <!-- Attendance Records -->
        <div class="card-details mt-3">
            @forelse($monthsOfUsers as $month)
                <div>
                    <h5 class="mb-3" style="font-size: 14px; color: #929A9F;">شهر {{ translateMonthToArabic($month) }}</h5>
                    @php
                        // Get all dates for the current month
                        $currentMonthDates = [];
                        foreach ($objs->filter(fn($obj) => \Carbon\Carbon::parse($obj->date)->format('F') === $month) as $obj) {
                            $currentMonthDates[] = $obj->date;
                        }

                        // Get absent dates for the current month
                        $currentMonthAbsentDates = array_filter($absentDates, function ($date) use ($month) {
                            return \Carbon\Carbon::parse($date)->format('F') === $month;
                        });

                        // Merge attendance and absent dates
                        $allMonthDates = array_unique(array_merge($currentMonthDates, $currentMonthAbsentDates));
                        // Sort dates in ascending order
                        usort($allMonthDates, function ($a, $b) {
                            return strtotime($a) - strtotime($b);
                        });
                    @endphp

                    @foreach($allMonthDates as $date)
                        <div class="bg-white mb-2" style="border-radius: 10px; padding: 16px">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <div class="icon-table" style="padding: 4px 16px;">
                                            <h5 class="text-center" style="font-size: 14px; color: #929A9F;">
                                                {{ \Carbon\Carbon::parse($date)->format('d') }}
                                            </h5>
                                            <h5 class="text-center" style="font-size: 14px;">
                                                {{ translateMonthToArabic(\Carbon\Carbon::parse($date)->format('F')) }}
                                            </h5>
                                        </div>
                                        <div>
                                            @if(in_array($date, $currentMonthDates))
                                                @php
                                                    $obj = $objs->firstWhere('date', $date);
                                                @endphp
                                                <h6 class="fs-12 mt-1 mb-3" style="font-weight: 400;">
                                                    تم الحضور الساعة
                                                    <span>
                                                {{ \Carbon\Carbon::parse($obj->checkin)->addHours(3)->format('h:i ') }}
                                                        {{ \Carbon\Carbon::parse($obj->checkin)->addHours(3)->format('A') === 'AM' ? 'صباحا' : 'مساءا' }}
                                            </span>
                                                </h6>
                                            @if($obj->checkout)
                                                    <h6 class="fs-12" style="font-weight: 400;">
                                                        تم الانصراف الساعة
                                                        <span>
                                                {{ \Carbon\Carbon::parse($obj->checkout)->addHours(3)->format('h:i ') }}
                                                            {{ \Carbon\Carbon::parse($obj->checkout)->addHours(3)->format('A') === 'AM' ? 'صباحا' : 'مساءا' }}
                                            </span>
                                                    </h6>
                                                @else
                                                    <h6 class="fs-12 mt-1 mb-3" style="font-weight: 400; color: red;">
                                                        لم يتم الانصراف
                                                    </h6>

                                            @endif

                                            @else
                                                <h6 class="fs-12 mt-1 mb-3" style="font-weight: 400;color: red;">
                                                    غائب
                                                </h6>
                                                <h6 class="fs-12 mt-1 mb-3" style="font-weight: 400; color: red;">
                                                    غائب
                                                </h6>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @empty
                <p class="text-center">لا توجد سجلات حضور وانصراف لهذا الموظف</p>
            @endforelse
        </div>
    </div>
@endsection
