<?php
if(($_SERVER["REQUEST_METHOD"] == "POST")){
    //Obtiene los datos del formulario
    
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    
    //Incluyendo archivos externos
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //Validando campos vacios y en caso de haberlos agrega el identificador de error en la URL
    if(emptyInputLogin($email, $pwd) !== false){
        header("location: ../index.php?error=emptyinput");
        //echo "<p>Los campos no pueden estar vacios EX</p>";
        exit();
    } else {
        //Llamando la función para relizar el login
        loginUser($dbh, $email, $pwd);
        //echo '<p>'.$respuesta.'</p>';
        exit();
    }
    

} else{
    //Regresa a la página inicial
    header("location: ../index.php");
    exit();
}

?>