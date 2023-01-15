jQuery(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    //   $("#owl_1").owlCarousel({
    //     transitionStyle : "fade"
    //   });

    $("#owl_1").owlCarousel({
        pagination: false,
        loop: true,
        margin: 10,
        nav: false,
        autoplay: true,
        dots: false,
        animateOut: "fadeOut",
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 1,
            },
        },
    });

    $("#owl_2").owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 3,
            },
            990: {
                items: 4,
            },
            1000: {
                items: 4,
            },
        },
    });

    $("#owl_3").owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 2,
            },
            990: {
                items: 2,
            },
            1000: {
                items: 2,
            },
        },
    });

    // Nav Dropdown Start

    // Add slideup & fadein animation to dropdown
    // $('.dropdown').on('show.bs.dropdown', function(e){
    // 	var $dropdown = $(this).find('.dropdown-menu');
    // 	var orig_margin_top = parseInt($dropdown.css('margin-top'));
    // 	$dropdown.css({'margin-top': (orig_margin_top + 10) + 'px', opacity: 0}).animate({'margin-top': orig_margin_top + 'px', opacity: 1}, 300, function(){
    // 	   $(this).css({'margin-top':''});
    // 	});
    // 	});
    // 	// Add slidedown & fadeout animation to dropdown
    // 	$('.dropdown').on('hide.bs.dropdown', function(e){
    // 	var $dropdown = $(this).find('.dropdown-menu');
    // 	var orig_margin_top = parseInt($dropdown.css('margin-top'));
    // 	$dropdown.css({'margin-top': orig_margin_top + 'px', opacity: 1, display: 'block'}).animate({'margin-top': (orig_margin_top + 10) + 'px', opacity: 0}, 300, function(){
    // 	   $(this).css({'margin-top':'', display:''});
    // 	});
    // });

    // Back to Top Start
    var btn = $("#button");
    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            btn.addClass("show");
        } else {
            btn.removeClass("show");
        }
    });
    btn.on("click", function (e) {
        e.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, "300");
    });

    // Navbar Fixed
    $(window).scroll(function () {
        if ($(this).scrollTop() > 3) {
            $("nav").addClass("sticky");
        } else {
            $("nav").removeClass("sticky");
        }
    });
});
