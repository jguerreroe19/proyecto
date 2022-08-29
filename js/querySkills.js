$(document).ready(function(){
    $('#btnBuscar').click(function(){ //Al presionar el botón Buscar
        //Obteniendo el valor de los campos
        var op1 = $("#Tipo").val();
        var op2 = $("#Tipo2").val();
        var op2a = $("#Tipo2a").val();
        var op3 = $("#Tipo3").val();
        var idU = $("#iduser").val();
        //console.log ('op1: '+op1+' '+'op2: '+op2+' '+'op2a: '+op2a+' '+'op3: '+op3+' '+'idU: '+idU)
        $.ajax({
                    url: 'includes/querySkills.inc.php',
                    type: 'POST',
                    data: {tipo: op1, idioma: op2 , skill: op2a , nivel: op3, idusr: idU},
                })
        .done(function(res){
            //console.log(res);
            if (res == 'noResults'){
                $("#tablaResultados").collapse("hide"); //hide la tabla de resultados
                $('#mensajes').html('<p> La consulta no generó resultados. Revise los datos ingresados y vuelva a intentarlo</p>');
                $("#mensajes").collapse("show"); //Muestra la tabla de mensajes
                
            }else{
                $("#mensajes").collapse("hide"); //Oculta la tabla de mensajes
                $('#tablaResultados').html(res);
                $("#tablaResultados").collapse("show"); //Muestra la tabla de resultados
            }

            /************************************************** Botón para editar el skill ****************************************************/
            $('.editarSkills').on('click',function(){
                $('#confirmaPopUp').html('')
                var currentRow =$(this).closest("tr");
                var tipo=currentRow.find("td:eq(0)").text();
                var idioma=currentRow.find("td:eq(1)").text();
                var tech=currentRow.find("td:eq(2)").text();
                var nvl=currentRow.find("td:eq(3)").text();
                //console.log('tipo: '+tipo+'  '+'nivel: '+nvl)
                //alert('Edita Campos'+col1);
                //Llenando los valores de la ventana emergente
                $("#tipoPopup").val(tipo)
                if (tipo == 'Idioma'){
                    $("#idLabelSkill").text('Idioma:'); //Cambia el valor de la etiqueta
                    $("#habilidadPopup").val(idioma)
                }else{
                    $("#idLabelSkill").text('Habilidad:'); //Cambia el valor de la etiqueta
                    $("#habilidadPopup").val(tech)
                }
                $.ajax({
                    url: 'includes/editSkillsCombo.inc.php',
                    type: 'POST',
                    data: {phptipo: tipo, phpnivel: nvl},
                })
                .done(function(res){
                    //console.log(res);
                    $('#nivelPopup').html(res); //Coloca los valores del combobox
                }) //END AJAX DONE includes/editSkillsCombo.inc.php'
                .fail(function(){
                    console.log("Fallo");
                })
                .always(function(){
                    console.log("Complete");
                });
                //Muestra la ventana emergente
                popupHabilidadesDelete.hide();
                popupHabilidadesUpdate.show();

                $("#btnGuardarPopup").click(function(e) {
                    //Evita el docble click sobre el botón
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    //Formando el díalogo de confirmación
                    $.confirm({
                        title: 'Editar Habilidades',
                        content: '¿Está seguro de aplicar el cambio?',
                        buttons: {
                            confirm: function () {
                                //Obteniendo los valores del formulario
                                var tipoP=$("#tipoPopup").val();
                                var skillP=$("#habilidadPopup").val();
                                var nvlP=$("#nivelPopup").val();
                                var usrP=$("#idusuarioPopup").val();
                                var idP=$("#idSessionPopup").val();
                                //console.log(tipoP+skillP+nvlP+usrP+idP)
                                $.ajax({
                                    url: 'includes/editSkills.inc.php',
                                    type: 'POST',
                                    data: {tipo: tipoP, skill: skillP , nivel: nvlP, idusuario: usrP, idsesion: idP},
                                })
                                .done(function(resConfirm){
                                    console.log(resConfirm);
                                    if (resConfirm == 'Actualizado'){
                                        $('#confirmaPopUp').html('La habilidad se actualizó con éxito'); //Coloca los valores del combobox
                                    } else if (resConfirm == 'Error'){
                                        $('#confirmaPopUp').html('Error al actualizar el registro. Intentelo nuevamente.'); //Coloca los valores del combobox
                                    } else if (resConfirm == 'noCambios'){
                                        $('#confirmaPopUp').html('No se detectaron cambios.'); //Coloca los valores del combobox
                                    }
                                }) //END AJAX DONE includes/editSkills.inc.php'
                                .fail(function(){
                                    console.log("Fallo");
                                })
                                .always(function(){
                                    console.log("Complete");
                                });
                            },
                            cancel: function () {
                                //$.alert('No se realizó ningún cambio');
                                console.log('Se canceló la eliminación');
                            }
                        }
                        
                    });
                });
            });

            /************************************************** Botón para eliminar el skill ****************************************************/
            $('.eliminarSkills').on('click',function(){
                $('#confirmaPopUpDelete').html('')
                var currentRow =$(this).closest("tr");
                var tipo=currentRow.find("td:eq(0)").text();
                var idioma=currentRow.find("td:eq(1)").text();
                var tech=currentRow.find("td:eq(2)").text();
                var nvl=currentRow.find("td:eq(3)").text();
                //console.log('tipo: '+tipo+'  '+'nivel: '+nvl)
                //alert('Edita Campos'+col1);
                //Llenando los valores de la ventana emergente
                $("#tipoPopupDelete").val(tipo)
                if (tipo == 'Idioma'){
                    $("#idLabelSkillDelete").text('Idioma:'); //Cambia el valor de la etiqueta
                    $("#habilidadPopupDelete").val(idioma)
                }else{
                    $("#idLabelSkillDelete").text('Habilidad:'); //Cambia el valor de la etiqueta
                    $("#habilidadPopupDelete").val(tech)
                }
                $.ajax({
                    url: 'includes/editSkillsCombo.inc.php',
                    type: 'POST',
                    data: {phptipo: tipo, phpnivel: nvl},
                })
                .done(function(res){
                    //console.log(res);
                    $('#nivelPopupDelete').html(res); //Coloca los valores del combobox
                }) //END AJAX DONE includes/editSkillsCombo.inc.php'
                .fail(function(){
                    console.log("Fallo");
                })
                .always(function(){
                    console.log("Complete");
                });
                //Muestra la ventana emergente
                popupHabilidadesUpdate.hide();
                popupHabilidadesDelete.show();

                $("#btnGuardarPopupDelete").click(function(e) {
                    //Evita el docble click sobre el botón
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    //Formando el díalogo de confirmación
                    $.confirm({
                        title: 'Eliminar Habilidades',
                        content: '¿Está seguro de eliminar la habilidad?',
                        buttons: {
                            confirm: function () {
                                //Obteniendo los valores del formulario
                                var tipoP=$("#tipoPopupDelete").val();
                                var skillP=$("#habilidadPopupDelete").val();
                                var usrP=$("#idusuarioPopupDelete").val();
                                var idP=$("#idSessionPopupDelete").val();
                                //console.log(tipoP+skillP+usrP+idP)
                                $.ajax({
                                    url: 'includes/deleteSkills.inc.php',
                                    type: 'POST',
                                    data: {tipo: tipoP, skill: skillP , idusuario: usrP, idsesion: idP},
                                })
                                .done(function(resConfirm){
                                    console.log(resConfirm);
                                    if (resConfirm == 'Eliminado'){
                                        $('#confirmaPopUpDelete').html('La habilidad se eliminó con éxito'); //Mensaje de éxito
                                    } else if (resConfirm == 'Error'){
                                        $('#confirmaPopUpDelete').html('Error al eliminar el registro. Intentelo nuevamente.'); //Mensaje de error
                                    }
                                }) //END AJAX DONE includes/editSkills.inc.php'
                                .fail(function(){
                                    console.log("Fallo");
                                })
                                .always(function(){
                                    console.log("Complete");
                                });
                            },
                            cancel: function () {
                                //$.alert('No se realizó ningún cambio');
                                console.log('Se canceló la eliminación');
                            }
                        }
                        
                    });
                });
            });
            
        }) //END AJAX DONE includes/querySkills.inc.php'
        .fail(function(){
                    console.log("Fallo");
        })
        .always(function(){
                    console.log("Complete");
        });
    });
});