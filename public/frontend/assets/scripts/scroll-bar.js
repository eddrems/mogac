var barOffset = $('#mainContentPage').offset();
$(".command-bar").css('top', barOffset.top);

$(window).bind('scroll', function () {
    if ($(window).width() >= 980) {
        //if ($(window).scrollTop() > barOffset.top - 45) {
        if ($(window).scrollTop() > 19) {
            $('.command-bar').addClass('command-bar-fixed');
            //$('.command-bar').css('top', barOffset.top - 21);
            $('.command-bar').css('top', '43px');
        }
        else {
            $('.command-bar').removeClass('command-bar-fixed');
            $('.command-bar').css('top', '64px');
        }
    }
});

$(window).resize(function () {
    if ($(window).width() < 980) {
        $('.command-bar').removeClass('command-bar-fixed');
        $('.command-bar').css('top', '64px');
    } else {
        $('.command-bar').addClass('command-bar-fixed');
        if ($(window).scrollTop() > 19) {
            $('.command-bar').css('top', '43px');
        } else {
            $('.command-bar').css('top', '64px');
        }
    }
});