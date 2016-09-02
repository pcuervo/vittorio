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