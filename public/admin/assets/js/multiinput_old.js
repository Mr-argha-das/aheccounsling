$(document).ready(function (e) {

    $(document).off('click keyup', '.clone_box .add')
    $('.clone_box .clone_row').addClass('clone_line').hide();

    $('.clone_line').each(function () {
        $(this).find('.cloneinput_datepicker').removeClass('hasDatepicker').removeAttr('id').datepicker();
    })

    $(document).on('click keyup', '.clone_box .add', function (event) {
        $(this).off('click');


        var data = $(this).closest('.clone_box').find('.clone_row').clone(true, true).removeClass('clone_row').show();


        $(this).closest('.clone_line').after(data);

        if ($(this).closest('.clone_box').find('.add').length > 2) {
            //$(this).switchClass('add','delete',10);
        };

        $(this).closest('.clone_box').find('.add').removeClass('add').addClass('delete');
        $(this).closest('.clone_box').find('.delete:last').removeClass('delete').addClass('add');



        //e.preventDefault();
        $(this).closest('.clone_line').next('.clone_line').find('input[type=text],textarea,select').filter(':first').focus();
        return false;
    })

    $(document).on('click', '.clone_box .delete', function (event) {
        $(this).closest('.clone_line').remove();

        // if($(this).closest('#fancybox-content')){ $.fancybox.update();  }
    });

    $('.clone_box').each(function () {
        $(this).find('.add').removeClass('add').addClass('delete');
        $(this).find('.delete:last').removeClass('delete').addClass('add');
        $(this).find('.add').click();
    });



});
