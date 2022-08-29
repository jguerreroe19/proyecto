<?php
//Incluyendo archivos externos
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(($_SERVER["REQUEST_METHOD"] == "POST")){
    //Obtiene los datos del formulario
    $tipo = $_POST["tipo"];
    $idioma = $_POST["idioma"];
    $skill = $_POST["skill"];
    $nivel = $_POST["nivel"];
    $idusr = $_POST["idusr"];

    //Llamando a la función para generar la tabla de resultados
	$respuesta = skillsTableQuery($dbh, $idusr, $tipo, $idioma, $skill, $nivel);
	echo $respuesta;
	
} else{
    //Regresa a la página inicial
    //echo "entra aqui";
    header("location: ../index.php");
    exit();
}

?>