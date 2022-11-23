<?php
    //Incluyendo archivos externos
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(($_SERVER["REQUEST_METHOD"] == "POST")){
        //Obtiene los datos del formulario
        $idcongreso = $_POST["idcongreso"];
        $idrol = $_POST["idrol"];
        $idsesion = $_POST["idsesion"];
        
        //Validando que se trate de rol profesor
        if ($idrol = 2 ){
            //Llamando la función para eliminar el congreso
            $resultado = DeleteCongress($dbh, $idcongreso, $idsesion);
            echo $resultado;
        }else{
            echo 'invalidRole';
            exit();
        }

    } else{
        //Regresa a la página inicial
        header("location: ../index.php");
        exit();
    }



?>