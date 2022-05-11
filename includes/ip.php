<?php
	try{
	require_once 'dbh.inc.php';
    require_once 'func.inc.php';
	//require_once 'include/func.inc.php';
	}catch (Exception $e){
            echo 'Error en el proceso de login '.$e;
    }
	
	echo getIPAddress();
	
	//phpinfo();
	//loginUser ($dbh, 'jguerreroe@gmail.com', '123');
	
	
?>