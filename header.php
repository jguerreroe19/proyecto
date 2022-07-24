<?php
session_set_cookie_params(0);
session_start();

//Valida si la sesión ya expiró
if (isset( $_SESSION['last_activity'])){
    if( $_SESSION['last_activity'] < time()-$_SESSION['expire_time'] ) { 
        //Redirecciona a la página de logout
        header("location: includes/logout.inc.php"); 
    } else{ //Si, todavía no expira, renueva el tiempo de la sesión.
        $_SESSION['last_activity'] = time();
    }
}
?>

<!doctype html>
<html lang="es" dir="ltr"> 
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Gestion de alumnos ICI</title>
    
    <!--Icono de la página-->
    <link rel="icon" type="image/png" href="img/logo.png" sizes="64x64">
    
    <!--Hoja de estilo local-->
    <link rel="stylesheet" type="text/css" href="css/styles.css">

    <!--Iconos Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <!--jQuery / Ajax-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!--Archivo local de funciones js-->
    <script type='text/javascript' src='js/functions.js'></script>
    <script type='text/javascript' src='js/funcionesJQ.js'></script>

    
</head>
<body>

<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Sistema de gestión de alumnos</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    

      <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <!--<a href="index.php"><img src="img/logo.png class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none" alt="logo"></a>-->
            <a href="https://getbootstrap.com/" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
          </a>

          <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
          <?php
                if (isset($_SESSION["idrol"])){
                    if ($_SESSION["idrol"] == '1'){ //ALUMNO
                        ?>
                        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Consulta</a>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                        <li><a class="dropdown-item" href="queryVacancy.php">Vacantes</a></li>
                                        <li><a class="dropdown-item" href="queryCongress.php">Congresos</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Habilidades</a>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                        <li><a class="dropdown-item" href="enterSkills.php">Captura</a></li>
                                        <li><a class="dropdown-item" href="querySkills.php">Consulta</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="img/logo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                        <li><a class="dropdown-item" href="profile.php">Información Personal</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="includes/logout.inc.php">Cerrar sesión</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <?php  
                    } elseif ($_SESSION["idrol"] == '2'){ //PROFESOR
                        ?>
                        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Consulta</a>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                        <li><a class="dropdown-item" href="consAlumnos.php">Alumnos</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Administración de usuarios</a>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                        <li><a class="dropdown-item" href="addRole.php">Asignar roles</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Congresos</a>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                        <li><a class="dropdown-item" href="enterCongress.php">Registro</a></li>
                                        <li><a class="dropdown-item" href="queryCongress.php">Consulta</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Vacantes</a>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                        <li><a class="dropdown-item" href="enterVacancy.php">Registro</a></li>
                                        <li><a class="dropdown-item" href="queryVacancy.php">Consulta</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="img/logo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                        <li><a class="dropdown-item" href="profile.php">Información Personal</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="includes/logout.inc.php">Cerrar sesión</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <?php  
                    } elseif ($_SESSION["idrol"] == '3'){ //ADMINISTRADOR
                        ?>
                        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Consulta</a>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                        <li><a class="dropdown-item" href="queryUsers.php">Usuarios</a></li>
                                        <li><a class="dropdown-item" href="queryLog.php">Bitácora</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Administración de usuarios</a>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                        <li><a class="dropdown-item" href="#">Administrar</a></li> <!----------------------------------------------------------------------------------------------------------------------FALTA ESTA PANTALLA --->
                                        <li><a class="dropdown-item" href="signup.php">Registrar nuevo usuario</a></li>
                                        <li><a class="dropdown-item" href="addRole.php">Asignar roles</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Administración de sistema</a>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                        <li><a class="dropdown-item" href="#">Depuración Accesos</a></li> <!----------------------------------------------------------------------------------------------------------------------FALTA ESTA PANTALLA --->
                                        <li><a class="dropdown-item" href="#">Depuración Errores</a></li> <!----------------------------------------------------------------------------------------------------------------------FALTA ESTA PANTALLA --->
                                    </ul>
                                </li>
                            </ul>
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="img/logo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                        <li><a class="dropdown-item" href="profile.php">Información Personal</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="includes/logout.inc.php">Cerrar sesión</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <?php 
                    } elseif ($_SESSION["idrol"] == '4'){ //REGISTRADO
                        ?>
                        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown"><a href="includes/logout.inc.php" class="nav-link text-secondary"><i class="bi bi-key"></i> Cerrar sesión</a></li>';
                            </ul>
                        </div>
                        <?php    
                    }
                } else {
                    // MENU DEFAULT
                    ?> 
                    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown"><a href="index.php" class="nav-link text-secondary"><i class="bi bi-house-door"></i> Inicio</a></li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown"><a href="signup.php" class="nav-link text-secondary"><i class="bi bi-clipboard-plus"></i> Registro</a></li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown"><a href="about.php" class="nav-link text-secondary"><i class="bi bi-info-circle"></i> Acerca de</a></li>
                        </ul>
                    </div>
                    <?php 
                }
            ?>
    </div>
</nav>
</header>
