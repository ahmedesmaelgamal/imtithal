$(function () {

    'use strict';

    // mobile toggle

    $(".mobile-toggle").click(function () {
        $(".sidebar").toggleClass("change");
    });


    //   datatables

    // $('#example').DataTable();


// new DataTable('#example');
//
// new DataTable('#example1');


    // tabs

    $('.tabs-list div').on('click', function () {

        $(this).addClass('show').siblings().removeClass('show');

        $('.content-list > div').hide();

        $($(this).data('content')).fadeIn();
    });


    // dropfiy

    $('.dropify').dropify();


    //collapse icon

    $('.btn-ollapse').click(function () {
        $(this).toggleClass('active');
    });


});
