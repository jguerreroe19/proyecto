<?php
    //Incluyendo archivos externos
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(($_SERVER["REQUEST_METHOD"] == "POST")){
        //Obtiene los datos del formulario
        $tipo = $_POST["tipo"];
        $skill = $_POST["skill"];
        $nivel = $_POST["nivel"];
        $idusuario = $_POST["idusuario"];
        $idsesion =  $_POST["idsesion"];

        //Llamando a la función para validar si hay cambios en lo ingresado por el usuario
        if (validateSkill($dbh, $tipo, $skill, $nivel, $idusuario, $idsesion) != false){
            $resultado = 'noCambios';
        }else{
            //Llamando a la función para guaradar los cambios
            $resultado = UpdateSkill($dbh, $tipo, $skill, $nivel, $idusuario, $idsesion);        
        }

        echo $resultado;


    } else{
        //Regresa a la página inicial
        header("location: ../index.php");
        exit();
    }

?>
