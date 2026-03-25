<!DOCTYPE html lang={{ app()->getLocale() }}>
<html>
@include('web.layouts.head')

<body>
    @include('web.layouts.sidebar')
    <div class="main home">
        <div class="main-content">
            @include('web.layouts.header')
            @yield('content')
        </div>
    </div>
    @include('web.layouts.footer')
    <script>
        // ضبط الإعدادات الافتراضية لـ Toastr
        toastr.options = {
            "progressBar": true,
            "timeOut": "5000",
            "positionClass": "toast-top-right",
            "showDuration": "300",
            "hideDuration": "1000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "toastClass": "toast toast-custom"
        };
        $(document).on('click', '.btn-filter', function(e) {
            e.preventDefault();
            $(this).closest('.card-border, .content-one, .content-two, .main-header-content').find('.form-filter').first().slideToggle();
        });
    </script>
    @yield('js')



</body>

</html>
