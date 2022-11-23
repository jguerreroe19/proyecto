$(document).ready(function(){
    
    //Cambiando el valor del encabezado
    $.fn.changeHeaderTitle('Asignar roles');
    
    $('#btnBuscar').click(function(){ //Al presionar el botón Buscar
        
        //Obtiene los valores de los campos
        var dato = $("#addRoleBuscar").val();
        var vidsesion = $("#idsesion").val();
        var vidrol = $("#idrol").val();

        console.log (dato +' - '+ vidsesion +' - '+vidrol );

        //Enviando los datos al servidor
        $.ajax({
            url: 'includes/queryAddRoles.inc.php',
            type: 'POST',
            data: {buscar: dato, idsesion: vidsesion, idrol: vidrol}
        })
        .done(function(res){
            //console.log(res);
            if (res == 'invalidRole'){
                $("#tablaResultados").collapse("hide"); //Oculta la tabla de resultados
                $.confirm({
                    title: '<i class="bi bi-exclamation-triangle" style= "color: orange;"></i> Advertencia',
                    content: 'EL rol actual no permite realizar esta acción',
                    type: 'orange',
                    typeAnimated: true,
                    buttons: {
                            Aceptar: function () {
                            }
                    }
                });
            } else if (res == 'noData'){
                $("#tablaResultados").collapse("hide"); //Oculta la tabla de resultados
                $.confirm({
                    title: '<i class="bi bi-exclamation-triangle" style= "color: orange;"></i> Advertencia',
                    content: 'No se encontraron resultados con los criterios de búsqueda',
                    type: 'orange',
                    typeAnimated: true,
                    buttons: {
                            Aceptar: function () {
                            }
                    }
                });
            } else {
                $('#tablaResultados').html(res)
                $("#tablaResultados").collapse("show"); //muestra la tabla de resultados

                $('#logTable').DataTable( {
                    scrollCollapse: true,
                    responsive: true
                });

                $('.guardaraddRoleBtn').click(function(){ //Al presionar el botón Guardar

                    var currentRow =$(this).closest("tr");
                    //var vnombre=currentRow.find("td:eq(0)").text();
                    var vidusuario=currentRow.find("td:eq(5)").text();
                    var vidnewrol=currentRow.find("td:eq(4)").find('option:selected').val();
                    var vidsesion = $("#idsesion").val();
                    var vidrol = $("#idrol").val();
                    console.log(vidusuario + ' | ' + vidrol + ' | ' + vidnewrol);
                    
                    //Validando que el rol seleccionado sea distinto a Registrado
                    if (vidnewrol == 4){
                        $.confirm({
                            title: '<i class="bi bi-exclamation-triangle" style= "color: orange;"></i> Advertencia',
                            content: 'Seleccione un rol distinto a "Registrado"',
                            type: 'orange',
                            typeAnimated: true,
                            buttons: {
                                    Aceptar: function () {
                                    }
                            }
                        });
                        //$.alert('Seleccione un rol distinto a "Registrado"');
                    }else {
                        //Enviando la solicitud de confirmación
                        $.confirm({
                            title: '<i class="bi bi-question-circle" style= "color: #666666;"></i> Confirmación',
                            content: '¿Desea actualizar el rol?',
                            type: 'dark',
                            typeAnimated: true,
                            buttons: {
                                confirm: function () {
                                    //Enviando los datos al servidor
                                    $.ajax({
                                        url: 'includes/addRole.inc.php',
                                        type: 'POST',
                                        data: {idusuario: vidusuario, newrol: vidnewrol, idsesion: vidsesion, idrol: vidrol}
                                    })
                                    .done(function(res){
                                        console.log(res);
                                        if (res == 'invalidRole'){
                                            $.confirm({
                                                title: '<i class="bi bi-exclamation-triangle" style= "color: orange;"></i> Advertencia',
                                                content: 'EL rol actual no tiene privilegios para realizar esta acción. Pongase en contacto con el administrador',
                                                type: 'orange',
                                                typeAnimated: true,
                                                buttons: {
                                                        Aceptar: function () {
                                                        }
                                                }
                                            });
                                        }else if (res == 'Error'){
                                            $.confirm({
                                                title: '<i class="bi bi-x-circle" style= "color: red;"></i>Error',
                                                content: 'Error al tratar de asignar el rol. Intentelo nuevamente o póngase en contacto con el administrador',
                                                type: 'red',
                                                typeAnimated: true,
                                                buttons: {
                                                        Aceptar: function () {
                                                        }
                                                }
                                            });
                                        } else {
                                            $.confirm({
                                                title: '<i class="bi bi-check-circle" style= "color: green;"></i> Correcto',
                                                content: 'Se asignó el rol!',
                                                type: 'green',
                                                typeAnimated: true,
                                                buttons: {
                                                        Aceptar: function () {
                                                        }
                                                }
                                            });
                                            $.fn.actualizaBusqueda();
                                        }
                                    }) //END AJAX DONE includes/consultaUsuarios.inc.php'
                                    .fail(function(){
                                        console.log("Fallo");
                                    })
                                    .always(function(){
                                        console.log("Complete");
                                        //Actualiza la página
                                        //$("#Tabla").load(location.href + " #Tabla");
                                        //location.reload();
                                    });
                                },
                                cancel: function () {
                                    console.log('Se canceló la actualizacíón de rol');
                                }
                            }
                        });
                    }
                });  
            }
            
        }) //END AJAX DONE includes/consultaUsuarios.inc.php'
        .fail(function(){
            console.log("Fallo");
        })
        .always(function(){
            console.log("Complete");
        });

    });

    //Función para actualizar los datos de la búsqueda
	$.fn.actualizaBusqueda = function(){ 
		$('#btnBuscar').click(); //Actualizando la pantalla de búsqueda
    }
  
   
});