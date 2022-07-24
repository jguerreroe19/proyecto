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
    
<section class="queryskills-form">
<h2> Consulta de habilidades  y conocimientos</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

        <label for="Tipo">Tipo de conocimiento: </label>
		<select name="Tipo" id= "Tipo">
				<option value="0">Selecciona un valor</option>
            	<?php
					//Llamando a la función para generar los valores del combobox
					fillComboBox($dbh);
				?>
        </select>
		</br></br>
        <label for="Tipo2">Idioma: </label>
		<select name="Tipo2" id= "Tipo2">
                <option value="0">Selecciona un valor</option>
            	<?php
					//Llamando a la función para generar los valores del combobox
					fillComboBox2c($dbh, "Idioma", $idusuario);
				?>
        </select>
		</br></br>
        <label for="Tipo2a">Conocimiento: </label>
		<select name="Tipo2a" id= "Tipo2a">
                <option value="0">Selecciona un valor</option>
            	<?php
					//Llamando a la función para generar los valores del combobox
					fillComboBox2c($dbh, "Habilidad", $idusuario);
				?>
        </select>
		</br></br>
        <label for="Tipo3">Nivel: </label>
		<select name="Tipo3" id= "Tipo3">
                <option value="0">Selecciona un valor</option>
            	<?php
					//Llamando a la función para generar los valores del combobox
					fillComboBox3c($dbh, $opcion);
				?>
        </select>
		<br><br>
        <input type="hidden" name="iduser" id="iduser" value="<?php echo $idusuario;?>">
		<button type="submit" name="submit">Buscar</button>
    </form>
		
        <?php
		//Obteniendo el valor seleccionado en el primer combobox
		if(isset($_GET["cat"])){
			$opcion = $_GET["cat"];
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
		<br><br>
		<br><br>
		<h2>Lista de habilidades y conocimientos</h2>
		
		<?php
		}
		?>
		
		<?php
        //Mostrando mensajes de error o confirmación
		if(isset($_GET["error"])){
				if($_GET["error"] == "noneUpdate"){
					echo "<p>Habilidad actualizada correctamente!</p>";
				}else if($_GET["error"] == "errorUpdate"){
					echo "<p>No se pudo actualizar la habilidad. Intente nuevamente o contacte al administrador.</p>";
				}else if($_GET["error"] == "noneDelete"){
					echo "<p>Habilidad eliminada correctamente!</p>";
				}else if($_GET["error"] == "errorDelete"){
					echo "<p>No se pudo eliminar la habilidad. Intente nuevamente o contacte al administrador.</p>";
				}
		}

        if(isset($_POST["submit"])){
            //Obtiene los datos del formulario
            $tipo = $_POST["Tipo"];
            $tipo2 = $_POST["Tipo2"];
            $tipo2a = $_POST["Tipo2a"];
            $tipo3 = $_POST["Tipo3"];
            $idusuario = $_POST["iduser"];

            skillsTableQuery($dbh, $idusuario, $tipo, $tipo2, $tipo2a, $tipo3);

			
       }
		?>
</section>
<?php
	}else{
		//Redirecciona al index si no hay sesión activa
		header("location: index.php");
		exit();   
	}
    include_once 'footer.php';
?>