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
    
    //Validando que se trate de rol administrador o profesor
    if ($idrol == 3 || $idrol == 2){

        //Query
        $query = "SELECT idusuario
                    , NVL(nombre, 'No especificado') nombre
                    , NVL(apellidos, 'No especificado') apellidos
                    , NVL(email, '') email
                    , NVL(fecharegistro, '') fecharegistro
                    , NVL(idrol, '') idrol
                FROM usuarios
                WHERE 1=1
                AND (UPPER(nombre) LIKE UPPER('%".$dato."%')  
                OR UPPER(email) LIKE UPPER('%".$dato."%')
                OR UPPER(apellidos) LIKE UPPER('%".$dato."%'))
                ";

        if($idrol == 2){ //Si el rol es profesor, sólo muestra los usuarios sin rol asignado
            $query = $query." AND idrol = 4";
        }
        //echo $query;              
        //Llamando a la función para generar la consulta
        $respuesta = consultaBD($dbh, $idsesion, $query);

        if ($respuesta != false){
            $result = '<table id="logTable" class="row-border compact stripe hover"><thead><tr>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Fecha de registro</th>
                            <th>Rol</th>
                            <th style="display:none;"></th>
                            <th></th>
                            </tr></thead><tbody>';
        
            while ($vtabla = $respuesta->fetch(PDO::FETCH_ASSOC)) {
                $result = $result.'<tr>
                                    <td>'.$vtabla['nombre'].'</td>
                                    <td>'.$vtabla['apellidos'].'</td>
                                    <td>'.$vtabla['email'].'</td>
                                    <td>'.$vtabla['fecharegistro'].'</td>
                                    <td>
                                        <select name="idrol" id= "idrol">'.roleList($dbh, $vtabla['idrol'], $idrol).'</select>
                                    </td>
                                    <td style="display:none;">'.$vtabla['idusuario'].'</td>
                                    <td><button class="guardaraddRoleBtn btn btn-secondary" style="vertical-align:middle"><span><i class="bi bi-briefcase"></i> Guardar </span></button></td>
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

