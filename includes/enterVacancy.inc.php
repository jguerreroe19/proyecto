<?php
//Incluyendo archivos externos
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(isset($_POST["submit"])){
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
    

    //Validando campos en blanco
    if(emptyInputVacancy($title, $details, $pdate, $edate, $phone, $email) !== false){
        header("location: ../enterVacancy.php?error=emptyinput");
        exit();
    }

    //Validando si la vacante ya existe
    if(vacancyExist($dbh, $title, $details) !== false){
        header("location: ../enterVacancy.php?error=vacancyDuplicated");
        exit();
    }
	
	//Llamando la función para guardar la vacante
    RecordVacancy($dbh, $title, $details, $pdate, $edate, $phone, $email, $iduser, $idsesion, $idrol);
		

} else{
    //Regresa a la página inicial
    echo "entra aqui";
    //header("location: ../index.php");
    exit();
}

?>