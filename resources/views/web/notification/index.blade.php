@extends('web.layouts.master')
@section('content')

    <div class="card-border mt-16">
        <div class="d-flex justify-content-between">
            <h5 class="text-primary">إدارة التنبيهات</h5>
        </div>
        <div>
            <div class="tabs">
                <div class="tabs-list d-flex mt-4">
                    <div class="show" data-content=".content-one">مستلمة</div>
                    <div data-content=".content-two">مرسلة</div>
                </div>
                <hr class="hr-card"/>
                <div class="content-list">
                    <div class="content-one">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn-filter">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25"
                                     fill="none">
                                    <path
                                        d="M19.25 5.41992H4.75L9.31174 11.1221C9.59544 11.4767 9.75 11.9173 9.75 12.3715V18.9199C9.75 19.4722 10.1977 19.9199 10.75 19.9199H13.25C13.8023 19.9199 14.25 19.4722 14.25 18.9199V12.3715C14.25 11.9173 14.4046 11.4767 14.6883 11.1221L19.25 5.41992Z"
                                        stroke="#857854" stroke-width="1.6" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <div class="scroll">
                            <table id="example1" class="data-table" style="width: 100%">
                                <thead>
                                <tr>
                                    <td style="width: 30%;">عنوان التنبيه</td>
                                    <td>مرسل التنبيه</td>
                                    <td>الأولوية</td>
                                    <td>تاريخ الارسال</td>
                                    <td>حالة التنبيه</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="high-priority">
                                                <i class="fa-regular fa-bell fa-lg"></i>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <h6 class="name-table mb-2">
                                                    تأخر وصول الحافلة إلى الموقع
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <img
                                                class="image-table"
                                                src="image/image1.png"
                                                alt="no-image"
                                            />
                                            <h6 class="name-table d-flex align-items-center">
                                                محمود ابراهيم القحطاني
                                            </h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-info text-red">عالية</div>
                                    </td>
                                    <td>
                                        <div class="table-info">12 مايو 2024</div>
                                    </td>
                                    <td>
                                        <span class="status-new"> جديد </span>
                                    </td>
                                    <td>
                                        <a href="notification-details.html" class="view">
                                            <img
                                                class="h-24"
                                                src="image/eye-icon.png"
                                                alt="no-image"
                                            />
                                            عرض
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="medium-priority">
                                                <i class="fa-regular fa-bell fa-lg"></i>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <h6 class="name-table mb-2">
                                                    تأخر وصول الحافلة إلى الموقع
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <img
                                                class="image-table"
                                                src="image/image1.png"
                                                alt="no-image"
                                            />
                                            <h6 class="name-table d-flex align-items-center">
                                                محمود ابراهيم القحطاني
                                            </h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-info text-brown">متوسطة</div>
                                    </td>
                                    <td>
                                        <div class="table-info">12 مايو 2024</div>
                                    </td>
                                    <td>
                                        <span class="status-new"> جديد </span>
                                    </td>
                                    <td>
                                        <a href="notification-details.html" class="view">
                                            <img
                                                class="h-24"
                                                src="image/eye-icon.png"
                                                alt="no-image"
                                            />
                                            عرض
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="normal-priority">
                                                <i class="fa-regular fa-bell fa-lg"></i>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <h6 class="name-table mb-2">
                                                    تأخر وصول الحافلة إلى الموقع
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <img
                                                class="image-table"
                                                src="image/image1.png"
                                                alt="no-image"
                                            />
                                            <h6 class="name-table d-flex align-items-center">
                                                محمود ابراهيم القحطاني
                                            </h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-info text-green">عادية</div>
                                    </td>
                                    <td>
                                        <div class="table-info">12 مايو 2024</div>
                                    </td>
                                    <td>
                                        <span class="status-new"> جديد </span>
                                    </td>
                                    <td>
                                        <a href="notification-details.html" class="view">
                                            <img
                                                class="h-24"
                                                src="image/eye-icon.png"
                                                alt="no-image"
                                            />
                                            عرض
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="high-priority">
                                                <i class="fa-regular fa-bell fa-lg"></i>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <h6 class="name-table mb-2">
                                                    تأخر وصول الحافلة إلى الموقع
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <img
                                                class="image-table"
                                                src="image/image1.png"
                                                alt="no-image"
                                            />
                                            <h6 class="name-table d-flex align-items-center">
                                                محمود ابراهيم القحطاني
                                            </h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-info text-red">عالية</div>
                                    </td>
                                    <td>
                                        <div class="table-info">12 مايو 2024</div>
                                    </td>
                                    <td>
                                        <span class="status-new"> جديد </span>
                                    </td>
                                    <td>
                                        <a href="notification-details.html" class="view">
                                            <img
                                                class="h-24"
                                                src="image/eye-icon.png"
                                                alt="no-image"
                                            />
                                            عرض
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="content-two">
                        <div class="d-flex justify-content-end mb-3">
                            <button type="button" class="btn-filter">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25"
                                     fill="none">
                                    <path
                                        d="M19.25 5.41992H4.75L9.31174 11.1221C9.59544 11.4767 9.75 11.9173 9.75 12.3715V18.9199C9.75 19.4722 10.1977 19.9199 10.75 19.9199H13.25C13.8023 19.9199 14.25 19.4722 14.25 18.9199V12.3715C14.25 11.9173 14.4046 11.4767 14.6883 11.1221L19.25 5.41992Z"
                                        stroke="#857854" stroke-width="1.6" stroke-linecap="round"
                                        stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <button
                                type="button"
                                class="main-button"
                                data-bs-toggle="modal"
                                data-bs-target="#exampleModal"
                            >
                                ارسال تنبيه
                            </button>
                        </div>
                        <div class="scroll">
                            <table id="example" class="data-table" style="width: 100%">
                                <thead>
                                <tr>
                                    <td>عنوان التنبيه</td>
                                    <td>مرسل الى</td>
                                    <td>تاريخ الارسال</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="medium-priority">
                                                <i class="fa-regular fa-bell fa-lg"></i>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <h6 class="name-table mb-2">
                                                    تأخر وصول الحافلة إلى الموقع
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <img
                                                class="image-table"
                                                src="image/image1.png"
                                                alt="no-image"
                                            />
                                            <h6 class="name-table d-flex align-items-center">
                                                محمود ابراهيم القحطاني
                                            </h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-info">12 مايو 2024</div>
                                    </td>
                                    <td>
                                        <a href="notification-details.html" class="view">
                                            <img
                                                class="h-24"
                                                src="image/eye-icon.png"
                                                alt="no-image"
                                            />
                                            عرض
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="medium-priority">
                                                <i class="fa-regular fa-bell fa-lg"></i>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <h6 class="name-table mb-2">
                                                    تأخر وصول الحافلة إلى الموقع
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <img
                                                class="image-table"
                                                src="image/image1.png"
                                                alt="no-image"
                                            />
                                            <h6 class="name-table d-flex align-items-center">
                                                محمود ابراهيم القحطاني
                                            </h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-info">12 مايو 2024</div>
                                    </td>
                                    <td>
                                        <a href="notification-details.html" class="view">
                                            <img
                                                class="h-24"
                                                src="image/eye-icon.png"
                                                alt="no-image"
                                            />
                                            عرض
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="medium-priority">
                                                <i class="fa-regular fa-bell fa-lg"></i>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <h6 class="name-table mb-2">
                                                    تأخر وصول الحافلة إلى الموقع
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <img
                                                class="image-table"
                                                src="image/image1.png"
                                                alt="no-image"
                                            />
                                            <h6 class="name-table d-flex align-items-center">
                                                محمود ابراهيم القحطاني
                                            </h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-info">12 مايو 2024</div>
                                    </td>
                                    <td>
                                        <a href="notification-details.html" class="view">
                                            <img
                                                class="h-24"
                                                src="image/eye-icon.png"
                                                alt="no-image"
                                            />
                                            عرض
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div
                    class="modal-header bg-gray d-flex flex-column align-items-start"
                >
                    <h5 class="text-primary fs-18" id="exampleModalLabel">
                        إرسال تنبيه جديد
                    </h5>
                    <p class="text-secondary fs-14 fw-400">يرجى إدخال بيانات التنبيه</p>
                </div>
                <div class="modal-body">
                    <form class="row g-3">
                        <div class="col-12">
                            <div class="change-direction">
                                <label
                                    for="validationDefault01"
                                    class="form-label fs-14 fw-500 text-primary"
                                >عنوان التنبيه
                                    <span class="text-red">*</span>
                                </label>
                                <input
                                    type="text"
                                    class="form-control fs-12 fw-400 text-secondary bg-gray"
                                    id="validationDefault01"
                                    placeholder="أدخل الاسم الكامل للموظف"
                                    required
                                />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="change-direction">
                                <label
                                    for="validationTextarea"
                                    class="form-label fs-14 fw-500 text-primary"
                                >وصف التنبيه
                                    <span class="text-red">*</span>
                                </label>
                                <textarea
                                    class="form-control fs-12 fw-400 text-secondary bg-gray h-150"
                                    id="validationTextarea"
                                    placeholder="وصف التنبيه"
                                    required
                                ></textarea>
                            </div>
                        </div>
                        <div class="col-12 d-flex flex-column">
                            <label
                                for="validationDefault04"
                                class="form-label fs-14 fw-500 text-primary"
                            >ارسال التنبيه الى
                                <span class="text-red">*</span>
                            </label>
                            <select
                                class="form-select w-100 fs-12 fw-400 text-primary bg-gray"
                                id="js-example-basic-single" multiple
                                required
                            >
                                <option>
                                    سارة نصر
                                </option>
                                <option>
                                    أحمد حسين
                                </option>
                                <option>
                                    عبدالرحمن صالح
                                </option>
                                <option>
                                    مصطفى علي
                                </option>
                            </select>
                        </div>
                        <div
                            class="col-12 d-flex justify-content-between border-top pt-3 mt-4"
                        >
                            <button
                                type="button"
                                class="view border-0"
                                data-bs-dismiss="modal"
                            >
                                الغاء
                            </button>
                            <button type="submit" class="main-button">
                                إرسال تنبيه جديد
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
