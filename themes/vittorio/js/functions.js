var $=jQuery.noConflict();

(function($){
    "use strict";
    $(function(){

    	$('select').material_select();
    	$('.datepicker').pickadate({
			selectMonths: true, //
			selectYears: 8 //
		});

        $('.modal-trigger').leanModal();

		$('form').parsley();

    });
})(jQuery);

if( $("#citaid").length && $("#citaid").val() != '' ) {
    console.log($("#citaid").val());
    $("#modal1").openModal();
}

if( $("#confirmada").length && $("#confirmada").val() != '' ) {
    $("#modal2").openModal();
}

$("#fecha").change(function(e) {
    console.log($(this).val());
    $.post($("#rutaAjax").val(), {action: 'validar_horarios', fecha: $(this).val() }, 
      function(data) {
        //console.log(data);
        if(data == "OK") {
            
        } 
        else {
          
        }
    })
    .always(function(data){ 
       console.log('Always -> ['+data+']');
    })
    .fail(function(xhr, status, error) {
        console.log('FAIL');
        console.log(xhr);
        console.log(status);
        console.log(error);
    });
});