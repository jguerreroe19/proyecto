<?php
//Incluyendo archivos externos
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(($_SERVER["REQUEST_METHOD"] == "POST")){
    //Obtiene los datos del formulario
    $cname = $_POST["cname"];
    $details = $_POST["details"];
	$sede = $_POST["sede"];
	$finicio = $_POST["finicio"];
    $ffin = $_POST["ffin"];
    $reco = $_POST["reco"];
    $pasoc = $_POST["pasoc"];
    
    $iduser = $_POST["iduser"];
    $idsesion = $_POST["idsesion"];
    $idrol = $_POST["idrol"];
    

    //Validando si el congreso ya existe
    if(congressExist($dbh, $cname) !== false){
        //header("location: ../enterVacancy.php?error=vacancyDuplicated");
        echo "alreadyExist";
        exit();
    }
	
	//Llamando la función para guardar el congreso
    $result = RecordCongress($dbh, $cname, $details, $sede, $finicio, $ffin, $reco, $pasoc, $iduser, $idsesion, $idrol);
    if($result === true){
        echo "done";
		exit();
    }else{
        echo "Error al tratar de guardar el congreso. Intentelo nuevamente o reportelo con el administrador ".$result;
        exit();
    }
} else{
    //Regresa a la página inicial
    //echo "entra aqui";
    header("location: ../index.php");
    exit();
}

?>