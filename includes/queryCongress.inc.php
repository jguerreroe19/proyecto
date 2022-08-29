<?php
//Incluyendo archivos externos
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(($_SERVER["REQUEST_METHOD"] == "POST")){
    //Obtiene los datos del formulario
    $cname = $_POST["cname"];
    $details = $_POST["details"];
    $vflag = $_POST['mine'];
    $actFlag = $_POST['activo'];
    
    
    //Validando los valores de los checkbox
    if($vflag == 'true'){
        $vflag = 'Y';
    } else {
        $vflag = 'N';
    }

    if($actFlag == 'true'){
        $actFlag = 'Y';
    } else {
        $actFlag = 'N';
    }

    $idusuario = $_POST["iduser"];
    $idrol = $_POST["idrol"];
    $idsesion = $_POST["idsesion"];

    
    /*
    echo '$vflag: ' . $vflag;
    echo '</br>' ;
    echo '$actFlag: ' . $actFlag;
    echo '</br>' ;
    */
    $queryBase = "SELECT NVL(CN.idcongreso, '')id 
                    , NVL(CN.nombre, '')nombre
                    , NVL(CN.detalles, '')detalles
                    , NVL(CN.sede, '')sede
                    , NVL(CN.fechainicio, '')fechainicio
                    , NVL(CN.fechafin, '')fechafin
                    , NVL(CN.titulo, '')titulo
                    , CASE NVL(PR.idproyecto, '')
                        WHEN 1 THEN 'Sin proyecto asociado'
                        ELSE NVL(PR.titulo, '')
                    END proyectoasociado
                    , NVL(PR.descripcion, '')descripcion
                    , NVL(PR.tipo, '')tipo
                    , NVL(CN.idproyecto, '')idproyecto
                FROM congresos CN
                LEFT OUTER JOIN proyectos PR ON CN.idproyecto = PR.idproyecto
                WHERE 1=1";

    if($idrol == 1){ //Si el rol es alumno sólo mostrará los congresos activos
    $queryBase = $queryBase." AND CN.fechainicio <= CURDATE() AND CN.fechafin >= CURDATE()";   
    }
    if(!empty($cname)){ //Si se indíca el nombre del congreso 
    $queryBase = $queryBase." AND UPPER(CN.nombre) LIKE UPPER('%".$cname."%')";
    }
    if(!empty($details)){ //Si se indíca algún detalle del congreso
    $queryBase = $queryBase." AND UPPER(CN.detalles) LIKE UPPER('%".$details."%')";
    }
    if($vflag == 'Y'){ //Trae los congresos generados por el usuario activo
    $queryBase = $queryBase." AND CN.creadopor = '".$idusuario."'";
    }
    if($actFlag == 'Y'){ //Trae sólo los congresos activos
        $queryBase = $queryBase." AND CN.fechainicio <= CURDATE() AND CN.fechafin >= CURDATE()";
    }
	
    //Llamando a la función para generar la consulta
    $respuesta = consultaBD($dbh, $idsesion, $queryBase);

    if ($respuesta != false){
        $result = '<table id="datosCongreso" class="table-responsive"><thead><tr>
                        <th>ID</th>    
                        <th>Nombre</th>
                        <th>Detalles</th>
                        <th>Sede</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de termino</th>
                        <th>Documento a otorgar</th>
                        <th>Proyecto asociado</th>
                        <th>Detalles del proyecto</th>
                        </tr></thead><tbody>';
        //Definiendo opciones a mostrar en base al rol
        switch ($idrol) {
            case 1: //Alumno
                $result = $result.'<th>Detalles de Asignación</th></tr></thead>';
                break;
            case 2: //Profesor
                $result = $result.'<th></th></tr></thead>';
                break;
            default: //Otro
                ErrorLog($dbh, $idsesion, 'El rol no permite consultar congresos '.$e, 'ISE_011');
        }
        while ($vtabla = $respuesta->fetch(PDO::FETCH_ASSOC)) {
            $result = $result.'<tr>
                               <td>'.$vtabla['id'].'</td>
                               <td>'.$vtabla['nombre'].'</td>
                               <td>'.$vtabla['detalles'].'</td>
                               <td>'.$vtabla['sede'].'</td>
                               <td>'.$vtabla['fechainicio'].'</td>
                               <td>'.$vtabla['fechafin'].'</td>
                               <td>'.$vtabla['titulo'].'</td>';
            //Varia si tiene o no proyecto asignado
            if($vtabla['proyectoasociado'] =='Sin proyecto asociado') {
                $result = $result.'<td>'.$vtabla['proyectoasociado'].'</td><td> N/A </td>';
            }else{
                $result = $result.'<td>'.$vtabla['proyectoasociado'].'</td>
                        <td><button name="detalles" class="datos btn btn-secondary" style="vertical-align:middle"><span><i class="bi bi-eye"></i> Detalles </span></button></td>';
            }
            
            //Definiendo opciones a mostrar en base al rol
            switch ($idrol) {
                case 1: //Alumno
                    if (validateApplyVacancy($dbh, $vtabla['id'], $idusuario) == false){
                        $result = $result.'<td style="display:none;">'.$vtabla['descripcion'].'</td>
                                           <td style="display:none;">'.$vtabla['tipo'].'</td>
                                           <td style="display:none;">'.$vtabla['idproyecto'].'</td>
                                           <td><button name="asignar" class="asignaBtn btn btn-secondary" style="vertical-align:middle"><span><i class="bi bi-eye"></i> Asignación </span></button></td>
                                           </tr>';
                    }else{
                        $result = $result.'<td style="display:none;">'.$vtabla['descripcion'].'</td>
                                           <td style="display:none;">'.$vtabla['tipo'].'</td>
                                           <td style="display:none;">'.$vtabla['idproyecto'].'</td>
                                           <td> N/A </td></tr>';
                    }
                break;
                case 2: //Profesor
                    $result = $result.'<td style="display:none;">'.$vtabla['descripcion'].'</td>
                                       <td style="display:none;">'.$vtabla['tipo'].'</td>
                                       <td style="display:none;">'.$vtabla['idproyecto'].'</td>
                                       <td>
                                       <button class="asociar btn btn-secondary" style="vertical-align:middle"><span><i class="bi bi-person-plus"></i> Asociar Alumno </span></button>
                                       <button class="editar btn btn-secondary" style="vertical-align:middle"><span><i class="bi bi-pencil-square"></i> Editar </span></button>
                                       <button class="eliminar btn btn-secondary" style="vertical-align:middle"><span><i class="bi bi-trash"></i> Eliminar </span></button>
                                       </td></tr>';
                break;
                default: //Otro
                    ErrorLog($dbh, $idsesion, 'El rol no permite consultar congresos '.$e, 'ISE_011');
                    
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



	//Llamando la función para generar la tabla de congresos
    //queryCongressTable($dbh, $cname, $details, $vflag, $actFlag, $idusuario, $idrol);

    //echo $valor;
		

} else{
    //Regresa a la página inicial
    //echo "entra aqui";
    header("location: ../index.php");
    exit();
}

?>

