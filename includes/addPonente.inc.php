<?php
//Incluyendo archivos externos
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(($_SERVER["REQUEST_METHOD"] == "POST")){
    
    $idalumno =  $_POST["alumnos"];
    $comentario =  $_POST["comentario"];
    $idcongreso =  $_POST["idcongreso"];
    $idsesion = $_POST["idsesion"];
    $iduser = $_POST["iduser"]; 

    //Validando si el alumno ya está asociado al congreso
    if(alumnoCongreso($dbh, $idalumno, $idcongreso)!== false){
        echo "alreadyAssigned";
        //echo "<p>El alumno seleccionado ya está asociado al congreso</p>";
        exit();
    }else{
        //Asociando el alumno al congreso
        $respuesta = addPonente($dbh, $idalumno, $idcongreso, $comentario, $iduser, $idsesion);
        if($respuesta!== false){
                echo "done";
            }else{
                echo "error";
            }
    }

} else{
    //Regresa a la página inicial
    header("location: ../index.php");
    exit();
}

?>
