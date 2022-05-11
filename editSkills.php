<?php
    include_once 'header.php';
	//Incluyendo archivos externos
	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';

	if(isset($_GET["var1"])){
		//Obtiene los datos de la URL
		$tipo = $_GET["var1"]; 
		$idioma = $_GET["var2"]; 
		$skill = $_GET["var3"]; 
		$nivel = $_GET["var4"];

?>
		<section class="skills-form">
		<h2> Edicion de niveles</h2>
		<form action="includes/editSkills.inc.php" method="post">
			<label for="tipo">Tipo de conocimiento: </label>	
			<input type="text" name="tipo" placeholder="Tipo de conocimiento" readonly="readonly" value="<?php echo $tipo ?>"><br><br>
			<label for="Habilidad">Habilidad/Idioma: </label>	
		<?php
			//Validando el tipo de habilidad/conocimiento a mostrar
			if ($idioma == NULL){
				?>
				<input type="text" name="Habilidad" placeholder="Habilidad" readonly="readonly" value="<?php echo $skill ?>"><br><br>
				<?php
			} elseif ($skill == NULL){
				?>
				<input type="text" name="Habilidad" placeholder="Idioma" readonly="readonly" value="<?php echo $idioma ?>"><br><br>
				<?php
			}
		?>	
			<label for="nivel">Nivel: </label>
			<select name="nivel" id= "nivel">
		<?php
			//Llamando a la función para generar los valores del combobox
			fillComboBoxEditSkills($dbh, $tipo, $nivel);
		?>
			</select>
			</br></br>
			<?php //Enviando datos de forma oculta?>
			<input type="hidden" name="iduser" id="iduser" value="<?php echo $_SESSION["idusuario"];?>">
			<input type="hidden" name="idsesion" id="idsesion" value="<?php echo $_SESSION["sid"];?>">
			<button type="submit" name="submit">Guardar</button>
		</form>

<?php
}
    include_once 'footer.php';
?>