<?php
    //Incluyendo archivos externos
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(($_SERVER["REQUEST_METHOD"] == "POST")){
        //Obtiene los datos del formulario
        $tipo = $_POST["tipo"];
        $skill = $_POST["skill"];
        $idusuario = $_POST["idusuario"];
        $idsesion =  $_POST["idsesion"];
        
        //Llamando la función para eliminar la habilidad
        $resultado = DeleteSkill($dbh, $tipo, $skill, $idusuario, $idsesion);
        echo $resultado;

    } else{
        //Regresa a la página inicial
        header("location: ../index.php");
        exit();
    }



?>