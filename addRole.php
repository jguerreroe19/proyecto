<?php
    include_once 'header.php';
?>
	<script type='text/javascript' src='js/addRole.js'></script>
<?php
    include_once 'header2.php';
	//Incluyendo archivos externos
	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';
    //Valida si hay sesión activa, de lo contrario redirecciona al index.
    if (isset($_SESSION["sid"])){
    //Definiendo el idusuario en base a la variable de sesión
	$idusuario = $_SESSION["idusuario"]; 
    $idRol = $_SESSION["idrol"];
?>
    
    <section class="addRole-form debajodelNav">
        <div class="container">
            <form name="qLog" id = "formAddRole" action="#" method="post" class="row g-3">
                <div class="col-12">
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <i class="bi bi-info-circle"></i> Indicaciones
                    </button>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                        Ingrese el usuario a buscar (email), nombre o apellido. Seleccione el rol y presione el botón guardar.
                        </div>
                    </div>
                </div>
                <div class="col-md-6"> 
				    <label for="buscar" class="form-label labelPopUp">Buscar: </label>
				    <input type="text" name="addRoleBuscar" id="addRoleBuscar" class="form-control" placeholder="Filtrar datos">
			    </div>
                <div class="col-12">
				    <input type="hidden" name="idrol" id="idrol" value="<?php echo $idRol;?>">	
				    <input type="hidden" name="idsesion" id="idsesion" value="<?php echo $_SESSION["sid"];?>">
                    <input type="button" value="Buscar" id="btnBuscar" class="buttonEnviar">
                </div> 	
            </form>
        </div> 
        </br></br>
        <!--Muestra la respuesta que se recibe de Ajax-->
	    <div id="tablaResultados" class="container-xl collapse hide" style="padding-top: 30px;"></div>
    </section>

<?php
}else{
    //Redirecciona al index si no hay sesión activa
    header("location: index.php");
    exit();   
}
    include_once 'footer.php';
?>