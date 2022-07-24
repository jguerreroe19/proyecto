<?php
//Incluyendo archivos externos
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(($_SERVER["REQUEST_METHOD"] == "POST")){
    //Obtiene los datos del formulario
    $cname = $_POST["cname"];
    $details = $_POST["details"];
    $vflag = $_POST['mine'];
    $actFlag = $_POST['activo'];
    
    //Validando los valores de los checkbox
    if($vflag == 'true'){
        $vflag = 'Y';
    } else {
        $vflag = 'N';
    }

    if($actFlag == 'true'){
        $actFlag = 'Y';
    } else {
        $actFlag = 'N';
    }

    $idusuario = $_POST["iduser"];
    $idrol = $_POST["idrol"];
    
    /*
    echo '$vflag: ' . $vflag;
    echo '</br>' ;
    echo '$actFlag: ' . $actFlag;
    echo '</br>' ;
    */
	
	//Llamando la función para guardar la vacante
    queryCongressTable($dbh, $cname, $details, $vflag, $actFlag, $idusuario, $idrol);

    //echo $valor;
		

} else{
    //Regresa a la página inicial
    //echo "entra aqui";
    header("location: ../index.php");
    exit();
}

?>

