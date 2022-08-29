<?php
if(($_SERVER["REQUEST_METHOD"] == "POST")){
    //Obtiene los datos del formulario
	$idusuario = $_POST["iduser"];
    
    //Incluyendo archivos externos
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
	
	echo '<h2>Lista de habilidades y conocimientos</h2>';
	//Armando la tabla de datos a mostrar
	echo '<table><tr><th>Tipo</th><th>Idioma</th><th>Tecnología</th><th>Nivel</th></tr>';
    echo skillsTable($dbh, $idusuario);
    echo '</table>';

} else{
    //Regresa a la página inicial
    header("location: ../index.php");
    exit();
}

?>