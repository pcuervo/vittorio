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
            //console.log('Coordenadas: '+position.coords.latitude+', '+position.coords.longitude);
            setTimeout('setCiudad('+position.coords.latitude+','+position.coords.longitude+')', 1000);
            setTimeout('setTienda('+position.coords.latitude+','+position.coords.longitude+')', 2000);
        },
        error: function (error) {
            alert('Geolocación fallida: por favor selecciona tu ciudad y tienda mas cercana. ' + error.message);
        },
        not_supported: function () {
            alert("Tu navegador no soporta geolocación, por favor selecciona tu ciudad y tienda mas cercana");
        },
        always: function () {
            //alert("Geolocation Done!");
        }
    });
}

var setCiudad = function (latCliente, longCliente) {
    //Agregar funcionalidad para calcular la ciudad mas cercana
    //setear la ciudad
    //cargar tiendas de la ciudad
    var ciudadMasCercana = 0;
    var menorDist = 100000000000000000000000;
    var aux = 100000000000000000000000;
    $(".optciudad").each(function() {
        aux = calcularDistancia($(this).data('lat'),$(this).data('long'),latCliente, longCliente);
        if(aux < menorDist) { 
            menorDist = aux; 
            ciudadMasCercana = $(this).attr('id');
        }
    });
    $("#ciudad option").removeAttr('selected');
    $("#"+ciudadMasCercana).attr('selected', 'selected');
    $(".select-dropdown:eq(0)").val($("#"+ciudadMasCercana).html());
    
    
}

var setTienda = function (latCliente, longCliente) {
    //Agregar funcionalidad para calcular la tienda mas cercana
    //setear la tienda
    var tiendaMasCercana = 0;
    var menorDist = 100000000000000000000000;
    var aux = 100000000000000000000000;
    $(".opttienda").each(function() {
        aux = calcularDistancia($(this).data('lat'),$(this).data('long'),latCliente, longCliente);
        if(aux < menorDist) { 
            menorDist = aux; 
            tiendaMasCercana = $(this).attr('id');
        }
    });
    $("#tienda option").removeAttr('selected');
    $("#"+tiendaMasCercana).attr('selected', 'selected');
    //SHOW ONLY CITY STORES
    var claseciudad = $(".select-dropdown:eq(0)").val().replace(/ /g,'');
    $("li.opcionestienda").hide();
    $("li."+claseciudad).show();
    //END SHOW ONLY CITY STORES
    $(".select-dropdown:eq(2)").val($("#"+tiendaMasCercana).html());
    //SETEAR INFO FOOTER
    $("#nombreTienda").html($("#"+tiendaMasCercana).html());
    $("#dirTienda").html($("#"+tiendaMasCercana).data('direccion'));
    $("#telTienda").html($("#"+tiendaMasCercana).data('telefono'));
    
}

var deg2rad = function (angle) {
    // http://jsphp.co/jsphp/fn/view/deg2rad
    // + original by: Enrique Gonzalez
    // * example 1: deg2rad(45);
    // * returns 1: 0.7853981633974483
    return (angle / 180) * Math.PI;
}

function calcularDistancia(lat1,lon1,lat2,lon2) {
  var R = 6371; // Radius of the earth in km
  var dLat = deg2rad(lat2-lat1);  // deg2rad below
  var dLon = deg2rad(lon2-lon1); 
  var a = 
    Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
    Math.sin(dLon/2) * Math.sin(dLon/2)
    ; 
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
  var d = R * c; // Distance in km
  return Math.round(d, 2);
}

$(document).ready(function() {
    setTimeout('$("li.opcionestienda").hide()', 1000);
    $("#tienda").change(function() {
        $("#nombreTienda").html($("#tienda option:selected").html());
        $("#dirTienda").html($("#tienda option:selected").data('direccion'));
        $("#telTienda").html($("#tienda option:selected").data('telefono'));
       
    });
    $("#ciudad").change(function() {
        //SHOW ONLY CITY STORES
        $(".select-dropdown:eq(2)").val('Seleccione una Tienda');
        var claseciudad = $(this).val().replace(/ /g,'');
        $("li.opcionestienda").hide();
        $("#tienda option").removeAttr('selected');
        $("li."+claseciudad).show();
       //END SHOW ONLY CITY STORES
    });
    mapGeolocation();
});
 



