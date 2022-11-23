$(document).ready(function(){

    //Cambiando el valor del encabezado
    $.fn.changeHeaderTitle('Registro de habilidades y conocimientos');
		
    $( "#Tipo" ).change(function() { //Cuando cambia el primer comboBox
			
			
        $("#cbConocimiento").empty(); //Vaciando el listado del combo 2
        $("#cbnivel").empty(); //Limpiando el contenido del combo 3
        
        $('#btnGuardar').attr('disabled',true); //Desactiva el botón guardar
        
        //Desactivando los combos 2 y 3
        $('#cbConocimiento').attr('disabled',true); //Activa el segundo combo
        $('#cbnivel').attr('disabled',true); //Activa el segundo combo
        
        //Agrega la opción por default
        $('#cbConocimiento').append($("<option></option>")
                        .attr('value', "")
                        .attr('disabled', true)
                        .attr('selected', true)
                        .text("Seleccione una opción ..."));
        
        $('#cbnivel').append($("<option></option>")
                        .attr('value', "")
                        .attr('disabled', true)
                        .attr('selected', true)
                        .text("Seleccione una opción ..."));
        
        
        
        var op1 = this.value;
        var idU = $("#iduser").val();
        console.log( op1 + ' / ' + idU);
        var valida = 1;
        
        //Llenando el combo box 2
        $.ajax({ 
            type: 'POST', 
            url: 'includes/skillsCombo2.inc.php', 
            data: { Tipo: op1, iduser: idU }, 
            dataType: 'json'
        })
        .done(function(data){
            console.log(data);	

            var $select = $('#cbConocimiento');
            
            $.each(data, function(i,item) {
                if (item.nombre == "noLang"){
                    //console.log('No hay datos de idioma');
                    $.confirm({
                        title: '<i class="bi bi-exclamation-triangle" style= "color: #666666;"></i> Información',
                        content: 'No hay más idiomas disponibles para capturar',
                        type: 'dark',
                        typeAnimated: true,
                        buttons: {
                                Aceptar: function () {
                                }
                        }
                    });
                    valida = 0;
                }else if (item.nombre == "noSkill"){
                    //console.log('No hay datos de Habilidades');
                    $.confirm({
                        title: '<i class="bi bi-exclamation-triangle" style= "color: #666666;"></i> Información',
                        content: 'No hay más habilidades disponibles para capturar',
                        type: 'dark',
                        typeAnimated: true,
                        buttons: {
                                Aceptar: function () {
                                }
                        }
                    });
                    valida = 0;
                }else{
                    $select .append($("<option></option>")
                    .attr('value', item.id)
                    .text(item.nombre))
                }
            });
                console.log('valida: '+valida);
                
                //Si hay opciones por mostrar
                if (valida == 1){
                    $('#cbConocimiento').attr('disabled',false); //Activa el segundo combo	
                    
                    //Llenando el combo box 3
                    $.ajax({ 
                        type: 'POST', 
                        url: 'includes/skillsCombo3.inc.php', 
                        data: { Tipo: op1}, 
                        dataType: 'json'
                    })
                    .done(function(data){
                        console.log(data);	
                        var $select = $('#cbnivel');
                        
                        $.each(data, function(i,item) {
                            $select .append($("<option></option>")
                            .attr('value', item.idnivel)
                            .text(item.nivel))

                            $('#cbnivel').attr('disabled',false); //Activa el tercer combo
                        });
                    });
                }
        });
    });
    
    $( "#cbnivel" ).change(function() { //Cuando cambia el tercer comboBox
        //console.log('cambio');
        $('#btnGuardar').attr('disabled',false); //Activa el botón guardar
    });
    
    $('#btnGuardar').click(function(){ //Al presionar el botón guardar
        console.log('guardar');
               
        //Obteniendo el valor de los campos
        var op1 = $("#Tipo").val();
        var op2 = $("#cbConocimiento").val();
        var op3 = $("#cbnivel").val();
        var idU = $("#iduser").val();
        var vidsesion = $("#idsesion").val();
        
        console.log(op1 + ' | ' + op2 + ' | ' + op3 + ' | ' + idU + ' | ' + vidsesion);
        
        //Enviando los datos al servidor
        $.ajax({
                url: 'includes/enterSkills.inc.php',
                type: 'POST',
                data: {opcion: op1, Tipo2: op2 , Tipo3: op3, iduser: idU, idsesion: vidsesion},
        })
        .done(function(res){
            console.log(res);
            if(res == 'alreadyExist'){
                $.confirm({
                    title: '<i class="bi bi-exclamation-triangle" style= "color: orange;"></i> Advertencia',
                    content: 'La habilidad ya está asignada al usuario',
                    type: 'orange',
                    typeAnimated: true,
                    buttons: {
                            Aceptar: function () {
                            }
                    }
                });
            }else if (res == 'error'){
                $.confirm({
                    title: '<i class="bi bi-x-circle" style= "color: red;"></i> Error',
                    content: 'Error al asignar la habilidad al usuario. Intente nuevamente o contacte con el administrador',
                    type: 'red',
                    typeAnimated: true,
                    buttons: {
                            Aceptar: function () {
                            }
                    }
                });
            }else if (res == 'success'){
                $.confirm({
                    title: '<i class="bi bi-check-lg" style= "color: green;"></i> Correcto',
                    content: 'La habilidad se guardó!',
                    type: 'green',
                    typeAnimated: true,
                    buttons: {
                            Aceptar: function () {
                            }
                    }
                });

                //Limpia los valores del formulario
                $('#Tipo').prop('selectedIndex',0);
                $('#cbConocimiento').prop('selectedIndex',0);
                $('#cbnivel').prop('selectedIndex',0);
                
                $('#btnGuardar').attr('disabled',true); //desactiva el botón guardar
                $('#cbConocimiento').attr('disabled',true); //desactiva el segundo combo	
                $('#cbnivel').attr('disabled',true); //desactiva el tercer combo

            }else{
                $.confirm({
                    title: '<i class="bi bi-x-circle" style= "color: red;"></i> Error',
                    content: 'Error inesperado. Intente nuevamente o contacte con el administrador',
                    type: 'red',
                    typeAnimated: true,
                    buttons: {
                            Aceptar: function () {
                            }
                    }
                });
            }
        });
        
        
        /*
        AGREGAR VALIDACIONES PARA QUE LOS CAMPOS NO ESTÉN VACIOS Y ENVIAR A LA FUNCION ORIGINAL PARA GUARDAR
        */
        
    });
});