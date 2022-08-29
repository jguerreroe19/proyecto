<?php
//Incluyendo archivos externos
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(($_SERVER["REQUEST_METHOD"] == "POST")){
    //Obtiene los datos del formulario
    $idsesion = $_POST["idsesion"];
    $pwd = $_POST["pwd"];
    $usrid = $_POST["usrid"];
    
    $result='';

    $result=resetPwd($dbh, $idsesion, $pwd, $usrid);
    if ($result != false){
        echo 'OK';
    }else {
        echo 'failed';
    }

} else{
    //Regresa a la página inicial
    //echo "entra aqui";
    header("location: ../index.php");
    exit();
}

?>

