<?php
    include_once 'header.php';
	//Incluyendo archivos externos
	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';
    //Definiendo el idusuario en base a la variable de sesión
	$idusuario = $_SESSION["idusuario"]; 
?>
    
<section class="skills-form">
<h2> Registro de habilidades  y conocimientos</h2>
    <form action="includes/enterSkills.inc.php" method="post">

        <label for="Tipo">Tipo de conocimiento: </label>
		<select name="Tipo" id= "Tipo" onChange="reload()"> <!--Manda llamar la función reload() que está en el archivo functions.js-->
				<option value="Selecciona">Selecciona un valor</option>
            	<?php
					//Llamando a la función para generar los valores del combobox
					fillComboBox($dbh);
				?>
        </select>
		</br></br>
		<?php
		//Obteniendo el valor seleccionado en el primer combobox
		if(isset($_GET["cat"])){
			$opcion = $_GET["cat"];
		?>
		<label for="Tipo2">Conocimiento: </label>
		<select name="Tipo2" id= "Tipo2">
            	<?php
					//Llamando a la función para generar los valores del combobox
					fillComboBox2($dbh, $opcion, $idusuario);
				?>
        </select>
		</br></br>
		<label for="Tipo3">Nivel: </label>
		<select name="Tipo3" id= "Tipo3">
            	<?php
					//Llamando a la función para generar los valores del combobox
					fillComboBox3($dbh, $opcion);
				?>
        </select>
		<br><br>
		<input type="hidden" name="iduser" id="iduser" value="<?php echo $idusuario;?>">
		<input type="hidden" name="opcion" id="opcion" value="<?php echo $opcion;?>">
		<button type="submit" name="submit">Guardar</button>
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
<?php
    include_once 'footer.php';
?>