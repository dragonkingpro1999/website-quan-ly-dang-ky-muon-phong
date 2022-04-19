// // Scroll to top button appear
$(document).on('scroll', function () {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
        $('.scroll-to-top').fadeIn();
    } else {
        $('.scroll-to-top').fadeOut();
    }
});

// // Smooth scrolling using jQuery easing
$(document).on('click', 'a.scroll-to-top', function (e) {
    $('html, body').animate({
        scrollTop: $("#page-top").offset().top
    }, 2000);
});
