<?php
//Incluyendo archivos externos
require_once 'dbh.inc.php';

if(($_SERVER["REQUEST_METHOD"] == "POST")){
    //Obtiene los datos del formulario
    $query = $_POST["query"];

//	$query = ("CALL SP_DATA_LENGTH");

	try{
		//Preparando la sentencia
		$sentencia = $dbh->prepare($query);
		
		//Ejecutando la sentencia
        $sentencia->execute();
		
		//Validando la cantidad de registros devueltos
		$cuenta = $sentencia->rowCount();
		
		if ($cuenta>0){
			$combov2 = $sentencia->fetchAll(PDO::FETCH_ASSOC);
			
			//Convirtiendo a json
			$respuesta = json_encode($combov2, JSON_UNESCAPED_SLASHES);
			echo $respuesta; //json_encode($respuesta);
            
		} else {
			echo '[{"id":"true","nombre":"noData"}]';
		}
		
        }catch (PDOException $e){
            $respuesta = ('Error al cargar los datos en el combobox2'.$e);
			echo $respuesta;
        }
	
} else{
    //Regresa a la página inicial
    //echo "entra aqui";
    header("location: ../index.php");
    exit();
}

?>