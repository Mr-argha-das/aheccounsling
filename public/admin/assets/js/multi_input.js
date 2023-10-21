$(document).ready(function (e) {

    //$('.clone_box .add').attr('href','javascript:void(0)').die();

    $(document).off('click keyup', '.clone_box .add')
    $('.clone_box .clone_row').addClass('clone_line').hide();

    $('.clone_line').each(function () {
        $(this).find('.datepicker').removeClass('hasDatepicker').removeAttr('id').datepicker();
    })

    $(document).on('click keyup', '.clone_box .add', function (event) {
        $(this).unbind('click');


        var data = $(this).closest('.clone_box').find('.clone_row').clone(true, true).removeClass('clone_row').show();
        data.find('.datepicker').removeClass('hasDatepicker').removeAttr('id').datepicker();
       // data.find('.datepicker').removeClass('hasDatepicker').removeAttr('id').datepicker();

        $(this).closest('.clone_line').after(data);

        if ($(this).closest('.clone_box').find('.add').length > 2) {
            //$(this).switchClass('add','delete',10);
        };

        $(this).closest('.clone_box').find('.add').removeClass('add').addClass('delete');
        $(this).closest('.clone_box').find('.delete:last').removeClass('delete').addClass('add');

        //if($(this).closest('#fancybox-content')){	$.fancybox.update();	}

        //e.preventDefault();
        $(this).closest('.clone_line').next('.clone_line').find('input[type=text],textarea,select').filter(':first').focus();

        $(this).closest('.clone_line').next('.clone_line').find('.clonerow-select2').select2({
            placeholder: {
                id: '', // the value of the option
                text: 'Select an option',
            },
            'width': '100%',

        });
        return false;
    })

    $(document).on('click', '.clone_box .delete', function (event) {
        $(this).closest('.clone_line').remove(); {

        }
        //if($(this).closest('#fancybox-content')){	$.fancybox.update();	}
        //if($(this).closest('#fancybox-content')){	$.fancybox.update();	}
    });

    $(document).ready(function(){
        setTimeout(function(){
            $('.clone_box').each(function () {
                $(this).find('.add').removeClass('add').addClass('delete');
                $(this).find('.delete:last').removeClass('delete').addClass('add');
                $(this).find('.add').click();
            });
        }, 100);
    });

  /*  $(document).off('afterShow.fb');
    $(document).on('afterShow.fb', function( e, instance, slide ){
        $(e.target).find('.clone_box').each(function () {
            $(this).find('.add').removeClass('add').addClass('delete');
            $(this).find('.delete:last').removeClass('delete').addClass('add');
            $(this).find('.add').click();
        });
    })
*/


});
