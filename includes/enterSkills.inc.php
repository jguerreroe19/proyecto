<?php
if(($_SERVER["REQUEST_METHOD"] == "POST")){
    //Obtiene los datos del formulario
    $tipo2 = $_POST["Tipo2"];
    $tipo3 = $_POST["Tipo3"];
	$idusuario = $_POST["iduser"];
	$tipo = $_POST["opcion"];
    
    //Incluyendo archivos externos
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
	
	//Llamando la función para guardar el skill
    echo RecordSkill($dbh, $tipo2, $tipo3, $idusuario, $tipo);

} else{
    //Regresa a la página inicial
    header("location: ../index.php");
    exit();
}

?>