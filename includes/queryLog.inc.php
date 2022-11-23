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
        
        $query = "SELECT NVL(B.idsesion, '') idsesion
                            , NVL(B.idusuario, '') idusuario
                            , NVL(U.email, '') usuario
                            , NVL(B.host, '') host
                            , NVL(B.fechainicio, '') fechainicio
                            , NVL(B.fechafin, '') fechafin
                            , NVL(TIMESTAMPDIFF(second, B.fechainicio, B.fechafin), '') duracion
                    FROM bitacora B
                    INNER JOIN usuarios U ON B.idusuario = U.idusuario
                    WHERE (UPPER(U.email) LIKE UPPER('".$dato."') OR UPPER(B.host) LIKE UPPER('".$dato."'))";
        
        //Ajustando los datos de fechas
        if ($check == 'true'){
            if ($fechaini > $fechafin){
                echo 'wrongDateRange';
                exit();
            }else{
                $query = $query." AND DATE(B.fechainicio) >= '".$fechaini."' AND DATE(B.fechafin) <= '".$fechafin."'";
            }
            
        }

        $query = $query." ORDER BY B.idsesion";
        
        //Llamando a la función para generar la consulta
        $respuesta = consultaBD($dbh, $idsesion, $query);
        if ($respuesta != false){
            $result = '<table id="logTable" class="row-border compact stripe hover"><thead><tr>
                            <th>ID Sesión</th>
                            <th>ID Usuario</th>
                            <th>Usuario</th>
                            <th>Host</th>
                            <th>Fecha de inicio</th>
                            <th>Fecha de fin</th>
                            <th>Duración en segundos</th>
                            </tr></thead><tbody>';
        
            while ($vtabla = $respuesta->fetch(PDO::FETCH_ASSOC)) {
                $result = $result.'<tr>
                                   <td>'.$vtabla['idsesion'].'</td>
                                   <td>'.$vtabla['idusuario'].'</td>
                                   <td>'.$vtabla['usuario'].'</td>
                                   <td>'.$vtabla['host'].'</td>
                                   <td>'.$vtabla['fechainicio'].'</td>
                                   <td>'.$vtabla['fechafin'].'</td>
                                   <td>'.$vtabla['duracion'].'</td>
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
    
   /*
        //Mostrando mensajes de error o confirmación
		if(isset($_GET["error"])){
				if($_GET["error"] == "statementerror"){
					echo "<p>Error al ejecutar la consulta. Intente nuevamente o reportelo con el administrador</p>";
				}
		}

        if(isset($_POST["submit"])){
            //Obtiene los datos del formulario
            $dato = $_POST["buscar"];
            
            //Si el check está marcado
            if (isset($_POST['cfechas'])){
                $check = $_POST["cfechas"];
                $fechaini = $_POST["fechaini"];
                $fechafin = $_POST["fechafin"];
                

            } else {
                $check = 'no';
                $fechaini = '0';
                $fechafin = '0';
            }

			?>    
			<h2>Bitácora de accesos</h2>
			<table>
			<tr>
			  <th>ID Sesión</th>
			  <th>ID Usuario</th>
			  <th>Usuario</th>
			  <th>Host</th>
			  <th>Fecha de inicio</th>
			  <th>Fecha de fin</th>
			  <th>Duración en segundos</th>
			</tr>
			<?php
			queryLog($dbh, $dato, $sid, $check, $fechaini, $fechafin);
			?>	
		  </table>
		  <br><br>
		  <br><br>
		  <?php
        }
    */

} else{
    //Regresa a la página inicial
    //echo "entra aqui";
    header("location: ../index.php");
    exit();
}

?>

