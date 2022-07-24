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
    

    //Validando campos en blanco
    if(emptyInputCongress($cname, $details, $sede, $finicio, $ffin, $reco) !== false){
        //header("location: ../enterVacancy.php?error=emptyinput");
        echo "<p>Los campos no pueden estar vacios</p>";
        exit();
    }

    //Validando si la vacante ya existe
    if(congressExist($dbh, $cname, $details) !== false){
        //header("location: ../enterVacancy.php?error=vacancyDuplicated");
        echo "<p>Ya existe un congreso registrado con el mismo nombre o detalles</p>";
        exit();
    }
	
	//Llamando la función para guardar la vacante
    $result = RecordCongress($dbh, $cname, $details, $sede, $finicio, $ffin, $reco, $pasoc, $iduser, $idsesion, $idrol);
    if($result === true){
        echo "<p>Congreso guardado exitosamente!</p>";
		exit();
    }else{
        echo "<p>Error al tratar de guardar el congreso. Intentelo nuevamente o reportelo con el administrador.</p> ".$result;
    }
} else{
    //Regresa a la página inicial
    //echo "entra aqui";
    header("location: ../index.php");
    exit();
}

?>