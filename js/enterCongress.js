$(document).ready(function(){

    //Cambiando el valor del encabezado
    $.fn.changeHeaderTitle('Registro de Congresos');

        //Asigna el valor de la fecha de publicación como valor minimo para la fecha de finalización
        $("#pdate").change(function () {
            //Obteniendo los valores actuales de las fechas
            var value = $(this).val();
            var endDate = $('#edate').val();
            //console.log('pDATE: ', value);
            //console. log('eDATE: ', endDate);
            
            //Creando una nueva variable para incrementar 15 días
            var date = new Date(value);
            var dateM = new Date(value);
            var dateF = new Date(value);
            date. setDate(date.getDate() + 15); //Fecha seleccionada del campo de expiración
            dateM. setDate(dateM.getDate() + 2); //Fecha minima del campo de expiración
            dateF. setDate(dateF.getDate() + 60); //Fecha maxima del campo de expiración
            
            var day = date.getDate();
            var dayM = dateM.getDate();
            var dayF = dateF.getDate();
            var month = date.getMonth() + 1;
            var monthM = dateM.getMonth() + 1;
            var monthF = dateF.getMonth() + 1;
            var year = date.getFullYear();
            var yearM = dateM.getFullYear();
            var yearF = dateF.getFullYear();
                    
            //Agregando 0s al día y el mes
            if (day < 10) {
                day = "0" + day;
            }
            if (month < 10) {
                month = "0" + month;
            }

            if (dayM < 10) {
                dayM = "0" + dayM;
            }
            if (monthM < 10) {
                monthM = "0" + monthM;
            }

            if (dayF < 10) {
                dayF = "0" + dayF;
            }
            if (monthF < 10) {
                monthF = "0" + monthF;
            }

            //Formando nueva fecha
            var nuevaFecha = year + "-" + month + "-" + day;
            var nuevaFechaM = yearM + "-" + monthM + "-" + dayM;
            var nuevaFechaF = yearF + "-" + monthF + "-" + dayF;

            //Actualizando el valor de la fecha de expiración de la vacante
            $("#edate").attr("min", nuevaFechaM);
            $("#edate").attr("max", nuevaFechaF);
            $("#edate").val(nuevaFecha);
        });

        //Submit form
        $('#btnGuardar').click(function(){  
                
            //Obteniendo los valores de los campos
            var form = $(this).parents("#formEnterCongress");
            var vcname = $('#cname').val();
            var vdetails = $('#details').val();
            var vsede = $('#sede').val();
            var vfinicio = $('#finicio').val();
            var vffin = $('#ffin').val();
            var vreco = $('#reco').find('option:selected').val();
            var vpasoc = $('#pasoc').find('option:selected').val();

            var vidusr = $('#iduser').val();
            var vidsesn = $('#idsesion').val();
            var vidrl = $('#idrol').val();
            var validacion = 0;
                
            //Validar campos vacios
            var resultado = $.fn.checkCampos2(form);
            
            //Agregando la validación
            $("#formEnterCongress").addClass('was-validated');

            //Si los combos no tienen valores seleccionados
            if(vreco ==""){
                    resultado++;
                    //console.log('Seleccionar un valor');
            }

            console.log('resultado: '+resultado);

            if (resultado == 0){
                $.ajax({
                    url: 'includes/enterCongress.inc.php',
                    type: 'POST',
                    data: {cname: vcname
                         , details: vdetails
                         , sede: vsede
                         , finicio: vfinicio
                         , ffin: vffin
                         , reco: vreco
                         , pasoc: vpasoc
                         , iduser: vidusr
                         , idsesion: vidsesn
                         , idrol: vidrl}
                })
                .done(function(res){
                    if(res == 'alreadyExist'){
                        $.confirm({
                            title: '<i class="bi bi-exclamation-triangle" style= "color: orange;"></i> Advertencia',
                            content: 'Ya existe un congreso registrado con el mismo nombre',
                            type: 'orange',
                            typeAnimated: true,
                            buttons: {
                                    Aceptar: function () {
                                    }
                            }
                        });
                        //$.alert('Ya existe un congreso registrado con el mismo nombre');
                    }else if (res == 'done'){
                        $.confirm({
                            title: '<i class="bi bi-check-lg" style= "color: green;"></i> Correcto',
                            content: 'Se guardó el congreso!',
                            type: 'green',
                            typeAnimated: true,
                            buttons: {
                                    Aceptar: function () {
                                    }
                            }
                        });
                        //$.alert('Congreso guardado exitosamente!');
                        $.fn.limpiarcampos(form); //Limpia los valores del formulario
                        $("#formEnterCongress").removeClass('was-validated'); //Remueve la clase de validación de campos
                    }else{
                        $.alert(res);
                    }

                    //$('#respuesta').html(res)
                })
                .fail(function(){
                    console.log("Fallo");
                })
                .always(function(){
                    console.log("Complete");
                });
            }
        });
});