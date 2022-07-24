<?php
    include_once 'header.php';
	//Incluyendo archivos externos
	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';
	//Valida si hay sesión activa, de lo contrario redirecciona al index.
	if (isset($_SESSION["sid"])){
    //Definiendo el idusuario en base a la variable de sesión
	$idusuario = $_SESSION["idusuario"]; 
?>
    
<section class="skills-form">
<h2> Registro de idiomas  y habilidades</h2>
    <form id="formaHab" method="post" action="includes/enterSkills.inc.php">
	<?php
		//Validando el tipo de habilidad a capturar
		if(!isset($_GET["cat"])){
	?>
        <label for="Tipo">Tipo de conocimiento: </label>
		<select name="Tipo" id= "Tipo" onChange="reload()"> <!--Manda llamar la función reload() que está en el archivo functions.js-->
				<option value="Selecciona">Selecciona una opción</option>
            	<?php
					//Llamando a la función para generar los valores del combobox
					fillComboBox($dbh);
				?>
        </select>
		</br></br>
		<?php
		}else{
			//if(isset($_GET["cat"])){
			//Obteniendo el valor seleccionado en el primer combobox
			$opcion = $_GET["cat"];

			if ($opcion == "Habilidad"){
				echo '<p><h3> Selecciona la '.$opcion.' y el nivel: </h3></p>';
			}elseif ($opcion == "Idioma"){
				echo '<p><h3> Selecciona el '.$opcion.' y el nivel :</h3></p>';
			}
		?>
		<label for="Tipo2"><?php echo $opcion.':' ?></label>
		<select class="combos" name="Tipo2" id= "Tipo2">
			<option value="Selecciona" id="sel2">Selecciona una opción</option>
            	<?php
					//Llamando a la función para generar los valores del segundo combobox
					fillComboBox2($dbh, $opcion, $idusuario);
				?>
        </select>
		</br></br>
		<label for="Tipo3">Nivel: </label>
		<select class="combos" name="Tipo3" id= "Tipo3">
			<option value="Selecciona">Selecciona una opción</option>
            	<?php
					//Llamando a la función para generar los valores del tercer combobox
					fillComboBox3($dbh, $opcion);
				?>
        </select>
		<br><br>
		<input type="hidden" name="iduser" id="iduser" value="<?php echo $idusuario;?>">
		<input type="hidden" name="opcion" id="opcion" value="<?php echo $opcion;?>">
		<button type="submit" name="submit">Guardar</button>
		<!--<input type="button" value="Guardar" id="enviar">-->
		<br><br>
		<br><br>
		<h2>Lista de habilidades y conocimientos</h2>
		
		<?php
		}
		?>
		
		<?php
        //Mostrando mensajes de error o confirmación
		if(isset($_GET["error"])){
			if($_GET["error"] == "emptyinput"){
				echo "<p>Los campos no deben estar vacios</p>";
			} else if($_GET["error"] == "none"){
				echo "<p>Habilidad guardada exitosamente!</p>";
			} else if($_GET["error"] == "nolanguajes"){
				echo "<p>No hay más idiomas disponibles para capturar</p>";
			}else if($_GET["error"] == "noskills"){
				echo "<p>No hay más habilidades disponibles para capturar</p>";
			}
		}
		?>
		
		<?php
			if(isset($_GET["error"])){
				if($_GET["error"] == "wrongdata"){
					echo "<p>Elige una opción válida</p>";
				}
			}
		?>

		<table>
		  <tr>
			<th>Tipo</th>
			<th>Idioma</th>
			<th>Tecnología</th>
			<th>Nivel</th>
		  </tr>
			<?php
                //Llamando la función para armar el cuerpo de la tabla
				skillsTable($dbh, $idusuario);
			?>	
		</table>

	</form>
</section>


<script>
	//Funciones para eliminar el valor default de los combox
$( "#Tipo2" ).change(function () {
	$("#Tipo2 option[value='Selecciona']").remove();
  })

  $( "#Tipo3" ).change(function () {
	$("#Tipo3 option[value='Selecciona']").remove();
  })
/*
  $( "#enviar" ).click(function() {
	alert( "Submit Form" );
  	$( "#formaHab" ).submit();
});
*/
</script>

<?php
	}else{
		//Redirecciona al index si no hay sesión activa
		header("location: index.php");
		exit();   
	}
    include_once 'footer.php';
?>