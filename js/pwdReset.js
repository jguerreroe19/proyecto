$(document).ready(function(){

    $('#btnBuscar').on('click', function(){
        //Obtiene los valores de los campos
        var vusr = $("#usuario").val();
        var vidrol = $("#idrol").val();
        var vidsesion = $("#idsesion").val();
        /*var vidusr = $("#iduser").val();
        
        */
        
        //console.log(vusr + ' ' + vidusr + ' ' + vidsesion + ' ' + vidrol)
        //console.log(vusr+' - '+vidrol);

        //Enviando los datos de consulta al servidor
        $.ajax({
            url: 'includes/queryUsers.inc.php',
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
            $('.pwdResetBtn').on('click', function(){
                //Obtiene los valores de los campos
                var vidsesion = $("#idsesion").val();
                var vidrol = $("#idrol").val();

                var currentRow =$(this).closest("tr");
                var col1=currentRow.find("td:eq(0)").text();
                $("#idusr").val(col1);
                

                //Limpia los campos de la ventana emergente
                $("#pwdPopup").val('');
                $("#pwdconfirmPopup").val('');

                //$.alert(col1);
                
                //Muestra la ventana emergente
                modalDatos.show();
            });

            $('#guardarPopupbtn').on('click', function(e){
                //Evita el doble click sobre el botón
                e.preventDefault();
                e.stopImmediatePropagation();

                //Obteniendo los valores de los campos
                var vidsesion = $("#idsesion").val();
                var vPwd = $("#pwdPopup").val();
                var vPwdConf = $("#pwdconfirmPopup").val();
                var vUsr2Reset = $("#idusr").val();

                console.log(vPwd+' - '+vPwdConf+' - '+vUsr2Reset); 

                //Validando los campos
                var vValidaPwd = $.fn.validaPwd(vPwd);
                var vValidaPwdRpt = $.fn.validaPwdRpt(vPwdConf);

                console.log(vValidaPwd+' - '+vValidaPwdRpt);

                var vtotal = vValidaPwd + vValidaPwdRpt;
                
                console.log(vtotal);

                if (vtotal == 2){
                    //Enviando los datos de consulta al servidor
                    $.ajax({
                        url: 'includes/resetPassword.inc.php',
                        type: 'POST',
                        data: {idsesion: vidsesion, pwd: vPwd, usrid: vUsr2Reset}
                    })
                    .done(function(res){
                        console.log(res);
                        if (res='OK'){
                            $.alert('Contraseña restablecida con éxito');
                            modalDatos.hide();
                        }else{
                            $.alert('Error al restablecer la contraseña. Intentelo nuevamente.');
                        }
                        
                    })//END AJAX DONE includes/resetPassword.inc.php'
                    .fail(function(){
                        console.log("Fallo resetPassword");
                    })
                    .always(function(){
                        console.log("Complete resetPassword");
                    });
                }                            
                            /*

                            
                            */
                            /*
                                        $.confirm({
                                            title: 'Restablecer contraseña',
                                            content: '¿Está seguro?',
                                            buttons: {
                                                confirm: function () {
                                                    console.log('Procede');   
                                    },
                                    cancel: function () {
                                        //$.alert('No se realizó ningún cambio');
                                        console.log('Se canceló el reset password');
                                    }
                                }
                                
                            });*/
            });

            //Valida la estructura de la contraseña desde el campo
            $('#pwdPopup').blur(function() {
                var resultado = $.fn.validaPwd(this.value);
                console.log(resultado);
            });




             

        }) //END AJAX DONE includes/queryUsers.inc.php'
        .fail(function(){
            console.log("Fallo unlockUser");
        })
        .always(function(){
            console.log("Complete unlockUser");
        });
    });
});