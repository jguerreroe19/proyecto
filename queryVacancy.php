<?php
    include_once 'header.php';
?>
    <script type='text/javascript' src='js/queryVacancy.js'></script>
<?php
    include_once 'header2.php';
	//Incluyendo archivos externos
	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';
    //Definiendo el idusuario en base a la variable de sesión
	$idusuario = $_SESSION["idusuario"]; 
    $idrol = $_SESSION["idrol"];
    //Valida si hay sesión activa, de lo contrario redirecciona al index.
    if (isset($_SESSION["sid"])){
?>
        <section class="queryvacancy-form">
            <h2> Consulta de Vacantes</h2>
            <div class="container">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="row g-3">
                    <div class="col-md-6">
                        <label for="title" class="form-label labelPopUp">Titulo: </label>
                        <input type="text" name="title" id="title" class="form-control" placeholder = "Buscar por título">
                    </div>
                    <div class="col-md-6">
                        <label for="details" class="form-label labelPopUp">Detalles: </label>
                        <input type="text" name="details" id="details" class="form-control" placeholder = "Buscar por detalles">
                    </div>
                    <?php //Muestra el checkbox sólo para el rol Profesor
                        if($idrol == 2){
                    ?>
                        <div class="col-12">
                            <div class="form-check">
                                <input type="checkbox" name="mine" id="mine" class="form-check-input">
                                <label class="form-check-label" for="mine">Registradas por mi</label>
                            </div>
                        </div>
                    <?php    
                        }
                    ?>
                    <input type="hidden" name="iduser" id="iduser" value="<?php echo $idusuario;?>">
                    <input type="hidden" name="idrol" id="idrol" value="<?php echo $idrol;?>">
                    <input type="hidden" name="idsesion" id="idsesion" value="<?php echo $_SESSION["sid"];?>">
                    <div class="col-12"> 
                        <input type="button" value="Buscar" id="btnBuscar" class="buttonEnviar">
                    </div>
                </form>
            </div>
            </br>
                <!-- Bloque que muestra los mensajes del sistema -->
                <div id="mensajes" class="col-md-12 collapse hide" style="background-color: #d3d3d4; padding:0.5rem; font-size: 19px;"></div> 
                <!-- Bloque que muestra la tabla con los resultados -->
                <div id="tablaResultados" class="col-md-12 collapse hide"></div> 	
        </section>

        <!--Ventana emeregente para mostrar información de las vacantes-->
        <div class="modal fade" id="popUpVacancy" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background: #e7e7e7;">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloPopup">Detalles de la vacante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="telefonoPopup" class = "labelPopUp">Teléfono: </label>	
                    <input type="text" id="telefonoPopup" name="telefonoPopup" class="inputPopUp" value="Tipo" disabled>
                    <label for="emailPopup" class = "labelPopUp" id="idLabelSkill">Email: </label>	
                    <input type="text" id="emailPopup" name="emailPopup" class="inputPopUp" value="Habilidad" disabled>
                </div>
                <div class="modal-footer">
                    <!--Muestra la respuesta que se recibe de Ajax-->
                    <div id="confirmaPopUp"></div>        
            </div>
            </div>
        </div>
        </div>
    <script>
        //Variable para obtener los ids de los Modales
        var modalDatos = new bootstrap.Modal(document.getElementById("popUpVacancy"), {});
    </script>

    <?php
}else{
    //Redirecciona al index si no hay sesión activa
    header("location: index.php");
    exit();   
}
    include_once 'footer.php';
?>