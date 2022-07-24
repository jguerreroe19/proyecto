<?php
    include_once 'header.php';
	//Incluyendo archivos externos
	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';
    if(isset($_SESSION["sid"])){
        //Definiendo el idusuario en base a la variable de sesión
        $idusuario = $_SESSION["idusuario"]; 
        $idrol = $_SESSION["idrol"];
?>
    
        <section class="queryvacancy-form">
        <h2> Consulta de Congresos</h2>
            <form name="qCongress" id = "formQueryCongress"action="includes/queryCongress.inc.php" method="post">

                <label for="cname">Nombre: </label>
                <input type="text" name="cname" id="cname" placeholder = "Buscar por nombre"></br></br>
                <label for="details">Detalles: </label>
                <input type="text" name="details" id="details" placeholder = "Buscar por detalles"></br></br>
                
                <?php //Muestra el checkbox sólo para el rol Profesor
                    if($idrol == 2){
                ?>
                        <input type="checkbox" name="mine" id="mine">
                        <label for="mine">Registrados por mi</label></br></br>
                        
                        <input type="checkbox" name="activo" id="activo">
                        <label for="activo"> Sólo congresos activos</label>
                        </br></br></br>
                <?php    
                    }
                ?>
                <input type="hidden" name="iduser" id="iduser" value="<?php echo $idusuario;?>">
                <input type="hidden" name="idrol" id="idrol" value="<?php echo $idrol;?>">
                <button type="button" id="btnBuscar">Buscar</button>
                <!--<button type="submit" name="submit">Buscar</button>-->
                </br></br>
            </form>

</section>
<!--Muestra la respuesta que se recibe de Ajax-->
<div id="mensaje"></div>

<!--Muestra la respuesta que se recibe de Ajax-->
<div id="respuesta"></div>

<!--Ventana emeregente para mostrar los detalles de los proyectos-->
<div class="modal fade" id="detallesProyecto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background: #e7e7e7;">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Datos del proyecto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                        <label class = "labelPopUp">Nombre: </label>
                        <p id = "datosPopUp0" class = "textPopUp"></p>
                        <label class = "labelPopUp">Descripción:</label>
                        <p id = "descProy0" class = "textPopUp"></p>
                        <label class = "labelPopUp">Tipo:</label>
                        <p id = "tipoProy0" class = "textPopUp"></p>
        </div>
        <div class="modal-footer">
        <button type="button" class="buttonEnviar" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!--Ventana emeregente para mostrar la asignación de los alumnos a los congresos-->
<div class="modal fade" id="asociarAlumno" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background: #e7e7e7;">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Datos del proyecto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                    <form action="addPonente.inc.php" method="post" id="formTest">
                        <label class = "labelPopUp">Alumno</label>
						<select class="combos inputPopUp" name="alumnos" id="alumnos">
							<option value="Seleccion" id="0">Selecciona una opción</option>
								<?php
									//Llamando a la función para generar los valores del combobox
									fillComboBoxCongress($dbh);
								?>
						</select>
						<label class = "labelPopUp">Comentarios</label> 
						<textarea iplaceholder="Comentarios" class="inputPopUp" name="comentario" id="comentario"></textarea>
                        <input type="hidden" name="idcongreso" id="idcongreso" value="0">
						<input type="button" value="Asociar" id="enviar" class="buttonEnviar">
                        <button type="button" class="buttonEnviar" data-bs-dismiss="modal">Cerrar</button>
						<!--<button class ="boton" id="enviar" >Enviar</button>-->
					</form>
        </div>
        <div class="modal-footer">
            <!--Muestra la respuesta que se recibe de Ajax-->
            <div id="confirma"></div>        
      </div>
    </div>
  </div>
</div>

<script>
    //Variable para obtener los ids de los Modales
	var modalDetalles = new bootstrap.Modal(document.getElementById("detallesProyecto"), {});
    var modalAdocia = new bootstrap.Modal(document.getElementById("asociarAlumno"), {});
    
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
			
			$.ajax({
				url: 'includes/queryCongress.inc.php',
				type: 'POST',
				//data: ruta,
                data: {cname: vcname, details: vdetails, mine: vmine, activo: vactivo, iduser: viduser, idrol: vidrol},
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

                //Cierra la ventana de los datos del proyecto
                $('#close').on('click', function(){         
                    $('#popup').fadeOut('slow');         
                    $('.popup-overlay').fadeOut('slow');         
                return false;     
                });

                //Botón para editar los datos del congreso
                $('.editar').on('click',function(){
                    var currentRow =$(this).closest("tr");
                    var col1=currentRow.find("td:eq(0)").text();
                    alert('Edita Campos'+col1);
                });

                //Botón para eliminar el congreso
                $('.eliminar').on('click',function(){
                    alert('Elimina Campos');
                });
                
                //Botón para asociar el congreso con un alumno
                $('.asociar').on('click',function(){
                    
                    //Limpia el mensaje anterior
                    $('#confirma').text('');
                    
                    //Obteniendo el valor del ID del congreso
                    var currentRow =$(this).closest("tr");
                    var col1=currentRow.find("td:eq(0)").text();
                    //Asignando el valor al campo oculto
                    $("#idcongreso").val(col1);
                    console.log('Boton'+col1);

                    //Muestra la ventana emergente
                    modalAdocia.show();
                });

                //Cerrar la ventana emergente
                $( ".close" ).click(function() {
                    $(".overlay").css("visibility", "hidden");
                    $(".overlay").css("opacity", "0");
                    $('#confirma').html('') //Borra el mensaje de la ventana popup
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

</script>

<?php
    } else{
        //Regresa a la página inicial
        header("location: index.php");
        exit();
    }
    include_once 'footer.php';
?>