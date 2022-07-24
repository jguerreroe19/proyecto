<?php
$closeSession;

//Incluyendo archivos externos
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

//Destruye la sesión y regresa a la página inicial
session_start();

$sid = CloseSessionID($dbh);
if ($sid == 0){
    ErrorLog($dbh, $idsesion, 'Error al actualizar la fecha de cierre de sesión en la BD', 'OSE_003');
};
session_unset();
session_destroy();
header("location: ../index.php?error=sessionclosed");
exit();

?>