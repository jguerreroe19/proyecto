<?php
//Incluyendo archivos externos
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(($_SERVER["REQUEST_METHOD"] == "POST")){
    
    //Obtiene los datos del formulario
    $name = $_POST["nombre"];
    $sname = $_POST["apellidos"];
    $email = $_POST["email"];
    $phone = $_POST["telefono"];
    $skill = $_POST["habilidad"];
    $nivel = $_POST["nivel"];
    $idsesion = $_POST["idsesion"];
    $idrol =  $_POST["idrol"];
       
    //Variable de retorno
    $result='';
    
    //Validando que se trate de rol profesor
    if ($idrol == 2){

        //Preparando la sentencia
        $sqlQuery = "SELECT 
                            SK.idusuario
                            , NVL(US.apellidos, 'N/E') apellidos
                            , NVL(US.nombre, 'N/E') nombre
                            , SK.tipo 
                            , NVL(ID.nombre, TC.nombre) habilidad 
                            , NVL(NV.nivel, 'N/E') nivel
                            , NVL(US.telefono, 'N/E')telefono
                            , NVL(US.telcontacto, 'N/E')telcontacto
                            , NVL(US.email, '')email
                            , NVL(US.semestre, 'No definido')semestre
                        FROM skills SK
                        LEFT JOIN usuarios US ON SK.idusuario  = US.idusuario
                        LEFT JOIN idiomas ID ON SK.ididioma = ID.ididioma
                        LEFT JOIN tecnologias TC ON SK.idtecnologia = TC.idtecnologia
                        LEFT JOIN niveles NV ON SK.idnivel = NV.idnivel
                        WHERE (ID.nombre IS NOT NULL OR TC.nombre IS NOT NULL)
                        AND US.idrol = 1";
        /*"SELECT SK.idusuario
                    , NVL(US.apellidos, '') apellidos
                    , NVL(US.nombre, '') nombre
                    , NVL(SK.tipo, '') tipo
                    , NVL(ID.nombre, 'N/A') idioma
                    , NVL(TC.nombre, 'N/A') tecnologia
                    , NVL(NV.nivel, 'No definido') nivel
                    , NVL(US.telefono, 'No definido')telefono
                    , NVL(US.telcontacto, 'No definido')telcontacto
                    , NVL(US.email, '')email
                    , NVL(US.semestre, 'No definido')semestre
                    FROM skills SK
                    LEFT JOIN usuarios US ON SK.idusuario  = US.idusuario
                    LEFT JOIN idiomas ID ON SK.ididioma = ID.ididioma
                    LEFT JOIN tecnologias TC ON SK.idtecnologia = TC.idtecnologia
                    LEFT JOIN niveles NV ON SK.idnivel = NV.idnivel
                    WHERE US.idrol = 1";*/
        
        if(!empty($name)){
            $sqlQuery = $sqlQuery." AND UPPER(US.nombre) LIKE UPPER(NVL('%".$name."%',US.nombre))";
        }
        if(!empty($sname)){
            $sqlQuery = $sqlQuery." AND UPPER(US.apellidos) LIKE UPPER(NVL('%".$sname."%', US.apellidos))";
        }
        if(!empty($email)){
            $sqlQuery = $sqlQuery." AND UPPER(US.email) LIKE UPPER(NVL('%".$email."%', US.email))";
        }
        if(!empty($phone)){
            $sqlQuery = $sqlQuery." AND (US.telefono LIKE NVL('%".$phone."%', US.telefono) OR US.telcontacto LIKE NVL('%".$phone."%', US.telcontacto))";
        }
        if(!empty($skill)){
            $sqlQuery = $sqlQuery." AND (UPPER(ID.nombre) LIKE UPPER(NVL('%".$skill."%', ID.nombre)) OR UPPER(TC.nombre) LIKE UPPER(NVL('%".$skill."%', TC.nombre)))";
        }
        if(!empty($nivel)){
            $sqlQuery = $sqlQuery." AND UPPER(NV.nivel) LIKE UPPER(NVL('%".$nivel."%', NV.nivel))";
        }


        $sqlQuery = $sqlQuery." ORDER BY US.apellidos, SK.tipo DESC, NVL(ID.nombre, TC.nombre)";

    
        //Llamando a la función para generar la consulta
        $respuesta = consultaBD($dbh, $idsesion, $sqlQuery);
        if ($respuesta != false){
            $result = '<table id="usersTable" class="row-border compact stripe hover"><thead><tr>
                            <th>Apellidos</th>
                            <th>Nombre</th>
                            <th>Tipo de conocimiento</th>
                            <th>Conocimiento</th>
                            <th>Nivel</th>
                            <th>Teléfono</th>
                            <th>Teléfono de contacto</th>
                            <th>Email</th>
                            <th>Semestre</th>
                            </tr></thead><tbody>';
        
            while ($vtabla = $respuesta->fetch(PDO::FETCH_ASSOC)) {
                $result = $result.'<tr>
                                   <td>'.$vtabla['apellidos'].'</td>
                                   <td>'.$vtabla['nombre'].'</td>
                                   <td>'.$vtabla['tipo'].'</td>
                                   <td>'.$vtabla['habilidad'].'</td>
                                   <td>'.$vtabla['nivel'].'</td>
                                   <td>'.$vtabla['telefono'].'</td>
                                   <td>'.$vtabla['telcontacto'].'</td>
                                   <td>'.$vtabla['email'].'</td>
                                   <td>'.$vtabla['semestre'].'</td>
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

