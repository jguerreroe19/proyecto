<?php
    include_once 'header.php';
?>
     <script type='text/javascript' src='js/profile.inc.js'></script>
<?php
    include_once 'header2.php';
    //Incluyendo archivos externos
    require_once 'includes/dbh.inc.php';
    require_once 'includes/functions.inc.php';
    //Valida si hay sesión activa, de lo contrario redirecciona al index.
    if (isset($_SESSION["sid"])){
       //Obteniendo el valor del id de usuario de las variables de sesión.
       $idusuario = $_SESSION["idusuario"];
       $idsesion = $_SESSION["sid"];
/*
        $imgUsr = getProfileImg($dbh, $idusuario, $idsesion);
        //Si no hay imagen asignada, muestra la de default
        if ($imgUsr == false){
            $imgUsr = 'default.jpg';
        };*/
        
?>
<section class="personal-info-form debajodelNav">
     <!--<form name="dpersonales" id = "dpersonales" action="includes/profile.inc.php" method="post">-->
    
    <div class="container">
    <form action="#" method="POST" enctype="multipart/form-data" class="row g-3" id="formUploadImg">
        <div class="col-md-2">
            <img src="img/uploads/<?php echo $imgUsr;?>" alt="mdo" width="100" height="100" class="rounded-circle">
        </div>
        <div class="col-md-6">
            <h3>Cambiar la imagen de perfil:</h3>
            <input type="hidden" name="iduserImg" id="iduserImg" value="<?php echo $idusuario;?>">
            <input type="hidden" name="idsesionImg" id="idsesionImg" value="<?php echo $idsesion;?>">
            <div class="input-group">
                <input type="file" class="form-control" id="uProfilefile" aria-describedby="uploadProfileImg" aria-label="Upload" name="uProfilefile" accept="image/png, image/jpeg, image/jfif">
                <button class="btn btn-primary" type="button" id="uploadProfileImg">Actualizar</button>
            </div>
        </div>
        <div class="col-md-4">
        </div>
    </form>
    <hr class="border-2 border-top border-dark">
    <h3>Actualizar la información personal:</h3>
    <form action="#" method="post" name="dpersonales" id = "dpersonales"  class="row g-3 requires-validation" novalidate>
        <?php
        try{
            //Sentencia para traer los datos almacenados en la BD y poder mostrar los que ya existan
            $sentencia = $dbh->prepare("SELECT NVL(nombre, '') nombre, NVL(apellidos, '') apellidos, NVL(fechanacimiento, '') fechanacimiento
                                        , NVL(telefono, '') telefono, NVL(email, '') email, NVL(telcontacto, '') telcontacto, NVL(semestre, '') semestre
                                        , NVL(numeromatricula, '') numeromatricula, NVL(numeroempleado, '') numeroempleado
                                        FROM usuarios WHERE idusuario = :idusuario");
            $sentencia->bindParam(':idusuario', $idusuario);
            //Ejecutando la sentencia
            $sentencia->execute();
            //Obteniendo los datos
            $usuario = $sentencia->fetch(PDO::FETCH_ASSOC);
        ?>
                    <div class="col-md-6">
                        <label for="name" class="form-label labelPopUp">Nombre(s)</label>
                        <input pattern=".{3,}" type="text" class="form-control" name="name" id="name" placeholder="Ingresa tu nombre" value= "<?php echo $usuario["nombre"];?>" required>
                        <div class="invalid-feedback">Debe especificar su nombre</div>
                    </div>
                    <div class="col-md-6">
                        <label for="sname" class="form-label labelPopUp">Apellidos</label>
                        <input pattern=".{3,}" type="text" class="form-control" name="sname" id="sname" placeholder="Ingresa tus apellidos" value= "<?php echo $usuario["apellidos"];?>" required>
                        <div class="invalid-feedback">Debe especificar su apellido</div>
                    </div>
                    <div class="col-md-6">
                        <label for="bdate" class="form-label labelPopUp">Fecha de nacimiento</label>
                        <input type="date" class="form-control" name="bdate" id="bdate" placeholder="Ingresa tu fecha de nacimiento" value= "<?php echo $usuario["fechanacimiento"];?>">
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label labelPopUp">Teléfono</label>
                        <input pattern=".{10,10}" type="text" class="form-control telefono" name="phone" id="phone" placeholder="Ingresa tu teléfono" maxlength=10 value= "<?php echo $usuario["telefono"];?>" required>
                        <div class="invalid-feedback">El número de teléfono debe ser de 10 dígitos</div>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label labelPopUp">Email</label>
                        <input type="text" class="form-control correoe" name="email" id="email" placeholder="Ingresa tu Email" value= "<?php echo $usuario["email"];?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="cphone" class="form-label labelPopUp">Teléfono de contacto</label>
                        <input pattern=".{10,10}" type="text " class="form-control telefono" name="cphone" id="cphone" placeholder="Ingresa tu teléfono de contacto" maxlength=10 value= "<?php echo $usuario["telcontacto"];?>" required>
                        <div class="invalid-feedback">El número de teléfono debe ser de 10 dígitos</div>
                    </div>
        <?php        
                if (isset($_SESSION["idrol"])){
                        if ($_SESSION["idrol"] == '1'){
        ?>      
                    <div class="col-md-6">
                        <label for="semEmp" class="form-label labelPopUp">Semestre</label>
                        <select class="form-select" id="semEmp" required>
                            <option selected disabled value = "">Elige una opción...</option>
                            <?php 
                                for ($i = 1; $i <= 11; $i++){
                                    if ($i == 11){
                                        if ($i == $usuario["semestre"]){
                                            echo ('<option value="'.$i.'" selected>Egresado</option>');    
                                        }else{
                                            echo ('<option value="'.$i.'">Egresado</option>');    
                                        }
                                        
                                    }else{
                                        if ($i == $usuario["semestre"]){
                                            echo ('<option value="'.$i.'" selected>'.$i.'&#176;</option>');    
                                        }else{
                                            echo ('<option value="'.$i.'">'.$i.'&#176;</option>');
                                        }
                                    }
                                }
                            
                            ?>
                        </select>
                    </div>
        <?php        
                        }else{
        ?>
                    <div class="col-md-6">
                        <label for="semEmp" class="form-label labelPopUp">No. de empleado</label>
                        <input type="text" class="form-control" name="semEmp" id="semEmp" placeholder="Ingresa tu número de empleado" value= "<?php echo $usuario["numeroempleado"];?>">
                    </div>
        <?php        
                        }
                }
        ?>
                <div class="col-md-6">
                        <label for="matricula" class="form-label labelPopUp">Matricula</label>
                        <input type="text" class="form-control" name="matricula" id="matricula" placeholder="Ingresa tu número de matricula" value= "<?php echo $usuario["numeromatricula"];?>">
                </div>
                <input type="hidden" name="iduser" id="iduser" value="<?php echo $idusuario;?>">
                <input type="hidden" name="idsesion" id="idsesion" value="<?php echo $idsesion;?>">
                <input type="hidden" name="idrol" id="idrol" value="<?php echo $_SESSION["idrol"];?>">
                
        <?php
        } catch (PDOException $e) {
            ErrorLog($dbh, $idsesion, 'No se pudieron recuperar los datos del usuario. '.$e, 'OSE_004');
        }
        ?>
                
                <div class="col-12">
                        <input type="button" id="btnEnviar" class="buttonEnviar" value="Guardar">
                </div>
                    <!--Muestra la respuesta que se recibe de Ajax
                    <div id="respuesta" class="alert alert-dark col-md-12" role="alert"></div>-->

    </form>
    </div>
</section>


<?php
    }else{
        //Redirecciona al index si no hay sesión activa
        header("location: index.php");
        exit();   
    }
    include_once 'footer.php';
?>