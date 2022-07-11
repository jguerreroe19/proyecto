<?php
    //Incluyendo archivos externos
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    require_once 'functions2.inc.php';


if(isset($_POST["submit"])){
    
    //Obteniendo datos del formulario
    $name =  validaEntrada($_POST["name"]);
    $sname =  validaEntrada($_POST["sname"]);
    $email =  validaEntrada($_POST["email"]);
    $pwd =  validaEntrada($_POST["pwd"]);
    $pwdRepeat =  validaEntrada($_POST["pwdrepeat"]);


    //Validando campos en blanco
    if(emptyInputSignup($name, $sname, $email, $pwd, $pwdRepeat) !== false){
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    
    //Validando que las contraseñas coincidan
    if(pwdMatch($pwd, $pwdRepeat) !== false){
        $errorDetails = getURLData($name, $sname, $email);
        header("location: ../signup.php?error=passwordsdontmatch&".$errorDetails);
        exit();
    }

    //Validando que la contraseña cumpla con las características establecidas
    $valor=invalidPwd($pwd);
    if($valor !== false){
        $errorDetails = getURLData($name, $sname, $email);
        $vencode = urlencode($valor);
		$valor = 'location: ../signup.php?error=invalidpassword&msg1='.$vencode.'&'.$errorDetails;
        header($valor);
        exit();
    }
    
    //Validando si el usuario ID ya existe
    if(uidExist($dbh, $email) !== false){
        $errorDetails = getURLData($name, $sname, $email);
        header("location: ../signup.php?error=usrnametaken&".$errorDetails);
        exit();
    }
    
    //Creando el usuario
    createUser($dbh, $name, $sname, $email, $pwd);
    
}else {
    header("location: ../index.php");
}