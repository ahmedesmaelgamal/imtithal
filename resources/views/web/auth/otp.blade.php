<!DOCTYPE html>
<html lang="ar">

<head>
    @include('web.layouts.head')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .error-border {
            border: 2px solid red !important;
            color: red !important;
            transition: 0.3s;
        }

        .disabled-button {
            background-color: #EAE0CF !important;
            color: #888 !important;
            cursor: not-allowed !important;
            border: none !important;
        }

        .enabled-button {
            background-color: #D4A373 !important;
            color: white !important;
            cursor: pointer !important;
        }
    </style>
</head>

<body>
<div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2 col-12"></div>
            <div class="col-lg-6 col-md-8 col-12 d-flex align-items-center" style="height: 100vh;">
                <div class="bg-white p-5">
                    <img class="h-70 mb-5" src="{{asset('web/image/logo.png')}}" alt="no-logo">
                    <h5 class="text-primary fs-30 fw-700 mb-3">تحقق من البريد الألكتروني</h5>
                    <p class="text-secondary2 fs-14 fw-400 mb-4">تم إرسال رمز التحقق إلى البريد الألكتروني،
                        يرجى إدخال الرمز لتأكيد العملية</p>

                    <!-- OTP Form -->
                    <form class="row g-3" action="{{ route('admin.new_password') }}" method="POST" id="otpForm">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <div class="col-12">
                            <div class="otp-container">
                                <input type="text" maxlength="1" class="otp-input" id="otp1">
                                <input type="text" maxlength="1" class="otp-input" id="otp2">
                                <input type="text" maxlength="1" class="otp-input" id="otp3">
                                <input type="text" maxlength="1" class="otp-input" id="otp4">
                            </div>
                        </div>
                        <div class="col-12">
                            <p class="fs-14 fw-400 text-primary text-center mb-2">لم يصلك رمز التحقق؟</p>
                            <p class="fs-14 fw-400 text-brown text-center">
                                إعادة الإرسال خلال <span id="countdown">50</span> ثانية ...
                            </p>
                            <p class="fs-14 fw-400 text-center">
                                <a href="javascript:void(0);" id="resend-otp" style="display: none; color: #080F13; text-decoration: none;">إعادة الإرسال الان؟</a>
                            </p>                        </div>
                        <div class="col-12 pt-3 mt-4 d-flex">
                            <a href="{{route('admin.forget_password')}}" class="btn-cancel w-50"> السابق</a>
                            <button type="submit" class="main-button w-50 disabled-button" id="confirm-button" disabled> تأكيد الحساب</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3 col-md-2 col-12"></div>
        </div>
    </div>
</div>

@include('web.layouts.footer')

<script>
    const otpInputs = document.querySelectorAll('.otp-input');
    const confirmButton = document.getElementById('confirm-button');

    let serverOTP = "{{ $otp }}";

    // ✅ Fix: Convert `otp_expire` to a valid JavaScript Date format
    let OtpExpire = new Date("{{ $otp_expire }}".replace(/-/g, '/').replace(' ', 'T'));

    console.log("OTP Expiration Time:", OtpExpire);
    console.log("Current Time:", new Date());

    function checkOtpExpiration() {
        let now = new Date();

        if (now > OtpExpire) {
            otpInputs.forEach(input => input.classList.add("error-border"));
            confirmButton.disabled = true;
            confirmButton.classList.add("disabled-button");
            confirmButton.classList.remove("enabled-button");
            console.log("OTP Expired: Inputs are red");
        }
    }

    function getEnteredOTP() {
        return Array.from(otpInputs).map(input => input.value).join('');
    }

    function validateOTP() {
        checkOtpExpiration();

        let enteredOTP = getEnteredOTP();

        if (enteredOTP.length === serverOTP.length) {
            if (enteredOTP !== serverOTP || new Date() > OtpExpire) {
                otpInputs.forEach(input => input.classList.add("error-border"));
                confirmButton.disabled = true;
                confirmButton.classList.add("disabled-button");
                confirmButton.classList.remove("enabled-button");
            } else {
                otpInputs.forEach(input => input.classList.remove("error-border"));
                confirmButton.disabled = false;
                confirmButton.classList.remove("disabled-button");
                confirmButton.classList.add("enabled-button");
            }
        } else {
            otpInputs.forEach(input => input.classList.remove("error-border"));
            confirmButton.disabled = true;
            confirmButton.classList.add("disabled-button");
            confirmButton.classList.remove("enabled-button");
        }
    }

    otpInputs.forEach((input, index) => {
        input.addEventListener('input', (e) => {
            if (e.target.value.length === 1 && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }
            validateOTP();
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === "Backspace") {
                validateOTP();
            }
        });

        input.addEventListener('keypress', (e) => {
            if (!/[0-9]/.test(e.key)) {
                e.preventDefault();
            }
        });
    });

    checkOtpExpiration();
</script>
<script>
    let countdownElement = document.getElementById("countdown");
    let resendButton = document.getElementById("resend-otp");
    let timeLeft = 50; // البداية
    let otpExpiration = new Date("{{ $otp_expire }}".replace(/-/g, '/').replace(' ', 'T'));

    function startCountdown() {
        let timer = setInterval(() => {
            if (timeLeft > 0) {
                countdownElement.innerText = timeLeft;
                countdownElement.parentElement.style.display = "block"; // إظهار النص أثناء العد التنازلي
                resendButton.style.display = "none"; // إخفاء زر إعادة الإرسال
                timeLeft--;
            } else {
                clearInterval(timer);
                countdownElement.parentElement.style.display = "none"; // إخفاء النص عند انتهاء العد
                resendButton.style.display = "inline"; // إظهار زر إعادة الإرسال
            }
        }, 1000);
    }


    resendButton.addEventListener("click", function() {
        resendButton.style.display = "none"; // إخفاء الزر
        countdownElement.style.display = "inline"; // إظهار العداد مجددًا
        timeLeft += 50; // إضافة 50 ثانية كل مرة
        startCountdown();

        $.ajax({
            url: "{{ route('admin.sendOtp') }}",
            method: "POST",
            data: {
                email: "{{ $email }}",
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                console.log("تم إرسال OTP جديد:", response.otp);
                otpExpiration = new Date(response.otp_expire);
            },
            error: function(error) {
                console.error("فشل في إعادة الإرسال", error);
            }
        });
    });

    startCountdown();
</script>


</body>
</html>
