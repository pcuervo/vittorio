var $=jQuery.noConflict();

(function($){
    "use strict";
    $(function(){

        $('.modal-trigger').leanModal();

		$('form').parsley();

    });
})(jQuery);


