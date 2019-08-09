(function( $ ) {
    /**
     * START - ONLOAD - JS
     */
    /* ----------------------------------------------- */
    /* ------------- FrontEnd Functions -------------- */
    /* ----------------------------------------------- */
    function slider() {
        $('.main-slider-inner').slick({
            dots: true,
            infinite: true,
            autoplay: true,
            pauseOnFocus: false,
            pauseOnHover: false,
            slidesToShow: 1,
            prevArrow: '<button type="button" class="slick-prev"></button>',
            nextArrow: '<button type="button" class="slick-next"></button>',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 990,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 520,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        $('.cate-slider').slick({
            dots: false,
            infinite: false,
            slidesToShow: 6,
            slidesToScroll: 1,
            prevArrow: '<button type="button" class="slick-prev cate-prev"></button>',
            nextArrow: '<button type="button" class="slick-next cate-next"></button>',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 520,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        $('.i-prod-slider').slick({
            dots: false,
            infinite: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            prevArrow: '<button type="button" class="slick-prev cate-prev"></button>',
            nextArrow: '<button type="button" class="slick-next cate-next"></button>',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 990,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 520,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        $('.prod-related-slider').slick({
            dots: false,
            infinite: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            prevArrow: '<button type="button" class="slick-prev cate-prev"></button>',
            nextArrow: '<button type="button" class="slick-next cate-next"></button>',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 990,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 520,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    }

    function backtop() {
        var header_height = $('.header').outerHeight();
        var img_height = $('.main-slider').outerHeight();
        $(window).on('scroll', function() {
            if($(window).scrollTop() > (header_height + img_height)) {
                $('.backtop').addClass('shw');
            } else {
                $('.backtop').removeClass('shw');
            }
        });

        $('.backtop').on('click', function(e){
            $("html,body").stop().animate({scrollTop: 0}, 'slow', 'swing');
        });
    }

    function perfectScrollbar() {
        const ps = new PerfectScrollbar('#h-cart-body');
    }

    function responsiveMenu() {
        $('.responsive-menu').on('click', function(e){
            $('.main-menu-ul').addClass('shw');
            $('.close-menu').addClass('shw');
        });

        $('.close-menu').on('click', function(e){
            $('.main-menu-ul').removeClass('shw');
            $(this).removeClass('shw');
        });
    }

    /* ----------------------------------------------- */
    /* ----------------------------------------------- */
    /* OnLoad Page */
    $(document).ready(function($){
        slider();
        backtop();
        perfectScrollbar();
        responsiveMenu();
    });
    /* OnLoad Window */
    var init = function () {

    };
    window.onload = init;

})(jQuery);
