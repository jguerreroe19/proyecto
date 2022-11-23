<?php
    include_once 'header.php';
?>
    <script type='text/javascript' src='js/unlockUser.js'></script>
<?php
    include_once 'header2.php';
	//Incluyendo archivos externos
	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';

    //Valida si hay sesión activa, de lo contrario redirecciona al index.
    if (isset($_SESSION["sid"])){
?>
    <section class="unlockUser-form debajodelNav">
        </br>
        <div class="container">
            <form name="unlockUsrF" id="unlockUsrForm" action="#" method="post" class="row g-3">
                <div class="col-12">
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <i class="bi bi-info-circle"></i> Indicaciones
                    </button>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            Ingrese el nombre de usuario a debloquear o deje el campo en blanco para traer todos los resultados.
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="buscar" class="col-sm-2 col-form-label labelPopUp">Usuario</label>
                    <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Buscar usuario">
                </div>
                <input type="hidden" name="iduser" id="iduser" value="<?php echo $_SESSION["idusuario"];?>">
                <input type="hidden" name="idsesion" id="idsesion" value="<?php echo $_SESSION["sid"];?>">
                <input type="hidden" name="idrol" id="idrol" value="<?php echo $_SESSION["idrol"];?>">
                <div class="col-md-12">
                    <input type="button" id="btnBuscar" class="buttonEnviar" value="Buscar">
                    <input type="button" value="Limpiar campos" id="limpiaCampos" class="buttonEnviar limpiaCampos">
                </div>
            </form>
        </div>        
            </br>
        <!-- Bloque que muestra los mensajes del sistema -->
		<div id="mensajes" class="col-md-12 collapse hide" style="background-color: #d3d3d4; padding:0.5rem; font-size: 19px;"></div> 
		<!-- Bloque que muestra la tabla con los resultados -->
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