<?php
if(($_SERVER["REQUEST_METHOD"] == "POST")){
	//Incluyendo archivos externos
	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';

    //Obtiene los datos del formulario
    $opcion = $_POST["Tipo"];
    $iduser = $_POST["iduser"];

	if ($opcion == 'Idioma'){
		$query = ("SELECT I.ididioma id, I.nombre
					FROM idiomas I
					WHERE NOT EXISTS (SELECT * FROM skills S WHERE S.IDUSUARIO = :usuario AND I.IDIDIOMA = S.IDIDIOMA)");
	} elseif ($opcion == 'Habilidad'){
		$query = ("SELECT T.idtecnologia id, T.nombre
					FROM tecnologias T
					WHERE NOT EXISTS (SELECT * FROM skills S WHERE S.IDUSUARIO = :usuario AND T.IDTECNOLOGIA= S.IDTECNOLOGIA)");
	}
	try{
		//Preparando la sentencia
		$sentencia = $dbh->prepare($query);
		//Parámetros
		$sentencia->bindParam(':usuario', $iduser);
    
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
			if ($opcion == 'Idioma'){
				echo '[{"id":"true","nombre":"noLang"}]';
			}elseif ($opcion == 'Habilidad') {
					echo '[{"id":"true","nombre":"noSkill"}]';
			}
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