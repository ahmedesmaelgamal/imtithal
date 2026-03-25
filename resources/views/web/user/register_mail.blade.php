<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تغيير كلمة المرور</title>
</head>

<body style="margin: 0; padding: 0; background-color: #F8F5EF; font-family: Arial, sans-serif;">

<table width="100%" dir="rtl" style="background-color: #F8F5EF; padding: 20px; text-align: right;">
    <tr>
        <td align="center">
            <table width="600" dir="rtl"
                   style="background-color: #ffffff; border-radius: 5px; overflow: hidden; text-align: right; direction: rtl;">

                <!-- Logo Section -->
                <tr>
                    <td align="center" style="background-color: #F8F5EF; padding: 30px;">
                        <img src="{{ asset('web/image/logo.png') }}" style="height: 70px;">
                    </td>
                </tr>

                <!-- Content Section -->
                <tr>
                    <td style="padding: 30px;" dir="rtl" align="right">
                        <h5 style="font-size: 24px; color: #25343E; margin-bottom: 15px;">السلام عليكم ورحمة الله
                            وبركاته،</h5>
                        <p style="font-size: 18px; color: #667178; line-height: 1.6;">
                            نود إعلامكم بأنه قد تم إضافتكم كموظف جديد ضمن فريق إدارة العمليات الميدانية. يمكنكم الآن
                            تسجيل الدخول إلى المنصة باستخدام البيانات التالية:
                        </p>
                            <div>
                             <a href="https://linktr.ee/RCMC_app" class="fs-14 fw-500 main-button mt-3 mb-3">تسجيل الدخول</a>

                            </div>


                        <div class="d-flex mb-3">
                            <span class="fs-18" style="color: #25343E;">رقم الهوية : </span>
                            <span class="fs-18lh-lg" style="color: #667178;">{{$national_id}}</span>
                        </div>
                        <div class="d-flex mb-3">
                            <span class="fs-18" style="color: #25343E;">البريد الإلكتروني : </span>
                            <span class="fs-18lh-lg" style="color: #667178;">{{$email}}</span>
                        </div>
                        <div class="d-flex mb-3">
                            <span class="fs-18" style="color: #25343E;">كلمة المرور : </span>
                            <span class="fs-18lh-lg" style="color: #667178;">{{$password}}</span>
                        </div>

                        <h5 style="font-size: 18px; color: #25343E; margin-top: 30px;">يرجى ملاحظة ما يلي:</h5>
                        <ul style="padding-right: 20px;">
                            <li style="font-size: 16px; color: #667178; margin-bottom: 10px;">
                                يمكنكم تغيير كلمة المرور عند تسجيل الدخول لأول مرة لضمان الأمان.
                            </li>
                            <li style="font-size: 16px; color: #667178; margin-bottom: 10px;">
                                في حال وجود أي استفسار، يُرجى التواصل مع فريق الدعم الفني عبر البريد الإلكتروني:
                                <a href="mailto:info@@rcmc.gov.sa">info@@rcmc.gov.sa</a>
                            </li>
                        </ul>

                        <h5 style="font-size: 16px; color: #25343E; margin-top: 30px;">
                            نتمنى لكم التوفيق في أداء مهامكم، ونسأل الله أن يكتب لكم الأجر في خدمة ضيوف الرحمن.
                        </h5>

                        <p style="font-size: 14px; color: #667178;">
                            المركز العام للنقل بالهيئة الملكية لمدينة مكة المكرمة والمشاعر المقدسة
                        </p>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>

</body>

</html>
