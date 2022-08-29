function alertas(mensaje){
    //alert(mensaje);
    $("#contenido").toggle();
}
//Función para mostrar los datos de contacto cuando una vacante ya fue aplicada
$(document).ready(function(){

    //Botón Buscar
    $('#btnBuscar').click(function(){  
        var vcname = $('#cname').val();
        var vdetails = $('#details').val();
        let checkMine = $('#mine').is(':checked'); //Valida el estado del checkbox
        var vmine = checkMine;
        let checkAct = $('#activo').is(':checked'); //Valida el estado del checkbox
        var vactivo = checkAct;
        var viduser = $('#iduser').val();
        var vidrol = $('#idrol').val();
        var vidsesion = $('#idsesion').val();
        
        $.ajax({
            url: 'includes/queryCongress.inc.php',
            type: 'POST',
            //data: ruta,
            data: {cname: vcname, details: vdetails, mine: vmine, activo: vactivo, iduser: viduser, idrol: vidrol, idsesion: vidsesion},
        })
        .done(function(res){
            $('#respuesta').html(res)

            //Botón para ver los detalles del proyecto
            $('.datos').on('click',function(){
                var currentRow =$(this).closest("tr");
                var col1=currentRow.find("td:eq(0)").text();
                /*
                var col2=currentRow.find("td:eq(1)").text();
                var col3=currentRow.find("td:eq(2)").text();
                var col4=currentRow.find("td:eq(3)").text();
                var col5=currentRow.find("td:eq(4)").text();
                var col6=currentRow.find("td:eq(5)").text();
                var col7=currentRow.find("td:eq(6)").text();
                */
                var col8=currentRow.find("td:eq(7)").text();
                //var col9=currentRow.find("td:eq(8)").text();
                var col10=currentRow.find("td:eq(9)").text();
                var col11=currentRow.find("td:eq(10)").text();
                var col12=currentRow.find("td:eq(11)").text();
                
                //alert(col1 + "\n" + col2 + "\n" + col3 + "\n" + col4 + "\n" + col5 + "\n" + col6+ "\n" + col7+ "\n" + col8+ "\n" + col9+ "\n" + col10+ "\n" + col11);

                //window.location="#divOne";

                $("#datosPopUp0").text(function(i, origText){
                return col8; //Nombre del proyecto
                });
                
                $("#descProy0").text(function(i, origText){
                return col10; //Descripción del proyecto
                });

                $("#tipoProy0").text(function(i, origText){
                return col11 + col12; //Tipo del proyecto
                });

                //Muestra la ventana emergente
                modalDetalles.show();
            });


            //Botón para ver los detalles de la asignación al congreso
            $('.asignaBtn').on('click', function(){
                $.alert('Muestra detalles de la asignación');
            });
            

            //Botón para editar los datos del congreso
            $('.editar').on('click', function(){
                var currentRow =$(this).closest("tr");
                var col1=currentRow.find("td:eq(0)").text();
                $.alert('Edita Campos'+col1);
            });

            //Botón para eliminar el congreso
            $('.eliminar').on('click', function(){
                $.alert('Elimina Campos');
            });
            
            //Botón para asociar el congreso con un alumno
            $('.asociar').on('click', function(){
                
                //Limpia el mensaje anterior
                $('#confirma').html('');
                
                //Obteniendo el valor del ID del congreso
                var currentRow =$(this).closest("tr");
                var col1=currentRow.find("td:eq(0)").text();
                //Asignando el valor al campo oculto
                $("#idcongreso").val(col1);
                console.log('Boton'+col1);

                //Muestra la ventana emergente
                modalAsocia.show();
            });

            //Botón enviar el formulario de asignación de alumno a congreso
            $("#enviar").click(function() {
                //Obtiene los valores del formulario de asocuación
                var valumnos = $('#alumnos').val();
                var vcomentario = $('#comentario').val();
                var vidcongreso = $('#idcongreso').val();

                $.ajax({
                    url: 'includes/addPonente.inc.php',
                    type: 'POST',
                    data: {alumnos: valumnos, comentario: vcomentario, idcongreso: vidcongreso},
                })
                .done(function(res){
                    $('#confirma').html(res)
                    //Limpia los campos de la ventana Popup
                    $('#formTest').each(function(){
                        this.reset();
                    });
                }) //END AJAX DONE includes/addPonente.inc.php'
                .fail(function(){
                    console.log("Fallo");
                })
                
                .always(function(){
                    console.log("Complete");
                });
            });

        }) //END AJAX DONE includes/queryCongress.inc.php'
        .fail(function(){
            console.log("Fallo");
        })
        
        .always(function(){
            console.log("Complete");
        });
        
    });
});