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

    //Función para validar vampos vacios en la forma de captura de vacantes
    function emptyInputVacancy($title, $details, $pdate, $edate, $phone, $email) {
        $result;
        if(empty($title) || empty($details) || empty($pdate) || empty($edate) || empty($phone) || empty($email)){
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
                echo 'true';
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
        header("location: ../signup.php?error=none&name=&sname=&email=");
        } catch (PDOException $e){
            //$sentencia->rollback();
            //throw $e;
            //header("location: ../signup.php?error=stmtfailed");
            $vencode = urlencode($e->getMessage());
		    $valorLocation = 'location: ../signup.php?error=stmtfailedinc&msg1='.$vencode;
            header($valorLocation);
        } 
    }

    //Función para realizar el proceso de login
    function loginUser($dbh, $email, $pwd){
        //Preparando la sentencia SQL
        /*
            La sentencia valida que el usuario no esté inactivo (fechafin) o que esté bloqueado, de ser así ya no traerá datos.
            Por lo tanto no se logrará establecer el login 
        */
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
                //Generando el registro de sesión en la BD
                if (CreateSessionID($dbh,$usuarios["IDUSUARIO"], getIPAddress())){

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
                        header("location: ../index.php");
                        exit();
                    } else {
                        ErrorLog($dbh, $idsesion, 'No se pudieron obtener los detalles de la sesión', 'OSE_001');
                        header("location: ../?error=OSE_001");
                        exit();
                    }
                } else {
                    ErrorLog($dbh, $idsesion, 'No fue posible generar la sesión', 'OSE_002');
                    header("location: ../?error=OSE_002");
                    exit();
                }
            } else if($checkPwd === false) {
                header("location: ../index.php?error=wronglogin");
                exit();
            }
        }catch (PDOException $e){
            ErrorLog($dbh, $idsesion, 'Error en el proceso de login '.$e, 'OSE_005');
        }

    }

    //Función para obtener el valor de los parámetros de configuración
    function obtieneParametro($dbh, $parametro){
        $parametro = 'expiracion';
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
            movimientos($dbh, $idsesion, 'UPDATE USUARIOS');
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
            $sentencia = $dbh->prepare("INSERT INTO logerrores(idsesion, mensaje, código) VALUES (NVL(:sesid,1), :msg, :code)");
            $sentencia->bindParam(':sesid', $idsesion);
            $sentencia->bindParam(':msg', $msg);
            $sentencia->bindParam(':code', $code);
            //Ejecutando la sentencia
            $sentencia->execute();
            return $sesid;
            } catch (PDOException $e){
                return $e;
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
	
	//Función para llenar el combobox de habilidades/idiomas
    function fillComboBox2($dbh, $opcion, $idusuario){
        if ($opcion == 'Idioma'){
			$query = ("SELECT I.ididioma id, I.nombre
						FROM idiomas I
						WHERE NOT EXISTS (SELECT * FROM skills S WHERE S.IDUSUARIO = :usuario AND I.IDIDIOMA = S.IDIDIOMA)");
		} elseif ($opcion == 'Habilidad'){
			$query = ("SELECT T.idtecnologia id, T.nombre
						FROM TECNOLOGIAS T
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
				while ($combov2 = $sentencia->fetch(PDO::FETCH_ASSOC)) {
					?>
						<option value="<?php echo $combov2['id'];?>"><?php echo $combov2['nombre'];?></option>
					<?php
				}
			} else {
				if ($opcion == 'Idioma'){
					header("location: enterSkills.php?error=nolanguajes");
					exit;
				}elseif ($opcion == 'Habilidad') {
					header("location: enterSkills.php?error=noskills");
					exit;
				}
			}	
        }catch (PDOException $e){
            echo('Error al cargar los datos en el combobox2'.$e);
        }
    }
	
	//Función para llenar el combobox del nivel de las habilidades/idiomas
	function fillComboBox3($dbh, $opcion){
		try{
			//Preparando la sentencia
			$sentencia = $dbh->prepare("SELECT idnivel, nivel FROM niveles WHERE TIPO = :opcion ORDER BY idnivel");
			//Parámetros
			$sentencia->bindParam(':opcion', $opcion);
            //Ejecutando la sentencia
            $sentencia->execute();
            //Obteniendo los datos
			while ($combov3 = $sentencia->fetch(PDO::FETCH_ASSOC)) {
			?>
				<option value="<?php echo $combov3['idnivel']?>"><?php echo $combov3['nivel']?></option>
			<?php
			}
        }catch (PDOException $e){
            echo('Error al cargar los datos en el combobox 3'.$e);
        }
	}
	
	//Función para registrar un skill en la base de datos
	function RecordSkill($dbh, $tipo2, $tipo3, $idusuario, $tipo){
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
			
			header("location: ../enterSkills.php?error=none"); /**************************************REVISAR LA URL DE REDIRECCIÓN*/
		} catch (PDOException $e){
			/******************************************************************************* IMPRIMIR ERROR */
			/*$vencode = urlencode($e->getMessage());
			$valorLocation = 'location: ../signup.php?error=stmtfailedinc&msg1='.$vencode;
			header($valorLocation);*/
		} 
	}
	
	//Función para generar la tabla con el listado de habilidades y conocimientos
	function skillsTable($dbh, $idusuario){
		try{
			//Preparando la sentencia
			$sentencia = $dbh->prepare("SELECT S.tipo, NVL(I.nombre, '-') idioma, NVL(T.nombre, '-') tecnologia, N.nivel
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
			?>
				<tr>
				<td><?php echo $vtabla['tipo']?></td>
				<td><?php echo $vtabla['idioma']?></td>
				<td><?php echo $vtabla['tecnologia']?></td>
				<td><?php echo $vtabla['nivel']?></td>
				</tr>
			<?php
			}
        }catch (PDOException $e){
            echo('Error al cargar los datos en el combobox 3'.$e);
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
                            FROM TECNOLOGIAS T
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
	function skillsTableQuery($dbh, $idusuario, $tipo, $tipo2, $tipo2a, $tipo3){
        //Formando el query en base a los datos de consulta
        $queryBase = "SELECT S.tipo, NVL(I.nombre, '') idioma, NVL(T.nombre, '') tecnologia, N.nivel
                        FROM skills S
                        INNER JOIN niveles N ON S.IDNIVEL = N.IDNIVEL
                        LEFT OUTER JOIN idiomas I ON S.IDIDIOMA = I.IDIDIOMA
                        LEFT OUTER JOIN tecnologias T ON S.IDTECNOLOGIA = T.IDTECNOLOGIA
                        WHERE S.idusuario = :idusuario";
        
        if($tipo != '0'){
            $queryBase = $queryBase." AND S.tipo = '".$tipo."'";
        }
        if($tipo2 != 0){
            $queryBase = $queryBase.' AND I.ididioma = '.$tipo2;
        }
        if($tipo2a != 0){
            $queryBase = $queryBase.' AND T.idtecnologia = '.$tipo2a;
        }
        if($tipo3 != '0'){
            $queryBase = $queryBase." AND N.nivel = '".$tipo3."'";
        }

        try{
			//Preparando la sentencia
			$sentencia = $dbh->prepare("$queryBase");
			//Parámetros
			$sentencia->bindParam(':idusuario', $idusuario);
            //Ejecutando la sentencia
            $sentencia->execute();
            //Obteniendo los datos
            ?>
            <table>
                <tr>
                    <th>Tipo</th>
                    <th>Idioma</th>
                    <th>Tecnología</th>
                    <th>Nivel</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                </tr>
            <?php
            //Validando la cantidad de registros devueltos
			$cuenta = $sentencia->rowCount();
            if ($cuenta > 0){
                while ($vtabla = $sentencia->fetch(PDO::FETCH_ASSOC)) {
			?>
				<tr>
				<td><?php echo $vtabla['tipo']?></td>
				<td><?php echo $vtabla['idioma']?></td>
				<td><?php echo $vtabla['tecnologia']?></td>
				<td><?php echo $vtabla['nivel']?></td>
                <?php
                    $cadena = 'var1='.$vtabla['tipo'].
                             '&var2='.$vtabla['idioma'].
                             '&var3='.$vtabla['tecnologia'].
                             '&var4='.$vtabla['nivel'];
                    $vencode = urlencode($cadena);
                ?>
                <td><a href="<?php echo 'editSkills.php?'.$cadena;?>">Modificar</a></td>
                <td><a href="<?php echo 'deleteSkills.php?'.$cadena;?>">Eliminar</a></td>
                </tr>
			<?php
			} //end while 
            ?>
            </table>
            <?php
            } //End if ($cuenta > 0)
            else {
                echo '<p> La consulta no generó datos. Revise los datos ingresados y vuelva a intentar</p>';
            }
        }catch (PDOException $e){
            echo('Error al cargar los datos en el combobox 3'.$e);
        }	
	}

    
	//Función para llenar el combobox del nivel de las habilidades/idiomas
	function fillComboBoxEditSkills($dbh, $tipo, $nivel){
		try{
			//Preparando la sentencia
			$sentencia = $dbh->prepare("SELECT idnivel, nivel FROM niveles WHERE TIPO = :tipo ORDER BY idnivel");
			//Parámetros
			$sentencia->bindParam(':tipo', $tipo);
            //Ejecutando la sentencia
            $sentencia->execute();
            //Obteniendo los datos
			while ($combov3 = $sentencia->fetch(PDO::FETCH_ASSOC)) {
			?>
				<?php
					if ($combov3['nivel'] == $nivel){
				?>
				<option value="<?php echo $combov3['idnivel']?>" selected><?php echo $combov3['nivel']?></option>
				<?php
					} else {
				?>
				<option value="<?php echo $combov3['idnivel']?>"><?php echo $combov3['nivel']?></option>
				<?php
				}
			}
        }catch (PDOException $e){
            echo('Error al cargar los datos en el combobox 3'.$e);
        }
	}
	
    //Función para actualizar un skill
	function UpdateSkill($dbh, $tipo, $skill, $nivel, $idusuario, $idsesion){
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
			
            //Redireccionando a la pantalla anterior
			header("location: ../querySkills.php?error=noneUpdate");
            
            
		} catch (PDOException $e){
			ErrorLog($dbh, $idsesion, 'Error al actualizar skills '.$e, 'ISE_003');
			header("location: ../querySkills.php?error=errorUpdate");
		} 
	}

    //Función para borrar skills
    function DeleteSkill($dbh, $tipo, $skill, $idusuario, $idsesion){
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
                
                //Redireccionando a la pantalla anterior
                header("location: ../querySkills.php?error=noneDelete");
                                
            } catch (PDOException $e){
                ErrorLog($dbh, $idsesion, 'Error al borrar skills '.$e, 'ISE_004');
                header("location: ../querySkills.php?error=errorDelete");
            } 
    }

    //Función para generar la tabla con el listado de usuarios sin rol asignado
	function queryUserRole($dbh, $idRol){
        $i = 0;
		try{
			//Preparando la sentencia
			$sentencia = $dbh->prepare("SELECT idusuario, NVL(nombre, '') nombre, NVL(apellidos, '') apellidos, NVL(email, '') email, NVL(fecharegistro, '') fecharegistro, NVL(idrol, '') idrol
                                        FROM usuarios
                                        WHERE idrol = 4");
            //Ejecutando la sentencia
            $sentencia->execute();
            //Obteniendo los datos
			while ($vtabla = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                $i++;
                echo '<form name="form'.$i.'" action="includes/addRole.inc.php" method="post">';
			?>
				
                <tr>
				<td><input type="text" name="fname" placeholder="Nombre" value="<?php echo $vtabla['nombre']?>" readonly></td>
				<td><input type="text" name="sname" placeholder="Apellido" value="<?php echo $vtabla['apellidos']?>" readonly></td>
				<td><input type="text" name="email" placeholder="Email" value="<?php echo $vtabla['email']?>" readonly></td>
                <td><input type="text" name="fecha" placeholder="Fecha de registro" value="<?php echo $vtabla['fecharegistro']?>" readonly></td>
                <td>
                    <select name="idrol" id= "idrol">
                        <?php 
                            roleList($dbh, $vtabla['idrol'], $idRol);
                            //echo $vtabla['idrol'];
                        ?>
                    </select>
                </td>
                <td><button type="submit" name="submit">Guardar</button></td>
                <td><input type="hidden" name="idusuario" placeholder="idusuario" value="<?php echo $vtabla['idusuario']?>"></td>
				</tr>
                </form>
			<?php
			}
        }catch (PDOException $e){
            echo('Error al cargar los datos en el combobox 3'.$e);
        }	
	}

    //Función para generar el listado de roles
    function roleList($dbh, $opcion, $idRol){
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
                    ?>
                        <option value="<?php echo $lista['idrol']?>" selected><?php echo $lista['nombre']?></option>
                    <?php        
                }else{
                    ?>
                        <option value="<?php echo $lista['idrol']?>"><?php echo $lista['nombre']?></option>
                    <?php
                }
            }
        }catch (PDOException $e){
            ErrorLog($dbh, $idsesion, 'Error al generar el listado de roles'.$e, 'OSE_006');
        }
    }

    //Función para actualizar el rol del usuario
    function updateRole($dbh, $idusr, $idrol, $idsesion){
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
            movimientos($dbh, $idsesion, 'UPDATE USUARIOS - IDROL');
			
            //Redireccionando a la pantalla anterior
			header("location: ../addRole.php?error=none");
            
            
		} catch (PDOException $e){
			ErrorLog($dbh, $idsesion, 'Error al actualizar rol del usuario '.$e, 'ISE_005');
			header("location: ../addRole.php?error=errorUpdate");
		} 
    } 

    //Función para generar la tabla con el listado de usuarios y los datos generales
	function queryUsers($dbh, $dato, $idsesion){
        $dato = '%'.$dato.'%';
		try{
			//Preparando la sentencia
			$sentencia = $dbh->prepare("SELECT NVL(U.idusuario, '') idusuario
                                             , NVL(U.nombre, '') nombre
                                             , NVL(U.apellidos, '') apellidos
                                             , NVL(U.fechanacimiento, '') fechanacimiento
                                             , NVL(U.telefono, '') telefono
                                             , NVL(U.telcontacto, '') telcontacto
                                             , NVL(U.email, '') email
                                             , NVL(U.idrol, '') idrol
                                             , NVL(R.nombre, '') rol
                                             , NVL(U.semestre, '') semestre
                                             , NVL(U.numeroempleado, '') numeroempleado
                                             , NVL(U.numeromatricula, '') numeromatricula
                                             , NVL(U.fecharegistro, '') fecharegistro
                                             , NVL(U.fechafin, '') fechafin
                                             , NVL(U.bloqueado, 'No') bloqueado
                                        FROM usuarios U
                                        INNER JOIN roles R ON U.idrol = R.idrol
                                        WHERE (UPPER(U.nombre) LIKE UPPER(:dato) OR UPPER(U.apellidos) LIKE UPPER(:dato) OR UPPER(U.email) LIKE UPPER(:dato))");
            
            //Parámetros
			$sentencia->bindParam(':dato', $dato);
            
            //Ejecutando la sentencia
            $sentencia->execute();
            
            //Obteniendo los datos
			while ($vtabla = $sentencia->fetch(PDO::FETCH_ASSOC)) {
			?>
                <tr>
                    <td><?php echo $vtabla['nombre'];?></td>
                    <td><?php echo $vtabla['apellidos'];?></td>
                    <td><?php echo $vtabla['fechanacimiento'];?></td>
                    <td><?php echo $vtabla['telefono'];?></td>
                    <td><?php echo $vtabla['telcontacto'];?></td>
                    <td><?php echo $vtabla['email'];?></td>
                    <td><?php echo $vtabla['rol'];?></td>
                    <td><?php echo $vtabla['semestre'];?></td>
                    <td><?php echo $vtabla['numeroempleado'];?></td>
                    <td><?php echo $vtabla['numeromatricula'];?></td>
                    <td><?php echo $vtabla['fecharegistro'];?></td>
                    <td><?php echo $vtabla['fechafin'];?></td>
                    <td><?php echo $vtabla['bloqueado'];?></td>
                </tr>
			<?php
			}
        }catch (PDOException $e){
            ErrorLog($dbh, $idsesion, 'Error al actualizar mostrar el listado de usuarios '.$e, 'ISE_006');
			header("location: ../queryUsers.php?error=statementerror");
        }	
	}
    

    
    //Función para generar la tabla con los datos de la bitácora de acceso
	function queryLog($dbh, $dato, $idsesion, $check, $fechaini, $fechafin){
        //Concatenando el valor de búsqueda para la BD
        $dato = '%'.$dato.'%';
        
        $query = "SELECT NVL(B.idsesion, '') idsesion
                            , NVL(B.idusuario, '') idusuario
                            , NVL(U.email, '') usuario
                            , NVL(B.host, '') host
                            , NVL(B.fechainicio, '') fechainicio
                            , NVL(B.fechafin, '') fechafin
                            , NVL(TIMESTAMPDIFF(second, B.fechainicio, B.fechafin), '') duracion
                    FROM bitacora B
                    INNER JOIN usuarios U ON B.idusuario = U.idusuario
                    WHERE (UPPER(U.email) LIKE UPPER(:dato) OR UPPER(B.host) LIKE UPPER(:dato))";
        //Ajustando los datos de fechas
        if ($check == 'no'){
            $fechaini = NULL;
            $fechafin = NULL;
        } else{
            $fechaini = "'".$fechaini."'";
            $fechafin = "'".$fechafin."'";

            $query = $query." AND DATE(B.fechainicio) >= NVL(".$fechaini.", B.fechainicio) 
                              AND DATE(B.fechafin) <= NVL(".$fechafin.", B.fechafin)";
        }

        $query = $query." ORDER BY B.idsesion";

        try{
			//Preparando la sentencia
			$sentencia = $dbh->prepare($query);
            
            //Parámetros
			$sentencia->bindParam(':dato', $dato);
            
            //Ejecutando la sentencia
            $sentencia->execute();
            
            //Obteniendo los datos
			while ($vtabla = $sentencia->fetch(PDO::FETCH_ASSOC)) {
			?>
                <tr>
                    <td><?php echo $vtabla['idsesion'];?></td>
                    <td><?php echo $vtabla['idusuario'];?></td>
                    <td><?php echo $vtabla['usuario'];?></td>
                    <td><?php echo $vtabla['host'];?></td>
                    <td><?php echo $vtabla['fechainicio'];?></td>
                    <td><?php echo $vtabla['fechafin'];?></td>
                    <td><?php echo $vtabla['duracion'];?></td>
                </tr>
			<?php
			}
        }catch (PDOException $e){
            ErrorLog($dbh, $idsesion, 'Error al actualizar mostrar los datos de la bitácora '.$e, 'ISE_007');
			//header("location: ../queryLog.php?error=statementerror");
        }	
	}

    //Función para generar la tabla con el listado de usuarios y los datos generales
	function queryAlumnos($dbh, $name, $sname, $email, $phone, $skill, $nivel, $sid){
        try{
			//Preparando la sentencia
            $sqlQuery = "SELECT SK.idusuario
            , NVL(US.apellidos, '') apellidos
            , NVL(US.nombre, '') nombre
            , NVL(SK.tipo, '') tipo
            , NVL(ID.nombre, '-') idioma
            , NVL(TC.nombre, '-') tecnologia
            , NVL(NV.nivel, '-') nivel
            , NVL(US.telefono, '-')telefono
            , NVL(US.telcontacto, '-')telcontacto
            , NVL(US.email, '')email
            , NVL(US.semestre, '')semestre
            FROM skills SK
            LEFT JOIN usuarios US ON SK.idusuario  = US.idusuario
            LEFT JOIN idiomas ID ON SK.ididioma = ID.ididioma
            LEFT JOIN tecnologias TC ON SK.idtecnologia = TC.idtecnologia
            LEFT JOIN niveles NV ON SK.idnivel = NV.idnivel
            WHERE US.idrol = 1";
            
            if(!empty($name)){
                $sqlQuery = $sqlQuery." AND UPPER(US.nombre) LIKE UPPER(NVL('%".$name."%',US.nombre))";
            }
            if(!empty($sname)){
                $sqlQuery = $sqlQuery." AND UPPER(US.apellidos) LIKE UPPER(NVL('%".$sname."%', US.apellidos))";
            }
            if(!empty($email)){
                $sqlQuery = $sqlQuery." AND UPPER(US.email) LIKE UPPER(NVL('%".$email."%', US.email))";
            }
            if(!empty($phone)){
                $sqlQuery = $sqlQuery." AND (US.telefono LIKE NVL('%".$phone."%', US.telefono) OR US.telcontacto LIKE NVL('%".$phone."%', US.telcontacto))";
            }
            if(!empty($skill)){
                $sqlQuery = $sqlQuery." AND (UPPER(ID.nombre) LIKE UPPER(NVL('%".$skill."%', ID.nombre)) OR UPPER(TC.nombre) LIKE UPPER(NVL('%".$skill."%', TC.nombre)))";
            }
            if(!empty($nivel)){
                $sqlQuery = $sqlQuery." AND UPPER(NV.nivel) LIKE UPPER(NVL('%".$nivel."%', NV.nivel))";
            }


            $sqlQuery = $sqlQuery." ORDER BY US.apellidos, SK.tipo DESC, NV.idnivel DESC";

            //Preparando la sentencia
			$sentencia = $dbh->prepare($sqlQuery);
            
            //Ejecutando la sentencia
            $sentencia->execute();
            
            //Obteniendo los datos
			while ($vtabla = $sentencia->fetch(PDO::FETCH_ASSOC)) {
			?>
                <tr>
                    <td><?php echo $vtabla['apellidos'];?></td>    
                    <td><?php echo $vtabla['nombre'];?></td>
                    <td><?php echo $vtabla['tipo'];?></td>
                    <td><?php echo $vtabla['idioma'];?></td>
                    <td><?php echo $vtabla['tecnologia'];?></td>
                    <td><?php echo $vtabla['nivel'];?></td>
                    <td><?php echo $vtabla['telefono'];?></td>
                    <td><?php echo $vtabla['telcontacto'];?></td>
                    <td><?php echo $vtabla['email'];?></td>
                    <td><?php echo $vtabla['semestre'];?></td>
                </tr>
			<?php
			}
        }catch (PDOException $e){
            ErrorLog($dbh, $idsesion, 'Error al actualizar mostrar el listado de usuarios '.$e, 'ISE_006');
			header("location: ../queryUsers.php?error=statementerror");
        }	
	}
    
    
    //Función para eliminar espacios y caracteres especiales de las cadenas de caracteres
    function validaEntrada($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Función para guardar el registro de una vacante en la base de datos
    function RecordVacancy($dbh, $title, $details, $pdate, $edate, $phone, $email, $iduser, $idsesion, $idrol){
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
            header("location: ../enterVacancy.php?error=none");

        } catch (PDOException $e){
                //$sentencia->rollback();
                //throw $e;
                ErrorLog($dbh, $idsesion, 'Error al registrar la vancante '.$e, 'ISE_008');
                header("location: ../enterVacancy.php?error=statementerror");
                /*debug code*/
                //$vencode = urlencode($e->getMessage());
                //$valorLocation = 'location: ../signup.php?error=stmtfailedinc&msg1='.$vencode;
                //header($valorLocation);
        } 
    }

    //Función para generar la tabla con el listado de vacantes dependiendo del rol del usuario logueado
	function vacancyQueryTable($dbh, $idusuario, $idrol, $title, $details, $vflag){
        //Formando el query en base a los datos de consulta
        $queryBase = "SELECT NVL(idvacante, '')id
                           , NVL(titulo, '')titulo
                           , NVL(detalles, '')detalles
                           , NVL(fechapublicacion, '')fechapublicacion
                           , NVL(fechafin, '')fechafin
                           , NVL(telefono, '')telefono
                           , NVL(email, '')email
                           , NVL(idusuario, '')idusuario
                        FROM vacantes
                        WHERE 1=1";
        
        if($idrol == 1){ //Si el rol es alumno sólo mostrará las vacantes activas y publicadas
            $queryBase = $queryBase." AND fechapublicacion <= sysdate() AND fechafin >= sysdate()";   
        }
        if(!empty($title)){ //Si se indíca el nombre de la vacante 
            $queryBase = $queryBase." AND UPPER(titulo) LIKE UPPER('%".$title."%')";
        }
        if(!empty($details)){ //Si se indíca algúnd detalle de la vacante
            $queryBase = $queryBase." AND UPPER(detalles) LIKE UPPER('%".$details."%')";
        }
        if($vflag == 'Y'){ //Trae las vacantes generadas por el usuario activo
            $queryBase = $queryBase." AND idusuario = '".$idusuario."'";
        }
        
        

        //echo $queryBase;

        //Cuerpo base del encabezado de la tabla
        ?>
            <h2>Listado de vacantes</h2></br>
            <table>
            <tr>
                <th>ID</th>    
                <th>Titulo</th>
                <th>Detalles</th>
                <th>Fecha de publicación</th>
                <th>Fecha de expiración</th>
           
        <?php
        //Definiendo opciones a mostrar en base al rol
        switch ($idrol) {
            case 1: //Alumno
                ?>
                        <th>Postularse</th>
                        </tr>    
                <?php
                break;
            case 2: //Profesor
                ?>
                    <th>Teléfono de contacto</th>
                    <th>Email de contacto</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                    </tr>    
                <?php
                break;
            case 3: //Administrador
                ?>
                    th>Teléfono de contacto</th>
                    <th>Email de contacto</th>
                    </tr>    
                <?php
                break;
            default: //Otro
                ErrorLog($dbh, $idsesion, 'El rol no permite consultar vacantes '.$e, 'ISE_009');
                header("location: ../queryVacancy.php?error=statementerror");   
        }

        try{
			//Preparando la sentencia
			$sentencia = $dbh->prepare("$queryBase");
            //Ejecutando la sentencia
            $sentencia->execute();
            //Validando la cantidad de registros devueltos
			$cuenta = $sentencia->rowCount();
            if ($cuenta > 0){
                //Armando la tabla con los datos obtenidos
                while ($vtabla = $sentencia->fetch(PDO::FETCH_ASSOC)) {
			?>
				<tr>
				<td><?php echo $vtabla['id']?></td>
				<td><?php echo $vtabla['titulo']?></td>
				<td><?php echo $vtabla['detalles']?></td>
				<td><?php echo $vtabla['fechapublicacion']?></td>
                <td><?php echo $vtabla['fechafin']?></td>
                <?php
                    $cadena = 'var1='.$vtabla['id'].
                              '&var2='.$vtabla['idusuario'].
                              '&var3='.$idusuario
                             ;
                    $vencode = urlencode($cadena);
                
                    //Definiendo opciones a mostrar en base al rol
                    switch ($idrol) {
                        case 1: //Alumno
                            if (validateApplyVacancy($dbh, $vtabla['id'], $idusuario) == false){
                            ?>
                                    <td style="display:none;"><?php echo $vtabla['telefono']?></td>
                                    <td style="display:none;"><?php echo $vtabla['email']?></td>
                                    <td><a href="<?php echo 'includes/applyVacancy.inc.php?'.$cadena;?>">Postularse</a></td>
                                    </tr>    
                            <?php
                            }else{
                            ?>
                                    <td style="display:none;"><?php echo $vtabla['telefono']?></td>
                                    <td style="display:none;"><?php echo $vtabla['email']?></td>
                                    <td><button class="datos">Mostrar datos</button></td>
                                    </tr>    
                            <?php
                            }
                            break;
                        case 2: //Profesor
                            ?>
                                <td><?php echo $vtabla['telefono']?></td>
                                <td><?php echo $vtabla['email']?></td>
                                <td><a href="<?php echo 'editVacancy.php?'.$cadena;?>">Editar</a></td>
                                <td><a href="<?php echo 'deleteVacancy.php?'.$cadena;?>">Eliminar</a></td>
                                </tr>    
                            <?php
                            break;
                        case 3: //Administrador
                            ?>
                                <td><?php echo $vtabla['telefono']?></td>
                                <td><?php echo $vtabla['email']?></td>
                                </tr>    
                            <?php
                            break;
                        default: //Otro
                        ErrorLog($dbh, $idsesion, 'El rol no permite consultar vacantes '.$e, 'ISE_009');
                        header("location: ../queryVacancy.php?error=statementerror");   
                    }
			} //end while 
            ?>
            </table>
            <?php
            } //End if ($cuenta > 0)
            else {
                echo '<p> La consulta no generó datos. Revise los datos ingresados y vuelva a intentar</p>';
            }
        }catch (PDOException $e){
            ErrorLog($dbh, $idsesion, 'El rol no permite consultar vacantes '.$e, 'ISE_009');
            header("location: ../queryVacancy.php?error=statementerror");   
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


