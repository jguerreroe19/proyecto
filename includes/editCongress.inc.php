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
    
    $idcong = $_POST["idcong"];
    $iduser = $_POST["iduser"];
    $idsesion = $_POST["idsesion"];
    $idrol = $_POST["idrol"];
    

	//Llamando la función para actualizar el congreso
    $result = EditCongress($dbh, $cname, $details, $sede, $finicio, $ffin, $reco, $pasoc, $idcong, $iduser, $idsesion, $idrol);
    echo $result;
	exit();
    
} else{
    //Regresa a la página inicial
    //echo "entra aqui";
    header("location: ../index.php");
    exit();
}

?>