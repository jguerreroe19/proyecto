<?php
session_start();
?>

<!doctype html>
<html lang="es" dir="ltr"> 
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Gestion de alumnos de la carrera ICI</title>
    
    <!--Page Icon -->
    <link rel="icon" type="image/png" href="img/logo.png" sizes="64x64">
    
    <!--Local Stylesheet -->
    <link rel="stylesheet" type="text/css" href="css/styles.css">

    <!--Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!--Archivo local de funciones js -->
    <script type='text/javascript' src='js/functions.js'></script>

</head>
<body>
    <nav>
        <!--<a href="index.php"><img src="img/logo.png" alt="logo"></a>-->
        <ul>
        <?php
            /* 
                FALTA CORREGIR TODAS LAS REFERENCIAS DE LOS LINKS. DIRECCIONARLOS A PÁGINAS CORRECTAS
            */
            if (isset($_SESSION["idrol"])){
                if ($_SESSION["idrol"] == '1'){ //ALUMNO
                    echo '<li><a href="profile.php">Información personal</a></li>';
                    echo '<li class="dropdown">';
                        echo '<a href="#" class="dropbtn">Consultas</a>';
                        echo '<div class="dropdown-content">';
                            echo '<a href="vacantes.php">Vacantes</a>';
                            echo '<a href="congresos.php">Congresos</a>';
                        echo '</div>';
                    echo '</li>';
                    echo '<li class="dropdown">';
                        echo '<a href="#" class="dropbtn">Habilidades</a>';
                        echo '<div class="dropdown-content">';
                            echo '<a href="enterSkills.php">Captura</a>';
                            echo '<a href="querySkills.php">Consulta</a>';
                        echo '</div>';
                    echo '</li>';
                    echo '<li><a href="includes/logout.inc.php">Cerrar sesión</a></li>';
                } elseif ($_SESSION["idrol"] == '2'){ //PROFESOR
                    echo '<li><a href="profile.php">Información personal</a></li>';
                    echo '<li class="dropdown">';
                        echo '<a href="#" class="dropbtn">Consultas</a>';
                        echo '<div class="dropdown-content">';
                            echo '<a href="consAlumnos.php">Alumnos</a>';
                        echo '</div>';
                    echo '</li>';
                    echo '<li><a href="usuarios.php">Administración de usuarios</a></li>';
                    echo '<li class="dropdown">';
                        echo '<a href="#" class="dropbtn">Congresos</a>';
                        echo '<div class="dropdown-content">';
                            echo '<a href="vacantes.php">Registro</a>';
                            echo '<a href="vacantes.php">Consulta</a>';
                            echo '<a href="vacantes.php">Edición</a>';
                        echo '</div>';
                    echo '</li>';
                    echo '<li class="dropdown">';
                        echo '<a href="#" class="dropbtn">Vacantes</a>';
                        echo '<div class="dropdown-content">';
                            echo '<a href="vacantes.php">Registro</a>';
                            echo '<a href="vacantes.php">Consulta</a>';
                            echo '<a href="vacantes.php">Edición</a>';
                        echo '</div>';
                    echo '</li>';
                    echo '<li><a href="includes/logout.inc.php">Cerrar sesión</a></li>';
                } elseif ($_SESSION["idrol"] == '3'){ //ADMINISTRADOR
                    echo '<li><a href="profile.php">Información personal</a></li>';
                    echo '<li class="dropdown">';
                        echo '<a href="#" class="dropbtn">Consultas</a>';
                        echo '<div class="dropdown-content">';
                            echo '<a href="vacantes.php">Usuarios</a>';
                            echo '<a href="congresos.php">Bitácora</a>';
                        echo '</div>';
                    echo '</li>';
                    echo '<li class="dropdown">';
                        echo '<a href="#" class="dropbtn">Administración de usuarios</a>';
                        echo '<div class="dropdown-content">';
                            echo '<a href="vacantes.php">Administrar</a>';
                            echo '<a href="vacantes.php">Registrar nuevo usuario</a>';
                            echo '<a href="vacantes.php">Asignar roles</a>';
                        echo '</div>';
                    echo '</li>';
                    echo '<li class="dropdown">';
                        echo '<a href="#" class="dropbtn">Administración de sistema</a>';
                        echo '<div class="dropdown-content">';
                            echo '<a href="vacantes.php">Depuración Accesos</a>';
                            echo '<a href="vacantes.php">Depuración Errores</a>';
                        echo '</div>';
                    echo '</li>';
                    echo '<li><a href="includes/logout.inc.php">Cerrar sesión</a></li>';
                } elseif ($_SESSION["idrol"] == '4'){ //REGISTRADO
                    echo '<li><a href="includes/logout.inc.php">Cerrar sesión</a></li>';
                }
            } else {
                    echo '<li><a href="index.php">Inicio</a></li>';
                    echo '<li><a href="signup.php">Registro</a></li>';
                    echo '<li><a href="about.php">Acerca de</a></li>';
            }
        ?>
        </ul>
    </nav>
        