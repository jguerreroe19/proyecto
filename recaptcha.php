<?php
  //Incluyendo el header de la página
  include_once 'header.php';


echo"aqui van los datos<br><br>";

if($_POST['google-response-token']){
    echo $_POST['google-response-token'];
    echo '<br><br><br>';

    $googletoken = $_POST['google-response-token'];
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".SECRET_KEY."&response={$googletoken}");
    $response = json_decode($response);

    $response = (array) $response;

    print_r($response);

    if($response['success'] && ($response['score'] && $response['score'] > 0.5)){
        echo '<div class= "alert alert-success"> Validación correcta </div>';
    } else {
        echo '<div class= "alert alert-danger"> Validación incorrecta </div>';
    }

    exit;
}

?>