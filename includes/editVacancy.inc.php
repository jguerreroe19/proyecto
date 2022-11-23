<?php
    //Incluyendo archivos externos
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(($_SERVER["REQUEST_METHOD"] == "POST")){
        //Obtiene los datos del formulario
        $titulo = $_POST["titulo"];
        $detalles = $_POST["detalles"];
        $pdate = $_POST["pdate"];
        $edate = $_POST["edate"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $idvacante = $_POST["idvacante"];
        $idsesion = $_POST["idsesion"];
        $idrol =  $_POST["idrol"];

        //Si la fecha de publicación es mayor o igual que la fecha de expiración.
        if($pdate >= $edate){
            echo 'invalidaDates';
        }else if (emptyVacancy($dbh, $titulo, $detalles, $phone, $email) != false){
            echo 'emptyFields';
        }else{
            //Actualiza la vacante
            $resultado = updateVacancy($dbh, $titulo, $detalles, $pdate, $edate, $phone, $email, $idvacante, $idsesion, $idrol);
            echo $resultado;
        }

        

    } else{
        //Regresa a la página inicial
        header("location: ../index.php");
        exit();
    }

?>
