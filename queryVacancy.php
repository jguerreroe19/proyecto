<?php
    include_once 'header.php';
?>
    <script type='text/javascript' src='js/queryVacancy.js'></script>
<?php
    include_once 'header2.php';
    
    //Valida si hay sesión activa, de lo contrario redirecciona al index.
    if (isset($_SESSION["sid"])){
    
    //Incluyendo archivos externos
	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';
    //Definiendo el idusuario en base a la variable de sesión
	$idusuario = $_SESSION["idusuario"]; 
    $idrol = $_SESSION["idrol"];
    
    //Fecha Actual
    $hoy = date("Y-m-d");
?>
        <section class="queryvacancy-form debajodelNav">
            <div class="container">
                <form name ="formQueryVacancy" id="formQueryVacancy" action="#" method="post" class="row g-3">
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

        <!--Ventana emeregente para editar la información de las vacantes-->
        <div class="modal fade" id="popUpEditVacancy" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background: #e7e7e7;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tituloPopup">Detalles de la vacante</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="#" method="post" id="editVacancyForm" class="row g-3 needs-validation" novalidate>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="col-md-12">
                                    <label for="vacanteTitle" class="form-label labelPopUp">Título:</label>
                                    <input type="text" name="title" id="vacanteTitle" class="form-control" placeholder="Ingresa el título"  required>
                                    <div class="invalid-feedback">Debe especificar el título de la vacante</div>
                                </div>
                                <div class="col-md-12">
                                    <label for="vacanteDetails" class="form-label labelPopUp">Detalles:</label>
                                    <textarea name="details" id="vacanteDetails" rows="10" class="form-control" required></textarea>
                                    <div class="invalid-feedback">Debe ingresar los detalles de la vacante</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="vacantePdate" class="form-label labelPopUp">Fecha de publicación:</label>
                                        <input type="date" name="pdate" id="vacantePdate" class="form-control" placeholder="Fecha de publicación" min="<?php echo $hoy;?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="vacanteEdate" class="form-label labelPopUp">Fecha de vencimiento:</label>
                                        <input type="date" name="edate" id="vacanteEdate" class="form-control" placeholder="Fecha de vencimiento" min="<?php echo $hoy;?>" required>
                                </div>
                                </div>
                                <div class="col-12">
                                    <hr>
                                    <p style="text-align: center; font-weight: bold;" class="labelPopUp"> Datos de contacto </p>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="vacantePhone" class="form-label labelPopUp">Teléfono:</label>
                                        <input type="text" name="phone" id="vacantePhone" class="form-control telefono" placeholder="Ingresa el teléfono" maxlength=10 required>
                                        <div class="invalid-feedback">Debe ingresar el teléfono de contacto</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="vacanteEmail" class="form-label labelPopUp">Email:</label>
                                        <input type="email" name="email" id="vacanteEmail" class="form-control" placeholder="Ingresa el email" required>
                                        <div class="invalid-feedback" id="emailmsg">La estructura del correo electrónico es incorrecta</div>
                                    </div>
                                </div>
                                <div style="text-align: center;" class="col-12">
                                    <input type="hidden" name="idvacante" id="idvacante">
                                    <input type="hidden" name="idsesion" id="idsesion" value="<?php echo $_SESSION["sid"];?>">
                                    <input type="hidden" name="idrol" id="idrol" value="<?php echo $_SESSION["idrol"];?>">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div style="text-align: center;" class="col-12">
                                <input type="button" id="btnEditarVacante" class="buttonEnviar" value="Guardar">
                                <input type="button" id="btnCancelar" class="buttonEnviar" data-bs-dismiss="modal"  value="Cancelar">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <script>
        //Variable para obtener los ids de los Modales
        var modalDatos = new bootstrap.Modal(document.getElementById("popUpVacancy"), {});
        var modalEdit = new bootstrap.Modal(document.getElementById("popUpEditVacancy"), {});
    </script>

    <?php
}else{
    //Redirecciona al index si no hay sesión activa
    header("location: index.php");
    exit();   
}
    include_once 'footer.php';
?>