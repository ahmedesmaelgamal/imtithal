<!-- footer -->
<div class="footer">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Load jQuery First -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> <!-- Load jQuery UI After jQuery -->

    <script src="{{ asset('web/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('web/js/all.min.js') }}"></script>

    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.bootstrap5.min.js"></script>

    <script src="{{ asset('web/js/main.js') }}"></script>
    <script src="{{ asset('web/js/plugin.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('web/toastr/toastr.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <script>
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
        }
    </script>
</div>
