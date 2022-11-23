<?php
if(($_SERVER["REQUEST_METHOD"] == "POST")){
	//Incluyendo archivos externos
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
	
	//Obtiene los datos del formulario
    $tipo = $_POST["opcion"];
	$tipo2 = $_POST["Tipo2"];
    $tipo3 = $_POST["Tipo3"];
	$idusuario = $_POST["iduser"];
	$idsesion = $_POST["idsesion"];
	
	if(empty($tipo) || empty($tipo2) || empty($tipo3) || empty($idusuario) || empty($idsesion)){
		echo 'emptyValues';
		exit();
    } else {
		
		//Validando entre Idioma o Habilidad
		if ($tipo == 'Idioma'){
				$queryExist = "SELECT idskill FROM skills WHERE tipo = '".$tipo."' AND idusuario = ".$idusuario." AND ididioma = ".$tipo2;
                $query = "INSERT INTO skills (idusuario, creadopor, ididioma, idnivel, tipo) VALUES (:idusuario, :idcreadopor, :idtecnologia, :idnivel, :tipo)";
		} elseif ($tipo == 'Habilidad') {
                $queryExist = "SELECT idskill FROM skills WHERE tipo = '".$tipo."' AND idusuario = ".$idusuario."  AND idtecnologia = ".$tipo2;
				$query = "INSERT INTO skills (idusuario, creadopor, idtecnologia, idnivel, tipo) VALUES (:idusuario, :idcreadopor, :idtecnologia, :idnivel, :tipo)";
		}

        //Validando si la habilidad ya fue previamente capturada
        $existe = skillExist($dbh, $queryExist);

        if ($existe != false){
            echo 'alreadyExist';
        }else{
            try{
                //Preparando la sentencia SQL
                $sentencia = $dbh->prepare($query);
                //Parámetros
                $sentencia->bindParam(':idusuario', $idusuario);
                $sentencia->bindParam(':idcreadopor', $idusuario);
                $sentencia->bindParam(':idtecnologia', $tipo2);
                $sentencia->bindParam(':idnivel', $tipo3);
                $sentencia->bindParam(':tipo', $tipo);
                
                //Registrando el movimiento en la BD            
                movimientos($dbh, $idsesion, 'ADD SKILL'.$tipo);
                        
                //Ejecutando la sentencia
                $sentencia->execute();
                echo 'success';
    
    
            } catch (PDOException $e){
                echo 'error';
                ErrorLog($dbh, $idsesion, 'Error al tratar de guardar la habilidad'.$e, 'ISE_019');   
            } 
        }
		
	}	

} else{
    //Regresa a la página inicial
    header("location: ../index.php");
    exit();
}

?>