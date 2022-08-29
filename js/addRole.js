$(document).ready(function(){
    
    $("#addRoleFilter").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#roleTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $('.guardaraddRoleBtn').click(function(){ //Al presionar el botón Guardar
        
        var currentRow =$(this).closest("tr");
        //var vnombre=currentRow.find("td:eq(0)").text();
        var vidusuario=currentRow.find("td:eq(5)").text();
        var vidnewrol=currentRow.find("td:eq(4)").find('option:selected').val();
        var vidsesion = $("#idsesion").val();
        var vidrol = $("#idrol").val();
        //console.log(vnombre);
        
        //Validando que el rol seleccionado sea distinto a Registrado
        if (vidnewrol == 4){
            $.alert('Seleccione un rol distinto a "Registrado"');
        }else {
            //Enviando los datos al servidor
            $.ajax({
                url: 'includes/addRole.inc.php',
                type: 'POST',
                data: {idusuario: vidusuario, newrol: vidnewrol, idsesion: vidsesion, idrol: vidrol}
            })
            .done(function(res){
                //console.log(res);
                if (res == 'invalidRole'){
                    $.alert('EL rol actual no tiene privilegios para realizar esta acción. Pongase en contacto con el administrador');
                } else if (res == 'Error'){
                    $.alert('Error al tratar de asignar el rol. Intentelo nuevamente');
                } else {
                    $.alert('Rol asignado correctamente');
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
        }
    });  
});