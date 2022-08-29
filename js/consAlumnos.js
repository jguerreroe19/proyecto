$(document).ready(function(){
    //Botón Buscar
    $('#btnBuscar').click(function(){ //Al presionar el botón Buscar
        
        $('#mensajes').html(''); //Limpia el apartado de mensajes
        //$.alert('Botón');

        //Obtiene los valores de los campos
            var vnombre = $("#nombre").val();
            var vapellidos = $("#apellidos").val();
            var vemail = $("#email").val();
            var vtelefono = $("#telefono").val();
            var vhabilidad = $("#habilidad").val();
            var vnivel = $("#nivel").val();
            var vidsesion = $("#idsesion").val();
            var vidrol = $("#idrol").val();
            //console.log (vnombre +' - '+ vapellidos +' - '+ vemail +' - '+ vtelefono +' - '+ vhabilidad +' - '+ vnivel +' - '+ vidsesion +' - '+ vidrol);
        
        //Enviando los datos de consulta al servidor
        $.ajax({
            url: 'includes/consAlumnos.inc.php',
            type: 'POST',
            data: {nombre: vnombre, apellidos: vapellidos, email: vemail, telefono: vtelefono, habilidad: vhabilidad, nivel: vnivel, idsesion: vidsesion, idrol: vidrol}
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

    //Botón para limpiar campos
    $('.limpiaCampos').click(function(){ 
        //resetform(); //Reset Form
        $("form select").each(function() { this.selectedIndex = 0 });
        $("form input[type=text] , form textarea").each(function() { this.value = '' });
    });
    
});