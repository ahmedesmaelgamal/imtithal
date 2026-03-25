@extends('web.layouts.master')
@section('content')

    <div class="container">
        <div class="d-flex justify-content-between">
            <div class="d-flex">
                <img class="image-table" src="image/image1.png" alt="no-image">
                <div>
                    <h6 class="name-table d-flex align-items-center">عبد الله الشمري</h6>
                    <p class="fs-12 text-secondary">مدير النظام</p>
                </div>
            </div>
            <div class="d-flex">
                <div class="header-icon">
                    <ul class="navbar-nav d-flex flex-row">
                        <li class="nav-item user">
                            <a class="nav-link position-relative text-center" href="notification.html">
                                <img class="h-24" src="image/bell.png" alt="no-icon">
                                <span class="position-absolute top-30 start-80 translate-middle badge notification">
                                                2
                                                <span class="visually-hidden">unread messages</span>
                                            </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="mobile-toggle me-3">
                    <i class="fa-solid fa-bars fs-3"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="card-border-shape mt-16">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12 mb-3">
                <div class="card-home">
                    <h2 class="text-primary fw-700">1,512</h1>
                        <div class="d-flex justify-content-between">
                            <p class="fs-14 text-secondary">عدد المهام</p>
                            <div class="status-true">
                                <img class="h-16" src="image/arrow-up-right.png" alt="no-icon">
                                <p>34.1%</p>
                            </div>
                        </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-3">
                <div class="card-home">
                    <h2 class="text-brown fw-700">2,637</h1>
                        <div class="d-flex justify-content-between">
                            <p class="fs-14 text-secondary">عدد الموظفين</p>
                            <div class="status-true">
                                <img class="h-16" src="image/arrow-up-right.png" alt="no-icon">
                                <p>4.1%</p>
                            </div>
                        </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-3">
                <div class="card-home">
                    <h2 class="text-primary2 fw-700">1,456</h1>
                        <div class="d-flex justify-content-between">
                            <p class="fs-14 text-secondary">عدد التقارير</p>
                            <div class="status-false">
                                <img class="h-16" src="image/arrow-down-right.png" alt="no-icon">
                                <p>4.1%</p>
                            </div>
                        </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-3">
                <div class="">
                    <h2 class="text-green fw-700">21</h1>
                        <div class="d-flex justify-content-between">
                            <p class="fs-14 text-secondary">عدد المناطق الجغرافية</p>
                            <div class="status-normal">
                                <img class="h-16" src="image/arrow-right.png" alt="no-icon">
                                <p>0.0%</p>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
{{--    <div class="shape"></div>--}}
    <div class="section-performance">
        <div class="row">
            <div class="col-lg-5 col-12">
                <div class="card-border mt-16">
                    <div class="d-flex justify-content-between">
                        <h5 class="text-primary d-flex align-items-center">نسبة إنجاز الموظفين</h5>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>السنة</option>
                            <option value="1">2024</option>
                            <option value="2">2023</option>
                            <option value="3">2022</option>
                        </select>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>الشهور</option>
                            <option value="1">يناير</option>
                            <option value="2">فبراير</option>
                            <option value="3">مارس</option>
                        </select>
                    </div>
                    <hr class="hr-card">
                    <div class="row card-section">
                        <div class="col-2 image-card">
                            <img src="image/image1.png" alt="no-image">
                        </div>
                        <div class="col-7 d-flex flex-column justify-content-center">
                            <h6>محمد القحطاني عبدالله</h6>
                            <p class="fs-12 text-secondary">مراقب</p>
                        </div>
                        <div class="col-3 mt-3">
                            <div class="status-true d-flex justify-content-center">
                                <img class="h-16" src="image/arrow-up-right.png" alt="no-icon">
                                <p>16.9%</p>
                            </div>
                        </div>
                    </div>
                    <div class="row card-section">
                        <div class="col-2 image-card">
                            <img src="image/image2.png" alt="no-image">
                        </div>
                        <div class="col-7 d-flex flex-column justify-content-center">
                            <h6>محمد القحطاني عبدالله</h6>
                            <p class="fs-12 text-secondary">مراقب</p>
                        </div>
                        <div class="col-3 mt-3">
                            <div class="status-false d-flex justify-content-center">
                                <img class="h-16" src="image/arrow-down-right.png" alt="no-icon">
                                <p>4.1%</p>
                            </div>
                        </div>
                    </div>
                    <div class="row card-section">
                        <div class="col-2 image-card">
                            <img src="image/image3.png" alt="no-image">
                        </div>
                        <div class="col-7 d-flex flex-column justify-content-center">
                            <h6>محمد القحطاني عبدالله</h6>
                            <p class="fs-12 text-secondary">مراقب</p>
                        </div>
                        <div class="col-3 mt-3">
                            <div class="status-true d-flex justify-content-center">
                                <img class="h-16" src="image/arrow-up-right.png" alt="no-icon">
                                <p>16.9%</p>
                            </div>
                        </div>
                    </div>
                    <div class="row card-section">
                        <div class="col-2 image-card">
                            <img src="image/image4.png" alt="no-image">
                        </div>
                        <div class="col-7 d-flex flex-column justify-content-center">
                            <h6>محمد القحطاني عبدالله</h6>
                            <p class="fs-12 text-secondary">مراقب</p>
                        </div>
                        <div class="col-3 mt-3">
                            <div class="status-normal d-flex justify-content-center">
                                <img class="h-16" src="image/arrow-right.png" alt="no-icon">
                                <p>0.0%</p>
                            </div>
                        </div>
                    </div>
                    <div class="row card-section">
                        <div class="col-2 image-card">
                            <img src="image/image5.png" alt="no-image">
                        </div>
                        <div class="col-7 d-flex flex-column justify-content-center">
                            <h6>محمد القحطاني عبدالله</h6>
                            <p class="fs-12 text-secondary">مراقب</p>
                        </div>
                        <div class="col-3 mt-3">
                            <div class="status-true d-flex justify-content-center">
                                <img class="h-16" src="image/arrow-up-right.png" alt="no-icon">
                                <p>16.9%</p>
                            </div>
                        </div>
                    </div>
                    <div class="row card-section">
                        <div class="col-2 image-card">
                            <img src="image/image1.png" alt="no-image">
                        </div>
                        <div class="col-7 d-flex flex-column justify-content-center">
                            <h6>محمد القحطاني عبدالله</h6>
                            <p class="fs-12 text-secondary">مراقب</p>
                        </div>
                        <div class="col-3 mt-3">
                            <div class="status-true d-flex justify-content-center">
                                <img class="h-16" src="image/arrow-up-right.png" alt="no-icon">
                                <p>16.9%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-12">
                <div class="section-report-home">
                    <div class="card-border mt-16">
                        <div class="d-flex justify-content-between">
                            <h5 class="text-primary d-flex align-items-center">التقارير الدورية</h5>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>اليوم</option>
                                <option value="1">اليوم السابق</option>
                                <option value="2">اليوم التالى</option>
                                <option value="3">الاسبوع</option>
                            </select>
                        </div>
                        <hr class="hr-card">
                        <div>
                            <div class="d-flex flex-column justify-content-center align-items-center"
                                 style="height: 500px;">
                                <img class="h-150" src="image/no-report.png" alt="no-image">
                                <h4 class="mt-3">لا توجد تقارير يومية مرسلة بعد</h4>
                                <p class="mt-1">عند الانتهاء من ارسال الموظف التقارير اليومية الخاصة به، ستظهر هنا
                                    لسجلاتك المستقبلية.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
