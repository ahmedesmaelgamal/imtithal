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
                    <img class="h-70 mb-5" src="{{asset('web/image/logo.png')}}" alt="no-logo">
                    <h5 class="text-primary fs-30 fw-700 mb-3">كلمة المرور الجديدة</h5>

                    <!-- Password Update Form -->
                    <form class="row g-3" action="{{ route('admin.update_password') }}" method="POST" id="passwordForm">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">

                        <!-- New Password Field -->
                        <div class="col-12 mb-2">
                            <div class="change-direction">
                                <label for="password" class="form-label fs-14 fw-500 text-primary">
                                    كلمة المرور الجديدة <span class="text-red">*</span>
                                </label>
                                <div class="input-container">
                                    <input type="password" name="password" class="form-control fs-12 fw-400 text-secondary bg-gray"
                                           id="password" placeholder="*************" required>
                                    <span class="toggle-password" onclick="togglePassword('password')">
                                        <i class="fa-regular fa-eye-slash text-secondary"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="col-12 mb-2">
                            <div class="change-direction">
                                <label for="confirmPassword" class="form-label fs-14 fw-500 text-primary">
                                    تأكيد كلمة المرور الجديدة <span class="text-red">*</span>
                                </label>
                                <div class="input-container">
                                    <input type="password" name="password_confirmation" class="form-control fs-12 fw-400 text-secondary bg-gray"
                                           id="confirmPassword" placeholder="*************" required>
                                    <span class="toggle-password" onclick="togglePassword('confirmPassword')">
                                        <i class="fa-regular fa-eye-slash text-secondary"></i>
                                    </span>
                                </div>
                                <small id="passwordError" class="text-red fs-12" style="display: none;">كلمتا المرور غير متطابقتين</small>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 pt-3 mt-3">
                            <button type="submit" class="main-button w-100" id="submitButton" disabled> تأكيد</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3 col-md-2 col-12"></div>
        </div>
    </div>
</div>

@include('web.layouts.footer')

<!-- ✅ JavaScript for Password Matching Validation -->
<script>
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirmPassword");
    const submitButton = document.getElementById("submitButton");
    const passwordError = document.getElementById("passwordError");

    function validatePasswords() {
        if (passwordInput.value === confirmPasswordInput.value && passwordInput.value.length > 0) {
            confirmPasswordInput.classList.remove("error-border");
            passwordError.style.display = "none";
            submitButton.disabled = false;
        } else {
            confirmPasswordInput.classList.add("error-border");
            passwordError.style.display = "block";
            submitButton.disabled = true;
        }
    }

    passwordInput.addEventListener("input", validatePasswords);
    confirmPasswordInput.addEventListener("input", validatePasswords);

    // ✅ Toggle Password Visibility
    function togglePassword(fieldId) {
        const passwordField = document.getElementById(fieldId);
        const icon = passwordField.nextElementSibling.querySelector("i");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        } else {
            passwordField.type = "password";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        }
    }
</script>

<!-- ✅ CSS for Error Styling -->
<style>
    .error-border {
        border: 2px solid red !important;
    }
    .text-red {
        color: red;
    }
</style>

</body>
</html>
