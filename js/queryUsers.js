$(document).ready(function(){
    //Botón Buscar
    $('#btnBuscar').click(function(){ //Al presionar el botón Buscar
        
        $('#mensajes').html(''); //Limpia el apartado de mensajes
        //$.alert('Botón');

        //Obtiene los valores de los campos
            var dato = $("#buscar").val();
            var vidsesion = $("#idsesion").val();
            var vidrol = $("#idrol").val();
            //console.log (dato +' - '+ vidsesion +' - '+ vidrol);
        
        //Enviando los datos de consulta al servidor
        $.ajax({
            url: 'includes/consultaUsuarios.inc.php',
            type: 'POST',
            data: {buscar: dato, idsesion: vidsesion, idrol: vidrol}
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
            } else {
                $("#mensajes").collapse("hide"); //Oculta la tabla de mensajes
                $('#tablaResultados').html(res)
                $("#tablaResultados").collapse("show"); //muestra la tabla de resultados
            }

        }) //END AJAX DONE includes/queryVacancy.inc.php'
        .fail(function(){
            console.log("Fallo");
        })
        .always(function(){
            console.log("Complete");
        });
    }); 

});