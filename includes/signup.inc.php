<?php
    //Incluyendo archivos externos
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    require_once 'functions2.inc.php';


if(($_SERVER["REQUEST_METHOD"] == "POST")){
    
    //Obteniendo datos del formulario
    $name =  $_POST["name"];
    $sname =  $_POST["sname"];
    $email =  $_POST["email"];
    $pwd =  $_POST["pwd"];
    $pwdRepeat =  $_POST["pwdrepeat"];


    //Validando campos en blanco
    if(emptyInputSignup($name, $sname, $email, $pwd, $pwdRepeat) !== false){
        //header("location: ../signup.php?error=emptyinput");
        echo "Los campos no pueden estar vacios";
        exit();
    }
    
    //Validando que las contraseñas coincidan
    if(pwdMatch($pwd, $pwdRepeat) !== false){
        //$errorDetails = getURLData($name, $sname, $email);
        //header("location: ../signup.php?error=passwordsdontmatch&".$errorDetails);
        echo "La contraseña y la confirmación no coinciden";
        exit();
    }

    //Validando que la contraseña cumpla con las características establecidas
    $valor=invalidPwd($pwd);
    if($valor !== false){
        //$errorDetails = getURLData($name, $sname, $email);
        //$vencode = urlencode($valor);
		//$valor = 'location: ../signup.php?error=invalidpassword&msg1='.$vencode.'&'.$errorDetails;
        //header($valor);
        echo '<strong>Error:</strong><br>'.$valor;  
        exit();
    }
    
    //Validando si el usuario ID ya existe
        $valor = uidExist($dbh, $email);
    if($valor !== false){
        //$errorDetails = getURLData($name, $sname, $email);
        //header("location: ../signup.php?error=usrnametaken&".$errorDetails);
        echo "El correo electrónico ingresado ya está registrado. Ingrese uno distinto". $valor;
        exit();
    }
    
    //Creando el usuario
    if(createUser($dbh, $name, $sname, $email, $pwd) !== false){
        echo "Usuario creado exitosamente!";
        exit();
    }else{
        echo "Error al registrar al usuario. Vuelva a intentarlo!";
        exit();
    }

}else {
    header("location: ../index.php");
}