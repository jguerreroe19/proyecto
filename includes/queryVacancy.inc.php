<?php
//Incluyendo archivos externos
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(($_SERVER["REQUEST_METHOD"] == "POST")){
    //Obtiene los datos del formulario
    $title = $_POST["titulo"];
    $details = $_POST["detalles"];
    $vflag = $_POST["mias"];
    $idusuario = $_POST["idusuario"];
    $idrol = $_POST["idrol"];
    $idsesion = $_POST["idsesion"];
    
    $result='';

     //Formando el query en base a los datos de consulta
     $queryBase = "SELECT NVL(idvacante, '')id
                , NVL(titulo, '')titulo
                , NVL(detalles, '')detalles
                , NVL(fechapublicacion, '')fechapublicacion
                , NVL(fechafin, '')fechafin
                , NVL(telefono, '')telefono
                , NVL(email, '')email
                , NVL(idusuario, '')idusuario
            FROM vacantes
            WHERE 1=1";

    if($idrol == 1){ //Si el rol es alumno sólo mostrará las vacantes activas y publicadas
    $queryBase = $queryBase." AND fechapublicacion <= sysdate() AND fechafin >= sysdate()";   
    }
    if(!empty($title)){ //Si se indíca el nombre de la vacante 
    $queryBase = $queryBase." AND UPPER(titulo) LIKE UPPER('%".$title."%')";
    }
    if(!empty($details)){ //Si se indíca algúnd detalle de la vacante
    $queryBase = $queryBase." AND UPPER(detalles) LIKE UPPER('%".$details."%')";
    }
    if($vflag == 'true'){ //Trae las vacantes generadas por el usuario activo
    $queryBase = $queryBase." AND idusuario = '".$idusuario."'";
    }

    //Llamando a la función para generar la consulta
    $respuesta = consultaBD($dbh, $idsesion, $queryBase);

    if ($respuesta != false){
        $result = '<h2>Listado de vacantes</h2></br>
                    <table>
                    <tr>
                    <th>ID</th>    
                    <th style="display:none;">Creadopor</th>
                    <th>Titulo</th>
                    <th>Detalles</th>
                    <th>Fecha de publicación</th>
                    <th>Fecha de expiración</th>';

        //Definiendo opciones a mostrar en base al rol
        switch ($idrol) {
            case 1: //Alumno
                $result = $result.'<th></th></tr>';
                break;
            case 2: //Profesor
                $result = $result.'<th>Teléfono de contacto</th>
                                          <th>Email de contacto</th>
                                          <th></th>
                                          </tr>';
                break;
            case 3: //Administrador
                $result = $result.'<th>Teléfono de contacto</th>
                                          <th>Email de contacto</th>
                                          </tr>';    
                break;
            default: //Otro
                ErrorLog($dbh, $idsesion, 'El rol no permite consultar vacantes '.$e, 'ISE_009');
        }
                    
        
        while ($vtabla = $respuesta->fetch(PDO::FETCH_ASSOC)) {
            $result = $result.'<tr><td>'.$vtabla['id'].'</td>
                               <td style="display:none;">'.$vtabla['idusuario'].'</td>
                               <td>'.$vtabla['titulo'].'</td>
                               <td>'.$vtabla['detalles'].'</td>
                               <td>'.$vtabla['fechapublicacion'].'</td>
                               <td>'.$vtabla['fechafin'].'</td>';

            //Definiendo opciones a mostrar en base al rol
            switch ($idrol) {
                case 1: //Alumno
                    if (validateApplyVacancy($dbh, $vtabla['id'], $idusuario) == false){
                        $result = $result.'<td style="display:none;">'.$vtabla['telefono'].'</td>
                                           <td style="display:none;">'.$vtabla['email'].'</td>
                                           <td><button class="btn btn-secondary btnPostularse" style="vertical-align:middle"><span>Postularse </span></button></td></tr>';    
                    }else{
                        $result = $result.'<td style="display:none;">'.$vtabla['telefono'].'</td>
                                           <td style="display:none;">'.$vtabla['email'].'</td>
                                           <td><button class="btn btn-secondary btnMostrarDatos" style="vertical-align:middle"><span><i class="bi bi-eye"></i> Mostrar datos </span></button></td></tr>';
                    }
                break;
                case 2: //Profesor
                    $result = $result.'<td>'.$vtabla['telefono'].'</td>
                                             <td>'.$vtabla['email'].'</td>
                                             <td>
                                                <button class="btn btn-secondary btnEditar" style="vertical-align:middle"><span><i class="bi bi-pencil-square"></i> Editar </span></button>
                                                <button class="btn btn-secondary btnEliminar" style="vertical-align:middle"><span><i class="bi bi-trash"></i> Eliminar </span></button>
                                             </td></tr>';
                break;
                case 3: //Administrador
                    $result = $result.'<td>'.$vtabla['telefono'].'</td>
                                             <td>'.$vtabla['email'].'</td></tr>';
                break;
                default: //Otro
                        ErrorLog($dbh, $idsesion, 'El rol no permite consultar vacantes '.$e, 'ISE_009');
                
                }
        } //end while 
        $result = $result.'</tbody></table>';
        
        //Devolviendo el valor
        echo $result;
        exit();
    }else{
        echo '<p> La consulta no generó datos. Revise los datos ingresados y vuelva a intentar</p>';
        exit();
    }

    //Llamando a la función para generar la tabla de resultados
	//$respuesta = vacancyQueryTable($dbh, $idusuario, $idrol, $title, $details, $vflag);
	//echo $respuesta;
	
} else{
    //Regresa a la página inicial
    //echo "entra aqui";
    header("location: ../index.php");
    exit();
}

?>