<?php
if(isset($_POST["submit"])){
    
    //Obteniendo datos del formulario
    $name =  $_POST["name"];
    $sname =  $_POST["sname"];
    $email =  $_POST["email"];
    $pwd =  $_POST["pwd"];
    $pwdRepeat =  $_POST["pwdrepeat"];

    //Incluyendo archivos externos
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //Validando campos en blanco
    if(emptyInputSignup($name, $sname, $email, $pwd, $pwdRepeat) !== false){
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    
    //Validando que las contraseñas coincidan
    if(pwdMatch($pwd, $pwdRepeat) !== false){
        header("location: ../signup.php?error=passwordsdontmatch");
        exit();
    }

    //Validando que la contraseña cumpla con las características establecidas
    /*
    $valor=invalidPwd($pwd);
    if($valor !== false){
        $vencode = urlencode($valor);
		$valor = 'location: ../signup.php?error=invalidpassword&msg1='.$vencode;
        header($valor);
        exit();
    }
    */
    
    //Validando si el usuario ID ya existe
    if(uidExist($dbh, $email) !== false){
        header("location: ../signup.php?error=usrnametaken");
        exit();
    }
    
    //Creando el usuario
    createUser($dbh, $name, $sname, $email, $pwd);
    
}else {
    header("location: ../index.php");
}