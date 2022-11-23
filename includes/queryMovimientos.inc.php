<?php
//Incluyendo archivos externos
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(($_SERVER["REQUEST_METHOD"] == "POST")){
    
    //Obtiene los datos del formulario
    $dato = $_POST["buscar"];
    $check = $_POST["check"];
    $idsesion = $_POST["idsesion"];
    $idrol =  $_POST["idrol"];
    $fechaini = $_POST["fechaInicio"];
    $fechafin = $_POST["fechaFin"];
       
    //Variable de retorno
    $result='';
    
    //Validando que se trate de rol administrador
    if ($idrol == 3){

        //Concatenando el valor de búsqueda para la BD
        $dato = '%'.$dato.'%';        
        
        $query = "SELECT NVL(MV.idmovimiento, '') idmovimiento
                        , NVL(BT.idsesion, '') idsesion
                        , NVL(US.idusuario, '') idusuario
                        , NVL(MV.fechamovimeinto, '') fechamovimeinto
                        , NVL(MV.tipomovimiento, '') tipomovimiento
                        , NVL(BT.fechainicio, '') iniciosesion
                        , NVL(BT.fechafin, '') finsesion
                        , NVL(BT.host, '') host
                        , NVL(US.email, '') email
                        FROM movimientos MV
                        LEFT OUTER JOIN bitacora BT ON MV.idsesion = BT.idsesion
                        LEFT OUTER JOIN usuarios US ON BT.idusuario = US.idusuario
                WHERE (UPPER(US.email) LIKE UPPER('".$dato."') 
                    OR UPPER(BT.host) LIKE UPPER('".$dato."')
                    OR UPPER(MV.tipomovimiento) LIKE UPPER('".$dato."'))";
        
        //Ajustando los datos de fechas
        if ($check == 'true'){
            if ($fechaini > $fechafin){
                echo 'wrongDateRange';
                exit();
            }else{
                $query = $query." AND DATE(MV.fechamovimeinto) >= '".$fechaini."' AND DATE(MV.fechamovimeinto) <= '".$fechafin."'";
            }
            
        }

        $query = $query." ORDER BY MV.fechamovimeinto DESC;";
        
        //Llamando a la función para generar la consulta
        $respuesta = consultaBD($dbh, $idsesion, $query);
        if ($respuesta != false){
            $result = '<table id="logTable" class="row-border compact stripe hover"><thead><tr>
                            <th>ID Movimiento</th>                
                            <th>ID Sesión</th>
                            <th>ID Usuario</th>
                            <th>Fecha del movimiento</th>
                            <th>Tipo de movimiento</th>
                            <th>Inicio de sesión</th>
                            <th>Fin de sesión</th>
                            <th>Host</th>
                            <th>Email</th>
                            </tr></thead><tbody>';
        
            while ($vtabla = $respuesta->fetch(PDO::FETCH_ASSOC)) {
                $result = $result.'<tr>
                                   <td>'.$vtabla['idmovimiento'].'</td>
                                   <td>'.$vtabla['idsesion'].'</td>
                                   <td>'.$vtabla['idusuario'].'</td>
                                   <td>'.$vtabla['fechamovimeinto'].'</td>
                                   <td>'.$vtabla['tipomovimiento'].'</td>
                                   <td>'.$vtabla['iniciosesion'].'</td>
                                   <td>'.$vtabla['finsesion'].'</td>
                                   <td>'.$vtabla['host'].'</td>
                                   <td>'.$vtabla['email'].'</td>
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

