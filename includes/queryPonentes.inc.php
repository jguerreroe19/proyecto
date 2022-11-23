<?php
//Incluyendo archivos externos
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(($_SERVER["REQUEST_METHOD"] == "POST")){
    
    $idcongreso =  $_POST["idcongreso"];
    $idusuario =  $_POST["idusuario"];
    $idsesion = $_POST["idsesion"];
    $idrol = $_POST["idrol"]; 

    $sql = "SELECT NVL(asignadopor, '') asignadopor, NVL(fechaasignacion, '') fechaasignacion, NVL(comentarios, '') comentarios
            FROM ponentes_v WHERE idusuario = ".$idusuario." AND idcongreso = ".$idcongreso;

    //Validando que se trate de rol Alumno
    if ($idrol == 1){
        //Llamando a la función para generar la consulta
        $respuesta = consultaBD($dbh, $idsesion, $sql);

        if ($respuesta != false){
            //Obteniendo los datos de la consulta
            $resultado = $respuesta->fetch(PDO::FETCH_ASSOC);
            $asignadopor = $resultado["asignadopor"];
            $fechaasignacion = $resultado["fechaasignacion"];
            $comentarios = $resultado["comentarios"];

            echo 'El congreso fue asignado por el profesor '.$asignadopor.' el día '.$fechaasignacion.' con los siguientes comentarios: '.$comentarios;

        }else{
            //echo $respuesta;
            echo 'noData';
            exit();
        }

        
    }else{
        echo 'invalidRole';
        exit();
    }

} else{
    //Regresa a la página inicial
    header("location: ../index.php");
    exit();
}

?>
