@extends('web.layouts.master')
@section('content')
    <div class="main-header sticky-top mb-2">
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
    </div>
    <div class="card-border mt-16">
        <div class="d-flex justify-content-between flex-wrap">
            <h5 class="text-primary">إدارة الموظفين </h5>
            <div class="d-flex">
                <button type="button" class="btn-filter">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25"
                        fill="none">
                        <path
                            d="M19.25 5.41992H4.75L9.31174 11.1221C9.59544 11.4767 9.75 11.9173 9.75 12.3715V18.9199C9.75 19.4722 10.1977 19.9199 10.75 19.9199H13.25C13.8023 19.9199 14.25 19.4722 14.25 18.9199V12.3715C14.25 11.9173 14.4046 11.4767 14.6883 11.1221L19.25 5.41992Z"
                            stroke="#857854" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <button type="button" class="main-button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    إضافة موظف
                </button>
            </div>
        </div>
        <hr class="hr-card">
        <div class="scroll">
            <table id="example" class="data-table" style="width:100%">
                <thead>
                    <tr>
                        <td> الاسم / الجنسية</td>
                        <td> رقم الهوية</td>
                        <td> الدور</td>
                        <td> الموقع</td>
                        <td> تاريخ الاضافة</td>
                        <td> حالة الموظف</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="d-flex">
                                <img class="image-table" src="image/image1.png" alt="no-image">
                                <div>
                                    <h6 class="name-table d-flex align-items-center">محمود ابراهيم القحطاني</h6>
                                    <p class="fs-12 fw-400 text-secondary">سعودي</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="table-info">2378903242</div>
                        </td>
                        <td>
                            <div class="table-info">مراقب</div>
                        </td>
                        <td>
                            <div class="table-info">مخيمات منى أ 1</div>
                        </td>
                        <td>
                            <div class="table-info">12 مايو 2024</div>
                        </td>
                        <td>
                            <div class="table-info">
                                <div class="form-check form-switch">
                                    <label class="form-check-label ms-2" for="flexSwitchCheckDefault">فعال</label>
                                    <input class="form-check-input ms-0" type="checkbox" id="flexSwitchCheckDefault">
                                </div>
                            </div>
                        </td>
                        <td>
                            <button class="view border-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <img class="h-24" src="image/edit-icon.png" alt="no-image">
                                تعديل
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex">
                                <img class="image-table" src="image/image5.png" alt="no-image">
                                <div>
                                    <h6 class="name-table d-flex align-items-center">محمود ابراهيم القحطاني</h6>
                                    <p class="fs-12 fw-400 text-secondary">سعودي</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="table-info">2378903242</div>
                        </td>
                        <td>
                            <div class="table-info">مراقب</div>
                        </td>
                        <td>
                            <div class="table-info">مخيمات منى أ 1</div>
                        </td>
                        <td>
                            <div class="table-info">12 مايو 2024</div>
                        </td>
                        <td>
                            <div class="table-info">
                                <div class="form-check form-switch">
                                    <label class="form-check-label ms-2" for="flexSwitchCheckDefault">فعال</label>
                                    <input class="form-check-input ms-0" type="checkbox" id="flexSwitchCheckDefault">
                                </div>
                            </div>
                        </td>
                        <td>
                            <button class="view border-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <img class="h-24" src="image/edit-icon.png" alt="no-image">
                                تعديل
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex">
                                <img class="image-table" src="image/image3.png" alt="no-image">
                                <div>
                                    <h6 class="name-table d-flex align-items-center">محمود ابراهيم القحطاني</h6>
                                    <p class="fs-12 fw-400 text-secondary">سعودي</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="table-info">2378903242</div>
                        </td>
                        <td>
                            <div class="table-info">مراقب</div>
                        </td>
                        <td>
                            <div class="table-info">مخيمات منى أ 1</div>
                        </td>
                        <td>
                            <div class="table-info">12 مايو 2024</div>
                        </td>
                        <td>
                            <div class="table-info">
                                <div class="form-check form-switch">
                                    <label class="form-check-label ms-2" for="flexSwitchCheckDefault">فعال</label>
                                    <input class="form-check-input ms-0" type="checkbox" id="flexSwitchCheckDefault">
                                </div>
                            </div>
                        </td>
                        <td>
                            <button class="view border-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <img class="h-24" src="image/edit-icon.png" alt="no-image">
                                تعديل
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-gray d-flex flex-column align-items-start">
                    <h5 class="text-primary fs-18" id="exampleModalLabel">إضافة موظف جديد </h5>
                    <p class="text-secondary fs-14 fw-400">يرجى إدخال بيانات الموظف الجديد لإضافته إلى النظام</p>
                </div>
                <div class="modal-body">

                    <form class="row g-3 addForm" id="addForm" class="addForm" method="POST"
                        enctype="multipart/form-data" action="{{ isset($storeRoute) ? $storeRoute : '' }}">
                        @csrf
                        <div class="col-12">
                            <div class="change-direction">
                                <label for="validationDefault01" class="form-label fs-14 fw-500 text-primary">full name
                                    <span class="text-red">*</span>
                                </label>
                                <input type="text" class="form-control fs-12 fw-400 text-secondary bg-gray"
                                    id="full_name" name="full_name" placeholder="{{ 'entry full name' }}" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="change-direction">
                                <label for="validationDefault02" class="form-label fs-14 fw-500 text-primary">
                                    national id
                                    <span class="text-red">*</span>
                                </label>
                                <input type="text" class="form-control fs-12 fw-400 text-secondary bg-gray"
                                    id="national_id" name="national_id" placeholder="{{ 'entry national id' }}">
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="validationDefaultUsername" class="form-label fs-14 fw-500 text-primary">
                                phone
                                <span class="text-red">*</span>
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control fs-12 fw-400 text-secondary text-start bg-gray"
                                    id="phone" name="phone" placeholder="{{ 'entry phone' }}">

                                <span class="input-group-text border-0 fs-12 fw-400 text-primary bg-gray"
                                    id="inputGroupPrepend2">+966</span>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="change-direction">
                                <label class="form-label fs-14 fw-500 text-primary">
                                    email
                                    <span class="text-red">*</span>
                                </label>
                                <input type="email" class="form-control fs-12 fw-400 text-secondary bg-gray"
                                    id="email" name="email" placeholder="{{ 'entry email' }}">
                            </div>
                        </div>

                        <div class="col-6 ">
                            <div class="form-group">
                                <label class="form-control-label" class="form-label fs-14 fw-500 text-primary">
                                    password
                                    <span class="text-red">*</span>
                                </label>
                                <input type="password" class="form-control fs-12 fw-400 text-secondary bg-gray"
                                    id="password" name="password">

                            </div>
                        </div>

                        <div class="col-6 ">
                            <div class="form-group">
                                <label class="form-control-label" class="form-label fs-14 fw-500 text-primary">
                                    password_confirmation
                                    <span class="text-red">*</span>
                                </label>
                                <input type="password" class="form-control fs-12 fw-400 text-secondary bg-gray"
                                    id="password_confirmation" name="password_confirmation">

                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between border-top pt-3 mt-4">
                            <button type="button" class="view border-0" data-bs-dismiss="modal">الغاء</button>
                            <button type="submit" class="main-button">ارسال دعوة</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('.dropify').dropify();
    </script>
@endsection
