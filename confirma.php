<?php
    include_once 'header.php';
	//Incluyendo archivos externos
	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';
	//Valida si hay sesión activa, de lo contrario redirecciona al index.
	if (isset($_SESSION["sid"])){

	if(isset($_GET["var1"])){
		//Obtiene los datos de la URL
		$tipo = $_GET["var1"]; 
		$idioma = $_GET["var2"]; 
		$skill = $_GET["var3"]; 
		$nivel = $_GET["var4"];

?>
		<section class="skills-form">
		<h2> Eliminar habilidades</h2>
		<form action="includes/deleteSkills.inc.php" method="post">
			<label for="tipo">Tipo de conocimiento: </label>	
			<input type="text" name="tipo" placeholder="Tipo de conocimiento" readonly="readonly" value="<?php echo $tipo; ?>"><br><br>
			<label for="Habilidad">Habilidad/Idioma: </label>	
		<?php
			//Validando el tipo de habilidad/conocimiento a mostrar
			if ($idioma == NULL){
				?>
				<input type="text" name="Habilidad" placeholder="Habilidad" readonly="readonly" value="<?php echo $skill; ?>"><br><br>
				<?php
			} elseif ($skill == NULL){
				?>
				<input type="text" name="Habilidad" placeholder="Idioma" readonly="readonly" value="<?php echo $idioma; ?>"><br><br>
				<?php
			}
		?>	
			<label for="nivel">Nivel: </label>
            <input type="text" name="nivel" placeholder="Nivel" readonly="readonly" value="<?php echo $nivel; ?>">
			<input type="hidden" name="iduser" id="iduser" value="<?php echo $_SESSION["idusuario"];?>">
			<input type="hidden" name="idsesion" id="idsesion" value="<?php echo $_SESSION["sid"];?>">
            </br></br>
			<button type="submit" name="submit">Eliminar</button>
		</form>

<?php
}
}else{
    //Redirecciona al index si no hay sesión activa
    header("location: index.php");
    exit();   
}
    include_once 'footer.php';
?>
