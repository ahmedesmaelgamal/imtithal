<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> مشروع الملكية</title>
    <link href="image/favicon.png" rel="icon" />


    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('web/print') }}/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('web/print') }}/css/bootstrap.min.css">

    <!-- datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.bootstrap5.min.css">

    <!- font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100..900&family=Readex+Pro:wght@160..700&display=swap"
            rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('web/print') }}/css/style.css">

        <style>
            .bg {
                background-image: url(image/bg-login.png);
                background-color: #F7F7F8;
                background-size: cover;
            }

            body {
                direction: rtl;
                font-family: "Readex Pro", serif;
            }

            .text-secondary2 {
                color: #565A5D !important;
                font-size: 16px;
                font-weight: 400;
            }

            @media print {
                body {
                    margin: 0;
                    font-family: "Readex Pro", serif;
                }
            }

            .red-color {
                background-color: #C05E5E;
                color: white;
            }

            .green-color {
                background-color: #35685F;
                color: white;
            }
        </style>

        <!-- pie chart styles -->
        <style>
            .pie-chart {
                display: block;
                margin: 0 auto;
                border-radius: 50%;
            }

            .legend-box {
                width: 10px;
                height: 10px;
                border-radius: 50%;
                display: inline-block;
            }
        </style>
        <!-- pie chart styles -->
</head>

