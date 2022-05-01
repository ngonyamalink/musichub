(function ($) {
    "use strict";

    jQuery(document).ready(function ($) {


        $(".embed-responsive iframe").addClass("embed-responsive-item");
        $(".carousel-inner .item:first-child").addClass("active");

        $('[data-toggle="tooltip"]').tooltip();

        /* Testimonial Slide Active*/
        $(".testimonial").owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            autoplayTimeout: 7000,
            smartSpeed: 500,
            center: true,
            nav: true,
            center: true,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right" ></i>']
        });

        /*     Paralax-background-active      */

        $('.home-slider').parallax("50%", 0.1);

    });


    jQuery(window).load(function () {


    });


}(jQuery));