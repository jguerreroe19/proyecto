</head>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- Título de la aplicación-->
            <span class="navbar-brand mb-0 h1 text-wrap">
                <img src="img\logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                Sistema de gestión de alumnos (ICI)<span id= "mainTitle" style="color:#9E9E9E;"></span>
            </span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    			<span class="navbar-toggler-icon"></span>
		    </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown" style="margin-right:9%;" >
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php
                    //Incluyendo archivos externos
                        require_once 'includes/dbh.inc.php';
                        require_once 'includes/functions.inc.php';

                        //Si hay una sesión iniciada
                        if (isset($_SESSION["idrol"])){
                            
                            //Obteniendo el valor del id de usuario de las variables de sesión.
                            $idusuario = $_SESSION["idusuario"];
                            $idsesion = $_SESSION["sid"];

                            $imgUsr = getProfileImg($dbh, $idusuario, $idsesion);
                            //Si no hay imagen asignada, muestra la de default
                            if ($imgUsr == false){
                                $imgUsr = 'default.jpg';
                            };
                            
                            if ($_SESSION["idrol"] == '1'){ //ALUMNO
                                ?>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Consulta</a>
                                            <ul class="dropdown-menu dropdown-menu-dark">
                                                <li><a class="dropdown-item" href="queryVacancy.php">Vacantes</a></li>
                                                <li><a class="dropdown-item" href="queryCongress.php">Congresos</a></li>
                                            </ul>
                                        </li>
                                    
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Habilidades</a>
                                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                                <li><a class="dropdown-item" href="enterSkills.php">Captura</a></li>
                                                <li><a class="dropdown-item" href="querySkills.php">Consulta</a></li>
                                            </ul>
                                        </li>
                                    
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="img/uploads/<?php echo $imgUsr;?>" alt="mdo" width="32" height="32" class="rounded-circle">
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                                <li><a class="dropdown-item" href="profile.php">Información Personal</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item" href="includes/logout.inc.php">Cerrar sesión</a></li>
                                            </ul>
                                        </li>
                                    
                                
                                <?php  
                            } elseif ($_SESSION["idrol"] == '2'){ //PROFESOR
                                ?>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Consulta</a>
                                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                                <li><a class="dropdown-item" href="consAlumnos.php">Alumnos</a></li>
                                            </ul>
                                        </li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Administración de usuarios</a>
                                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                                <li><a class="dropdown-item" href="addRole.php">Asignar roles</a></li>
                                                <li><a class="dropdown-item" href="unlockUser.php">Desbloquear usuario </a></li>
                                                <li><a class="dropdown-item" href="pwdReset.php">Restablecer contraseña </a></li>
                                            </ul>
                                        </li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Congresos</a>
                                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                                <li><a class="dropdown-item" href="enterCongress.php">Registro</a></li>
                                                <li><a class="dropdown-item" href="queryCongress.php">Consulta</a></li>
                                            </ul>
                                        </li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Vacantes</a>
                                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                                <li><a class="dropdown-item" href="enterVacancy.php">Registro</a></li>
                                                <li><a class="dropdown-item" href="queryVacancy.php">Consulta</a></li>
                                            </ul>
                                        </li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="img/uploads/<?php echo $imgUsr;?>" alt="mdo" width="32" height="32" class="rounded-circle">
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                                <li><a class="dropdown-item" href="profile.php">Información Personal</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item" href="includes/logout.inc.php">Cerrar sesión</a></li>
                                            </ul>
                                        </li>

                                
                                <?php  
                            } elseif ($_SESSION["idrol"] == '3'){ //ADMINISTRADOR
                                ?>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Consulta</a>
                                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                                <li><a class="dropdown-item" href="queryUsers.php">Usuarios</a></li>
                                                <li><a class="dropdown-item" href="queryLog.php">Bitácora</a></li>
                                                <li><a class="dropdown-item" href="queryMovimientos.php">Movimientos</a></li>
                                                <li><a class="dropdown-item" href="queryErrores.php">Log de errores</a></li>
                                            </ul>
                                        </li>
                                    
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Administración de usuarios</a>
                                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                                <li><a class="dropdown-item" href="signup.php">Registrar nuevo usuario</a></li>
                                                <li><a class="dropdown-item" href="addRole.php">Asignar roles</a></li>
                                                <li><a class="dropdown-item" href="unlockUser.php">Desbloquear usuario </a></li>
                                                <li><a class="dropdown-item" href="pwdReset.php">Restablecer contraseña </a></li>
                                            </ul>
                                        </li>
                                    
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Administración de sistema</a>
                                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                                <li><a class="dropdown-item" href="setup.php">Configuración</a></li>
                                                <li><a class="dropdown-item" href="depuraAccesos.php">Depuración Accesos</a></li>
                                                <li><a class="dropdown-item" href="depuraErrores.php">Depuración Errores</a></li>
                                            </ul>
                                        </li>
                                    
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="img/uploads/<?php echo $imgUsr;?>" alt="mdo" width="32" height="32" class="rounded-circle">
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                                <li><a class="dropdown-item" href="profile.php">Información Personal</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item" href="includes/logout.inc.php">Cerrar sesión</a></li>
                                            </ul>
                                        </li>
                                    
                                
                                <?php 
                            } elseif ($_SESSION["idrol"] == '4'){ //REGISTRADO
                                ?>
                                <li class="nav-item">
                                    <div id="scroll-container">
                                        <div id="scroll-text" style="color: white;"><i class="bi bi-exclamation-triangle-fill" style="color: #FFC300;"></i> Actualmente este usuario no tiene privilegios. Pongase en contacto con un profesor o administrador del sistema para que le sean asignados <i class="bi bi-exclamation-triangle-fill" style="color: #FFC300;"></i><div>
                                    </div>
                                </li>
                                    <li class="nav-item"><a href="includes/logout.inc.php" class="nav-link active"><i class="bi bi-key"></i> Cerrar sesión</a></li>';
                                <?php    
                            }
                        } else {
                            // MENU DEFAULT
                            ?> 
                                <li class="nav-item"><a href="index.php" class="nav-link active"><i class="bi bi-house-door"></i> Inicio</a></li>
                            <?php
                                    //Valida si la opción de registro está activa y de ser así la muestra
                                    if (obtieneParametro($dbh, 'registro') == 'checked'){
                                        ?>
                                            <li class="nav-item"><a href="signup.php" class="nav-link active"><i class="bi bi-clipboard-plus"></i> Registro</a></li>
                                        <?php
                                    }
                                        ?>
                                    <li class="nav-item"><a href="about.php" class="nav-link active"><i class="bi bi-info-circle"></i> Acerca de</a></li>
                    <?php 
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
<body>

    
