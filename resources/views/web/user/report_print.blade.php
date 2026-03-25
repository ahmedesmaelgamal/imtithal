<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> مشروع الملكية</title>
    <link href="{{ asset('web/pdf/logo.png') }}" rel="icon" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.min.js"></script>

    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/bootstrap.min.css') }}">

    <!-- datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.bootstrap5.min.css">

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100..900&family=Readex+Pro:wght@160..700&display=swap" rel="stylesheet">

    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <style>
        .bg{
            background-image: url("{{ asset('web/pdf/bg-login.png') }}");
            background-size: cover;
        }
        body{
            direction: rtl;
            font-family: "Readex Pro", serif;
            background-color: #F7F7F8;
        }
        .text-secondary2{
            color: #565A5D !important;
            font-size: 16px;
            font-weight: 400;
        }

        /*@page {*/
        /*    margin: 0; !* إزالة الهوامش *!*/
        /*}*/

        {{--@media print {--}}
        {{--    body {--}}
        {{--        margin: 0;--}}
        {{--        padding: 0;--}}
        {{--        -webkit-print-color-adjust: exact;--}}
        {{--        print-color-adjust: exact;--}}
        {{--    }--}}
        {{--    .bg{--}}
        {{--        background-image: url("{{ asset('web/pdf/bg-login.png') }}") !important;--}}
        {{--        background-size: cover;--}}
        {{--    }--}}
        {{--}--}}
        @media print {
            /* منع تجزئة الصفحة الأولى */
            .first-page {
                page-break-after: avoid;
            }

            /* السماح بتجزئة محتوى الأسئلة والإجابات عند الحاجة */
            /*.content {*/
            /*    page-break-inside: auto;*/
            /*    page-break-after: always;*/
            /*    margin-top: 20px !important;*/
            /*}*/
            /* إضافة هامش علوي عند بداية الصفحة الجديدة */
            /*.content > div {*/
            /*    page-break-before: auto;*/
            /*    margin-top: 30px !important; !* زيادة الهامش عند بداية كل صفحة جديدة *!*/
            /*}*/

            /* الحفاظ على الصفحة الأخيرة في وضع ممتد وإخفاء الصفحة الإضافية */
            .last-page {
                page-break-before: always;
                min-height: 100vh; /* يجعل الصفحة الأخيرة تمتد تلقائيًا */
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }


    </style>



</head>

<body >

<div class="bg d-flex align-items-center first-page" style="height: 100vh;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bg-white p-5 w-100">
                    <img class="mb-4" style="height: 80px;" src="{{ asset('web/pdf/logo.png') }}" alt="no-logo">
                    <h5 class="fw-700 mb-3" style="color: #857854; font-size: 30px !important;">التقرير اليومي للرصد الميداني</h5>
                    <p class="text-secondary2 mb-4">{{ $data->dailyReport->title }}</p>
                    <hr>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <p class="mb-2" style="color: #9EA3A5; font-size: 14px; font-weight: 400;">اسم {{ $data->user->getRoleNames()->first() }}</p>
                            <p style="color:#00080C; font-size:14px; font-weight: 500;">{{ $data->user->full_name }}</p>
                        </div>
                        <div class="col-6 mb-3">
                            <p class="mb-2" style="color: #9EA3A5; font-size: 14px; font-weight: 400;">تاريخ الارسال</p>
                            <p style="color:#00080C; font-size:14px; font-weight: 500;">
                                {{ $data->created_at->format('Y/m/d') }} م -
                                {{ \Alkoumi\LaravelHijriDate\Hijri::Date('Y/m/d', $data->created_at) }} هـ
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- page1 -->
@php
    $answers = $data->answers;
    $chunkedAnswers = $answers->chunk(14); // This is the correct way to chunk a collection
@endphp
@foreach($chunkedAnswers as $chunk)
<div id="page-2" class="content" style="min-height: 100vh;background-color: white !important;">
    <div class="bg-white mb-5">
        <div class="container">
            <img class="mb-5 mt-5" style="height: 70px;" src="{{ asset('web/pdf/logo.png') }}" alt="no-logo">
            <div class="axis-title" style="background-color: #857854; padding: 12px; color: white;">
                {{ $data->axis->name }}
            </div>
            <div style="background-color: #F7F7F8; padding: 25px">
                <div class="row">
                    @foreach(collect($chunk) as $answer)
                        <div class="col-6 mb-3">
                            <p class="mb-2" style="color: #9EA3A5; font-size: 14px; font-weight: 400;">{{ $answer->axisQuestion->question }}</p>
                            <p style="color:#00080C; font-size:14px; font-weight: 500;">{{ $answer->questionAnswer ? $answer->questionAnswer->answer: $answer->answer ?? '-' }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach


<div class="bg d-flex align-items-center last-page" style="height: 100vh">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bg-white p-5 w-100">
                    <img class="mb-5" style="height: 70px;" src="{{ asset('web/pdf/logo.png') }}" alt="no-logo">
                    <h5 class="fw-700 mb-3" style="color: #857854; font-size: 30px !important;">شكرا لكم</h5>
                    <hr>
                    <p class="text-secondary2 mb-4">جميع الحقوق محفوظة © 2025</p>
                </div>
            </div>
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
        setTimeout(() => {
            window.print();
            window.close();
        }, 2000);
</script>

</body>

</html>
