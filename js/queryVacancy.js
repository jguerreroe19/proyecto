

$(document).ready(function(){

    //Botón Buscar
    $('#btnBuscar').click(function(){ //Al presionar el botón Buscar
        $('#mensajes').html(''); //Limpia el apartado de mensajes
        //Obtiene los valores de los campos
        var vtitulo = $("#title").val();
        var vdetalles = $("#details").val();
        var vmias = $("#mine").is(":checked");
        var viduser = $("#iduser").val();
        var vidrol = $("#idrol").val();
        var vidsesion  = $("#idsesion").val();
        //console.log(vtitulo + ' ' + vdetalles + ' ' + vmias + ' ' + viduser + ' ' + vidrol)

        //Enviando los datos de consulta al servidor
        $.ajax({
            url: 'includes/queryVacancy.inc.php',
            type: 'POST',
            data: {titulo: vtitulo, detalles: vdetalles, mias: vmias, idusuario: viduser, idrol: vidrol, idsesion: vidsesion}
        })
        .done(function(res){
            //console.log(res);
            if (res == 'noData'){
                $('#mensajes').html('<p> La consulta no generó datos. Revise los datos ingresados y vuelva a intentar</p>'); //Coloca la respuesta en el apartado de mensajes
                $("#mensajes").collapse("show"); //Muestra el apartado de mensajes
                $("#tablaResultados").collapse("hide"); //Oculta la tabla de resultados
            }else if (res == 'Error009'){
                $('#mensajes').html('<p> Error al consultar las vacantes</p>'); //Coloca la respuesta en el apartado de mensajes
            }else{
                $('#tablaResultados').html(res); //Coloca los valores en la tabla de resultados
                $("#tablaResultados").collapse("show"); //Muestra la tabla de resultados
                $("#mensajes").collapse("hide"); //Oculta el apartado de mensajes
            }

            //Botón Postularse
            $('.btnPostularse').click(function(e){ //Al presionar el botón Buscar
                //Evita el docble click sobre el botón
                e.preventDefault();
                e.stopImmediatePropagation();
                //Obteniendo los valores de la columna
                var currentRow =$(this).closest("tr");
                var vidVacante=currentRow.find("td:eq(0)").text();
                var vidCreadoPor=currentRow.find("td:eq(1)").text();
                //console.log('idVacante: '+vidVacante+' / '+'idCreadoPor: '+vidCreadoPor+' / '+'viduser: '+viduser);

                //Mensaje para confirmar la postulación de la vacante
                $.confirm({
                    title: 'Postular a vacante',
                    content: '¿Está seguro de postularte a la vacante?',
                    buttons: {
                        confirm: function () {
                            //$.alert('Postularse');
                            //Enviando los datos de consulta al servidor
                            $.ajax({
                                url: 'includes/applyVacancy.inc.php',
                                type: 'POST',
                                data: {idvacante: vidVacante, idCreado: vidCreadoPor, idpostulante: viduser}
                            })
                            .done(function(res){
                                $('#mensajes').html(res); //Coloca la respuesta en el apartado de mensajes
                                $("#mensajes").collapse("show"); //Muestra el apartado de mensajes
                            }) //END AJAX DONE includes/applyVacancy.inc.php'
                            .fail(function(){
                                console.log("Fallo");
                            })
                            .always(function(){
                                console.log("Complete");
                            });
                        },
                        cancel: function () {
                            //$.alert('No se realizó ningún cambio');
                            console.log('Se canceló la postulación');
                        }
                    }
                    
                });
                
            });
            
            //Botón Mostrar Datos
            $('.btnMostrarDatos').click(function(){ //Al presionar el botón Buscar
                //$.alert('Mostrar Datos');
                //Obteniendo los valores de la columna
                var currentRow =$(this).closest("tr");
                var vNombre=currentRow.find("td:eq(2)").text();
                var vTelefono=currentRow.find("td:eq(6)").text();
                var vEmail=currentRow.find("td:eq(7)").text();
                //console.log('vTelefono: '+vTelefono+' / '+'vEmail: '+vEmail+' / '+'vNombre: '+vNombre);

                //Asignando los valores a los campos
                $("#tituloPopup").text(vNombre);
                $("#telefonoPopup").val(vTelefono);
                $("#emailPopup").val(vEmail);

                //Muestra la ventana emergente
                modalDatos.show();
            });

            //Botón Editar
            $('.btnEditar').click(function(){ //Al presionar el botón Buscar
                $.alert('Editar Datos');
            });

            //Botón Eliminar
            $('.btnEliminar').click(function(){ //Al presionar el botón Buscar
                $.alert('Eliminar');
            });

            

        }) //END AJAX DONE includes/queryVacancy.inc.php'
        .fail(function(){
            console.log("Fallo");
        })
        .always(function(){
            console.log("Complete");
        });
    });

    
    //Función para mostrar los datos de contacto cuando una vacante ya fue aplicada
    $(".datos").on('click',function(){
        var currentRow =$(this).closest("tr");
        //var col1=currentRow.find("td:eq(0)").text();
        var col2=currentRow.find("td:eq(1)").text();
        //var col3=currentRow.find("td:eq(2)").text();
        //var col4=currentRow.find("td:eq(3)").text();
        //var col5=currentRow.find("td:eq(4)").text();
        var col6=currentRow.find("td:eq(5)").text();
        var col7=currentRow.find("td:eq(6)").text();
        
        //alert(col1 + "\n" + col2 + "\n" + col3 + "\n" + col4 + "\n" + col5 + "\n" + col6+ "\n" + col7);

        $("#tituloPopUp").text(function(i, origText){
        return "Vacante: " + col2; 
        });
        
        $("#datostel").text(function(i, origText){
        return "Telefono: " + col6;
        });

        $("#datosemail").text(function(i, origText){
        return "Email: " + col7;
        });
        
        $('#popup').fadeIn('slow');         
        $('.popup-overlay').fadeIn('slow');         
        $('.popup-overlay').height($(window).height());         
        return false;
    });

    $('#close').on('click', function(){         
        $('#popup').fadeOut('slow');         
        $('.popup-overlay').fadeOut('slow');         
    return false;     });
});
