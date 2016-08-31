var $=jQuery.noConflict();

(function($){
    "use strict";
    $(function(){

    	$('select').material_select();
    	$('.datepicker').pickadate({
			selectMonths: true, // Creates a dropdown to control month
			selectYears: 2 // Creates a dropdown of 15 years to control year
		});

        $('.modal-trigger').leanModal();

		$('form').parsley();



    });
})(jQuery);


