<?php
//Incluyendo archivos externos
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(($_SERVER["REQUEST_METHOD"] == "POST")){
    //Obtiene los datos del formulario
    $title = $_POST["title"];
    $details = $_POST["details"];
	$pdate = $_POST["pdate"];
	$edate = $_POST["edate"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $iduser = $_POST["iduser"];
    $idsesion = $_POST["idsesion"];
    $idrol = $_POST["idrol"];

    //Validando si la vacante ya existe
    if(vacancyExist($dbh, $title, $details) !== false){
        echo 'alreadyExist';
        exit();
    }
	
	//Llamando la función para guardar la vacante
    $result = RecordVacancy($dbh, $title, $details, $pdate, $edate, $phone, $email, $iduser, $idsesion, $idrol);
	if($result === true){
        echo "done";
		exit();
    }else{
        echo "Error al tratar de guardar la vacante. Intentelo nuevamente o reportelo con el administrador ".$result;
        exit();
    }	

} else{
    //Regresa a la página inicial
    //echo "entra aqui";
    header("location: ../index.php");
    exit();
}

?>