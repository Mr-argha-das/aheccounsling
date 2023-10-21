$(function () {
    if (/Android|webOS|iPhone|iPad|iPod|Opera Mini/i.test(navigator.userAgent)) {

        $(document).on('focus', 'input', function (e) {

            var elmMsg = $(this);
            var parentScrollElm = $('html, body');
            var parentScrollElmValue = $(window).scrollTop();
            if (elmMsg.closest('.fancybox-slide').length > 0) {
                parentScrollElm = elmMsg.closest('.fancybox-slide');
                parentScrollElmValue = elmMsg.offset().top;
            }
            //                /console.log(parentScrollElmValue+'-'+elmMsg.offset().top);
            if (parentScrollElmValue < elmMsg.offset().top - 20) {
                //$('html, body').animate({
                parentScrollElm.animate({
                    scrollTop: elmMsg.offset().top - 150
                });
            }
        })
    }
})

$(window).on('load', function () {
    $('#page-loading').css({
        'left': $(window).width() - ($(window).width() * 2),
    });
})