<body>

    <div class="bg d-flex align-items-center" style="height: 100vh;">
        <div class="container">
            <div class="row">
                <!-- <div class="col-2"></div> -->
                <div class="col-12">
                    <div class="bg-white p-5 w-100">
                        <img class="mb-4" style="height: 80px;" src="{{ asset('web/image/logo.png') }}"
                            alt="no-logo">
                        <h5 class="fw-700 mb-3" style="color: #857854; font-size: 30px !important;">التقرير اليومي للرصد
                            الميداني</h5>

                        @foreach ($axes_data as $data)
                            <p class="text-secondary2 mb-4">
                                {{ "{$loop->iteration} - {$data['axis']->name}" }}
                            </p>
                        @endforeach
                        <hr>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <p class="mb-2" style="color: #9EA3A5; font-size: 14px; font-weight: 400;">اسم المشرف
                                </p>
                                <p style="color:#00080C; font-size:14px; font-weight: 500;">
                                    {{ auth()->user()->full_name }}</p>
                            </div>
                            <div class="col-6 mb-3">
                                <p class="mb-2" style="color: #9EA3A5; font-size: 14px; font-weight: 400;">تاريخ
                                    الارسال</p>
                                <p class="text-secondary2" style="font-size:16px; font-weight: 500;">
                                    {{ \Carbon\Carbon::now()->format('Y/m/d') }} م -
                                    {{ \Alkoumi\LaravelHijriDate\Hijri::Date('Y/m/d', \Carbon\Carbon::now()) }} هـ
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-2"></div> -->
            </div>
        </div>
    </div>

    <!-- page1 -->
    @foreach ($axes_data as $data)
        <div class="bg-white mb-5">
            <div class="container">
                <img class="mb-5 mt-5" style="height: 70px;" src="{{ asset('web/image/logo.png') }}" alt="no-logo">
                <div style="background-color: #857854; padding: 12px; color: white;">
                    {{ "{$loop->iteration} - {$data['axis']->name}" }}
                </div>
                <div style="background-color: #F7F7F8; padding: 25px">
                    <div class="row">
                        <div class="col-4 mb-3">
                            <p class="mb-2" style="color: #9EA3A5; font-size: 14px; font-weight: 400;">عدد البلاغات
                            </p>
                            <p style="color:#00080C; font-size:14px; font-weight: 500;">{{ $data['notices_count'] }}
                            </p>
                        </div>
                        <div class="col-4 mb-3">
                            <p class="mb-2" style="color: #9EA3A5; font-size: 14px; font-weight: 400;">أعلى نوع بلاغ
                            </p>
                            <p style="color:#00080C; font-size:14px; font-weight: 500;">
                                {{ isset($data['top_notice_type']['type_name']) ? $data['top_notice_type']['type_name'] : 'لا يوجد بلاغات في هذا المحور' }}
                            </p>
                        </div>
                        <div class="col-4 mb-3">
                            <p class="mb-2" style="color: #9EA3A5; font-size: 14px; font-weight: 400;"> عدد الحافلات
                            </p>
                            <p style="color:#00080C; font-size:14px; font-weight: 500;">
                                {{ $data['bus_reports_count'] }}</p>
                        </div>
                        <div class="col-12 mb-3">
                            <p class="mb-2" style="color: #9EA3A5; font-size: 14px; font-weight: 400;">البلاغات</p>
                            @foreach ($data['notices'] as $notice)
                                <div class="card-border mt-16">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="card-details">
                                                <div>
                                                    <h6 class="text-primary">شرح البلاغ</h6>
                                                </div>
                                                <hr class="hr-card">
                                                <p class="text-secondary2 fs-14 fw-400 lh-lg">
                                                    {{ $notice->description }} </p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="card-details">
                                                <div>
                                                    <h6 class="text-primary">اسم البلاغ</h6>
                                                </div>
                                                <hr class="hr-card">
                                                <p class="text-secondary2 fs-14 fw-400 lh-lg">
                                                    {{ $notice->noticeType->name }} </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-details mt-16">
                                        <div>
                                            <h6 class="text-primary">تفاصيل البلاغ</h6>
                                        </div>
                                        <hr class="hr-card">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                                <p class="text-secondary fs-14 fw-400 mb-2">موقع البلاغ</p>
                                                <p class="text-primary fs-14 fw-500">
                                                    {{ $notice->getLocationName() }}
                                                </p>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                                <p class="text-secondary fs-14 fw-400 mb-2">مرسل البلاغ </p>
                                                <div class="d-flex">
                                                    <img class="image-table"
                                                        src="{{ getFile($notice->user->image, 'web/image/image1.png') }}"
                                                        alt="no-image">
                                                    <h6 class="name-table d-flex align-items-center">
                                                        {{ $notice->user->full_name }}
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                                <p class="text-secondary fs-14 fw-400 mb-2">درجة الأهمية</p>
                                                <p class="text-red fs-14 fw-500">
                                                    {{ \App\Enum\NoticeTypePriorityEnum::from($notice->noticeType->priority)->lang() ?? '' }}
                                                </p>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                                <p class="text-secondary fs-14 fw-400 mb-2">تاريخ ووقت الإبلاغ</p>
                                                <p class="text-primary fs-14 fw-500">
                                                    {{ $notice->getFormattedDate() }}
                                                </p>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                                <p class="text-secondary fs-14 fw-400 mb-2">حالة البلاغ</p>
                                                <span
                                                    class="
                                                    {{ $notice->status == 0 ? 'status-new' : ($notice->status == 1 ? 'status-accept' : 'status-refuse') }}">
                                                    {{ \App\Enum\NoticeStatusEnum::from($notice->status)->lang() }}
                                                </span>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                                <p class="text-secondary fs-14 fw-400 mb-2">تاريخ الارسال</p>
                                                <p class="text-primary fs-14 fw-500">
                                                    {{ $notice->created_at->locale('ar')->translatedFormat('d F Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-details mt-16">
                                        <div>
                                            <h6 class="text-primary">الأدلة والشواهد الميدانية</h6>
                                        </div>
                                        <hr class="hr-card">
                                        <div class="row">
                                            <div class="col-12 mb-2">
                                                <div class="d-flex flex-wrap bg-white rounded p-2">
                                                    @forelse($notice->media as $media)
                                                        <img style="height: 100px;" class="ms-2"
                                                            src="{{ getFile($media->file, 'web/image/file.png') }}"
                                                            alt="no-image">
                                                    @empty
                                                        <p class="text-secondary fs-14 fw-400 text-center">لا يوجد أدلة
                                                            وشواهد ميدانية</p>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-12">
                            <p class="mb-2" style="color: #9EA3A5; font-size: 14px; font-weight: 400;">التقارير</p>
                            @foreach ($data['axis']->dailyReport as $daily_report)
                                <div class="card-border mt-16">
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <h5 class="text-primary">{{ $daily_report->title }}</h5>
                                        <div class="d-flex">
                                            <span class="status-new">
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
                                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                                <p class="text-secondary fs-14 fw-400 mb-2">تاريخ التقرير اليومى</p>
                                                <p class="text-primary fs-14 fw-500">
                                                    {{ $daily_report->created_at->locale('ar')->translatedFormat('d F Y') }}
                                                </p>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                                <p class="text-secondary fs-14 fw-400 mb-2">نوع الرصد</p>
                                                <p class="text-primary fs-14 fw-500">
                                                    {{ \App\Enum\monitorType::from($daily_report->monitor_type)->lang() }}
                                                </p>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                                <p class="text-secondary fs-14 fw-400 mb-2"> الجهة ذات علاقة</p>
                                                <p class="text-primary fs-14 fw-500">
                                                    {{ \App\Enum\SideType::from($daily_report->side_type)->lang() }}
                                                </p>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                                <p class="text-secondary fs-14 fw-400 mb-2">اسم المحور</p>
                                                <p class="text-primary fs-14 fw-500">
                                                    {{ $daily_report->axis->name }}</p>
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
                                                    {{ $daily_report->description }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-details mt-16">
                                        <div>
                                            <h6 class="text-primary">اسئلة المحور</h6>
                                        </div>
                                        <hr class="hr-card">
                                        @php
                                            $colors = ['#c2a873', '#eae3d8', '#ffb84d', '#a8dadc', '#bdb2ff']; // ألوان متغيرة حسب الإجابات
                                        @endphp

                                        @foreach ($daily_report->axis->axisQuestions->sortBy('order_number') as $index => $axisQuestion)
                                            <div class="mt-3">
                                                <button class="btn-ollapse d-flex justify-content-between w-100">
                                                    <div class="head-collapse d-flex">
                                                        <span class="status-accept"
                                                            style="padding: 0 8px;">{{ $loop->iteration }}</span>
                                                        <h6 class="fw-400 me-2">{{ $axisQuestion->question }}</h6>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="collapse-icon me-2">
                                                            <i class="fa-solid fa-angle-down"></i>
                                                        </div>
                                                    </div>
                                                </button>

                                                <div class="me-3">
                                                    @if ($axisQuestion->answer_type != 0)
                                                        @php
                                                            $totalAnswers = $axisQuestion
                                                                ->questionUserAnswers()
                                                                ->count();
                                                            $answerData = [];

                                                            foreach ($axisQuestion->answers as $ans) {
                                                                $count = method_exists($ans, 'answerStats')
                                                                    ? $ans->answerStats()->count()
                                                                    : 0;
                                                                $percentage =
                                                                    $totalAnswers > 0
                                                                        ? round(($count / $totalAnswers) * 100)
                                                                        : 0;
                                                                $answerData[] = [
                                                                    'label' => $ans->answer,
                                                                    'count' => $count,
                                                                    'percentage' => $percentage,
                                                                ];
                                                            }

                                                            $offset = 25;
                                                            $currentOffset = 0;
                                                            $hasData = collect($answerData)->sum('percentage') > 0;
                                                        @endphp

                                                        <div class="text-center my-3">
                                                            <svg viewBox="0 0 32 32" width="120" height="120"
                                                                class="pie-chart">
                                                                @if ($hasData)
                                                                    @foreach ($answerData as $i => $data)
                                                                        @php
                                                                            $dasharray =
                                                                                "{$data['percentage']} " .
                                                                                (100 - $data['percentage']);
                                                                            $color = $colors[$i % count($colors)];
                                                                        @endphp
                                                                        <circle r="16" cx="16" cy="16"
                                                                            stroke="{{ $color }}"
                                                                            stroke-dasharray="{{ $dasharray }}"
                                                                            stroke-dashoffset="{{ $offset - $currentOffset }}"
                                                                            stroke-width="32" fill="none"
                                                                            transform="rotate(-90 16 16)" />
                                                                        @php
                                                                            $currentOffset += $data['percentage'];
                                                                        @endphp
                                                                    @endforeach
                                                                @else
                                                                    <!-- عرض دائرة رمادية فارغة -->
                                                                    <circle r="16" cx="16" cy="16"
                                                                        stroke="#d3d3d3" stroke-dasharray="100 0"
                                                                        stroke-width="32" fill="none"
                                                                        transform="rotate(-90 16 16)" />
                                                                @endif
                                                            </svg>

                                                            <div class="legend d-flex justify-content-center mt-3">
                                                                @foreach ($answerData as $i => $data)
                                                                    <div class="d-flex align-items-center mb-1">
                                                                        <span class="legend-box"
                                                                            style="background-color: {{ $colors[$i % count($colors)] }};"></span>
                                                                        <span class="ms-2">{{ $data['label'] }}
                                                                            ({{ $data['count'] }})
                                                                            -
                                                                            {{ $data['percentage'] }}%</span>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @else
                                                        <p class="fw-400 mt-3 bg-white p-2"
                                                            style="border-radius: 8px;">
                                                            مقـــالـــي
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>


                                </div>
                            @endforeach
                        </div>
                        @if (isset($data['users']))
                            <div class="col-12 mt-3">
                                <p class="mb-2" style="color: #9EA3A5; font-size: 14px; font-weight: 400;">الموظفين
                                </p>
                                @foreach ($data['users'] as $user)
                                    <div class="card-border mt-16">
                                        <div class="col-12 mb-3">
                                            <p class="text-secondary fs-14 fw-400 mb-2"> الموظف </p>
                                            <div class="d-flex">
                                                <img class="image-table"
                                                    src="{{ getFile($user->image, 'assets/uploads/avatar.png') }}"
                                                    alt="no-image">
                                                <h6 class="name-table d-flex align-items-center">
                                                    {{ $user->full_name }}
                                                </h6>
                                            </div>
                                        </div>
                                        <hr class="hr-card">
                                        <div class="card-details">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                                    <p class="text-secondary fs-14 fw-400 mb-2">عدد البلاغات</p>
                                                    <p class="text-primary fs-14 fw-500">
                                                        {{ $user->userNotices()->count() }} </p>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                                    <p class="text-secondary fs-14 fw-400 mb-2"> عدد التقارير اليومية
                                                    </p>
                                                    <p class="text-primary fs-14 fw-500">
                                                        {{ $user->userDailyReports()->where('status', '4')->count() }}
                                                    </p>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                                    <p class="text-secondary fs-14 fw-400 mb-2">عدد المخالفات</p>
                                                    <p class="text-primary fs-14 fw-500">
                                                        {{ $user->violationReports()->count() }}</p>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                                    <p class="text-secondary fs-14 fw-400 mb-2">عدد ايام الحضور</p>
                                                    <p class="text-primary fs-14 fw-500">
                                                        {{ $user->attendances()->count() }}
                                                    </p>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                                    <p class="text-secondary fs-14 fw-400 mb-2">عدد ايام الغياب</p>
                                                    <p class="text-primary fs-14 fw-500">
                                                        @php
                                                            $startDate = \Carbon\Carbon::parse(
                                                                $user->created_at,
                                                            )->startOfDay(); // Ensure it starts at midnight
                                                            $endDate = \Carbon\Carbon::now()->endOfDay(); // Ensure it includes the current day

                                                            // Calculate total days (inclusive of start and end dates)
                                                            $totalDays = $startDate->diffInDays($endDate) + 1; // Add 1 to include both start and end dates

                                                            // Get the number of attendances
                                                            $attendances = $user
                                                                ->attendances()
                                                                ->whereBetween('date', [
                                                                    $startDate->format('Y-m-d'),
                                                                    $endDate->format('Y-m-d'),
                                                                ])
                                                                ->count();

                                                            // Calculate absences
                                                            echo floor($totalDays - $attendances);
                                                        @endphp
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <div class="bg d-flex align-items-center" style="height: 100vh;">
        <div class="container">
            <div class="row">
                <!-- <div class="col-2"></div> -->
                <div class="col-12">
                    <div class="bg-white p-5 w-100">
                        <img class="mb-5" style="height: 70px;" src="{{ asset('web/image/logo.png') }}"
                            alt="no-logo">
                        <h5 class="fw-700 mb-3" style="color: #857854; font-size: 30px !important;">شكرا لكم</h5>
                        <hr>
                        <p class="text-secondary2 mb-4">جميع الحقوق محفوظة © 2025</p>
                    </div>
                </div>
                <!-- <div class="col-2"></div> -->
            </div>
        </div>
    </div>





    <script src="{{ asset('web') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('web') }}/js/all.min.js"></script>
    <script src="{{ asset('web') }}/js/jquery-1.10.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('web') }}/js/main.js"></script>
    <script src="{{ asset('web') }}/js/plugin.js"></script>

    <script>
        // window.print();
        // window.close();
    </script>
</body>

</html>
