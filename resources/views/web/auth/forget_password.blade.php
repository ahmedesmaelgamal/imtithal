<!DOCTYPE html>
<html>

@include('web.layouts.head')

<body >

<div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2 col-12"></div>
            <div class="col-lg-6 col-md-8 col-12 d-flex align-items-center" style="height: 100vh;">
                <div class="bg-white p-5">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <img class="h-70 mb-5" src="{{asset('web/image/logo.png')}}" alt="no-logo">
                    <h5 class="text-primary fs-30 fw-700 mb-3">هل نسيت كلمة المرور؟</h5>
                    <p class="text-secondary2 fs-16 fw-400 mb-4">أدخل البريد الألكتروني لتصلك رسالة برمز التحقق لاستعادة
                        كلمة
                        المرور.</p>
                    <form class="row g-3" action="{{route('admin.sendOtp')}}" method="POST">
                        @csrf
                        <div class="col-12">
                            <label for="validationDefaultUsername" class="form-label fs-14 fw-500 text-primary">البريد
                                الألكتروني<span class="text-red">*</span>
                            </label>
                            <div class="input-group">
                                <input type="email" class="form-control fs-12 fw-400 text-secondary text-start bg-gray"
                                       id="validationDefaultUsername" name="email" placeholder="ادخل البريد الالكترونى"
                                       aria-describedby="inputGroupPrepend2" required>

                            </div>
                        </div>
                        <div class="col-12 pt-3 mt-4 d-flex">
                            <a href="{{route('admin.login')}}" class="btn-cancel w-50"> الغاء</a>
                            <button type="submit" class="main-button w-50"> التالى</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3 col-md-2 col-12"></div>
        </div>
    </div>
</div>


@include('web.layouts.footer')

</body>

</html>
