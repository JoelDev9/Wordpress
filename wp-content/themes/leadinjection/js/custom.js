(function ($) {

    "use strict";

    var $window = $(window);

    var currentWindowPos = $window.scrollTop();
    $window.scroll(function () {
        currentWindowPos = $window.scrollTop();
    });

    var currentWindowWidth = $window.width();
    $window.resize(function () {
        currentWindowWidth = $(window).width();
    });


    // Site preloader
    // -------------------------------------------------------------------------------
    $window.load(function () {
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });


    // Scroll To Animation
    //-------------------------------------------------------------------------------
    var scrollTo = $(".scroll-to");

    scrollTo.on('click', function () {
        $('.modal').modal('hide');

        var scrollOffset = 99;
        var marker = $(this).attr('href');

        if (typeof marker === 'undefined') {
            marker = $(this).find('a').attr('href');
        }

        marker = marker.substr(marker.indexOf('#'));

        //console.log(marker);

        $('html, body').animate({scrollTop: $(marker).offset().top - scrollOffset}, 'slow');
        return false;
    });

    // Scroll Up Btn
    //-------------------------------------------------------------------------------
    $window.scroll(function () {
        if (currentWindowWidth > 768) {
            if (currentWindowPos > 100) {
                $('.scroll-up-btn').removeClass("animated fadeOutRight");
                $('.scroll-up-btn').fadeIn().addClass("animated fadeInRight");
            } else {
                $('.scroll-up-btn').removeClass("animated fadeInRight");
                $('.scroll-up-btn').fadeOut().addClass("animated fadeOutRight");
            }
        }
    });


    // Open a Modal from Nav
    //-------------------------------------------------------------------------------
    var modalLinkDefaultMenu = $(".liModal");
    modalLinkDefaultMenu.on('click', function (event) {
        var modalId = $(this).children("a").attr('href');
        if (modalId === undefined) {
            modalId = $(this).attr('href');
        }
        $(modalId).modal();
        return false;
    });

    var modalLinkMegaMainMenu = $(".liModal .item_link");
    modalLinkMegaMainMenu.on('click', function (event) {
        var modalId = $(this).attr('href');
        $(modalId).modal();
        return false;
    });


    // Header Fade In after Scroll
    // -------------------------------------------------------------------------------
    $window.scroll(function () {
        if (currentWindowPos > 300) {
            $('.header-hidden').fadeIn();
        } else {
            $('.header-hidden').fadeOut();
        }
    });


    // Header Style 2
    // -------------------------------------------------------------------------------
    $window.scroll(function () {
        if (currentWindowPos > 180) {
            $('.header-style-2.header-fixed .header-top').slideUp();
            $('.header-style-2.header-fixed .navbar .nav_logo .logo_link').show('1000');
        } else {
            $('.header-style-2.header-fixed .header-top').slideDown();
            if (currentWindowWidth >= 992) {
                $('.header-style-2.header-fixed .navbar .nav_logo .logo_link').hide('1000');
            }
        }
    });

    // Top Widget Bar
    // -------------------------------------------------------------------------------
    $window.scroll(function () {
        if (currentWindowPos > 47) {
            $('.navbar-widgets-fade').fadeOut();
        } else {
            $('.navbar-widgets-fade').fadeIn();
        }
    });

    // Transparent Header
    // -------------------------------------------------------------------------------
    $window.scroll(function () {
        if (currentWindowPos > 47) {
            $('.header-transparent .header-nav').removeClass('transparent-enable');
        } else {
            $('.header-transparent .header-nav').addClass('transparent-enable');
        }
    });


    // Transparent to Color Menu
    // -------------------------------------------------------------------------------
    $window.scroll(function () {
        if (currentWindowPos > 45) {
            $(".li-header.header-fixed").addClass('transparent-to-color');
        } else {
            $('.li-header.header-fixed').removeClass('transparent-to-color');
        }
    });


    // Animation
    // -------------------------------------------------------------------------------
    $window.load(function () {  // run after all scripts a loaded
        if (jQuery().waypoint) {     // check if waypoint function exists!
            $('.li-animate').waypoint(function () {
                var effect = $(this.element).data('effect');
                $(this.element).css('visibility', 'visible');
                $(this.element).addClass('animated');
                $(this.element).addClass(effect);
            }, {
                offset: '87%',
                triggerOnce: true
            });
        }

    });

    // Number Counter
    // -------------------------------------------------------------------------------
    $window.load(function () {  // run after all scripts a loaded

        if (jQuery().waypoint && jQuery().animateNumber) {     // check if waypoint function exists!

            $('.number-counter-value').waypoint(function () {

                var numberValueStart = $(this.element).data('start');
                var numberValueEnd = $(this.element).data('end');

                var numberValueSpeed = $(this.element).data('speed');
                //console.log(numberValueSpeed);
                if (undefined === numberValueSpeed) {
                    numberValueSpeed = 5000;
                }
                $(this.element).prop('number', numberValueStart).animateNumber({number: numberValueEnd}, numberValueSpeed);

            }, {
                offset: '87%',
                triggerOnce: true
            });
        }

    });

    // Pricing Table Simple
    // -------------------------------------------------------------------------------
    $(".pricing-table-col").on("mouseover", function () {

        var animation = 'swing';

        $(".pricing-table-col").removeClass("highlight");
        $(".pricing-table-col .action").removeClass("animated " + animation);
        $(this).addClass("highlight");
        $(this).find(".action").addClass("animated " + animation);
    });


    // Accordion
    // -------------------------------------------------------------------------------

    // Accordion Bullets Style

    $(".li-bullets-toogle .panel-title a").on("click", function () {

        $(".li-bullets-toogle .panel-title a i").removeClass("fa-dot-circle-o");
        $(".li-bullets-toogle .panel-title a i").addClass("fa-circle-o");

        $(".li-bullets-toogle .panel .panel-heading").removeClass("panel-heading_active");
        $(this).closest('.panel-heading').addClass("panel-heading_active");

        $("i", this).removeClass("fa-circle-o");
        $("i", this).addClass("fa-dot-circle-o");
    });

    // Accordion Plus/Minus Style

    $(".li-plus-minus-toogle .panel-title a").on("click", function () {

        $(".li-plus-minus-toogle .panel .panel-heading").removeClass("panel-heading_active");
        $(this).closest('.panel-heading').addClass("panel-heading_active");

        $(".li-plus-minus-toogle a span").removeClass("panel-title-link-toggle_collapse");
        $("span", this).addClass("panel-title-link-toggle_collapse");

        $(".li-plus-minus-toogle  .panel-title a span").html("-");
        $(".li-plus-minus-toogle  .panel-title a span").html("+");

        $("span", this).html("+");
        $("span", this).html("-");

    });


    // Blog Post Popup Image
    // -------------------------------------------------------------------------------
    $('.image-popup').magnificPopup({
        type: 'image',
    });

    $('.gallery-container').magnificPopup({
        delegate: 'a', // child items selector, by clicking on it popup will open
        type: 'image',
        gallery: {
            enabled: true
        }
    });

    // WooCommerce quantity input field
    // -------------------------------------------------------------------------------
    $('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
    $('.quantity').each(function () {
        var spinner = $(this),
            input = spinner.find('input[type="number"]'),
            btnUp = spinner.find('.quantity-up'),
            btnDown = spinner.find('.quantity-down'),
            min = input.attr('min'),
            max = 1000;

        btnUp.click(function () {
            console.log('click');
            var oldValue = parseFloat(input.val());
            if (oldValue >= max) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue + 1;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("change");
        });

        btnDown.click(function () {
            var oldValue = parseFloat(input.val());
            if (oldValue <= min) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue - 1;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("change");
        });

    });


})(jQuery);


// Rev Slider Modal Open CallBack
// -----------------------------------------------------------------------------------
function openModal(liModalId) {
    jQuery('#' + liModalId).modal();
}


// Skip link focus code snippet from _s theme
// -----------------------------------------------------------------------------------
(function () {
    var is_webkit = navigator.userAgent.toLowerCase().indexOf('webkit') > -1,
        is_opera = navigator.userAgent.toLowerCase().indexOf('opera') > -1,
        is_ie = navigator.userAgent.toLowerCase().indexOf('msie') > -1;

    if ((is_webkit || is_opera || is_ie) && document.getElementById && window.addEventListener) {
        window.addEventListener('hashchange', function () {
            var id = location.hash.substring(1),
                element;

            if (!(/^[A-z0-9_-]+$/.test(id))) {
                return;
            }

            element = document.getElementById(id);

            if (element) {
                if (!(/^(?:a|select|input|button|textarea)$/i.test(element.tagName))) {
                    element.tabIndex = -1;
                }

                element.focus();
            }
        }, false);
    }
})();

