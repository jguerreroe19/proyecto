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

    <!--jQuery / Ajax-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>


    <!--Archivo local de funciones js-->
    <script type='text/javascript' src='js/functions.js'></script>
    <script type='text/javascript' src='js/funcionesJQ.js'></script>