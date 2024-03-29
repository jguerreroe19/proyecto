<?php
    //Función para validar campos vacios en la forma de login
    function emptyInputLogin($username, $pwd){
        $result;
        if(empty($username) || empty($pwd)){
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    //Función para validar los campos vacios en la forma de registro
    function emptyInputSignup($uname, $name, $pwd, $pwdRepeat){
        $result;
        if(empty($uname) || empty($name) || empty($pwd)|| empty($pwdRepeat)){
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    //Función para validar campos vacios en la forma de información personal
    function emptyInputPersonalInfo($name, $sname, $email) {
        $result;
        if(empty($name) || empty($sname) || empty($email)){
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    //Función para validar que las contraseñas ingresadas coincidan
    function pwdMatch($pwd, $pwdRepeat){
        $result;
        if($pwd !== $pwdRepeat){
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }


    //Función para validar si existe el usuario dentro de la base de datos
    function uidExist($dbh, $email){
        //Variable para almacenar el resultado
        $result;
        //Preparando la sentencia SQL
        $sentencia = $dbh->prepare("SELECT * FROM usuarios WHERE email = :email");
        //Definiendo los parámetros
        $sentencia->bindParam(':email', $email);
        //Ejecutando la sentencia
        $sentencia->execute();
        //Obteniendo los datos
        //$usuarios = $sentencia->fetch(PDO::FETCH_ASSOC);
         
        //Valiando si trae datos la búsqueda
        $cuenta = $sentencia->rowCount();
            
        if($cuenta >= 1){
            return $cuenta;
        } else {
            $result = false;
            return $result;
        }
    }

    //Función para validar si la habilidad ya está asignada al usuario
    function skillExist($dbh, $query){
        //Variable para almacenar el resultado
        $result;
        //Preparando la sentencia SQL
        $sentencia = $dbh->prepare($query);
        
        //Ejecutando la sentencia
        $sentencia->execute();
         
        //Valiando si trae datos la búsqueda
        $cuenta = $sentencia->rowCount();
            
        if($cuenta >= 1){
            return $cuenta;
        } else {
            $result = false;
            return $result;
        }
    }

    //Función para validar si existe la vancante capturada dentro de la base de datos
    function vacancyExist($dbh, $title, $details){
        //Variable para almacenar el resultado
        $result;

        //Preparando la sentencia SQL
        $sentencia = $dbh->prepare("SELECT * FROM vacantes WHERE titulo = :title OR detalles = :details");
        
        //Definiendo los parámetros
        $sentencia->bindParam(':title', $title);
        $sentencia->bindParam(':details', $details);
        
        //Ejecutando la sentencia
        $sentencia->execute();
                 
        //Valiando si trae datos la búsqueda
        $cuenta = $sentencia->rowCount();
            
        if($cuenta >= 1){
            return $cuenta;
        } else {
            $result = false;
            return $result;
        }
    }

    //Función para validar si existe el congreso capturada dentro de la base de datos
    function congressExist($dbh, $cname){
        //Variable para almacenar el resultado
        $result;
        //Preparando la sentencia SQL
        $sentencia = $dbh->prepare("SELECT * FROM congresos WHERE nombre = :cname");
        //Definiendo los parámetros
        $sentencia->bindParam(':cname', $cname);
        //Ejecutando la sentencia
        $sentencia->execute();
                 
        //Valiando si trae datos la búsqueda
        $cuenta = $sentencia->rowCount();
            
        if($cuenta >= 1){
            return $cuenta;
        } else {
            $result = false;
            return $result;
        }
    }

    //Función para validar la estructura de la contraseña
    function invalidPwd($clave){
            $contar = 0;
            $error_clave ="";
           if(strlen($clave) < 8){
              $error_clave = $error_clave."La contraseña debe tener al menos 8 caracteres <br>";
           }
    
           if(strlen($clave) > 16){
              $error_clave = $error_clave."La contraseña no puede tener más de 16 caracteres<br>";
           }
    
           if (!preg_match('`[a-zA-Z]`',$clave)){
              $error_clave = $error_clave."La contraseña debe tener al menos una letra<br>";
              $contar++;
           }
           
           if (!preg_match('`[0-9]`',$clave)){
              $error_clave = $error_clave."La contraseña debe tener al menos un caracter numérico<br>";
              $contar++;
           }
           if ((strpos($clave, '$') !== false) || (strpos($clave, '#') !== false) || (strpos($clave, '-') !== false) || (strpos($clave, '_') !== false) || (strpos($clave, '&') !== false) || (strpos($clave, '%') !== false)) {
                //echo 'true';
            } else {
                $error_clave = $error_clave."La contraseña debe tener al menos un caracter especial (#,$,-,_,&,%) <br>";
                $contar++;
            }
           
            $expresion = '/^[a-zA-Z0-9-_#$&%]{8,16}$$/i'; // Valida la longitud de 8 a 16 caracteres, los caracteres admitidos
            $resultado = preg_match($expresion, $clave);
            if(!$resultado) {
              $contar++;
            } 
    
            if($contar > 0){
                return $error_clave;
            } else {
                $error_clave = false;
                return $error_clave;
            }
    }

    //Función para crear el nuevo usuario
    function createUser($dbh, $name, $sname, $email, $pwd){
        $result;
        try{
        //Preparando la sentencia SQL
        $sentencia = $dbh->prepare("INSERT INTO usuarios (nombre, apellidos, email, contrasena, idrol) VALUES (:name, :sname, :email, :pwd, 4)");
        $sentencia->bindParam(':name', $name);
        $sentencia->bindParam(':sname', $sname);
        $sentencia->bindParam(':email', $email);

        //Encriptando la contraseña
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT); 
        $sentencia->bindParam(':pwd', $hashedPwd);
        
        //Ejecutando la sentencia
        $sentencia->execute();
        $result = 'true';
        return $result;
        //header("location: ../signup.php?error=none&name=&sname=&email=");
        } catch (PDOException $e){
            //$sentencia->rollback();
            //throw $e;
            //header("location: ../signup.php?error=stmtfailed");
            $result = false;
            $vencode = urlencode($e->getMessage());
		    $valorLocation = 'location: ../signup.php?error=stmtfailedinc&msg1='.$vencode;
            header($valorLocation);
            return $result;
        } 
    }

    //Función para realizar el proceso de login
    function loginUser($dbh, $email, $pwd){
        //Variable de retorno
        $respuesta;
        //Preparando la sentencia SQL
        /*
            La sentencia valida que el usuario no esté inactivo (fechafin) o que esté bloqueado, de ser así ya no traerá datos.
            Por lo tanto no se logrará establecer el login 
        */
        //Valida si existe el usuario
        $existe = uidExist($dbh, $email);
        if ($existe != false){
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
                    $ip = getIPAddress();
                    //Generando el registro de sesión en la BD
                    if (CreateSessionID($dbh,$usuarios["IDUSUARIO"], $ip)){

                        //Obteniendo el número de sesión para inicializarlo en PHP
                        $sid = GetSessionID($dbh,$usuarios["IDUSUARIO"]);
                        if ($sid > 0) {
                            session_id($sid);
                            session_set_cookie_params(0);
                            session_start();
                            //Variables para gestionar el tiempo de inactividad
                            $_SESSION['logged_in'] = true; //Define que la sesión está activa
                            $_SESSION['last_activity'] = time(); //Establece la hora en la que se inició la sesión (o la última actividad)
                            
                            //Llama a la función para obtener el valor del parámetro actual de duración de la sesión
                            $tiempoSesion = obtieneParametro($dbh, 'expiracion');
                            $_SESSION['expire_time'] = $tiempoSesion; //Tiempo de expiración en segundos

                            //Variables globales de la sesión actual
                            $_SESSION["userid"] = $usuarios["EMAIL"];
                            $_SESSION["usernombre"] = $usuarios["NOMBRE"];
                            $_SESSION["typeRol"] = $usuarios["nombrerol"];
                            $_SESSION["idrol"] = $usuarios["IDROL"];
                            $_SESSION["idusuario"] = $usuarios["IDUSUARIO"];
                            $_SESSION["sid"] = $sid;
                            //echo 'success';
                            header("location: ../index.php");
                            exit();
                        } else {
                            ErrorLog($dbh, $idsesion, 'No se pudieron obtener los detalles de la sesión', 'OSE_001');
                            //$respuesta = 'Error OSE_001: No se pudieron obtener los detalles de la sesión';
                            //return $respuesta;
                            //echo 'error';
                            header("location: ../?error=OSE_001");
                            exit();
                        }
                    } else {
                        ErrorLog($dbh, $idsesion, 'No fue posible generar la sesión', 'OSE_002');
                        //$respuesta = 'Error OSE_002: No fue posible generar la sesión';
                        //return $respuesta;
                        header("location: ../?error=OSE_002");
                        //echo 'error';
                        exit();
                        
                    }
                } else if($checkPwd === false) {
                    //$respuesta = 'Datos de acceso incorrectos';
                    //return $respuesta;
                    header("location: ../index.php?error=wronglogin");
                    //echo 'wronglogin';
                    exit();
                }
            }catch (PDOException $e){
                ErrorLog($dbh, $idsesion, 'Error en el proceso de login '.$e, 'OSE_005');
            }
        }else{
            //echo 'wronglogin';
            header("location: ../index.php?error=wronglogin");
            exit();
        }
    }

    //Función para obtener el valor de los parámetros de configuración
    function obtieneParametro($dbh, $parametro){
        //$parametro = 'expiracion';
        //Preparando la sentencia SQL
        try{
        $sentencia = $dbh->prepare("SELECT valor FROM configuracion WHERE parametro = :param");
        $sentencia->bindParam(':param', $parametro);

        //Ejecutando la sentencia
        $sentencia->execute();
        //Obteniendo los datos
        $resultados = $sentencia->fetch(PDO::FETCH_ASSOC);
        $valor = $resultados["valor"];
        return $valor;
        } catch (PDOException $e){
            $valor = null;
            return $valor;
        } 
    }

    //Función para obtener el valor de los parámetros de configuración
    function actualizaParametro($dbh, $parametro, $valor, $idsesion){
        //Preparando la sentencia SQL
        try{
            $sentencia = $dbh->prepare("UPDATE configuracion SET valor = :val WHERE parametro = :param");
            
            //Definiendo parámetros
            $sentencia->bindParam(':val', $valor);
            $sentencia->bindParam(':param', $parametro);
    
            //Ejecutando la sentencia
            $sentencia->execute();
            
            //Registrando el movimiento en la BD
            movimientos($dbh, $idsesion, 'UPDATE CONFIGURACION - Parámetro: '.$parametro.' / Valor: '.$valor);

            //Devolviendo el valor
            return 'done';

        } catch (PDOException $e){
                return 'Error: '.$e;
        } 
    }

    //Función para actualizar la información personal
    function UpdatePersonalInfo($dbh, $name, $sname, $bdate, $phone, $email, $cphone, $semEmp, $matricula, $iduser, $idsesion, $idrol){
        $confirm;
        //Preparando la sentencia SQL
        try{
            if ($idrol == 1){
                    $sentencia = $dbh->prepare("UPDATE usuarios SET 
                                                nombre = :name
                                                , apellidos = :sname
                                                , fechanacimiento = :bdate
                                                , telefono = :phone
                                                , email = :email
                                                , telcontacto = :cphone
                                                , semestre = :semEmp
                                                , numeromatricula = :matricula 
                                                WHERE idusuario = :iduser");
                }else{
                    $sentencia = $dbh->prepare("UPDATE usuarios SET 
                                                nombre = :name
                                                , apellidos = :sname
                                                , fechanacimiento = :bdate
                                                , telefono = :phone
                                                , email = :email
                                                , telcontacto = :cphone
                                                , numeroempleado = :semEmp
                                                , numeromatricula = :matricula 
                                                WHERE idusuario = :iduser");
                }
            $sentencia->bindParam(':name', $name);
            $sentencia->bindParam(':sname', $sname);
            $sentencia->bindParam(':bdate', $bdate);
            $sentencia->bindParam(':phone', $phone);
            $sentencia->bindParam(':email', $email);
            $sentencia->bindParam(':cphone', $cphone);
            $sentencia->bindParam(':semEmp', $semEmp);
            $sentencia->bindParam(':matricula', $matricula);
            $sentencia->bindParam(':iduser', $iduser);
            
            //Ejecutando la sentencia
            $sentencia->execute();
            movimientos($dbh, $idsesion, 'UPDATE USUARIOS - PERSONAL INFO');
            
            //Devolviendo el valor
            $confirm = true;
            return $confirm;

        } catch (PDOException $e){
            ErrorLog($dbh, $idsesion, 'No fue posible actualizar la información personal '.$e, 'ISE_001');
            $confirm = false;
            return $confirm;
        } 
    }

    //Función para CREAR el ID de sesión en la BD
    function CreateSessionID($dbh, $idusuario, $host){
        $confirm;
        //Preparando la sentencia SQL
        try{
        $sentencia = $dbh->prepare("INSERT INTO bitacora (idusuario, host) VALUES (:idusuario, :host)");
        $sentencia->bindParam(':idusuario', $idusuario);
        $sentencia->bindParam(':host', $host);

        //Ejecutando la sentencia
        $sentencia->execute();
        $confirm = true;
        return $confirm;
        
        } catch (PDOException $e){
            $confirm = false;
            return $confirm;
        } 
    }

    //Función para obtener el número de ID de sesión
    function GetSessionID($dbh, $idusuario){
        $sid;
        //Preparando la sentencia SQL
        try{
        $sentencia = $dbh->prepare("SELECT MAX(idsesion) idsesion, idusuario
                                    FROM bitacora
                                    WHERE idusuario = :idusuario");
        $sentencia->bindParam(':idusuario', $idusuario);
        //Ejecutando la sentencia
        $sentencia->execute();
        //Obteniendo los datos
        $sesion = $sentencia->fetch(PDO::FETCH_ASSOC);
        $sid = $sesion["idsesion"];
        return $sid;
        } catch (PDOException $e){
            $sid = 0;
            return $sid;
        } 
    }

    //Función para cerrar la sesión actual en la BD
    function CloseSessionID($dbh){
        $sesid = $_SESSION["sid"];
        $idusuario = $_SESSION["idusuario"];
        //Preparando la sentencia SQL
        try{
            $sentencia = $dbh->prepare("UPDATE bitacora SET fechafin = current_timestamp() 
                                        WHERE idusuario = :idusuario AND idsesion = :sesid");
            $sentencia->bindParam(':idusuario', $idusuario);
            $sentencia->bindParam(':sesid', $sesid);
            //Ejecutando la sentencia
            $sentencia->execute();
            return $sesid;
            } catch (PDOException $e){
                $sesid = 0;
                return $sesid;
            } 
    }

    //Función para insertar en el log de erroes
    function ErrorLog($dbh, $idsesion, $msg, $code){
        //Preparando la sentencia SQL
        try{
            $sentencia = $dbh->prepare("INSERT INTO logerrores(idsesion, mensaje, código) VALUES (:sesid, :msg, :code)");
            $sentencia->bindParam(':sesid', $idsesion);
            $sentencia->bindParam(':msg', $msg);
            $sentencia->bindParam(':code', $code);
            //Ejecutando la sentencia
            $sentencia->execute();
            return 'OK';
            } catch (PDOException $e){
                return 'Error: '.$e;
            } 
    }

    //Función para insertar en la tabla de movimientos
    function movimientos($dbh, $idsesion, $tipo){
        try{
            $sentencia = $dbh->prepare("INSERT INTO movimientos(idsesion, tipomovimiento) VALUES (NVL(:sesid,1), :tipomov)");
            $sentencia->bindParam(':sesid', $idsesion);
            $sentencia->bindParam(':tipomov', $tipo);
            //Ejecutando la sentencia
            $sentencia->execute();
            } catch (PDOException $e){
                ErrorLog($dbh, $idsesion, 'Error al registrar el movimiento en la BD '.$e, 'ISE_002');
            } 
    }

    //Función para obtener la dirección IP del cliente que ingresó al sistema
    function getIPAddress() {  
        //Si la IP es compartida   
         if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                    $ip = $_SERVER['HTTP_CLIENT_IP'];  
            }  
        //Si la IP es de un proxy
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
         }  
       //Si la IP es una dirección remota
        else{  
                 $ip = $_SERVER['REMOTE_ADDR'];  
         }  
         return $ip;  
    }  

    /*
    //Función para llenar el combobox de tipo de habilidad/conocimiento
    function fillComboBox($dbh){
        try{
            $sentencia = $dbh->prepare("SELECT DISTINCT tipo FROM niveles");
            //Ejecutando la sentencia
            $sentencia->execute();
            //Obteniendo los datos
		
			while ($combov1 = $sentencia->fetch(PDO::FETCH_ASSOC)) {
			?>
				<option value="<?php echo $combov1['tipo']?>"><?php echo $combov1['tipo']?></option>
			<?php
			}
        }catch (PDOException $e){
            echo('Error al cargar los datos en el combobox'.$e);
        }

    }
	*/
/*
	//Función para llenar el combobox de habilidades/idiomas
    function fillComboBox2($dbh, $opcion, $idusuario){
        //Variable para regresar la información 
        $respuesta='';
        $users_arr = array();

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
			$sentencia->bindParam(':usuario', $idusuario);
            //Ejecutando la sentencia
            $sentencia->execute();
			//Validando la cantidad de registros devueltos
			$cuenta = $sentencia->rowCount();
			if ($cuenta>0){
				//$combov2 = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                while ($combov2 = $sentencia->fetch(PDO::FETCH_ASSOC)) {
					$id = $combov2['id'];
                    $name = $combov2['nombre'];
                    //$respuesta = ($respuesta.'<option value="'.$combov2['id'].'">'.$combov2['nombre'].'</option>');
                    //Codificando en formato Json los resultados
                    //$respuesta = json_encode($combov2);
                    $users_arr[] = array("id" => $id, "name" => $name);
				}
			} else {
				if ($opcion == 'Idioma'){
					$respuesta = 'nolanguajes';
					//header("location: index.php?error=nolanguajes");
				}elseif ($opcion == 'Habilidad') {
					$respuesta = 'noskills';
					//header("location: index.php?error=noskills");
				}
			}
		return $respuesta;			
        }catch (PDOException $e){
            $respuesta = ('Error al cargar los datos en el combobox2'.$e);
			return $respuesta;
        }
    }
	
	//Función para llenar el combobox del nivel de las habilidades/idiomas
	function fillComboBox3($dbh, $opcion){
		//Variable para regresar la información 
        $respuesta='';
		try{
			//Preparando la sentencia
			$sentencia = $dbh->prepare("SELECT idnivel, nivel FROM niveles WHERE TIPO = :opcion ORDER BY idnivel");
			//Parámetros
			$sentencia->bindParam(':opcion', $opcion);
            //Ejecutando la sentencia
            $sentencia->execute();
            //Obteniendo los datos
			while ($combov3 = $sentencia->fetch(PDO::FETCH_ASSOC)) {
				
				$respuesta = ($respuesta.'<option value="'.$combov3['idnivel'].'">'.$combov3['nivel'].'</option>');
			}
			return $respuesta;
        }catch (PDOException $e){
            $respuesta = ('Error al cargar los datos en el combobox 3'.$e);
			return $respuesta;
        }
	}
	//Finción para registrar un skill en la base de datos
	function RecordSkill($dbh, $tipo2, $tipo3, $idusuario, $tipo){
		//Variable para regresar la información 
        $respuesta='';
		try{
			if ($tipo == 'Idioma'){
				$query = "INSERT INTO skills (idusuario, creadopor, ididioma, idnivel, tipo) VALUES (:idusuario, :idcreadopor, :idtecnologia, :idnivel, :tipo)";
			} elseif ($tipo == 'Habilidad') {
				$query = "INSERT INTO skills (idusuario, creadopor, idtecnologia, idnivel, tipo) VALUES (:idusuario, :idcreadopor, :idtecnologia, :idnivel, :tipo)";
			}
			
			//Preparando la sentencia SQL
			$sentencia = $dbh->prepare($query);
			//Parámetros
			$sentencia->bindParam(':idusuario', $idusuario);
			$sentencia->bindParam(':idcreadopor', $idusuario);
			$sentencia->bindParam(':idtecnologia', $tipo2);
			$sentencia->bindParam(':idnivel', $tipo3);
			$sentencia->bindParam(':tipo', $tipo);
					
			//Ejecutando la sentencia
			$sentencia->execute();
			$respuesta = 'success';
			return $respuesta;
			
			//header("location: ../index.php?error=none"); 
		} catch (PDOException $e){
			$respuesta = '<p>Error al tratar de guardar la habilidad. '.$e.'</p>';
			return $respuesta;
			
		} 
	}*/
  
	//Función para generar la tabla con el listado de habilidades y conocimientos
	function skillsTable($dbh, $idusuario){
		//Variable para regresar la información 
        $respuesta='';
		try{
			//Preparando la sentencia
			$sentencia = $dbh->prepare("SELECT S.tipo, NVL(I.nombre, '') idioma, NVL(T.nombre, '') tecnologia, N.nivel
										FROM skills S
										INNER JOIN niveles N ON S.IDNIVEL = N.IDNIVEL
										LEFT OUTER JOIN idiomas I ON S.IDIDIOMA = I.IDIDIOMA
										LEFT OUTER JOIN tecnologias T ON S.IDTECNOLOGIA = T.IDTECNOLOGIA
										WHERE S.idusuario = :idusuario
										ORDER BY S.tipo");
			//Parámetros
			$sentencia->bindParam(':idusuario', $idusuario);
            //Ejecutando la sentencia
            $sentencia->execute();
            //Obteniendo los datos
			while ($vtabla = $sentencia->fetch(PDO::FETCH_ASSOC)) {
			$respuesta = $respuesta.'<tr><td>'.$vtabla['tipo'].'</td><td>'.$vtabla['idioma'].'</td><td>'.$vtabla['tecnologia'].'</td><td>'.$vtabla['nivel'].'</td></tr>';
			}
			return $respuesta;
			
        }catch (PDOException $e){
            $respuesta ='Error al cargar los datos en el combobox 3'.$e;
			return $respuesta;
        }	
	}

    //Función para llenar el combobox de habilidades/idiomas en la pantalla de consulta
    function fillComboBox2c($dbh, $opcion, $idusuario){
        if ($opcion == 'Idioma'){
            $query = ("SELECT I.ididioma id, I.nombre
                            FROM idiomas I
                            WHERE EXISTS (SELECT * FROM skills S WHERE S.IDUSUARIO = :usuario AND I.IDIDIOMA = S.IDIDIOMA)");
        } elseif ($opcion == 'Habilidad'){
                $query = ("SELECT T.idtecnologia id, T.nombre
                            FROM tecnologias T
                            WHERE EXISTS (SELECT * FROM skills S WHERE S.IDUSUARIO = :usuario AND T.IDTECNOLOGIA= S.IDTECNOLOGIA)");
        }
        try{
                //Preparando la sentencia
                $sentencia = $dbh->prepare($query);
                //Parámetros
                $sentencia->bindParam(':usuario', $idusuario);
                //Ejecutando la sentencia
                $sentencia->execute();
                //Validando la cantidad de registros devueltos
                $cuenta = $sentencia->rowCount();
                if ($cuenta>0){
                    while ($combov2 = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <option value="<?php echo $combov2['id'];?>"><?php echo $combov2['nombre'];?></option>
                        <?php
                    }
                }	
        }catch (PDOException $e){
                echo('Error al cargar los datos en el combobox2'.$e);
        }
    }
        
    //Función para llenar el combobox del nivel de las habilidades/idiomas en la pantalla de consulta
    function fillComboBox3c($dbh, $opcion){
            try{
                //Preparando la sentencia
                $sentencia = $dbh->prepare("SELECT DISTINCT nivel FROM niveles ORDER BY idnivel");
                //Ejecutando la sentencia
                $sentencia->execute();
                //Obteniendo los datos
                while ($combov3 = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <option value="<?php echo $combov3['nivel']?>"><?php echo $combov3['nivel']?></option>
                <?php
                }
            }catch (PDOException $e){
                echo('Error al cargar los datos en el combobox 3'.$e);
            }
    }

    //Función para generar la tabla con el listado de habilidades y conocimientos en la pantalla de consulta
	function skillsTableQuery($dbh, $idusuario, $tipo, $idioma, $skill, $nivel){
        //Variable de retorno
        $respuesta='';
        //Formando el query en base a los datos de consulta
        $queryBase = "SELECT S.tipo, NVL(I.nombre, 'N/A') idioma, NVL(T.nombre, 'N/A') tecnologia, N.nivel
                        FROM skills S
                        INNER JOIN niveles N ON S.IDNIVEL = N.IDNIVEL
                        LEFT OUTER JOIN idiomas I ON S.IDIDIOMA = I.IDIDIOMA
                        LEFT OUTER JOIN tecnologias T ON S.IDTECNOLOGIA = T.IDTECNOLOGIA
                        WHERE S.idusuario = :idusuario";
        
        if($tipo != '0'){
            $queryBase = $queryBase." AND S.tipo = '".$tipo."'";
        }
        if($idioma != '0'){
            $queryBase = $queryBase." AND I.ididioma = ".$idioma;
        }
        if($skill != '0'){
            $queryBase = $queryBase." AND T.idtecnologia = ".$skill;
        }
        if($nivel != '0'){
            $queryBase = $queryBase." AND N.nivel = '".$nivel."'";
        }

        try{
			//Preparando la sentencia
			$sentencia = $dbh->prepare("$queryBase");
			//Parámetros
			$sentencia->bindParam(':idusuario', $idusuario);
            //Ejecutando la sentencia
            $sentencia->execute();
            //Obteniendo los datos
            $respuesta = '<table id="datosSkills" class="row-border compact stripe hover"><thead><tr>
                            <th>Tipo</th>
                            <th>Idioma</th>
                            <th>Tecnología</th>
                            <th>Nivel</th>
                            <th></th>
                         </tr></thead><tbody>';
            //Validando la cantidad de registros devueltos
			$cuenta = $sentencia->rowCount();
            if ($cuenta > 0){
                while ($vtabla = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                    $respuesta = $respuesta.'
                                                <tr>
                                                <td>'.$vtabla['tipo'].'</td>
                                                <td>'.$vtabla['idioma'].'</td>
                                                <td>'.$vtabla['tecnologia'].'</td>
                                                <td>'.$vtabla['nivel'].'</td>
                                                <td>
                                                <button class="editarSkills btn btn-secondary" style="vertical-align:middle"><span><i class="bi bi-pencil-square"></i> Editar </span></button>
                                                <button class="eliminarSkills btn btn-secondary" style="vertical-align:middle"><span><i class="bi bi-trash"></i> Eliminar </span></button>
                                                </td>
                                                </tr>
                                            ';
			    } //end while 
                $respuesta = $respuesta.'</tbody></table>';
                return $respuesta;
            } //End if ($cuenta > 0)
            else {
                $respuesta = 'noResults';
                return $respuesta;
            }
        }catch (PDOException $e){
            $respuesta = 'Error al cargar los datos en el combobox 3'.$e;
            return $respuesta;
        }	
	}

    
	//Función para llenar el combobox del nivel de las habilidades/idiomas
	function fillComboBoxEditSkills($dbh, $tipo, $nivel){
        //Variable de retorno
        $respuesta='';
		try{
			//Preparando la sentencia
			$sentencia = $dbh->prepare("SELECT idnivel, nivel FROM niveles WHERE TIPO = :tipo ORDER BY idnivel");
			//Parámetros
			$sentencia->bindParam(':tipo', $tipo);
            //Ejecutando la sentencia
            $sentencia->execute();
            //Obteniendo los datos
			while ($combov3 = $sentencia->fetch(PDO::FETCH_ASSOC)) {
        		if ($combov3['nivel'] == $nivel){
                        $respuesta = $respuesta.'<option value="'.$combov3['idnivel'].'" selected>'.$combov3['nivel'].'</option>';
				
					} else {
        				$respuesta = $respuesta.'<option value="'.$combov3['idnivel'].'">'.$combov3['nivel'].'</option>';
				}
			}
            //return $respuesta;
            return $respuesta;
        }catch (PDOException $e){
            $respuesta = 'Error al cargar los datos en el combobox '.$e;
            return $respuesta;
        }
	}
	
    //Función para saber si el valor a actualizar es el mismo que el actual
	function UpdateSkill($dbh, $tipo, $skill, $nivel, $idusuario, $idsesion){
		//Variable de retorno
        $respuesta='';
        try{
			//Definiendo el query
            $query = 'UPDATE skills SET idnivel = :nivel WHERE idusuario = :idusuario AND tipo = :tipo';
            if ($tipo == 'Idioma'){
                $query = $query.' AND ididioma = (SELECT ididioma FROM idiomas WHERE nombre = :skill)';
            } elseif ($tipo == 'Habilidad') {    
                $query = $query.' AND idtecnologia = (SELECT idtecnologia FROM tecnologias WHERE nombre = :skill)';
            }

			//Preparando la sentencia SQL
			$sentencia = $dbh->prepare($query);
			//Parámetros
			$sentencia->bindParam(':nivel', $nivel);
            $sentencia->bindParam(':idusuario', $idusuario);
			$sentencia->bindParam(':tipo', $tipo);
            $sentencia->bindParam(':skill', $skill);

					
			//Ejecutando la sentencia
			$sentencia->execute();
            
            //Registrando el movimiento en la bitácora
            movimientos($dbh, $idsesion, 'UPDATE SKILLS');
			
            //Devolviendo la respuesta
			$respuesta = 'Actualizado';
            return $respuesta;
            
		} catch (PDOException $e){
			ErrorLog($dbh, $idsesion, 'Error al actualizar skills '.$e, 'ISE_003');
			$respuesta = 'Error';
            return $respuesta;
		} 
    }

    //Función para actualizar un skill
	function validateSkill($dbh, $tipo, $skill, $nivel, $idusuario, $idsesion){
		//Variable de retorno
        $respuesta;
        try{
			//Definiendo el query
            $query = 'SELECT * FROM skills WHERE idusuario = :idusuario AND tipo = :tipo AND idnivel = :nivel';
            if ($tipo == 'Idioma'){
                $query = $query.' AND ididioma = (SELECT ididioma FROM idiomas WHERE nombre = :skill)';
            } elseif ($tipo == 'Habilidad') {    
                $query = $query.' AND idtecnologia = (SELECT idtecnologia FROM tecnologias WHERE nombre = :skill)';
            }

			//Preparando la sentencia SQL
			$sentencia = $dbh->prepare($query);
			//Parámetros
			$sentencia->bindParam(':nivel', $nivel);
            $sentencia->bindParam(':idusuario', $idusuario);
			$sentencia->bindParam(':tipo', $tipo);
            $sentencia->bindParam(':skill', $skill);

					
			//Ejecutando la sentencia
			$sentencia->execute();
            
            //Valiando si trae datos la búsqueda
            $cuenta = $sentencia->rowCount();

            if($cuenta >= 1){
                return $cuenta;
            } else {
                $respuesta = false;
                return $respuesta;
            }
            
		} catch (PDOException $e){
			ErrorLog($dbh, $idsesion, 'Error al actualizar skills '.$e, 'ISE_003');
			$respuesta = false;
            return $respuesta;
		} 
	}

    //Función para borrar skills
    function DeleteSkill($dbh, $tipo, $skill, $idusuario, $idsesion){
        //Variable de retorno
        $respuesta='';    
        try{
                //Definiendo el query
                $query = 'DELETE FROM skills WHERE idusuario = :idusuario AND tipo = :tipo';
                if ($tipo == 'Idioma'){
                    $query = $query.' AND ididioma = (SELECT ididioma FROM idiomas WHERE nombre = :skill)';
                } elseif ($tipo == 'Habilidad') {    
                    $query = $query.' AND idtecnologia = (SELECT idtecnologia FROM tecnologias WHERE nombre = :skill)';
                }
    
                //Preparando la sentencia SQL
                $sentencia = $dbh->prepare($query);
                //Parámetros
                $sentencia->bindParam(':idusuario', $idusuario);
                $sentencia->bindParam(':tipo', $tipo);
                $sentencia->bindParam(':skill', $skill);
                        
                //Ejecutando la sentencia
                $sentencia->execute();
    
                //Registrando el movimiento en la bitácora
                movimientos($dbh, $idsesion, 'DELETE SKILLS');
                
                //Devolviendo la respuesta
			    $respuesta = 'Eliminado';
                return $respuesta;
                                
            } catch (PDOException $e){
                ErrorLog($dbh, $idsesion, 'Error al borrar skills '.$e, 'ISE_004');
                //header("location: ../querySkills.php?error=errorDelete");
                $respuesta = 'Error';
                return $respuesta;
            } 
    }

    //Función para generar el listado de roles
    function roleList($dbh, $opcion, $idRol){

        //Variable de retorno
        $result='';

        //Armando el Query
        if ($idRol == 2){ //Si es profesor
            $sqlQuery = "SELECT idrol, nombre FROM roles WHERE idrol IN (1, 4)";
        } elseif($idRol == 3) { //Si es administrador
            $sqlQuery = "SELECT idrol, nombre FROM roles";
        }
        
        try{
            //Preparando la sentencia
            $sentencia = $dbh->prepare($sqlQuery);
            //Ejecutando la sentencia
            $sentencia->execute();
            //Obteniendo los datos
            while ($lista = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                if ($opcion == $lista['idrol']){
                    $result = $result.'<option value="'.$lista['idrol'].'" selected>'.$lista['nombre'].'</option>';
                }else{
                    $result = $result.'<option value="'.$lista['idrol'].'">'.$lista['nombre'].'</option>';
                }
            }
            return $result;
        }catch (PDOException $e){
            ErrorLog($dbh, $idsesion, 'Error al generar el listado de roles'.$e, 'OSE_006');
        }
    }


    //Función para actualizar el rol del usuario
    function updateRole($dbh, $idusr, $idrol, $idsesion){
        //Variable de retorno
        $result;

        try{
			//Definiendo el query
            $query = 'UPDATE usuarios SET idrol = :idrol WHERE idusuario = :idusr';

			//Preparando la sentencia SQL
			$sentencia = $dbh->prepare($query);
			//Parámetros
			$sentencia->bindParam(':idrol', $idrol);
            $sentencia->bindParam(':idusr', $idusr);
					
			//Ejecutando la sentencia
			$sentencia->execute();
            
            //Registrando el movimiento en la bitácora
            movimientos($dbh, $idsesion, 'UPDATE USUARIOS - IDROL userid: '.$idusr);
			
            //Devolviendo la respuesta
            $result = 'Done';
			return $result;
            
            
		} catch (PDOException $e){
			ErrorLog($dbh, $idsesion, 'Error al actualizar rol del usuario '.$e, 'ISE_005');
			//Devolviendo la respuesta
            $result = 'Error';
			return $result;
		} 
    } 

    //Función para generar el listado de usuarios y sus datos generales
	function queryUsers($dbh, $dato, $idsesion){
        //Variable de retorno
        $result;

        $dato = '%'.$dato.'%';
		try{
			//Preparando la sentencia
			$sentencia = $dbh->prepare("SELECT NVL(U.idusuario, '') idusuario
                                             , NVL(U.nombre, ' N/E') nombre
                                             , NVL(U.apellidos, 'N/E') apellidos
                                             , NVL(U.fechanacimiento, 'N/E') fechanacimiento
                                             , NVL(U.telefono, 'N/E') telefono
                                             , NVL(U.telcontacto, 'N/E') telcontacto
                                             , NVL(U.email, 'N/E') email
                                             , NVL(U.idrol, '') idrol
                                             , NVL(R.nombre, 'N/E') rol
                                             , NVL(U.semestre, 'N/E') semestre
                                             , NVL(U.numeroempleado, 'N/E') numeroempleado
                                             , NVL(U.numeromatricula, 'N/E') numeromatricula
                                             , NVL(U.fecharegistro, '') fecharegistro
                                             , NVL(U.fechafin, 'N/E') fechafin
                                             , NVL(U.bloqueado, 'No') bloqueado
                                        FROM usuarios U
                                        INNER JOIN roles R ON U.idrol = R.idrol
                                        WHERE (UPPER(U.nombre) LIKE UPPER(:dato) OR UPPER(U.apellidos) LIKE UPPER(:dato) OR UPPER(U.email) LIKE UPPER(:dato))");
            
            //Parámetros
			$sentencia->bindParam(':dato', $dato);
            
            //Ejecutando la sentencia
            $sentencia->execute();

            //Valiando la cantidad de registros devueltos
            $cuenta = $sentencia->rowCount();
    
            if($cuenta >= 1){ //Si hay por lo menos una coincidencia
                $result = $sentencia ;
            } else {
                $result = false;
            }
            
            //Devolviendo el resultado
            return $result;

        }catch (PDOException $e){
            echo('Error al mostrar el listado de usuarios '.$idsesion.': '.$e);
            ErrorLog($dbh, $idsesion, 'Error al mostrar el listado de usuarios '.$e, 'ISE_006');
			//header("location: ../queryUsers.php?error=statementerror");
        }	
	}
    

    //Función para guardar el registro de una vacante en la base de datos enterCongress.inc.php
    function RecordVacancy($dbh, $title, $details, $pdate, $edate, $phone, $email, $iduser, $idsesion, $idrol){
        //Variable de retorno
        $result;

        //Definiendo el script de INSERT
        $SQL_insert = "INSERT INTO vacantes (titulo, detalles, telefono, email, fechapublicacion, fechafin, idusuario)
                        VALUES (:title, :details, :phone, :email, :pdate, :edate, :iduser)";

        try{
            //Preparando la sentencia SQL
            $sentencia = $dbh->prepare($SQL_insert);
            
            //Definiendo los parámetros
            $sentencia->bindParam(':title', $title);
            $sentencia->bindParam(':details', $details);
            $sentencia->bindParam(':phone', $phone);
            $sentencia->bindParam(':email', $email);
            $sentencia->bindParam(':pdate', $pdate);
            $sentencia->bindParam(':edate', $edate);
            $sentencia->bindParam(':iduser', $iduser);
            
            //Ejecutando la sentencia
            $sentencia->execute();
            
            $result = true;
            return $result;

        } catch (PDOException $e){
            ErrorLog($dbh, $idsesion, 'Error al registrar la vancante '.$e, 'ISE_008');
            return $e;
        } 
    }

    //Función para validar campos vacios en la forma de edición de vacantes
    function emptyVacancy($dbh, $title, $details, $phone, $email){
        //Variable de retorno
        $result;

        if(empty($title) || empty($details) || empty($phone)|| empty($email)){
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    //Función para actualizar vacantes
    function updateVacancy($dbh, $title, $details, $pdate, $edate, $phone, $email, $idvacante, $idsesion, $idrol){
        //Variable de retorno
        $result;

        try{
            //Preparando la sentencia SQL
            $sentencia = $dbh->prepare("UPDATE vacantes 
                                        SET titulo = :title
                                          , detalles = :details
                                          , telefono = :phone
                                          , email = :email
                                          , fechapublicacion = :pdate
                                          , fechafin = :edate
                                        WHERE idvacante = :idvacante");
            
            //Definiendo los parámetros
            $sentencia->bindParam(':title', $title);
            $sentencia->bindParam(':details', $details);
            $sentencia->bindParam(':phone', $phone);
            $sentencia->bindParam(':email', $email);
            $sentencia->bindParam(':pdate', $pdate);
            $sentencia->bindParam(':edate', $edate);
            $sentencia->bindParam(':idvacante', $idvacante);
            
            //Ejecutando la sentencia
            $sentencia->execute();

            //Registrando el movimiento en la bitácora
            movimientos($dbh, $idsesion, 'UPDATE VACANTES - Id vacante: '.$idvacante);

            $result = 'done';
            return $result;

        } catch (PDOException $e){
            ErrorLog($dbh, $idsesion, 'Error al actualizar la vancante '.$e, 'OSE_009');
            return $e;
        } 
    }

    //Funcion para validar que exista la vacante ingresada
    function validateVacancy($dbh, $idVacante, $idcreador){

        //Variable para almacenar el resultado
        $result;

        //Preparando la sentencia SQL
        $sentencia = $dbh->prepare("SELECT * FROM vacantes WHERE idvacante = :idvacante AND idusuario = :idusuario");
        //Definiendo los parámetros
        $sentencia->bindParam(':idvacante', $idVacante);
        $sentencia->bindParam(':idusuario', $idcreador);
        //Ejecutando la sentencia
        $sentencia->execute();
                 
        //Valiando si trae datos la búsqueda
        $cuentaReg = $sentencia->rowCount();
            
        if($cuentaReg >= 1){
            return $cuentaReg; //La vacante existe
        } else {
            $result = false;
            return $result;
        }
    }

    //Función para validar si el usuario ya está aplicado a la vacante
    function validateApplyVacancy($dbh, $idVacante, $idpostulante){
         //Variable para almacenar el resultado
         $result;

         //Preparando la sentencia SQL
         $sentencia = $dbh->prepare("SELECT * FROM postulantes WHERE idvacante = :idvacante AND idusuario = :idusuario");
         //Definiendo los parámetros
         $sentencia->bindParam(':idvacante', $idVacante);
         $sentencia->bindParam(':idusuario', $idpostulante);
         //Ejecutando la sentencia
         $sentencia->execute();
                  
         //Valiando si trae datos la búsqueda
         $cuentaReg = $sentencia->rowCount();
             
         if($cuentaReg >= 1){
             return $cuentaReg; //El alumno ya está postulado
         } else {
             $result = false;
             return $result;
         }
    }

    //Función para postular alumno a una vacante
    function applyVacancy($dbh, $idVacante, $idpostulante){

        //Variable para almacenar el resultado
        $result;
        try{
            //Preparando la sentencia SQL
            $sentencia = $dbh->prepare("INSERT INTO postulantes (idvacante, idusuario) VALUES (:idvacante, :idusuario)");
            //Definiendo los parámetros
            $sentencia->bindParam(':idvacante', $idVacante);
            $sentencia->bindParam(':idusuario', $idpostulante);
            //Ejecutando la sentencia
            $sentencia->execute();
            $result = true;

        }catch (PDOException $e){
            $result = false;
            ErrorLog($dbh, $idsesion, 'Error al postular alumno a vacante '.$e, 'ISE_010');
        }
        return $result;
    }

    //Función para guardar el registro de uncongreso
    function RecordCongress($dbh, $cname, $details, $sede, $finicio, $ffin, $reco, $pasoc, $iduser, $idsesion, $idrol){
        $result;

        //Definiendo el script de INSERT. Si el valor del proyecto está vacio se asocia al proyecto de carga inicial
        if (empty($pasoc)){
            $pasoc=1;
        }

        $SQL_insert = "INSERT INTO congresos (nombre, detalles, sede, fechainicio, fechafin, titulo, creadopor, idproyecto)
        VALUES (:cname, :details, :sede, :finicio, :ffin, :reco, :idusr, :pasoc)";

        try{
            //Preparando la sentencia SQL
            $sentencia = $dbh->prepare($SQL_insert);
            //Definiendo los parámetros
            $sentencia->bindParam(':cname', $cname);
            $sentencia->bindParam(':details', $details);
            $sentencia->bindParam(':sede', $sede);
            $sentencia->bindParam(':finicio', $finicio);
            $sentencia->bindParam(':ffin', $ffin);
            $sentencia->bindParam(':reco', $reco);
            $sentencia->bindParam(':idusr', $iduser);
            $sentencia->bindParam(':pasoc', $pasoc);
            
            //Ejecutando la sentencia
            $sentencia->execute();
            $result = true;
            return $result;
            //header("location: ../enterVacancy.php?error=none");

        } catch (PDOException $e){
                //$sentencia->rollback();
                //throw $e;
                ErrorLog($dbh, $idsesion, 'Error al registrar el congreso '.$e, 'ISE_008');   
                return $e;
                //header("location: ../enterCongress.php?error=statementerror");
                /*debug code*/
                //$vencode = urlencode($e->getMessage());
                //$valorLocation = 'location: ../signup.php?error=stmtfailedinc&msg1='.$vencode;
                //header($valorLocation);
        } 
    }

    //Función para llenar el combobox de tipo de habilidad/conocimiento
    function fillComboBoxCongress($dbh){
        try{
            $sentencia = $dbh->prepare("SELECT NVL(US.idusuario, '')idusuario , CONCAT(NVL(US.apellidos, ''),' ',NVL(US.nombre, '')) alumno
                                        FROM usuarios US
                                        WHERE US.idrol = 1
                                        AND (US.fechafin <= CURDATE() OR US.fechafin IS NULL)
                                        AND US.bloqueado IS NULL");
            
            //Ejecutando la sentencia
            $sentencia->execute();
            //Obteniendo los datos
		
			while ($combov1 = $sentencia->fetch(PDO::FETCH_ASSOC)) {
			?>
				<option value="<?php echo $combov1['idusuario']?>"><?php echo $combov1['alumno']?></option>
			<?php
			}
        }catch (PDOException $e){
            echo('Error al cargar los datos en el combobox'.$e);
        }

    }

    //Función para validar si el alumno ya está asociado al congreso
    function alumnoCongreso($dbh, $idusr, $idcng){
        //Variable para almacenar el resultado
        $result;
        //Preparando la sentencia SQL
        $sentencia = $dbh->prepare("SELECT * FROM ponentes_v WHERE idcongreso = :idcng AND idusuario = :idusr");
        //Definiendo los parámetros
        $sentencia->bindParam(':idcng', $idcng);
        $sentencia->bindParam(':idusr', $idusr);
        //Ejecutando la sentencia
        $sentencia->execute();
        //Valiando la cantidad de registros devueltos
        $cuenta = $sentencia->rowCount();
            
        if($cuenta >= 1){
            return $cuenta;
        } else {
            $result = false;
            return $result;
        }
    }

    //Función para asociar alumnos a congresos
    function addPonente($dbh, $idusr, $idcng, $commts, $idSesionUsuario, $idsesion){
        //Variable para almacenar el resultado
        $result;

        try{
        //Preparando la sentencia SQL
        $sentencia = $dbh->prepare("INSERT INTO ponentes (idcongreso, idusuario, asignadopor, comentarios) 
                                                  VALUES (:idcng, :idusr, :idSesionUsuario, :commts);");
        
        //Definiendo los parámetros
        $sentencia->bindParam(':idcng', $idcng);
        $sentencia->bindParam(':idusr', $idusr);
        $sentencia->bindParam(':idSesionUsuario', $idSesionUsuario);
        $sentencia->bindParam(':commts', $commts);

        //Ejecutando la sentencia
        $sentencia->execute();
        
        //Registrando el movimiento en la BD    
        movimientos($dbh, $idsesion, 'INSERT PONENTES idcongreso: '.$idcng);
        
        $result = 'true';
        return $result;

        } catch (PDOException $e){
            $result = false;
            return $result;
            ErrorLog($dbh, $idsesion, 'Error al tratar de asociar alumno al congreso '.$idcng.': '.$e, 'OSE_010');
        } 
    }

    //Función para desbloquear usuarios
    function unlockUser($dbh, $idsesion, $usr2Unlock){

        try{
            //Preparando la sentencia SQL
            $sentencia = $dbh->prepare("UPDATE usuarios SET bloqueado = NULL, fechafin = NULL WHERE idusuario = :usuario");
            
            //Definiendo los parámetros
            $sentencia->bindParam(':usuario', $usr2Unlock);
            
            //Ejecutando la sentencia
            $sentencia->execute();

            //Registrando el movimiento en la BD            
            movimientos($dbh, $idsesion, 'DESBLOQUEAR USUARIO USERID: '.$usr2Unlock);

            //Devolviendo la respuesta
            return true;

            } catch (PDOException $e){
                return false;
                ErrorLog($dbh, $idsesion, 'Error al tratar de desbloquear el usuario '.$usr2Unlock.': '.$e, 'OSE_007');
            } 
    }

    //Función para ejecutar queries de consulta
    function consultaBD($dbh, $idsesion, $sql){
            //Variable de retorno
            $result;
    
            try{
                //Preparando la sentencia SQL
                $sentencia = $dbh->prepare($sql);
                
                //Ejecutando la sentencia
                $sentencia->execute();

                //Registrando el movimiento en la BD            
                movimientos($dbh, $idsesion, 'QUERY A LA BASE DE DATOS');
    
                //Valiando la cantidad de registros devueltos
                $cuenta = $sentencia->rowCount();
    
                if($cuenta >= 1){ //Si hay por lo menos una coincidencia
                    $result = $sentencia ;
                } else {
                    $result = false;
                }
                
                //Devolviendo el resultado
                return $result;

            }catch (PDOException $e){
                echo('Error al realizar la búsqueda, sesionID '.$idsesion.': '.$e);
            }
        }
    
    //Función para restablecer la contraseña
    function resetPwd($dbh, $idsesion, $pwd, $usrid){
        //Variable de retorno
        $result;

        try{
            //Preparando la sentencia SQL
            $sentencia = $dbh->prepare("UPDATE usuarios SET contrasena = :pwd WHERE idusuario=:idusr");

            //Definiendo los parámetros
            $sentencia->bindParam(':idusr', $usrid);

            //Encriptando la contraseña
            $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT); 
            $sentencia->bindParam(':pwd', $hashedPwd);

            //Ejecutando la sentencia
            $sentencia->execute();

            //Registrando el movimiento en la BD            
            movimientos($dbh, $idsesion, 'RESET PASSWORD USERID: '.$usrid);

            //Devolviendo el resultado
            $result = true;
            return $result;

        }catch (PDOException $e){
            ErrorLog($dbh, $idsesion, 'Error al restablecer la contraseña del usuario '.$usrid.': '.$e, 'OSE_008');
            
            //Devolviendo el resultado
            $result = false;
            return $result;
        }
    }

    //Función para generar el listado de proyectos activos
    function listaProyectos($dbh){
        //Variable de retorno
        $result;
        //Query
        $sql = "SELECT idproyecto, titulo 
                    FROM proyectos";
        try{
                //Preparando la sentencia SQL
                $sentencia = $dbh->prepare($sql);
                
                //Ejecutando la sentencia
                $sentencia->execute();
    
                //Valiando la cantidad de registros devueltos
                $cuenta = $sentencia->rowCount();
    
                if($cuenta >= 1){ //Si hay por lo menos una coincidencia
                    while ($vtabla = $sentencia->fetch(PDO::FETCH_ASSOC)){
                        $result = $result.' <option value = "'.$vtabla['idproyecto'].'">'.$vtabla['titulo'].'</option>';
                    }
                    echo $result;
                } else {
                    echo ' <option value = "0">No hay datos</option>';
                }
            }catch (PDOException $e){
                echo('Error al realizar la búsqueda, sesionID '.$idsesion.': '.$e);
            }
    }

    //Función para eliminar vacantes
    function DeleteVacancy($dbh, $idvacante, $idsesion){
        //Variable de retorno
        $result;

        try{
            //Preparando la sentencia SQL
            $sentencia = $dbh->prepare("DELETE FROM vacantes WHERE idvacante = :pidvacante");
            
            //Definiendo los parámetros
            $sentencia->bindParam(':pidvacante', $idvacante);

            //Ejecutando la sentencia
            $sentencia->execute();

            //Registrando el movimiento en la BD            
            movimientos($dbh, $idsesion, 'DELETE VACANTE IDVACANTE: '.$idvacante);
            
            //Resultado 
            $result = 'done';

            return $result;
 
        }catch (PDOException $e){
            echo('error');
            ErrorLog($dbh, $idsesion, 'Error al eliminar la vacante '.$idvacante.': '.$e, 'ISE_012');
        }
    }

    //Función para eliminar vacantes
    function DeleteCongress($dbh, $idcongreso, $idsesion){
        //Variable de retorno
        $result;

        try{
            //Preparando la sentencia SQL
            $sentencia = $dbh->prepare("DELETE FROM congresos WHERE idcongreso = :pidcongreso");
            
            //Definiendo los parámetros
            $sentencia->bindParam(':pidcongreso', $idcongreso);

            //Ejecutando la sentencia
            $sentencia->execute();

            //Registrando el movimiento en la BD            
            movimientos($dbh, $idsesion, 'DELETE CONGRESOS IDCONGRESO: '.$idcongreso);
            
            //Resultado 
            $result = 'done';

            return $result;
 
        }catch (PDOException $e){
            echo('error');
            ErrorLog($dbh, $idsesion, 'Error al eliminar el conrgreso '.$idvacante.': '.$e, 'ISE_013');
        }
    }

    //Función para contar el total de registros de una consulta
    function cuentaRegistros($dbh, $idsesion, $sql){
        //Variable de retorno
        $result;

        try{
            //Preparando la sentencia SQL
            $sentencia = $dbh->prepare($sql);
            
            //Ejecutando la sentencia
            $sentencia->execute();

            //Registrando el movimiento en la BD            
            movimientos($dbh, $idsesion, 'QUERY A LA BASE DE DATOS ');

            //Valiando la cantidad de registros devueltos
            $cuenta = $sentencia->rowCount();

            if($cuenta >= 1){ //Si hay por lo menos una coincidencia
                $result = $cuenta;
            } else {
                $result = false;
            }
            
            //Devolviendo el resultado
            return $result;

        }catch (PDOException $e){
            echo('Error al realizar la búsqueda, sesionID '.$idsesion.': '.$e);
        }
    }

    //Función para depurar registros
    function depuraRegistros($dbh, $idsesion, $query, $tipo){
        //Variable de retorno
        $result;

        try{
            //Preparando la sentencia SQL
            $sentencia = $dbh->prepare($query);
            
            //Ejecutando la sentencia
            $sentencia->execute();

            //Registrando el movimiento en la BD            
            movimientos($dbh, $idsesion, 'DEPURA '.$tipo);
            
            //Resultado 
            $result = 'done';

            return $result;
 
        }catch (PDOException $e){
            ErrorLog($dbh, $idsesion, 'Error al depurar registros '.$tipo.': '.$e, 'ISE_014');
            echo('error'.$e);
        }
    }

    //Función para editar la información del congreso
    function EditCongress($dbh, $cname, $details, $sede, $finicio, $ffin, $reco, $pasoc, $idcong, $iduser, $idsesion, $idrol){
        $result;

        //Definiendo el script de INSERT. Si el valor del proyecto está vacio se asocia al proyecto de carga inicial
        if (empty($pasoc)){
            $pasoc=1;
        }
        
        if($idrol == 2) {//Rol de profesor
            $SQL = "UPDATE congresos SET nombre = :cname, detalles = :details, sede = :sede, fechainicio = :finicio, fechafin = :ffin, titulo = :reco, idproyecto = :pasoc WHERE idcongreso = :idcong";

            try{
                //Preparando la sentencia SQL
                $sentencia = $dbh->prepare($SQL);

                //Definiendo los parámetros
                $sentencia->bindParam(':cname', $cname);
                $sentencia->bindParam(':details', $details);
                $sentencia->bindParam(':sede', $sede);
                $sentencia->bindParam(':finicio', $finicio);
                $sentencia->bindParam(':ffin', $ffin);
                $sentencia->bindParam(':reco', $reco);
                $sentencia->bindParam(':pasoc', $pasoc);
                $sentencia->bindParam(':idcong', $idcong);
                
                //Ejecutando la sentencia
                $sentencia->execute();

                //Registrando el movimiento en la BD            
                movimientos($dbh, $idsesion, 'UPDATE '.$iduser);

                $result = 'done';
                return $result;

            } catch (PDOException $e){
                    ErrorLog($dbh, $idsesion, 'Error al actualizar el congreso '.$e, 'ISE_015');   
                    return $e;
            } 

        }else{
            $result = 'invalidRole';
            return $result;
        }
    }

    //Función para obtener el nombre de la imagen de perfil del usuario
    function getProfileImg($dbh, $idusr, $idsesion){
        //Variable de retorno
        $result;
        //Query
        $sql = "SELECT archivo FROM profileimg WHERE idusuario = :idusr";

        try{
            //Preparando la sentencia SQL
            $sentencia = $dbh->prepare($sql);

            //Definiendo los parámetros
            $sentencia->bindParam(':idusr', $idusr);
            
            //Ejecutando la sentencia
            $sentencia->execute();

            //Registrando el movimiento en la BD            
            movimientos($dbh, $idsesion, 'QUERY IMG PROFILE');

            //Valiando la cantidad de registros devueltos
            $cuenta = $sentencia->rowCount();

            if($cuenta >= 1){ //Si hay por lo menos una coincidencia
                
                $resp = $sentencia->fetch(PDO::FETCH_ASSOC);
                //Obteniendo el valor de la base de datos
                $result = $resp["archivo"];

            } else {
                $result = false;
            }
            
            //Devolviendo el resultado
            return $result;

        }catch (PDOException $e){
            ErrorLog($dbh, $idsesion, 'Error al realizar la búsqueda de la imagen de perfil'.$e, 'ISE_016');   
        }   
    }

        //Función para actualizar el nombre de la imagen de perfil del usuario
        function updateProfileImg($dbh, $idusr, $idsesion, $extension){
            //Variable de retorno
            $result;

            $archivo = $idusr.'.'.$extension;
            //Validando si existe imagen previa y definiendo el query en base a ello
            if(imgExist($dbh, $idusr) != false){
                $sql = "UPDATE profileimg SET archivo = :archivo  WHERE idusuario = :idusr";   
            }else{
                $sql = "INSERT INTO profileimg (archivo, idusuario) VALUES (:archivo, :idusr)"; 
            }
            
            
    
            try{
                //Preparando la sentencia SQL
                $sentencia = $dbh->prepare($sql);
    
                //Definiendo los parámetros
                $sentencia->bindParam(':archivo', $archivo);
                $sentencia->bindParam(':idusr', $idusr);
                
                //Ejecutando la sentencia
                $sentencia->execute();
    
                //Registrando el movimiento en la BD            
                movimientos($dbh, $idsesion, 'UPDATE IMG PROFILE');
    
                $result = 'done';
                //Devolviendo el resultado
                return $result;
    
            }catch (PDOException $e){
                ErrorLog($dbh, $idsesion, 'Error al actualizar de la imagen de perfil'.$e, 'ISE_017');   
            }   
        }

        //Función para validar si existe alguna imagen de usuario previa
        function imgExist($dbh, $idusr){
            //Variable para almacenar el resultado
            $result;
            //Preparando la sentencia SQL
            $sentencia = $dbh->prepare("SELECT * FROM profileimg WHERE idusuario = :idusr");
            //Definiendo los parámetros
            $sentencia->bindParam(':idusr', $idusr);
            //Ejecutando la sentencia
            $sentencia->execute();
            //Obteniendo los datos
            //$usuarios = $sentencia->fetch(PDO::FETCH_ASSOC);
            
            //Valiando si trae datos la búsqueda
            $cuenta = $sentencia->rowCount();
                
            if($cuenta >= 1){
                return $cuenta;
            } else {
                $result = false;
                return $result;
            }
        }