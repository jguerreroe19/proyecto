<?php
	include_once 'header.php';
	?>
    <script type='text/javascript' src='js/querySkills.js'></script>
	<?php
	include_once 'header2.php';

	//Valida si hay sesión activa, de lo contrario redirecciona al index.
	if (isset($_SESSION["sid"])){
		
		//Incluyendo archivos externos
		require_once 'includes/dbh.inc.php';
		require_once 'includes/functions.inc.php';
		
		//Definiendo el idusuario en base a la variable de sesión
		$idusuario = $_SESSION["idusuario"]; 
		$sid = $_SESSION["sid"]; 
	?>

	<section class="queryskills-form debajodelNav">
		<div class="container">
			<form name="qSkills" id="formQuerySkills" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="row g-3">
				<div class="col-md-6">
					<label for="Tipo" class="form-label labelPopUp">Tipo de conocimiento: </label>
					<select name="Tipo" id= "Tipo" class="form-select">
						<option selected value="0">Seleccione una opción ...</option>
						<option value="Idioma">Idioma</option>
						<option value="Habilidad">Habilidad</option>
					</select>
				</div>
				<div class="col-md-6">
					<label for="Tipo2" class="form-label labelPopUp">Idioma: </label>
					<select name="Tipo2" id= "Tipo2" class="form-select">
							<option value="0">Selecciona un valor</option>
							<?php
								//Llamando a la función para generar los valores del combobox
								fillComboBox2c($dbh, "Idioma", $idusuario);
							?>
					</select>
				</div>
				<div class="col-md-6">
					<label for="Tipo2a" class="form-label labelPopUp">Conocimiento: </label>
					<select name="Tipo2a" id= "Tipo2a" class="form-select">
							<option value="0">Selecciona un valor</option>
							<?php
								//Llamando a la función para generar los valores del combobox
								fillComboBox2c($dbh, "Habilidad", $idusuario);
							?>
					</select>
				</div>
				<div class="col-md-6">
					<label for="Tipo3" class="form-label labelPopUp">Nivel: </label>
					<select name="Tipo3" id= "Tipo3" class="form-select">
							<option value="0">Selecciona un valor</option>
							<?php
								//Llamando a la función para generar los valores del combobox
								fillComboBox3c($dbh, $opcion);
							?>
					</select>
				</div>
				<input type="hidden" name="iduser" id="iduser" value="<?php echo $idusuario;?>">
				<div class="col-12">
					<button type="button" name="submit" class="buttonEnviar" id="btnBuscar">Buscar</button>
				</div>
			</form>
		</div>
		</br>
			<!-- Bloque que muestra los mensajes del sistema -->
			<div id="mensajes" class="col-md-12 collapse hide" style="background-color: #d3d3d4; padding:0.5rem; font-size: 19px;"></div> 
			<!-- Bloque que muestra la tabla con los resultados -->
			<div id="tablaResultados" class="container-xl collapse hide" style="padding-top: 30px;"></div> 	

	</section>

	<!--Ventana emeregente para mostrar la edicion de los skills-->
	<div class="modal fade" id="popUpSkills" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" style="background: #e7e7e7;">
		<div class="modal-header">
			<h5 class="modal-title" id="tituloPopup">Editar habilidad</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
						<form action="addPonente.inc.php" method="post" id="formTest">
							<label for="tipoPopup" class = "labelPopUp">Tipo de conocimiento: </label>	
							<input type="text" id="tipoPopup" name="tipoPopup" class="inputPopUp" value="Tipo" disabled>
							<label for="habilidadPopup" class = "labelPopUp" id="idLabelSkill">Habilidad/Idioma: </label>	
							<input type="text" id="habilidadPopup" name="habilidadPopup" class="inputPopUp" value="Habilidad" disabled>
							<label for="nivelPopup" class = "labelPopUp">Nivel: </label>	
							<select class="combos inputPopUp" name="nivelPopup" id="nivelPopup">
							</select>
							<p id = "datosPopUp0" class = "textPopUp">*Sólo se puede cambiar el nivel de conocimientos, si requieres cambiar algún otro valor, elimina la habilidad y vuelve a capturarla.
							</p>
							<input type="hidden" name="idusuarioPopup" id="idusuarioPopup" value=<?php echo $idusuario;?>>
							<input type="hidden" name="idSessionPopup" id="idSessionPopup" value=<?php echo $sid;?>>
							<input type="button" value="Guardar" id="btnGuardarPopup" class="btn btn-secondary">
							<input type="button" value="Cerrar" class="btn btn-secondary" data-bs-dismiss="modal">
							<!--<button class ="boton" id="enviar" >Enviar</button>-->
						</form>
			</div>
			<div class="modal-footer">
				<!--Muestra la respuesta que se recibe de Ajax-->
				<div id="confirmaPopUp"></div>        
		</div>
		</div>
	</div>
	</div>

	<!--Ventana emeregente para mostrar la eliminación de los skills-->
	<div class="modal fade" id="popUpSkillsDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" style="background: #e7e7e7;">
		<div class="modal-header">
			<h5 class="modal-title" id="tituloPopupDelete">Eliminar habilidad</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
						<form action="addPonente.inc.php" method="post" id="formTest">
							<label for="tipoPopup" class = "tipoPopupDelete">Tipo de conocimiento: </label>	
							<input type="text" id="tipoPopupDelete" name="tipoPopupDelete" class="inputPopUp" value="Tipo" disabled>
							<label for="habilidadPopupDelete" class = "labelPopUp" id="idLabelSkillDelete">Habilidad/Idioma: </label>	
							<input type="text" id="habilidadPopupDelete" name="habilidadPopupDelete" class="inputPopUp" value="Habilidad" disabled>
							<label for="nivelPopupDelete" class = "labelPopUp">Nivel: </label>	
							<select class="combos inputPopUp" name="nivelPopupDelete" id="nivelPopupDelete" disabled>
							</select>
							<p id = "datosPopUp0Delete" class = "textPopUp">* Una vez eliminado el registro no se puede recuperar
							</p>
							<input type="hidden" name="idusuarioPopupDelete" id="idusuarioPopupDelete" value=<?php echo $idusuario;?>>
							<input type="hidden" name="idSessionPopupDelete" id="idSessionPopupDelete" value=<?php echo $sid;?>>
							<input type="button" value="Eliminar" id="btnGuardarPopupDelete" class="btn btn-secondary">
							<input type="button" value="Cerrar" class="btn btn-secondary" data-bs-dismiss="modal">
							<!--<button class ="boton" id="enviar" >Enviar</button>-->
						</form>
			</div>
			<div class="modal-footer">
				<!--Muestra la respuesta que se recibe de Ajax-->
				<div id="confirmaPopUpDelete"></div>        
		</div>
		</div>
	</div>
	</div>


	<script>
		//Variable para obtener los ids de los Modales
		var popupHabilidadesUpdate = new bootstrap.Modal(document.getElementById("popUpSkills"), {});
		var popupHabilidadesDelete = new bootstrap.Modal(document.getElementById("popUpSkillsDelete"), {});
	</script>

	<?php
	}else{
		//Redirecciona al index si no hay sesión activa
		header("location: index.php");
		exit();   
	}
    include_once 'footer.php';
?>
