<?php
//Incluyendo archivos externos
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(($_SERVER["REQUEST_METHOD"] == "POST")){
    //Obtiene los datos del formulario
    $idsesion = $_POST["idsesion"];
    $idrol = $_POST["idrol"];
    $usr2Unlock = $_POST["usr2Unlock"];
    
    $result='';

    //Validando que se trate de rol administrador o profesor
    if ($idrol = 2 || $idrol = 3){
        //Llamando la función para generar la tabla 
        if (unlockUser($dbh, $idsesion, $usr2Unlock)){
           echo 'done';
        } else{
           echo 'Error';
        }
    }else{
        echo 'invalidRole';
        exit();
    }

} else{
    //Regresa a la página inicial
    //echo "entra aqui";
    header("location: ../index.php");
    exit();
}

?>

