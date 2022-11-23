<?php
require_once 'includes/dbh.inc.php';
require_once 'includes/functions.inc.php';

echo 'Pagina de prueba';
echo '</br>';
$ip = getIPAddress();

echo $ip;
//Generando el registro de sesión en la BD
//$sesion = CreateSessionID($dbh,1, $ip);

echo $sesion;

$idusuario = 1;
$host = $ip;
echo '</br></br>';
//Preparando la sentencia SQL
try{
$sentencia = $dbh->prepare("INSERT INTO bitacora (idusuario, host) VALUES (:idusuario, :host)");
$sentencia->bindParam(':idusuario', $idusuario);
$sentencia->bindParam(':host', $host);

//Ejecutando la sentencia
$sentencia->execute();
$confirm = true;
echo 'ok';

} catch (PDOException $e){
    $confirm = false;
    echo $e;
} 
