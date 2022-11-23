$(document).ready(function(){

    //Cambiando el valor del encabezado
    $.fn.changeHeaderTitle('Depurar log de errores');

    //Declarando constantes
    const etiquetas = [];
	const datos = [];

    //Generando la gráfica graficaAccesos
    $.ajax({ 
        type: 'POST', 
        url: 'includes/getData.inc.php', 
        data: { query: 'CALL SP_DATA_LENGTH'}, 
        dataType: 'json'
        })
        .done(function(res){
            console.log(res);

            $.each(res, function(i,item) {
                        datos.push(item.MB);
                        console.log(item.MB);
                        etiquetas.push(item.table_name);
                        console.log(item.table_name);
            });

            const data = {
                    labels: etiquetas,
                    datasets: [{
                    type: 'bar',
                    label: 'Espacio ocupado por las tablas en la base de datos (MB)',
                    backgroundColor:  ['rgba(255, 99, 132, 0.2)'],
                    borderColor: [  'rgb(255, 99, 132)'],
                    borderWidth: 1,
                    data: datos,
                    }, {
                        type: 'line',
                        label: '25 MB (referencia)',
                        data: [25, 25, 25, 25],
                        fill: false,
                        borderColor: 'rgb(54, 162, 235)'
                    }]
                };

                const config = {
                    type: 'scatter',
                    data: data,
                    options: {
                        
                            responsive: true,
                            scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                    },
                                    plugins: {legend: {
                                        position: 'top',
                                        },
                                        title: {
                                        display: true,
                                        text: 'Espacio ocupado por las 4 tablas más grandes de la Base de Datos'
                                        }
                                    }
                            }
                };

                const myChart = new Chart(
                    document.getElementById('graficaErrores'),
                    config
                );
        }); //done includes/getData.inc.php


    //Botón Buscar
    $('#btnDepurar').click(function(){ //Al presionar el botón Buscar
        
        //Obtiene los valores de los campos
            var vidsesion = $("#idsesion").val();
            var vidrol = $("#idrol").val();
            var fini = $("#fechaini").val();
            var ffin = $("#fechafin").val();

            //Enviando los datos al servidor
            $.ajax({
                url: 'includes/depuraErrores.inc.php',
                type: 'POST',
                data: {idsesion: vidsesion, idrol: vidrol, fechaInicio: fini, fechaFin: ffin}
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
                } else if (res == 'noData'){
                    $.confirm({
                        title: '<i class="bi bi-exclamation-triangle" style= "color: orange;"></i> Advertencia',
                        content: 'No hay datos dentro del intervalo seleccionado',
                        type: 'orange',
                        typeAnimated: true,
                        buttons: {
                                Aceptar: function () {
                                }
                        }
                    });
                } else {
                    $.confirm({
                        title: '<i class="bi bi-question-circle" style= "color: #666666;"></i> Confirmación',
                        content: 'Se eliminará(n) ' +  res + ' registro(s). ¿Desea continuar?',
                        type: 'dark',
                        typeAnimated: true,
                        buttons: {
                                Aceptar: function () {
                                    //$.alert('Eliminar registros ' + fini + ' | ' + ffin);
                                    //Eliminando los registros
                                    $.ajax({
                                        url: 'includes/deleteErrores.inc.php',
                                        type: 'POST',
                                        data: {idsesion: vidsesion, idrol: vidrol, fechaInicio: fini, fechaFin: ffin},
                                    })
                                    .done(function(res){
                                        if (res == 'error'){
                                            $.confirm({
                                                title: '<i class="bi bi-x-circle" style= "color: red;"></i> Error',
                                                content: 'Error al depurar la tabla de errores. Intentelo nuevamente o revise el log de errores para más detalles',
                                                type: 'red',
                                                typeAnimated: true,
                                                buttons: {
                                                        Aceptar: function () {
                                                        }
                                                }
                                            });
                                        } else if (res == 'done'){
                                            $.confirm({
                                                title: '<i class="bi bi-check-lg" style= "color: green;"></i> Correcto',
                                                content: 'Los registros se eliminaron!',
                                                type: 'green',
                                                typeAnimated: true,
                                                buttons: {
                                                        Aceptar: function () {
                                                        }
                                                }
                                            });
                                        } else {
                                            $.confirm({
                                                title: '<i class="bi bi-x-circle" style= "color: red;"></i> Error',
                                                content: 'Error inesperado. Revise el log de errores para más detalles',
                                                type: 'red',
                                                typeAnimated: true,
                                                buttons: {
                                                        Aceptar: function () {
                                                        }
                                                }
                                            });
                                        }
                                    }) //END AJAX DONE includes/deleteErrores.inc.php
                                    .fail(function(){
                                        console.log("Fallo");
                                    })
                                    .always(function(){
                                        console.log("Complete");
                                    });
                                },
                                Cancelar: function () {
                                    console.log('Se canceló la depuración');
                                }
                        }
                    });
                }
                
            }) //END AJAX DONE includes/depuraErrores.inc.php'
            .fail(function(){
                console.log("Fallo");
            })
            .always(function(){
                console.log("Complete");
            });
    }); 

});