<?php
//Incluyendo archivos externos
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(($_SERVER["REQUEST_METHOD"] == "POST")){
    
    //Obtiene los datos del formulario
    $dato = $_POST["buscar"];
    $idsesion = $_POST["idsesion"];
    $idrol =  $_POST["idrol"];
       
    //Variable de retorno
    $result='';
    
    //Validando que se trate de rol administrador
    if ($idrol == 3){
        //Llamando a la función para generar la consulta
        $respuesta = queryUsers($dbh, $dato, $idsesion);
        if ($respuesta != false){
            $result = '<table id="usersTable" class="table-responsive"><thead><tr>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Teléfono</th>
                            <th>Teléfono de contacto</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Semestre</th>
                            <th>Número de empleado</th>
                            <th>Número de matricula</th>
                            <th>Fecha de registro</th>
                            <th>Fecha de inactivación</th>
                            <th>Bloqueado</th>
                            </tr></thead><tbody>';
        
            while ($vtabla = $respuesta->fetch(PDO::FETCH_ASSOC)) {
                $result = $result.'<tr>
                                   <td>'.$vtabla['nombre'].'</td>
                                   <td>'.$vtabla['apellidos'].'</td>
                                   <td>'.$vtabla['fechanacimiento'].'</td>
                                   <td>'.$vtabla['telefono'].'</td>
                                   <td>'.$vtabla['telcontacto'].'</td>
                                   <td>'.$vtabla['email'].'</td>
                                   <td>'.$vtabla['rol'].'</td>
                                   <td>'.$vtabla['semestre'].'</td>
                                   <td>'.$vtabla['numeroempleado'].'</td>
                                   <td>'.$vtabla['numeromatricula'].'</td>
                                   <td>'.$vtabla['fecharegistro'].'</td>
                                   <td>'.$vtabla['fechafin'].'</td>
                                   <td>'.$vtabla['bloqueado'].'</td>
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

