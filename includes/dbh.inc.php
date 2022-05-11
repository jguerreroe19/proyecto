<?php
    /*Datos de conexión*/
    
    $serverName="sql212.epizy.com";
    $dBUsername="epiz_31704310";
    $dBPassword="BbpJVwozyH1Z";
    $dBName="epiz_31704310_ici";

    /*$serverName="localhost";
    $dBUsername="id16975702_dbadmin";
    $dBPassword="uaa2022ICI#999";
    $dBName="id16975702_ici";
    */

/*Conexión a la BD*/
try{
    $dbh = new PDO("mysql:host=$serverName;dbname=$dBName", $dBUsername, $dBPassword);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    //echo "Error: " . $e->getMessage();
    header("location: ../index.php?error=stmtfailed");
}