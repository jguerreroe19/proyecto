<?php
    include_once 'header.php';
?>
    <script type='text/javascript' src='js/enterSkills.js'></script>
<?php
	include_once 'header2.php';
	//Incluyendo archivos externos
	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';
	//Valida si hay sesión activa, de lo contrario redirecciona al index.
	if (isset($_SESSION["sid"])){
    //Definiendo el idusuario en base a la variable de sesión
	$idusuario = $_SESSION["idusuario"]; 
	$idrol = $_SESSION["idrol"];
	$idsesion = $_SESSION["sid"];
	/*
	---------------------------------------
	LAS CORRECCIONES LAS ESTOY HACIENDO EN EL NOTEPAD++
	---------------------------------------
	*/
?>

<section class="skills-form debajodelNav">
	<div class="container" id="formSkills">
		<form method="post" id="skillsComboUno" name="combos" class="form-horizontal">
			<div class="col-md-6">
				<label for="Tipo" class="form-label labelPopUp">Tipo de conocimiento: </label>
				<select name="Tipo" id= "Tipo" class="form-select">
						<option selected disabled value="">Seleccione una opción ...</option>
						<option value="Idioma">Idioma</option>
						<option value="Habilidad">Habilidad</option>
				</select>
			</div>
			</br>
			<div class="col-md-6">
				<label for="cbConocimiento" class="form-label labelPopUp">Conocimiento: </label>
				<select name="cbConocimiento" id= "cbConocimiento" class="form-select" disabled>
					<option selected disabled value="">Seleccione una opción ...</option>
				</select>
			</div>
			</br>
			<div class="col-md-6">
				<label for="cbnivel" class="form-label labelPopUp">Nivel: </label>
				<select name="cbnivel" id= "cbnivel" class="form-select" disabled>
					<option selected disabled value="">Seleccione una opción ...</option>
				</select>
			</div>
			</br>		
			<div class="col-md-6" style="text-align:center;">
				<input type="hidden" name="iduser" id="iduser" value="<?php echo $idusuario; ?>"> <!-- Actualizar los valores de las sesiones y de id usuario-->
				<input type="hidden" name="idsesion" id="idsesion" value="<?php echo $idsesion; ?>">
				<input type="button" id="btnGuardar" class="buttonEnviar" value="Guardar" disabled>
			</div>
				<!--
				<div class="collapse hide" id="datosSecundarios">  Bloque que muestra el segundo y tercer select 
					<div id="skillsComboDos"></div>
					</br>
					
				</div>
				-->
		</form>
	</div>
	</br>
	<div id="mensajes" class="collapse hide" style="background-color: #d3d3d4; padding:0.5rem; font-size: 19px;"></div> <!-- Bloque que muestra los mensajes del sistema -->
	<div id="tablaResultados"class="container-xl collapse hide" style="padding-top: 30px;"></div> <!-- Bloque que muestra la tabla con los resultados -->	
</section>

<?php
	}else{
		//Redirecciona al index si no hay sesión activa
		header("location: index.php");
		exit();   
	}
    include_once 'footer.php';
?>