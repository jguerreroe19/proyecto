$(document).ready(function(){
    //Botón Buscar
    $('#btnBuscar').click(function(){ //Al presionar el botón Buscar
        
        $('#mensajes').html(''); //Limpia el apartado de mensajes
        //$.alert('Botón');

        //Obtiene los valores de los campos
            var dato = $("#buscar").val();
            let checkMine = $('#cfechas').is(':checked'); //Valida el estado del checkbox
            var vmine = checkMine;
            var vidsesion = $("#idsesion").val();
            var vidrol = $("#idrol").val();
            var fini = $("#fechaini").val();
            var ffin = $("#fechafin").val();
            
            console.log (dato +' - '+ checkMine +' - '+ fini+' - '+ ffin+' - '+vidsesion +' - '+vidrol );

            if (checkMine){
                var vcheck = 'true';
            }else{
                var vcheck = 'false';
            }

            //Enviando los datos al servidor
            $.ajax({
                url: 'includes/queryLog.inc.php',
                type: 'POST',
                data: {buscar: dato, check: vcheck, idsesion: vidsesion, idrol: vidrol, fechaInicio: fini, fechaFin: ffin}
            })
            .done(function(res){
                //console.log(res);
                if (res == 'invalidRole'){
                    $("#tablaResultados").collapse("hide"); //Oculta la tabla de resultados
                    $('#mensajes').html('EL rol actual no tiene privilegios para realizar esta acción. Pongase en contacto con el administrador')
                    $("#mensajes").collapse("show"); //muestra la tabla de mensajes
                } else if (res == 'noData'){
                    $("#tablaResultados").collapse("hide"); //Oculta la tabla de resultados
                    $('#mensajes').html('No se encontraron resultados con los criterios de búsqueda.')
                    $("#mensajes").collapse("show"); //muestra la tabla de mensajes
                } else if (res == 'wrongDateRange'){
                    $("#tablaResultados").collapse("hide"); //Oculta la tabla de resultados
                    $('#mensajes').html('La fecha fin debe ser mayor que la fecha inicio.')
                    $("#mensajes").collapse("show"); //muestra la tabla de mensajes
                } else {
                    $("#mensajes").collapse("hide"); //Oculta la tabla de mensajes
                    $('#tablaResultados').html(res)
                    $("#tablaResultados").collapse("show"); //muestra la tabla de resultados
                }
                
            }) //END AJAX DONE includes/consultaUsuarios.inc.php'
            .fail(function(){
                console.log("Fallo");
            })
            .always(function(){
                console.log("Complete");
            });
    }); 
});