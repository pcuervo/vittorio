var $=jQuery.noConflict();

(function($){
    "use strict";
    $(function(){

        var hoy = new Date();

    	$('select').material_select();
        $('.modal-trigger').leanModal();
        $('form').parsley();

    	var picker = $('.datepicker').pickadate({
			selectMonths: true, //
			selectYears: 8, //
            closeOnSelect: true,
            min: new Date(hoy.getFullYear(),hoy.getMonth(),hoy.getDate()),
            onSet: function(context) {
                if(context.select) {
                    this.close();
                }
            }

		});

    });
})(jQuery);

if( $("#citaid").length && $("#citaid").val() != '' ) {
    //console.log($("#citaid").val());
    $("#modal1").openModal();
}

if( $("#confirmada").length && $("#confirmada").val() != '' ) {
    $("#modal2").openModal();
}
$(document).ready(function() {
    $(".opcioneshorario").hide();
});

$("#fecha").change(function(e) {
    //picker.close(true);
    //console.log($(this).val());
    var diasSemana = ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'];
    var fec = new Date($(this).val());
    var diaS = diasSemana[fec.getDay()];
    var fechaFormateada = ('0' + fec.getDate()).slice(-2) + '/'+ ('0' + (fec.getMonth()+1)).slice(-2) + '/'+fec.getFullYear();
    $(".opcioneshorario").hide();
    //console.log(fec);
    //console.log(fec.getDay());
    //console.log(diaS);
    //console.log(fechaFormateada);
    //console.log('TIENDAID:'+$("#tienda").val());
    $(".opcioneshorario").addClass('ocupado');
    $.post($("#rutaAjax").val(), {action: 'validar_horarios', fecha: $(this).val(), dia: diaS, tiendaid: $("#tienda").val() },
      function(data) {
        //console.log("AQUI:"+data);
        if(data != "") {
            $(".select-dropdown:eq(4)").val('Horario');
            //$(".opcioneshorario").show();
            var res = data.split('*****');
            //console.log(res);
            var hs = res[0].split('-');
            var ocus = res[1].split('-');
            //console.log(hs.length);
            //console.log(hs);
            if(hs.length>1) {
                for (var i = 0; i < hs.length-1; i++) {
                    //console.log(i+'->'+hs[i]);
                    $("."+hs[i]).removeClass('ocupado');
                    $("."+hs[i]).show();
                }
                if(ocus.length>1) {
                    for (var i = 0; i < ocus.length-1; i++) {
                        //console.log(i+'->'+ocus[i]);
                        $("."+ocus[i]).addClass('ocupado');
                        //$("."+ocus[i]).hide();
                    }
                }
            }
            else {
                $(".select-dropdown:eq(4)").val('No hay horarios disponibles');
                $(".opcioneshorario").hide();
            }
        }

    })
    .always(function(data){
       //console.log('Always -> ['+data+']');
    })
    .fail(function(xhr, status, error) {
        console.log('FAIL');
        console.log(xhr);
        console.log(status);
        console.log(error);
    });
});