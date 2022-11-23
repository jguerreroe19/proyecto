<?php
//Incluyendo archivos externos
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(($_SERVER["REQUEST_METHOD"] == "POST")){
    
    //Obtiene los datos del formulario
    $idsesion = $_POST["idsesion"];
    $idrol =  $_POST["idrol"];
    $fechaini = $_POST["fechaInicio"];
    $fechafin = $_POST["fechaFin"];
       
    //Variable de retorno
    $result='';
    
    //Validando que se trate de rol administrador
    if ($idrol == 3){

        $query = "DELETE FROM logerrores where DATE(fechaerror) >= '".$fechaini."' AND DATE(fechaerror) <= '".$fechafin."'";

        //Llamando a la función para contar los registros
        $respuesta = depuraRegistros($dbh, $idsesion, $query, 'ERRORES');
        
        echo $respuesta;    
        exit();

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

