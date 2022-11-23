<?php
//Incluyendo archivos externos
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(($_SERVER["REQUEST_METHOD"] == "POST")){
    
    //Obtiene los datos del formulario
    $bcodigo = $_POST["bcodigo"];
    $bdetalles = $_POST["bdetalles"];
    $check = $_POST["check"];
    $idsesion = $_POST["idsesion"];
    $idrol =  $_POST["idrol"];
    $fechaini = $_POST["fechaInicio"];
    $fechafin = $_POST["fechaFin"];
       
    //Variable de retorno
    $result='';
    
    //Validando que se trate de rol administrador
    if ($idrol == 3){

        $query = "SELECT idregistro, idsesion, mensaje, codigo, fechaerror FROM logerrores
                    WHERE (UPPER(codigo) LIKE UPPER('%".$bcodigo."%')
                       AND UPPER(mensaje) LIKE UPPER('%".$bdetalles."%'))";


        //Ajustando los datos de fechas
        if ($check == 'true'){
            if ($fechaini > $fechafin){
                echo 'wrongDateRange';
                exit();
            }else{
                $query = $query." AND DATE(fechaerror) >= '".$fechaini."' AND DATE(fechaerror) <= '".$fechafin."'";
            }
        }

        $query = $query." ORDER BY fechaerror DESC;";

                
        //Llamando a la función para generar la consulta
        $respuesta = consultaBD($dbh, $idsesion, $query);
        if ($respuesta != false){
            $result = '<table id="errorTable" class="row-border compact stripe hover"><thead><tr>
                            <th>ID registro</th>                
                            <th>ID Sesión</th>
                            <th>Detalles del error</th>
                            <th>Código de error</th>
                            <th>Fecha de registro</th></tr></thead><tbody>';
        
            while ($vtabla = $respuesta->fetch(PDO::FETCH_ASSOC)) {
                $result = $result.'<tr>
                                   <td>'.$vtabla['idregistro'].'</td>
                                   <td>'.$vtabla['idsesion'].'</td>
                                   <td>'.$vtabla['mensaje'].'</td>
                                   <td>'.$vtabla['codigo'].'</td>
                                   <td>'.$vtabla['fechaerror'].'</td>
                                   </tr>';
            }
            $result = $result.'</tbody></table>';
            //Devolviendo el valor
            echo $result;
            exit();
        }else{
            echo 'noData';
            exit();
        }

    }else{
        echo 'invalidRole';
        exit();
    }

} else{
    //Regresa a la página inicial
    //echo "entra aqui";
    header("location: ../index.php");
    exit();
}

?>

