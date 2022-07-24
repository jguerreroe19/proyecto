<?php
//Incluyendo archivos externos
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(($_SERVER["REQUEST_METHOD"] == "POST")){
    
    $idalumno =  $_POST["alumnos"];
    $comentario =  $_POST["comentario"];
    $idcongreso =  $_POST["idcongreso"];
    $idusuario = 3; //$_SESSION["idusuario"]; 
    
    /*echo 'Los datos son: ';
    echo '</br>';
    echo 'idalumno: '.$idalumno;
    echo '</br>';
    echo 'comentario: '.$comentario;
    echo '</br>';
    echo 'idcongreso: '.$idcongreso;
    echo '</br>';*/

    //Validando si el alumno ya está asociado al congreso
    if(alumnoCongreso($dbh, $idalumno, $idcongreso)!== false){
        echo "<p>El alumno seleccionado ya está asociado al congreso</p>";
        exit();
    }else{
     //Validando si el alumno ya está asociado al congreso
        if(addPonente($dbh, $idalumno, $idcongreso, $comentario, $idusuario)!== false){
            echo "<p>El alumno fue asignado al congreso exitosamente!</p>";
            exit();
        }   
    }

    

} else{
    //Regresa a la página inicial
    header("location: ../index.php");
    exit();
}

?>
