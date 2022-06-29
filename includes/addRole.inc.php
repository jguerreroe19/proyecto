<?php
if(isset($_POST["fname"])){
    
//Obteniendo datos del formulario
$name =  $_POST["fname"];
$sname =  $_POST["sname"];
$email =  $_POST["email"];
$idrol =  $_POST["idrol"];
$idusr =  $_POST["idusuario"];


//Variables de sesión
$idsesion = $_SESSION["sid"];

    //Incluyendo archivos externos
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    require_once 'functions2.inc.php';

    echo $name;
    echo $sname;
    echo $email;
    echo $idrol;

    //Validando que el rol sea distinto a 4
    if ($idrol ==4){
        header("location: ../addRole.php?error=nochanges");
    } else {
        updateRole($dbh, $idusr, $idrol, $idsesion);  
    }


}else {
    header("location: ../index.php");
}
   