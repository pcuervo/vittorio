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
            setCiudad();
            setTienda();
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
    console.log($(".optCiudad ").first().html());
}

var setTienda = function () {
    //Agregar funcionalidad para calcular la tienda mas cercana
    //setear la tienda
    $(".optTienda").removeAttr('selected', false);
    $(".optTienda").first().attr('selected', true);
    console.log($(".optTienda ").first().html());
}

$(document).ready(function() {

    mapGeolocation();
});



