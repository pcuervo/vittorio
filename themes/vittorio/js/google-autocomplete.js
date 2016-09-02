(function($){

	"use strict";
	$("#_ubicacion_meta").keypress(function(e) {
		if(e.which == 13) {
	        e.preventDefault();
	    }
	});
	
	$(function(){
		if (document.getElementById("_ubicacion_meta")) {
			var autocomplete = new google.maps.places.Autocomplete($("#_ubicacion_meta")[0], {});

	        google.maps.event.addListener(autocomplete, 'place_changed', function() {
	       	 	var place = autocomplete.getPlace();

	       	 	$('#_latitud_meta').val( place.geometry.location.lat() );
	       	 	$('#_longitud_meta').val( place.geometry.location.lng() );

	       	 	var iframe = '<iframe width="100%" height="170" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q='+place.geometry.location.lat()+','+place.geometry.location.lng()+'&hl=es;z=14&amp;output=embed"></iframe>';
	       	 	$('.iframe-cont').empty().append(iframe);

	        });

		};

	});

})(jQuery);