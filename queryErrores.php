<?php
    include_once 'header.php';
?>
	<script type='text/javascript' src='js/queryErrores.js'></script>
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
                        Buscar por código de error, detalles o ambos. Dejarlos en blanco para traer todos los resultados.
                        </br>
                        Habilitar el checkbox para realizar búsquedas por rango de fechas.
                    </div>
                </div>
            </div>
            <div class="col-md-6"> 
				<label for="cError" class="form-label labelPopUp">Código de error: </label>
				<input type="text" name="cError" id="cError" class="form-control" placeholder="Ingrese el código de error">
			</div>
            <div class="col-md-6"> 
				<label for="bDetalles" class="form-label labelPopUp">Detalles: </label>
				<input type="text" name="bDetalles" id="bDetalles" class="form-control" placeholder="Ingrese el texto a buscar">
			</div>
            <div class="col-12">
                <div class="form-check">
                    <input type="checkbox" name="cfechas" id="cfechas" class="form-check-input" value="yes" onClick="DisableDates();">
                    <label class="form-check-label" for="cfechas">Consultar por rango de fechas</label>
                </div> 
            </div>  
            <div class="col-md-6">  
                <label for="fechaini" class="form-label labelPopUp">Fecha Inicio:</label>
                <input type="date" name="fechaini" id='fechaini' class="form-control" value="<?php echo $date; ?>" min="2022-04-01" max="<?php echo $date; ?> " disabled>
            </div>  
            <div class="col-md-6">  
                <label for="fechafin" class="form-label labelPopUp">Fecha Fin:</label>
                <input type="date" name="fechafin" id='fechafin' class="form-control" value="<?php echo $date; ?>" min="2022-04-01" max="<?php echo $date; ?> " disabled>
            </div> 
            <div class="col-12">
				<input type="hidden" name="idrol" id="idrol" value="<?php echo $_SESSION["idrol"];?>">	
				<input type="hidden" name="idsesion" id="idsesion" value="<?php echo $_SESSION["sid"];?>">
				<input type="button" value="Buscar" id="btnBuscar" class="buttonEnviar">
            </div> 		

        </form>
    </div> 
	</br>
	<!--Muestra la respuesta que se recibe de Ajax-->
	<div id="mensajes" class="col-md-12 collapse hide" style="background-color: #d3d3d4; padding:0.5rem; font-size: 19px;"></div>
	<!--Muestra la respuesta que se recibe de Ajax-->
	<div id="tablaResultados" class="container-xl collapse hide" style="padding-top: 30px;"></div>
</section>

<script>
    //Función para activar / desactivar los campos de fechas
    function DisableDates(){
    if (document.getElementById('cfechas').checked) 
    {
        document.getElementById("fechaini").disabled = false;
        document.getElementById("fechafin").disabled = false;        
    } else {
        document.getElementById("fechaini").disabled = true;
        document.getElementById("fechafin").disabled = true;
    }
    }
</script>

<?php
    }else{
        //Redirecciona al index si no hay sesión activa
        header("location: index.php");
        exit();   
    }
    include_once 'footer.php';
?>