$(document).ready(function(){

    $('#btnBuscar').on('click', function(){
        //Obtiene los valores de los campos
        var vusr = $("#usuario").val();
        var vidrol = $("#idrol").val();
        var vidsesion = $("#idsesion").val();
        /*var vidusr = $("#iduser").val();
        
        */
        //console.log(vusr + ' ' + vidusr + ' ' + vidsesion + ' ' + vidrol)

        //Enviando los datos de consulta al servidor
        $.ajax({
            url: 'includes/searchLockedUser.inc.php',
            type: 'POST',
            data: {usuario: vusr, idrol: vidrol, idsesion: vidsesion}
        })
        .done(function(res){
            //console.log(res);
            if (res == 'invalidRole'){
                $("#tablaResultados").collapse("hide"); //Oculta la tabla de resultados
                $('#mensajes').html('EL rol actual no tiene privilegios para realizar esta acción. Pongase en contacto con el administrador')
                $("#mensajes").collapse("show"); //muestra la tabla de mensajes
            } else if (res == 'noData'){
                $("#tablaResultados").collapse("hide"); //Oculta la tabla de resultados
                $('#mensajes').html('No se encontraron resultados con los criterios de búsqueda o no hay usuarios bloqueados actualmente.')
                $("#mensajes").collapse("show"); //muestra la tabla de mensajes

            } else {
                $("#mensajes").collapse("hide"); //Oculta la tabla de mensajes
                $('#tablaResultados').html(res)
                $("#tablaResultados").collapse("show"); //muestra la tabla de resultados
            }
            

            //Botón para eliminar el congreso
            $('.unlockUsr').on('click', function(){
                //Obtiene los valores de los campos
                var vidsesion = $("#idsesion").val();
                var vidrol = $("#idrol").val();

                var currentRow =$(this).closest("tr");
                var col1=currentRow.find("td:eq(0)").text();
                var col4=currentRow.find("td:eq(3)").text();
                
                

                $.confirm({
                    title: 'Desbloquear usuario',
                    content: '¿Desea desbloquear el usaurio '+col4+' ?',
                    buttons: {
                        confirm: function () {
                            console.log('Procede');   
                            //Enviando los datos de consulta al servidor
                            $.ajax({
                                url: 'includes/unlockUser.inc.php',
                                type: 'POST',
                                data: {idsesion: vidsesion, idrol: vidrol, usr2Unlock: col1}
                            })
                            .done(function(res){
                                console.log(res);
                                $.alert(res);
                            })
                            .fail(function(){
                                console.log("Fallo unlockUser");
                            });
                        },
                        cancel: function () {
                            //$.alert('No se realizó ningún cambio');
                            console.log('Se canceló el unlock user');
                        }
                    }
                    
                });





            });//END AJAX DONE includes/unlockUser.inc.php'
            

        }) //END AJAX DONE includes/searchLockedUser.inc.php'
        .fail(function(){
            console.log("Fallo unlockUser");
        })
        .always(function(){
            console.log("Complete unlockUser");
        });
    });
});