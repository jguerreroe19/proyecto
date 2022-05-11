<!doctype html>
<html lang="es" dir="ltr"> 
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PRUEBAS</title>
    
    <!--Local Stylesheet -->
    <link rel="stylesheet" type="text/css" href="css/styles.css">

</head>
<body>
<?php
	require_once 'includes/dbh.inc.php';
    require_once 'includes/functions.inc.php';
	//require_once 'include/func.inc.php';

	//echo getIPAddress();
	
	//phpinfo();
	
	echo 'INICIANDO EL PROGRAMA </br>';
	loginUser2 ($dbh, 'jguerreroe@gmail.com', '123');
	echo 'DESPUÉS DE LA FUNCIÓN </br>';
	
			echo '</br>';
			echo $_SESSION["userid"];
			echo '</br>';
			echo $_SESSION["usernombre"];
			echo '</br>';
			echo $_SESSION["typeRol"];
			echo '</br>';
			echo $_SESSION["idrol"]; 
			echo '</br>';
			echo $_SESSION["idusuario"];
			echo '</br>';
			echo $_SESSION["sid"];
	
	
	
//Función para realizar el proceso de login
    function loginUser2($dbh, $email, $pwd){
        echo 'ENTRANDO EN LA FUNCIÓN </br>';
        
        try{
            $sentencia = $dbh->prepare("SELECT U.*, R.nombre nombrerol FROM usuarios U, roles R 
                        WHERE U.idrol = R.idrol 
                        AND (U.fechafin < current_date() OR U.fechafin IS NULL) 
                        AND (U.bloqueado <> 'Y' OR U.bloqueado  IS NULL)
                        AND U.email = :email");
            $sentencia->bindParam(':email', $email);
            //Ejecutando la sentencia
            $sentencia->execute();
            //Obteniendo los datos
            $usuarios = $sentencia->fetch(PDO::FETCH_ASSOC);

            //Obteniendo la contraseña guardada en la base de datos
            $hashedPwd = $usuarios["CONTRASENA"];
            $checkPwd = password_verify($pwd, $hashedPwd);

            //Si la contraseña ingresada conincide con la almacenada en la BD
            if($checkPwd === true){
				echo 'SI SON IGUALES </br>';
				echo '$usuarios["IDUSUARIO"]: '.$usuarios["IDUSUARIO"].'</br>';
				$ip = getIPAddress();
				echo 'IP: '.$ip.'</br>';
				
                $creasesion = CreateSessionID($dbh,$usuarios["IDUSUARIO"], $ip);
				echo '</br>Sesion creada: '.$creasesion.'</br>';
				
				//Generando el registro de sesión en la BD
				
                if ($creasesion === true){

                    //Obteniendo el número de sesión para inicializarlo en PHP
                    $sid = GetSessionID($dbh,$usuarios["IDUSUARIO"]);
					echo 'sesion id: '.$sid.'</br>';
					
                    if ($sid > 0) {
                        session_id($sid);
                        session_start();
                        $_SESSION["userid"] = $usuarios["EMAIL"];
                        $_SESSION["usernombre"] = $usuarios["NOMBRE"];
                        $_SESSION["typeRol"] = $usuarios["nombrerol"];
                        $_SESSION["idrol"] = $usuarios["IDROL"];
                        $_SESSION["idusuario"] = $usuarios["IDUSUARIO"];
                        $_SESSION["sid"] = $sid;
                        //header("location: ../index.php");
                        //exit();
                    } else {
                        //ErrorLog($dbh, $idsesion, 'No se pudieron obtener los detalles de la sesión', 'OSE_001');
                        //header("location: ../?error=OSE_001");
                        //exit();
						echo 'ERROR SESION</br>';
                    }
                } else {
                    //ErrorLog($dbh, $idsesion, 'No fue posible generar la sesión', 'OSE_002');
                    //header("location: ../?error=OSE_002");
                    //exit();
					echo 'SESION FALSE</br>';
				}
				
            } else if($checkPwd === false) {
                echo 'NO SON </br>';
				//header("location: ../index.php?error=wronglogin");
                //exit();
            }
		}catch (PDOException $e){
            echo 'ERROR: '. $e;
			//ErrorLog($dbh, $idsesion, 'Error en el proceso de login '.$e, 'OSE_005');
        }
		
    }
	
	
?>
</body>
</html>