<?php
    /*Datos de conexión*/
    
    $serverName="localhost";
    $dBUsername="jjge";
    $dBPassword="guerrero2021";
    $dBName="ICI";

    /*$serverName="localhost";
    $dBUsername="u649030186_dbuser";
    $dBPassword="uaa2022ICI#999";
    $dBName="u649030186_proyecto";
    */

/*Conexión a la BD*/
try{
    $dbh = new PDO("mysql:host=$serverName;dbname=$dBName", $dBUsername, $dBPassword);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo "éxito";

} catch (PDOException $e) {
    //echo "Error: " . $e->getMessage();
    header("location: ../index.php?error=stmtfailed");
}
