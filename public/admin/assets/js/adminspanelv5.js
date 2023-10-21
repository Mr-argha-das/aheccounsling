 // Step 1: Create reusable jQuery plugin
// Step 1: Create reusable jQuery plugin
// =====================================

var $= jQuery.noConflict();


$.fancyConfirm = function (opts) {
    opts = $.extend(true, {
        title: 'Are you sure?',
        message: '',
        okButton: 'OK',
        noButton: 'Cancel',
        callback: $.noop
    }, opts || {});

    $.fancybox.open({
        type: 'html',
        src: '<div class="fc-content p-5 rounded">' +
            '<h3 class="mb-3">' + opts.title + '</h3>' +
            '<p>' + opts.message + '</p>' +
            '<p class="text-center">' +
            (opts.noButton == '' ? '' : '<a href="javascript:;"></a><a data-value="0" data-fancybox-close href="javascript:;" class="mr-2 btn btn-secondary">' + opts.noButton + '</a>') +
            '<button data-value="1" data-fancybox-close class="btn btn-themecolor">' + opts.okButton + '</button>' +
            '</p>' +
            '</div>',
        opts: {
            animationDuration: 350,
            animationEffect: 'material',
            modal: true,
            baseTpl: '<div class="fancybox-container fc-container" role="dialog" tabindex="-1">' +
                '<div class="fancybox-bg"></div>' +
                '<div class="fancybox-inner">' +
                '<div class="fancybox-stage"></div>' +
                '</div>' +
                '</div>',
            afterClose: function (instance, current, e) {
                var button = e ? e.target || e.currentTarget : null;
                var value = button ? $(button).data('value') : 0;

                opts.callback(value);
            }
        }
    });
};


function stringToSlug(str) {
    var $slug = '';
    var trimmed = $.trim(str);
    trimmed = trimmed.replace("&", "and");
    $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
    replace(/-+/g, '-').
    replace(/^-|-$/g, '');
    return $slug.toLowerCase();
}


function jsonToOptions(url, elm, childElm, nullSelect = true) {
    childElm.val('').html('');
    if (nullSelect) {
        childElm.append($('<option>').text("Select").attr('value', ''));
    }
    var currentValue = elm.val();
    if (currentValue == "" || currentValue == " ") {
        return false;
    }
    $.getJSON(url + currentValue, function (data) {
        //JSON.parse(data);
        if (data.status != "success") {
            console.log(data);
            return false;
        }
        $.each(data.data, function (i, obj) {
            childElm.append($('<option>').text(obj.text).attr('value', obj.id));
        });
        selectVal(childElm);
        childElm.change();
    });
}

function common() {
    "use strict";


    $.datepicker.setDefaults({
        dateFormat: 'dd-M-yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        /*gotoCurrent: true,*/

    });

    $('.datepicker').datepicker({
        beforeShow: function (input, inst) {

            var calendar = inst.dpDiv;

            setTimeout(function () {
                calendar.position({
                    my: 'left top',
                    at: 'left bottom',
                    collision: 'none',
                    of: input
                });
            }, 1);
        }
    });
    $(".dt_from").datepicker({
        /*defaultDate: "+1w",
      changeMonth: true,*/
        onClose: function (selectedDate) {
            $(this).closest('.daterange').find('.dt_to').datepicker("option", "minDate", selectedDate);
        }
    });

    $(".dt_to").datepicker({
        /* defaultDate: "+1w",
      changeMonth: true,*/
        onClose: function (selectedDate) {
            $(this).closest('.daterange').find('.dt_from').datepicker("option", "maxDate", selectedDate);
        }
    });
   

    $(document).on('click', '[data-action-url]', function () {
        var t = $(this);
        var Title = t.attr('data-alert-title');
        var Msg = t.attr('data-alert-msg');
        if (Title == null) {
            Title = "Alert";
        }
        if (Msg == null) {
            Msg = "Are you sure to continue?";
        }

        $.alert({
            title: Title,
            content: Msg,
            backgroundDismiss: true,
            escapeKey: true,
            buttons: {
                confirm: function () {
                    var Url = t.attr('data-action-url');
                    window.location.href = Url;
                },
                cancel: function () {}
            }
        });
    })


    $('input[type=text],textarea,input[type=email]').attr('spellcheck', "true");

    //addBootstrapInput
    $('input[type=text],input[type=email],input[type=number],input[type=password],input[type=url],input[type=tel],select,textarea').not('.no_bs').addClass('form-control form-control-sm');

/*
    $(".select,select:not(.default-select,.clone_box select)").select2({
        placeholder: {
            id: '', // the value of the option
            text: 'Select an option',
            // container: ".container" // can accept any jQuery selector
        },

        'width': '100%'

    });*/
   /* $(".selecttags").select2({
        placeholder: {
            id: '', // the value of the option
            text: 'Select an option',
            // container: ".container" // can accept any jQuery selector
        },
        tags:true,

        'width': '100%'

    });
*/
}

// function addFancybox() {
//     $('.fancyboxajax').attr('data-type', "ajax");

