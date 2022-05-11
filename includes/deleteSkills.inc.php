<?php

//Incluyendo archivos externos
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(isset($_POST["submit"])){
    //Obtiene los datos del formulario
    $tipo = $_POST["tipo"];
    $skill = $_POST["Habilidad"];
	$nivel = $_POST["nivel"];
	$iduser = $_POST["iduser"];
    $idsesion = $_POST["idsesion"];
	
	//Llamando la función para relizar el login
    DeleteSkill($dbh, $tipo, $skill, $iduser, $idsesion);
		

} else{
    //Regresa a la página inicial
    header("location: ../index.php");
    exit();
}



?>