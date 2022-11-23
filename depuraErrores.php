<?php
    include_once 'header.php';
?>
	<script type='text/javascript' src='js/depuraErrores.js'></script>
<?php
    include_once 'header2.php';
	//Incluyendo archivos externos
	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';
    //Valida si hay sesión activa, de lo contrario redirecciona al index.
    if (isset($_SESSION["sid"])){
	//Variables de sesión
	$sid = $_SESSION["sid"];

    
    // Obteniendo la fecha actual del servidor
    $date = date('Y-m-d');
    //echo $date;
    $hoy = date("Y-m-d");
    $d=strtotime("-3 Months");
    $d2=strtotime("+2 Months");
    $m=strtotime("-95 Days");
    $fechaMax = date("Y-m-d", $d);
    $fechaIni = date("Y-m-d", $m);
    $fechaFin2 = date("Y-m-d", $d2);
    
?>
    
<section class="queryMov-form debajodelNav">
    <div class="container">
        <form name="qLog" id = "formConsErrors" action="#" method="post" class="row g-3">
            </br></br>
            <div class="col-12">
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <i class="bi bi-info-circle"></i> Indicaciones
                </button>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <ul>
                            <li>Ingrese el periodo de fechas en el que desea depurar la tabla de bitácora de accesos.
                            Una vez eliminados los registros no se podrán recuperar.</li>
                            <li>Sólo se permite la depuración de información de 3 meses de antiguedad hacia atrás</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">  
                <label for="fechaini" class="form-label labelPopUp">Fecha Inicio:</label>
                <input type="date" name="fechaini" id='fechaini' class="form-control" value="<?php echo $fechaIni; ?>" min="2022-04-01" max="<?php echo $fechaMax; ?>">
            </div>  
            <div class="col-md-6">  
                <label for="fechafin" class="form-label labelPopUp">Fecha Fin:</label>
                <input type="date" name="fechafin" id='fechafin' class="form-control" value="<?php echo $fechaMax; ?>" min="2022-04-01" max="<?php echo $fechaMax; ?>">
            </div> 
            <div class="col-12">
				<input type="hidden" name="idrol" id="idrol" value="<?php echo $_SESSION["idrol"];?>">	
				<input type="hidden" name="idsesion" id="idsesion" value="<?php echo $_SESSION["sid"];?>">
				<input type="button" value="Depurar" id="btnDepurar" class="buttonEnviar">
            </div> 		

        </form>
    </div>
    <div class="container" style="padding: 30px;">
		<canvas id="graficaErrores"></canvas>
	</div> 
</section>

<?php
    }else{
        //Redirecciona al index si no hay sesión activa
        header("location: index.php");
        exit();   
    }
    include_once 'footer.php';
?>