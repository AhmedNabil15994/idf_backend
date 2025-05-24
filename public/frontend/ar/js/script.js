
(function ($) {
    'use strict';
    var $window = $(window);

    /*======================================
     Site Header
     ======================================*/

    $('.navbar-nav .nav-item .dropdown-item').on("click", function (e) {
        $('.navbar-collapse').removeClass('show');
    });
    $('.navbar-nav .nav-item a').on("click", function (e) {
        $('.navbar-collapse').removeClass('show');
    });
    $('.navbar-toggler').on("click", function (e) {
        $('.header-area').addClass('sticky');
    });

    $('.responsive-menu').on("click", function (e) {
        $('.header-menu').toggleClass('active');
    });
    $('.category-filter h3').on("click", function (e) {
        $('.filter-block').toggleClass('active');
    });
    $('.filter-block .theme-btn').on("click", function (e) {
        $('.filter-block').removeClass('active');
    });

    /*======================================
     ScrollIT
     ======================================*/
    $.scrollIt({
        upKey: 60, // key code to navigate to the next section
        downKey: 40, // key code to navigate to the previous section
        easing: 'linear', // the easing function for animation
        scrollTime: 600, // how long (in ms) the animation takes
        activeClass: 'active', // class given to the active nav element
        onPageChange: null, // function(pageIndex) that is called when page is changed
        topOffset: -70 // offste (in px) for fixed top navigation
    }
    );

    /*======================================
     WOW Animation
     ======================================*/
    var wow = new WOW({
        boxClass: 'wow', // animated element css class (default is wow)
        animateClass: 'animated', // animation css class (default is animated)
        offset: 0, // distance to the element when triggering the animation (default is 0)
        mobile: false, // trigger animations on mobile devices (default is true)
        live: true, // act on asynchronously loaded content (default is true)
        callback: function (box) {
        }
        , scrollContainer: true // optional scroll container selector, otherwise use window
    }
    );
    wow.init();


    $('.list-partners').owlCarousel({
        responsiveClass: true,
        nav: false,
        dots: true,
        margin: 20,
        animateOut: 'fadeOut',
        autoplay: 3000,
        autoplayTimeout: 3000,
        smartSpeed: 3000,
        paginationSpeed: 3000,
        rtl: true,
        navText: ['<span class="ti-angle-right"></span>', '<span class="ti-angle-left"></span>'],
        responsive: {
            0: {
                items: 2,
            },
            600: {
                items: 2
            },
            1200: {
                items: 3
            }
        }
    });
    $('.home-slides').owlCarousel({
        loop: true,
        responsiveClass: true,
        nav: true,
        dots: true,
        autoplay: true,
        animateOut: 'fadeOut',
        autoplayTimeout: 5000,
        smartSpeed: 500,
//        paginationSpeed: 3000,
        rtl: true,
        autoplayHoverPause: true,
        items: 1,
        navText: ['<span class="ti-angle-right"></span>', '<span class="ti-angle-left"></span>']
    });
    $('.nice-select').niceSelect();
    $('.date').dateDropper();
    $(document).on("click", ".family-members .remove-member", function (e) {
        e.preventDefault();
        $(this).parent().remove();
    });

})(jQuery);
