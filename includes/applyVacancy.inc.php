<?php
if(isset($_GET["var1"])){
    //Obtiene los datos del formulario
    $idVacante = $_GET["var1"];
    $idcreador = $_GET["var2"];
    $idpostulante = $_GET["var3"];
	
    
    //Incluyendo archivos externos
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //Validando que exista la vacante
    if(validateVacancy($dbh, $idVacante, $idcreador) == false){
        header("location: ../queryVacancy.php?error=vacancynotexist");
        exit();
    }

    //Validando si el usuario ya está postulado a la vacante
    if(validateApplyVacancy($dbh, $idVacante, $idpostulante) !== false){
        header("location: ../queryVacancy.php?error=vacancyalreadyapplied");
        exit();
    }
        
    //Llamando la función para postular al alumno a la vacante
    if (applyVacancy($dbh, $idVacante, $idpostulante) !== false){
        header("location: ../queryVacancy.php?error=none");
        exit();
    } else {
        header("location: ../queryVacancy.php?error=statementerror");
        exit();
    } 
    
		

} else{
    //Regresa a la página inicial
    header("location: ../index.php");
    exit();
}

?>