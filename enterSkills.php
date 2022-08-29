<?php
    include_once 'header.php';
	include_once 'header2.php';
	//Incluyendo archivos externos
	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';
	//Valida si hay sesión activa, de lo contrario redirecciona al index.
	if (isset($_SESSION["sid"])){
    //Definiendo el idusuario en base a la variable de sesión
	$idusuario = $_SESSION["idusuario"]; 
	$idrol = $_SESSION["idrol"];
?>

<section class="skills-form">
    <h2> Registro de habilidades  y conocimientos</h2>
	<div class="container">
		<form action="includes/enterSkills.inc.php" method="post" id="skillsComboUno" name="combos" class="form-horizontal">
			<div class="col-md-4">
				<label for="Tipo" class="form-label labelPopUp">Tipo de conocimiento: </label>
				<select name="Tipo" id= "Tipo" class="form-select">
						<option value="sel">Selecciona un valor</option>
						<?php
							//Llamando a la función para generar los valores del combobox 1
							fillComboBox($dbh);
						?>
				</select>
			</div>
			</br>		
				<input type="hidden" name="iduser" id="iduser" value="<?php echo $idusuario;?>">
				<div class="collapse hide" id="datosSecundarios"> <!-- Bloque que muestra el segundo y tercer select -->
					<div id="skillsComboDos"></div>
					</br>
					<input type="button" id="btnGuardar" class="buttonEnviar" value="Guardar">
				</div>
		</form>
	</div>
	</br>
	<div id="mensajes" class="collapse hide" style="background-color: #d3d3d4; padding:0.5rem; font-size: 19px;"></div> <!-- Bloque que muestra los mensajes del sistema -->
	<div class="collapse hide" id="tablaResultados"></div> <!-- Bloque que muestra la tabla con los resultados -->	
</section>

<script>
	$(document).ready(function(){
		
		$( "#Tipo" ).change(function() { //Cuando cambia el primer comboBox
			//alert( this.value );
			$('#mensajes').text(''); //Limpia el div de mensajes
			$("#tablaResultados").collapse("hide"); //Oculta la tabla de resultados
			$('#Tipo option:eq(0)').attr('disabled',true); //Desactiva la primer opción del Select
			//Obteniendo los valores de los campos
			var op1 = this.value;
			var idU = $("#iduser").val();
			//console.log( op1 + ' / ' + idU);
			if (op1 == 'sel'){
				$('#Tipo option:eq(0)').attr('disabled',false); //Activa la primer opción del primer Select
				$('#Tipo option:eq(0)').attr('selected',true); //Selecciona la primer opción del primer Select para permitir una nueva captura
			}else {
				//Enviando datos para llenar los dos comboBox siguientes
				$.ajax({
					url: 'includes/skillsCombo2.inc.php',
					type: 'POST',
					//data: ruta,
					data: {opcion: op1, iduser: idU},
				})
				.done(function(res){
					console.log (res);
					if (res == 'noValues'){
						$('#mensajes').text(''); //Limpia el div de mensajes
						$('#mensajes').html('<p>No hay más idiomas disponibles para capturar</p>');
						$("#mensajes").collapse("show"); //Muestra la tabla de mensajes
						$("#datosSecundarios").collapse("hide"); //Oculta los siguientes combobox
					}else if (res == 'noSkills'){
						$('#mensajes').text(''); //Limpia el div de mensajes
						$('#mensajes').html('<p>No hay más habilidades disponibles para capturar</p>');
						$("#mensajes").collapse("show"); //Muestra la tabla de mensajes
						$("#datosSecundarios").collapse("hide"); //Oculta los siguientes combobox
					}else{
						$('#skillsComboDos').html(res)
						$("#datosSecundarios").collapse("show"); //Muestra los siguientes combobox
						
						$( "#Tipo2" ).change(function() {
							$('#Tipo2 option:eq(0)').attr('disabled',true); //Desactiva la primer opción del Select
						});
						
						$( "#Tipo3" ).change(function() {	
							$('#Tipo3 option:eq(0)').attr('disabled',true); //Desactiva la primer opción del Select
						});
					}
				}) //END AJAX DONE includes/queryCongress.inc.php'
				.fail(function(){
					console.log("Fallo");
				})
					.always(function(){
					console.log("Complete");
				});
			}	
		});
		
		$('#btnGuardar').click(function(){ //Al presionar el botón guardar
			//Obteniendo el valor de los campos
			var op1 = $("#Tipo").val();
			var op2 = $("#Tipo2").val();
			var op3 = $("#Tipo3").val();
			var idU = $("#iduser").val();
			
			//Validando que se hayan seleccionado opciones válidas
			if(op1 == 'sel' || op2 == 'sel' || op3 == 'sel'){	
					$('#mensajes').html('<p>Revise que haya seleccionado valores en cada campo</p>');
					console.log(op1 + ' / ' + op2 + ' / ' + op3 + ' / ');
			}else{
					$.ajax({
						url: 'includes/enterSkills.inc.php',
						type: 'POST',
						data: {opcion: op1, Tipo2: op2 , Tipo3: op3, iduser: idU},
					})
					.done(function(res){
						//console.log (res);
						//Valida la respuesta devuelta por el proceso
						if (res == 'success'){
							$('#mensajes').html('<p>Habilidad guardada exitosamente!</p>');

							//Llama al proceso para generar la tabla de habilidades
							$.ajax({
							url: 'includes/skillsTable.inc.php',
							type: 'POST',
							data: {iduser: idU},
						})
						.done(function(res){
							$('#tablaResultados').html(res);
							$("#tablaResultados").collapse("show"); //Muestra la tabla de resultados
						}) //END AJAX DONE includes/skillsTable.inc.php'

						.fail(function(){
						console.log("Fallo");
						})
						
						.always(function(){
						console.log("Complete");
						});

						}else{
							$('#mensajes').html(res);
						}
						$("#datosSecundarios").collapse("hide"); //Oculta los combobox 2 y 3
						$("#mensajes").collapse("show"); //Muestra la respuesta del proceso de guardado
						$('#Tipo option:eq(0)').attr('disabled',false); //Activa la primer opción del primer Select
						$('#Tipo option:eq(0)').attr('selected',true); //Selecciona la primer opción del primer Select para permitir una nueva captura
						

					}) //END AJAX DONE includes/enterSkills.inc.php'
					.fail(function(){
						console.log("Fallo");
					})
						.always(function(){
						console.log("Complete");
					});
			}
		});
	});
</script>

<?php
	}else{
		//Redirecciona al index si no hay sesión activa
		header("location: index.php");
		exit();   
	}
    include_once 'footer.php';
?>