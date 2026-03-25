<!DOCTYPE html>
<html>

@include('web.layouts.head')
<body >

<div class="bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2 col-12"></div>
            <div class="col-lg-6 col-md-8 col-12 d-flex align-items-center" style="height: 100vh;">
                <div class="bg-white p-5">
                    <img class="h-70 mb-5" src="{{asset('web/image/logo.png')}}" alt="no-logo">
                    <h5 class="text-primary fs-30 fw-700 mb-3">مرحبًا بك!</h5>
                    <p class="text-secondary2 fs-16 fw-400 mb-4">يرجى إدخال بياناتك لتسجيل الدخول وإدارة المنصة
                        بسهولة.</p>

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

                    <form class="row g-3" action="{{route('admin.login')}}" method="POST">
                        @csrf

                        <div class="col-12 mb-2">
                            <div class="change-direction">
                                <label for="validationDefault02" class="form-label fs-14 fw-500 text-primary"> رقم
                                    الهوية/البريد الإلكتروني
                                    <span class="text-red">*</span>
                                </label>
                                <input type="text" class="form-control fs-12 fw-400 text-secondary bg-gray"
                                       id="validationDefault02" placeholder="000" name="input"  required>
                                @error('input')
                                <span class="text-danger fs-12">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="change-direction">
                                <label for="validationDefault01" class="form-label fs-14 fw-500 text-primary">كلمة
                                    المرور
                                    <span class="text-red">*</span>
                                </label>

                                  <div class="input-container">
                                            <input type="password" class="form-control fs-12 fw-400 text-secondary bg-gray"
                                                   id="password" name="password" placeholder="*************" required>
                                      <span class="toggle-password" id="toggle-password">
                            <i id="icon" class="fa-solid fa-eye-slash text-secondary"></i>
                </span>



                                      @error('password')
                                    <span class="text-danger fs-12">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="col-12 pt-3 mt-3">
                            <button type="submit" class="main-button w-100">تسجيل الدخول</button>
                        </div>
                    </form>
                    <div class="text-center">
                        <a href="{{route('admin.forget_password')}}" class="fs-14 fw-500 text-white mt-4 mb-3"
                           style="text-decoration: underline;">نسيت كلمة المرور؟</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-2 col-12"></div>
        </div>
    </div>
</div>

@include('web.layouts.footer')


<script>
    document.getElementById('toggle-password').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        // const icon = this.querySelector('i');
        const icon = document.getElementById('icon');
        console.log(icon);
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    });
</script>
</body>

</html>
