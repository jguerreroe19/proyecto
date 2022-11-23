<?php
if(($_SERVER["REQUEST_METHOD"] == "POST")){
    //Incluyendo archivos externos
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    
	//Obtiene los datos del formulario
    $opcion = $_POST["Tipo"];

	try{	
		//Preparando la sentencia
		$sentencia = $dbh->prepare("SELECT idnivel, nivel FROM niveles WHERE TIPO = :opcion ORDER BY idnivel");
		//Parámetros
		$sentencia->bindParam(':opcion', $opcion);
		//Ejecutando la sentencia
		$sentencia->execute();
		
		//Validando la cantidad de registros devueltos
		$cuenta = $sentencia->rowCount();
		
		
		$combov3 = $sentencia->fetchAll(PDO::FETCH_ASSOC);
			
		//Convirtiendo a json
		$respuesta = json_encode($combov3, JSON_UNESCAPED_SLASHES);
		echo $respuesta; //json_encode($respuesta);
		
        }catch (PDOException $e){
            $respuesta = ('Error al cargar los datos en el combobox2'.$e);
			echo $respuesta;
        }
	
} else{
    //Regresa a la página inicial
    header("location: ../index.php");
    exit();
}

?>