//     $('.fancyboxajax').fancybox({
//         type: 'ajax',
//         model: true,
//         touch: false,
//         trapFocus: false,
//         afterLoad: function () {
//             common();
//             //$(".fancybox-wrap form").validate();
//             selectVal('');
//         }
//     });

// }

function selectVal(element) {
    if (element == '') {
        $("select[data-curval],input[data-curval]").each(function () {
            $(this).val($(this).attr('data-curval'));
        });
    } else {

        if (element.attr('data-curval')) {
            element.val(element.attr('data-curval'));
        }

    }
}


$(document).ready(function () {

    $(document).on('change', '.alpha_dash', function () {
        $(this).val(StrungToSlug($(this).val()));
    });

    $(document).on("click", "[data-action-url]", function () {
        var elm = $(this);

        var title = elm.attr('data-alert-title');
        var msg = elm.attr('data-alert-msg');
        if (title == null) {
            title = "Alert";
        }
        if (msg == null) {
            msg = "Are you sure want to continue?";
        }
        // Open customized confirmation dialog window
        $.fancyConfirm({
            title: title,
            message: msg + '<br><br>',
            okButton: 'Yes',
            noButton: 'No',
            callback: function (value) {
                if (value) {
                    var Url = elm.attr('data-action-url');
                    window.location.href = Url;
                } else {

                }
            }
        });

    });



    selectVal('');
    common();


    // addFancybox();

    var loc = window.location.href;
    $("a").each(function () {
        if (this.href === loc) {
            $(this).addClass('sl');
        }
        if (!$(this).attr('title') && $(this).attr('href')) {
            var tyu = jQuery.trim($(this).text().replace(/\s+/g, " ").replace(/^\s|\s$/g, ""));
            $(this).attr('title', tyu);
        }
    });


});



$('.ajaxprocessbutton,.ajax_msg').hide();

$(document).on('click', '.ajaxbutton', function () {
    $(this).closest('form').submit();
});
/*$(".ajaxform").on('submit',function(e) {*/
$(document).on('submit', '[data-ajaxAction]', function (e) {
    e.preventDefault();
    var elmForm = $(this);

    if (elmForm.find('.ajax_msg').length == 0) {
        elmForm.prepend('<div class="ajax_msg" style="display: none;"></div>');
    }
    var elmMsg = elmForm.find('.ajax_msg');

    var elmSubmitBtn = elmForm.find('.ajaxbutton');

    if (elmSubmitBtn.length == 0) {
        elmSubmitBtn = elmForm.find(':submit');
    }

    if (elmForm.find('.ajaxprocessbutton').length == 0) {
        elmSubmitBtn.after('<button type="button" class="btn btn-themecolor buttonload ajaxprocessbutton" disable style="display: none;"><i class="fa fa-spinner sfa fa-spin"></i> Processing</button>');
    }

    /* if (elmForm.find('.ajaxprocessbutton').length == 0) {
        elmSubmitBtn.after('<button class="buttonload ajaxprocessbutton" disable style="display: none;"><i class="fa fa-spinner sfa fa-spin"></i>Loading</button>');
    }*/
    var elmProcessBtn = elmForm.find('.ajaxprocessbutton');

    var formData = new FormData(this);

    var formUrl = elmForm.attr('data-ajaxAction');

    var successUrl = '';
    if (elmForm.is('[data-ajaxsuccessUrl]')) {
        successUrl = elmForm.attr('data-ajaxsuccessUrl');
    }

    elmProcessBtn.show();
    elmSubmitBtn.hide();

    elmMsg.hide();

    $.ajax({
        url: elmForm.attr('data-ajaxAction'),
        type: 'POST',
        data: formData,
        success: function (data) {
            if(typeof data !='object'){
                data=JSON.parse(data);
            }
            
            console.log(data);
            //data=JSON.parse(data);
            //alert(data);
            if (data.status == "success") {
                //elmSubmitBtn.show();
                var msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + data.message + '</div>';
                elmMsg.html(msg).fadeIn();
                if (data.data['nextUrl']) {
                    window.location = data.data['nextUrl'];
                } else if (successUrl != '') {
                    window.location.href = successUrl;
                } else {
                    window.location.reload();
                }
            } else if (data.status == "error") {
                var msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + data.message + '</div>';
                elmMsg.html(msg).fadeIn();
                elmProcessBtn.hide();
                elmSubmitBtn.show();
            } else {

                alert('no-status');
                elmProcessBtn.hide();
                elmSubmitBtn.show();
                alert(data);
            }

            var parentScrollElm = $('html, body');
            var parentScrollElmValue = $(window).scrollTop();
            if (elmMsg.closest('.fancybox-slide').length > 0) {
                parentScrollElm = elmMsg.closest('.fancybox-slide');
                parentScrollElmValue = elmMsg.offset().top;
            }

            if (parentScrollElmValue > elmMsg.offset().top - 20) {
                //$('html, body').animate({
                parentScrollElm.animate({
                    scrollTop: elmMsg.offset().top - 20
                });
            }
            /*$('html, body').animate({
                        scrollTop: 0
                    });*/


        },
        cache: false,
        contentType: false,
        processData: false
    });
});


$(document).on('click', '.alert .close-msg', function () {
    $(this).closest('.alert').slideUp();
});
