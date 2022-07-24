<?php
//Incluyendo archivos externos
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(($_SERVER["REQUEST_METHOD"] == "POST")){
    
    //Obteniendo datos del formulario
    $name =  $_POST["name"];
    $sname =  $_POST["sname"];
    $bdate =  $_POST["bdate"];
    $phone =  $_POST["phone"];
    $email =  $_POST["email"];
    $cphone =  $_POST["cphone"];
    $semEmp =  $_POST["semEmp"];
    $matricula =  $_POST["matricula"];
    $iduser =  $_POST["iduser"];
    $idsesion =  $_POST["idsesion"];
    $idrol =  $_POST["idrol"];
    
    //Validando campos obligatorios en blanco
    if(emptyInputPersonalInfo($name, $sname, $email) !== false){
        //header("location: ../profile.php?error=emptyinput");
        echo "<p>Los campos no pueden estar vacios</p>";
        //exit();
    }
    
    //Actualizando la información personal
    if (UpdatePersonalInfo($dbh, $name, $sname, $bdate, $phone, $email, $cphone, $semEmp, $matricula, $iduser, $idsesion, $idrol) === false){
        //header("location: ../profile.php?error=ISE_001");
        echo "<p>error ISE_001: No se pudieron actualizar los datos, vuelve a intentarlo</p>";
        //exit();
    }else{
        //header("location: ../profile.php?error=none");
        echo "<p>Datos actualizados exitosamente!</p>";
    }    

}else {
    header("location: ../index.php");
}