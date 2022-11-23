<?php
    //Incluyendo archivos externos
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(($_SERVER["REQUEST_METHOD"] == "POST")){
        //Obtiene los datos del formulario
        $idVacante = $_POST["idvacante"];
        $idcreador = $_POST["idCreado"];
        $idpostulante = $_POST["idpostulante"];
        
        
        if(validateVacancy($dbh, $idVacante, $idcreador) == false){ //Validando que exista la vacante
            //header("location: ../queryVacancy.php?error=vacancynotexist");
            echo "notExist";
            //echo "<p>No se encontró la vancante seleccionada. Intente nuevamente o contacte al administrador.</p>";
            exit();
        } else if(validateApplyVacancy($dbh, $idVacante, $idpostulante) !== false){ //Validando si el usuario ya está postulado a la vacante
            //header("location: ../queryVacancy.php?error=vacancyalreadyapplied");
            echo "alreadyApplied";
            //echo "<p>La vacante seleccionada ya fue aplicada</p>";
            exit();
        } else if (applyVacancy($dbh, $idVacante, $idpostulante) !== false){ //Llamando la función para postular al alumno a la vacante
            //header("location: ../queryVacancy.php?error=none");
            echo "done";
            //echo "<p>Vacante aplicada exitosamente. Consulte las vacantes nuevamete para ver los datos de contacto.</p>";
            exit();
        } else {
            //header("location: ../queryVacancy.php?error=statementerror");
            echo "error";
            //echo "<p>Error en el módulo de vacantes. Intente nuevamente o contacte al administrador.</p>";
            exit();
        } 

    } else{
        //Regresa a la página inicial
        header("location: ../index.php");
        exit();
    }

?>