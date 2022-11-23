<?php
if(($_SERVER["REQUEST_METHOD"] == "POST")){

    //Incluyendo archivos externos
    include ("../keys.php");
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    

    //Obtiene los datos del formulario
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $googletoken = $_POST['google-response-token'];

    //Datos Captcha
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response={$googletoken}");
    $response = json_decode($response);
    $response = (array) $response;



    //Validando campos vacios y en caso de haberlos agrega el identificador de error en la URL
    if(emptyInputLogin($email, $pwd) !== false){
        header("location: ../index.php?error=emptyinput");
        //echo "emptyInput";
        exit();
    } else if($response['success']){ //Validando la respuesta Captcha
        //Llamando la función para relizar el login
        loginUser($dbh, $email, $pwd);
        exit();
    } else {
        //echo " errorCaptcha";
        header("location: ../index.php?error=errorCaptcha");
        exit();
    }

} else{
    //Regresa a la página inicial
    header("location: ../index.php");
    exit();
}

?>