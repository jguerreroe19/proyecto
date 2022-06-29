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

    //Validando campos con el valor "Selecciona una opción"
    if($tipo2 == "Selecciona"){
        header("location: ../enterSkills.php?error=wrongdata");
        exit();
    }
    if($tipo3 == "Selecciona"){
        header("location: ../enterSkills.php?error=wrongdata");
        exit();
    }
    
	
	//Llamando la función para guardar el skillz
    RecordSkill($dbh, $tipo2, $tipo3, $idusuario, $tipo);
		

} else{
    //Regresa a la página inicial
    header("location: ../index.php");
    exit();
}

?>