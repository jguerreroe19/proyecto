<?php
//Incluyendo archivos externos
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

	if(($_SERVER["REQUEST_METHOD"] == "POST")){
		//Obteniendo los datos del archivo
        $file = $_FILES['uProfilefile'];
        $idusr = $_POST["iduserImg"];
        $idsesion = $_POST["idsesionImg"];

        
		//print_r($file);
		$fileName = $file['name'];
		$fileTmpName = $file['tmp_name'];
		$fileSize = $file['size'];
		$fileError = $file['error'];
		$fileType = $file['type'];
		
		$fileExt = explode('.', $fileName); //Dividiendo el nombre del archivo y la extensión en base al punto
		$fileActualExt = strtolower(end($fileExt)); //Convirtiendo la extensión a minúscula (la instrucción explode la guarda en un arreglo)
		
		$allowed = array('tif', 'pjp', 'xbm', 'jxl', 'svgz', 'jpg', 'jpeg', 'ico', 'tiff', 'gif', 'svg', 'jfif', 'webp', 'png', 'bmp', 'pjpeg', 'avif'); //Arreglo de extensiones permitidas
		
		if(in_array($fileActualExt, $allowed)) { // Si la extensión está permitida
			if($fileError === 0){ //Si no hubo errores al subir el archivo
				if($fileSize < 10485760) { //Si el archivo es mayor a 10 Megas (Lectura en bytes)
					$fileNameNew = $idusr.".".$fileActualExt; //Asignando un nuevo nombre al archivo a subir
					$fileDestination = '../img/uploads/'.$fileNameNew;
					move_uploaded_file($fileTmpName, $fileDestination); //Moviendo el archivo de la ubicación temporal a la definitiva
					//header("Location: index.php?uploadsuccess");
                    
                    //Actualiza el nombre del archivo en la base de datos
                    updateProfileImg($dbh, $idusr, $idsesion, $fileActualExt);
                    echo $fileDestination;
				} else {
					echo "errorSize";
				}
			} else {
				echo "errorUpload";
			}
				
		}else{
			echo "errorFileType";
		}
			
		
	}else{
        //Regresa a la página inicial
        //echo "entra aqui";
        header("location: ../index.php");
        exit();
    }