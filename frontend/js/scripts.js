//   all ------------------
function  initEasybook() {
    "use strict";
    //   loader ------------------
    $(".loader-wrap").fadeOut(300, function () {
        $("#main").animate({
            opacity: "1"
        }, 600);
    });

    //   tabs------------------
    $(".tabs-menu a").on("click", function (a) {
        a.preventDefault();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var b = $(this).attr("href");
        $(".tab-content").not(b).css("display", "none");
        $(b).fadeIn();
    });

    // scroll animation ------------------
    $(window).on("scroll", function (a) {
        if ($(this).scrollTop() > 150) {
            $(".to-top").fadeIn(500);
        } else {
            $(".to-top").fadeOut(500)
        }
    });
    //   scroll to------------------
    $(".custom-scroll-link").on("click", function () {
        var a = 150 + $(".scroll-nav-wrapper").height();
        if (location.pathname.replace(/^\//, "") === this.pathname.replace(/^\//, "") || location.hostname === this.hostname) {
            var b = $(this.hash);
            b = b.length ? b : $("[name=" + this.hash.slice(1) + "]");
            if (b.length) {
                $("html,body").animate({
                    scrollTop: b.offset().top - a
                }, {
                    queue: false,
                    duration: 1200,
                    easing: "easeInOutExpo"
                });
                return false;
            }
        }
    });
    $(".to-top").on("click", function (a) {
        a.preventDefault();
        $("html, body").animate({
            scrollTop: 0
        }, 800);
        return false;
    });
    // modal ------------------
    var modal = {};
    modal.hide = function () {
        $('.modal , .reg-overlay').fadeOut(200);
        $("html, body").removeClass("hid-body");
    };
    $('.modal-open').on("click", function (e) {
        e.preventDefault();
        $('.modal , .reg-overlay').fadeIn(200);
        $("html, body").addClass("hid-body");
    });
    $('.close-reg , .reg-overlay').on("click", function () {
        modal.hide();
    });
    // Header ------------------
    $(".more-filter-option").on("click", function () {
        $(".hidden-listing-filter").slideToggle(500);
        $(this).find("span").toggleClass("mfilopact");
    });
    var headSearch = $(".header-search"),
        ssbut = $(".show-search-button"),
        wlwrp = $(".wishlist-wrap"),
        wllink = $(".wishlist-link");
    function showSearch() {
        headSearch.addClass("vis-head-search").removeClass("vis-search");
        ssbut.find("span").text("Close");
        ssbut.find("i").addClass("vis-head-search-close");
        hideWishlist();
    }
    function hideSearch() {
        headSearch.removeClass("vis-head-search").addClass("vis-search");
        ssbut.find("span").text("Search");
        ssbut.find("i").removeClass("vis-head-search-close");
    }
    ssbut.on("click", function () {
        if ($(".header-search").hasClass("vis-search")) showSearch();
        else hideSearch();
    });
    $(".close-header-search").on("click", function () {
        hideSearch();
    });
    function showWishlist() {
        wlwrp.fadeIn(1).addClass("vis-wishlist").removeClass("novis_wishlist")
        hideSearch();
        wllink.addClass("scwllink");
    }
    function hideWishlist() {
        wlwrp.fadeOut(1).removeClass("vis-wishlist").addClass("novis_wishlist");
        wllink.removeClass("scwllink");
    }
    wllink.on("click", function () {
        if (wlwrp.hasClass("novis_wishlist")) showWishlist();
        else hideWishlist();
    });
    $(".eye").on("click touchstart", function () {
        var epi = $(this).parent(".pass-input-wrap").find("input");
        if (epi.attr("type") === "password") {
            epi.attr("type", "text");
        } else {
            epi.attr("type", "password");
        }
    });
    $(".dasboard-menu li").on({
        mouseenter: function () {

            $(this).find("a").css({
                "color": "#666",
                "background": "#fff"
            });

        },
        mouseleave: function () {
            $(this).find("a").css({
                "color": "#fff",
                "background": "none"
            });
        }
    });
    //   scrollToFixed------------------
    $(".fixed-scroll-column-item").scrollToFixed({
        minWidth: 1064,
        marginTop: 200,
        removeOffsets: true,
        limit: function () {
            var a = $(".limit-box").offset().top - $(".fixed-scroll-column-item").outerHeight() - 46;
            return a;
        }
    });
    $(".scroll-nav-wrapper").scrollToFixed({
        minWidth: 768,
        zIndex: 1112,
        marginTop: 110,
        removeOffsets: true,
        limit: function () {
            var a = $(".limit-box").offset().top - $(".scroll-nav-wrapper").outerHeight(true) - 190;
            return a;
        }
    });
    $(".back-to-filters").scrollToFixed({
        minWidth: 1064,
        zIndex: 12,
        marginTop: 190,
        removeOffsets: true,
        limit: function () {
            var a = $(".limit-box").offset().top - $(".back-to-filters").outerHeight(true) - 30;
            return a;
        }
    });
    $(".dasboard-sidebar-content").scrollToFixed({
        minWidth: 1064,
        zIndex: 12,
        marginTop: 130,
        removeOffsets: true,
        limit: function () {
            var a = $(".limit-box").offset().top - $(".dasboard-sidebar-content").outerHeight(true) - 48;
            return a;
        }
    });
    if ($(".fixed-bar").outerHeight(true) < $(".post-container").outerHeight(true)) {
        $(".fixed-bar").addClass("fixbar-action");
        $(".fixbar-action").scrollToFixed({
            minWidth: 1064,
            marginTop: function () {
                var a = $(window).height() - $(".fixed-bar").outerHeight(true) - 100;
                if (a >= 0) return 20;
                return a;
            },
            removeOffsets: true,
            limit: function () {
                var a = $(".limit-box").offset().top - $(".fixed-bar").outerHeight();
                return a;
            }
        });
    } else $(".fixed-bar").removeClass("fixbar-action");
    //   Slick------------------

    $('.single-slider').slick({
        infinite: true,
        slidesToShow: 1,
        dots: true,
        arrows: false,
        adaptiveHeight: true
    });
    // Styles ------------------
    if ($("footer.main-footer").hasClass("fixed-footer")) {
        $('<div class="height-emulator fl-wrap"></div>').appendTo("#main");
    }
    function csselem() {
        $(".height-emulator").css({
            height: $(".fixed-footer").outerHeight(true)
        });
        $(".slideshow-container .slideshow-item").css({
            height: $(".slideshow-container").outerHeight(true)
        });
        $(".slider-container .slider-item").css({
            height: $(".slider-container").outerHeight(true)
        });
        $(".map-container.column-map").css({
            height: $(window).outerHeight(true) - 110 + "px"
        });
    }
    csselem();
    // Mob Menu------------------
    $(".nav-button-wrap").on("click", function () {
        $(".main-menu").toggleClass("vismobmenu");
    });
    function mobMenuInit() {
        var ww = $(window).width();
        if (ww < 1064) {
            $(".menusb").remove();
            $(".main-menu").removeClass("nav-holder");
            $(".main-menu nav").clone().addClass("menusb").appendTo(".main-menu");
            $(".menusb").menu();
            $(".map-container.fw-map.big_map.hid-mob-map").css({
                height: $(window).outerHeight(true) - 110 + "px"
            });
        } else {
            $(".menusb").remove();
            $(".main-menu").addClass("nav-holder");
            $(".map-container.fw-map.big_map.hid-mob-map").css({
                height: 550 + "px"
            });
        }
    }
    mobMenuInit();
    //   css ------------------
    var $window = $(window);
    $window.on("resize", function () {
        csselem();
        mobMenuInit();
        if ($(window).width() > 1064) {
            $(".lws_mobile , .dasboard-menu-wrap").addClass("vishidelem");
            $(".map-container.fw-map.big_map.hid-mob-map").css({
                "right": "0"
            });
            $(".map-container.column-map.hid-mob-map").css({
                "right": "0"
            });
        } else {
            $(".lws_mobile , .dasboard-menu-wrap").removeClass("vishidelem");
            $(".map-container.fw-map.big_map.hid-mob-map").css({
                "right": "-100%"
            });
            $(".map-container.column-map.hid-mob-map").css({
                "right": "-100%"
            });
        }
    });
    $(".box-cat").on({
        mouseenter: function () {
            var a = $(this).data("bgscr");
            $(".bg-ser").css("background-image", "url(" + a + ")");
        }
    });
    $(".header-user-name").on("click", function () {
        $(".header-user-menu ul").toggleClass("hu-menu-vis");
        $(this).toggleClass("hu-menu-visdec");
    });
    // Counter ------------------
    if ($(".counter-widget").length > 0) {
        var countCurrent = $(".counter-widget").attr("data-countDate");
        $(".countdown").downCount({
            date: countCurrent,
            offset: 0
        });
    }
	function showBookingForm (){
		$(".booking-modal-wrap , .bmw-overlay").fadeIn(400);
		$("html, body").addClass("hid-body");
	}
	function hideBookingForm (){
		$(".booking-modal-wrap , .bmw-overlay").fadeOut(400);
		$("html, body").removeClass("hid-body");
	}
    $(".booking-modal-close , .bmw-overlay").on("click", function () {
  		hideBookingForm ();
    });
    $(".book-btn").on("click", function (e) {
		e.preventDefault();
  		showBookingForm ();
    });
}

//   Parallax ------------------
function initparallax() {
    var a = {
        Android: function () {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function () {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function () {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function () {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function () {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function () {
            return a.Android() || a.BlackBerry() || a.iOS() || a.Opera() || a.Windows();
        }
    };
    trueMobile = a.any();
    if (null === trueMobile) {
        var b = new Scrollax();
        b.reload();
        b.init();
    }
    if (trueMobile) $(".bgvid , .background-vimeo , .background-youtube-wrapper ").remove();
}

$('.fuzone input').each(function () {
    $(this).on('change', function () {
        var pufzone = $(this).parents(".fuzone").find('.photoUpload-files');
        pufzone.empty();
        var files = $(this)[0].files;
        for (var i = 0; i < files.length; i++) {
            $("<span></span>").text(files[i].name).appendTo(pufzone);
        }
    });
});

function initAutocomplete() {
    var acInputs = document.getElementsByClassName("autocomplete-input");
    for (var i = 0; i < acInputs.length; i++) {
        var autocomplete = new google.maps.places.Autocomplete(acInputs[i]);
        autocomplete.inputId = acInputs[i].id;
    }
}
$(".dasboard-menu-btn").on("click", function () {
    $(".dasboard-menu-wrap").slideToggle(500);
});
$(".list-single-facts .inline-facts-wrap").matchHeight({});
$(".listing-item-container  .listing-item").matchHeight({});
$(".article-masonry").matchHeight({});
$(".grid-opt li span").on("click", function () {
    $(".listing-item").matchHeight({
        remove: true
    });
    setTimeout(function () {
        $(".listing-item").matchHeight();
    }, 50);
    $(".grid-opt li span").removeClass("act-grid-opt");
    $(this).addClass("act-grid-opt");
    if ($(this).hasClass("two-col-grid")) {
        $(".listing-item").removeClass("has_one_column");
        $(".listing-item").addClass("has_two_column");
    } else if ($(this).hasClass("one-col-grid")) {
        $(".listing-item").addClass("has_one_column");
    } else {
        $(".listing-item").removeClass("has_one_column").removeClass("has_two_column");
    }
});
$(".notification-close").on("click", function () {
    $(this).parent(".notification").slideUp(500);
});
document.addEventListener('gesturestart', function (e) {
	e.preventDefault();
});
// Init All ------------------
$(document).ready(function () {
    initEasybook();
    initparallax();
});