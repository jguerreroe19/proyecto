<?php
if(isset($_POST["submit"])){
    //Obtiene los datos del formulario
    $tipo2 = $_POST["Tipo2"];
    $tipo3 = $_POST["Tipo3"];
	$idusuario = $_POST["iduser"];
	$tipo = $_POST["opcion"];
	
	
    
    //Incluyendo archivos externos
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //Validando campos vacios y en caso de haberlos agrega el identificador de error en la URL
    /*if(emptyInputLogin($tipo2, $tipo3) !== false){
        header("location: ../index.php?error=emptyinput");
        exit();
    }
    */
	
	//Llamando la función para relizar el login
    RecordSkill($dbh, $tipo2, $tipo3, $idusuario, $tipo);
		

} else{
    //Regresa a la página inicial
    header("location: ../index.php");
    exit();
}

?>