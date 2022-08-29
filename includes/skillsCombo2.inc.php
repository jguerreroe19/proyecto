<?php
//Incluyendo archivos externos
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(($_SERVER["REQUEST_METHOD"] == "POST")){
    //Obtiene los datos del formulario
    $opcion = $_POST["opcion"];
    $iduser = $_POST["iduser"];

    //Llamando a la función para generar los valores del combobox 2
	$respuesta = fillComboBox2($dbh, $opcion, $iduser);
	if ($respuesta == 'nolanguajes'){
		echo 'noValues';
	}else if ($respuesta == 'noskills'){
		echo 'noSkills';
	} else {
		echo '<div class="col-md-4">';
		echo '<label for="Tipo2" class="form-label labelPopUp">Conocimiento: </label>';
		echo '<select name="Tipo2" id= "Tipo2" class="form-select">';
		echo '<option value="sel">Selecciona un valor</option>';
		echo $respuesta;
		echo '</select>';
		echo '</div></br>';
		//Llamando a la función para generar los valores del combobox 3
		echo'<div class="col-md-4">';
		echo '<label for="Tipo3" class="form-label labelPopUp">Nivel: </label>';
		echo '<select name="Tipo3" id= "Tipo3" class="form-select">';
		echo '<option value="sel">Selecciona un valor</option>'.fillComboBox3($dbh, $opcion).'</select>';
		echo '</div></br>';
	}
	
	
} else{
    //Regresa a la página inicial
    //echo "entra aqui";
    header("location: ../index.php");
    exit();
}

?>