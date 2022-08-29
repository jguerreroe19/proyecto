<?php
//Incluyendo archivos externos
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(($_SERVER["REQUEST_METHOD"] == "POST")){
    //Obtiene los datos del formulario
    $tipo = $_POST["phptipo"];
    $nivel = $_POST["phpnivel"];

    //Llamando a la función para generar los valores del combobox
	$respuesta = fillComboBoxEditSkills($dbh, $tipo, $nivel);
	echo $respuesta;
	
} else{
    //Regresa a la página inicial
    //echo "entra aqui";
    header("location: ../index.php");
    exit();
}

?>