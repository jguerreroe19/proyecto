<?php
//Incluyendo archivos externos
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(($_SERVER["REQUEST_METHOD"] == "POST")){
    
    //Obteniendo datos del formulario
    $idusuario =  $_POST["idusuario"];
    $newrol =  $_POST["newrol"];
    $idsesion =  $_POST["idsesion"];
    $idrol =  $_POST["idrol"];

    

    //Validando que se trate de rol administrador o profesor
    if ($idrol == 3 || $idrol == 2){
            //Llama la función para actualizar el rol
            $respuesta = updateRole($dbh, $idusuario, $newrol, $idsesion);
            echo $respuesta;
            exit();
    }else{
        echo 'invalidRole';
    }

} else{
    //Regresa a la página inicial
    //echo "entra aqui";
    header("location: ../index.php");
    exit();
}
   