$ = jQuery.noConflict();
var mapGeolocation = function () {
    var map = new GMaps({
        div: '#gmap_geo',
        lat: -12.043333,
        lng: -77.028333
    });

    GMaps.geolocate({
        success: function (position) {
            map.setCenter(position.coords.latitude, position.coords.longitude);
            console.log('Coordenadas: '+position.coords.latitude+', '+position.coords.longitude);
            setTimeout('setCiudad()', 1000);
            setTimeout('setTienda()', 2000);
        },
        error: function (error) {
            alert('Geolocation failed: ' + error.message);
        },
        not_supported: function () {
            alert("Your browser does not support geolocation");
        },
        always: function () {
            //alert("Geolocation Done!");
        }
    });
}

var setCiudad = function () {
    //Agregar funcionalidad para calcular la ciudad mas cercana
    //setear la ciudad
    //cargar tiendas de la ciudad
    $(".optCiudad").removeAttr('selected', false);
    $(".optCiudad").first().attr('selected', true);
    $(".select-dropdown:eq(0)").val($(".optCiudad:eq(1)").html());
    console.log($(".optCiudad ").first().html());
}

var setTienda = function () {
    //Agregar funcionalidad para calcular la tienda mas cercana
    //setear la tienda
    $(".optTienda").removeAttr('selected', false);
    $(".optTienda").first().attr('selected', true);
    $(".select-dropdown:eq(2)").val($(".optTienda:eq(1)").html());
    console.log($(".optTienda ").first().html());
    
}

$(document).ready(function() {

    mapGeolocation();
});



