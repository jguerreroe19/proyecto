<?php
//Incluyendo archivos externos
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(($_SERVER["REQUEST_METHOD"] == "POST")){
    //Obtiene los datos del formulario
    $usuario = $_POST["usuario"];
    $idrol = $_POST["idrol"];
    $idsesion = $_POST["idsesion"];

    
    
    $result='';

    $sql = "SELECT US.idusuario
            , NVL(US.nombre, '') nombre
            , NVL(US.apellidos, '') apellidos
            , NVL(US.email, '') email
            , RL.nombre rol
            , NVL(US.bloqueado, 'Y') bloqueado
            , NVL(US.fechafin, 'N/A')fechafin
                    FROM usuarios US
                    LEFT OUTER JOIN roles RL ON RL.idrol = US.idrol
                    WHERE UPPER(email) LIKE UPPER('%".$usuario."%')";
    if ($idrol == 2){
        $sql = $sql.' AND RL.idrol NOT IN (2, 3)';
    }
    
    //Validando que se trate de rol administrador o profesor
    if ($idrol == 2 || $idrol == 3){
        //Llamando a la función para generar la consulta
        $respuesta = consultaBD($dbh, $idsesion, $sql);
        if ($respuesta != false){
            $result = '<table id="usersTable" class="table-responsive"><thead><tr>
                            <th>ID usuario</th>    
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Fecha de Expiración</th>
                            <th>Bloqueado</th>
                            <th></th>
                            </tr></thead><tbody>';
        
            while ($vtabla = $respuesta->fetch(PDO::FETCH_ASSOC)) {
                $result = $result.'<tr>
                                   <td>'.$vtabla['idusuario'].'</td>
                                   <td>'.$vtabla['nombre'].'</td>
                                   <td>'.$vtabla['apellidos'].'</td>
                                   <td>'.$vtabla['email'].'</td>
                                   <td>'.$vtabla['rol'].'</td>
                                   <td>'.$vtabla['fechafin'].'</td>
                                   <td>'.$vtabla['bloqueado'].'</td>
                                   <td><button class="pwdResetBtn btn btn-secondary" style="vertical-align:middle"><span><i class="bi bi-key"></i> Restablecer</br>Contraseña </span></button></td>
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

