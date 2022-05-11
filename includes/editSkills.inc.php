<?php
    //Incluyendo archivos externos
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

if(isset($_POST["submit"])){
    //Obtiene los datos del formulario
    $tipo = $_POST["tipo"];
    $skill = $_POST["Habilidad"];
	$nivel = $_POST["nivel"];
    $idusuario = $_POST["iduser"];
    $idsesion =  $_POST["idsesion"];

    echo '</br> $tipo: '.$tipo;
    echo '</br> $skill: '.$skill;
    echo '</br> $nivel: '.$nivel;
    echo '</br> $idusuario: '.$idusuario;
   
    //Llamando a la función para guaradar los cambios
    UpdateSkill($dbh, $tipo, $skill, $nivel, $idusuario, $idsesion);

} else{
    //Regresa a la página inicial
    header("location: ../index.php");
    exit();
}

?>
