<?php
    include_once 'header.php';
?>
    <script type='text/javascript' src='js/setup.js'></script>
<?php
    include_once 'header2.php';

    //Incluyendo archivos externos
    require_once 'includes/dbh.inc.php';
    require_once 'includes/functions.inc.php';

    if (isset($_SESSION["sid"])){

?>
        <section class="setUp debajodelNav">
            </br></br>
            <div class="container">
                <form name="fSetUp" id = "formSetUp" action="#" method="post" class="row g-3">
                <div class="mb-3 row">
                    <label for="duracionSesion" class="col-sm-2 col-form-label">Duración de la sesión <button type="button" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Fijar el tiempo de duración de la sesión de los usuarios en el sistema (tiempo en segundos)"><i class="bi bi-info-circle"></i></button></label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="duracionSesion" value="<?php echo obtieneParametro($dbh, 'expiracion');?>">
                    </div>
                </div>    
                    <div class="col-md-12"> 
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="notificaciones" <?php echo obtieneParametro($dbh, 'notificacion'); ?>>
                            <label class="form-check-label" for="notificaciones" >Envío de notificaciones por email <button type="button" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Habilitar el envío de correos electrónicos desde la aplicación"><i class="bi bi-info-circle"></i></button></label>
                        </div>
                        </br>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="registro" <?php echo obtieneParametro($dbh, 'registro'); ?>>
                            <label class="form-check-label" for="registro">Permitir registro de usuarios nuevos <button type="button" class="btn btn-link" data-bs-toggle="tooltip" data-bs-placement="top" title="Habilitar la opción de registro de usuarios nuevos desde la página principal"><i class="bi bi-info-circle"></i></button></label>
                        </div>
                    </div>
                    <div class="col-12">
                        </br></br>
                        <input type="hidden" name="idrol" id="idrol" value="<?php echo $_SESSION["idrol"];?>">	
                        <input type="hidden" name="idsesion" id="idsesion" value="<?php echo $_SESSION["sid"];?>">
                        <input type="button" value="Guardar" id="btnGuardar" class="buttonEnviar">
                    </div>
                </form>
            </div>
        </section>

        <script>
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        </script>
<?php
    }else{
        //Redirecciona al index si no hay sesión activa
        header("location: index.php");
        exit();   
    }
    include_once 'footer.php';
?>