<?php
if(($_SERVER["REQUEST_METHOD"] == "POST")){
    //Incluyendo archivos externos
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //Obtiene los datos del formulario
    $dsesion = $_POST["dsesion"];
    $notificacion = $_POST["notificacion"];
    $registro = $_POST["registro"];
    $idrol = $_POST["idrol"];
    $idsesion = $_POST["idsesion"];
    
    //Validando que se trate de rol administrador
    if ($idrol = 3){
        //Validando que haya cambios en los datos del formulario vs los de la BD
        if (obtieneParametro($dbh, 'expiracion') == $dsesion && obtieneParametro($dbh, 'notificacion') == $notificacion && obtieneParametro($dbh, 'registro') == $registro){
            echo 'noChanges';
            exit();
        }else{
            //Actualizando los parámetros
            $respuesta = actualizaParametro($dbh, 'expiracion', $dsesion, $idsesion);
            $respuesta = $respuesta.actualizaParametro($dbh, 'notificacion', $notificacion, $idsesion);
            $respuesta = $respuesta.actualizaParametro($dbh, 'registro', $registro, $idsesion);
            echo $respuesta;
            exit();
        }
    }else{
        echo 'EL rol actual no tiene privilegios para realizar esta acción. Pongase en contacto con el administrador';
        exit();
    }

} else{
    //Regresa a la página inicial
    header("location: ../index.php");
    exit();
}

?>