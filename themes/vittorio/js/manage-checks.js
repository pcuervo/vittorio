var $=jQuery.noConflict();

$("#ayudachecks").change(function(e) {
    
    if($(this).is(':checked')) {
        $('.check_horario').prop('checked', true);
    }
    else {
        $('.check_horario').prop('checked', false);
    }
});