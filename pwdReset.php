<?php
    include_once 'header.php';
?>
    <script type='text/javascript' src='js/pwdReset.js'></script>
<?php
    include_once 'header2.php';
	//Incluyendo archivos externos
	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';

    //Valida si hay sesión activa, de lo contrario redirecciona al index.
    if (isset($_SESSION["sid"])){
?>
    <section class="pwdReset-form">
        <h2> Restablecer contraseña</h2>
        </br>
        <div class="container">
            <form action="includes/queryUsers.inc.php" method="post" class="row g-3">
                <div class="col-md-6">
                    <label for="buscar" class="col-sm-2 col-form-label labelPopUp">Usuario</label>
                    <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Buscar usuario">
                </div>
                <input type="hidden" name="iduser" id="iduser" value="<?php echo $_SESSION["idusuario"];?>">
                <input type="hidden" name="idsesion" id="idsesion" value="<?php echo $_SESSION["sid"];?>">
                <input type="hidden" name="idrol" id="idrol" value="<?php echo $_SESSION["idrol"];?>">
                <div class="col-md-12">
                    <input type="button" id="btnBuscar" class="buttonEnviar" value="Buscar">
                </div>
            </form>
        </div>        
            </br>
        <!-- Bloque que muestra los mensajes del sistema -->
		<div id="mensajes" class="col-md-12 collapse hide" style="background-color: #d3d3d4; padding:0.5rem; font-size: 19px;"></div> 
		<!-- Bloque que muestra la tabla con los resultados -->
		<div id="tablaResultados" class="col-md-12 collapse hide"></div> 	

    </section>

    <!--Ventana emeregente para pedir la nueva contraseña-->
    <div class="modal fade" id="popUpResetPwd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background: #e7e7e7;">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloPopup">Ingrese la nueva contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="includes/resetPassword.inc.php" method="post" id="formTest">
                            <label for="pwdPopup" class = "labelPopUp">Contraseña: </label>	
                            <i class="bi bi-exclamation-circle malPwd" style="color:red; display:none" data-bs-toggle="tooltip" data-bs-placement="right" title="La contraseña debe contener al menos:&#10;8 dígitos&#10;1 mayúscula&#10;1 minúscula&#10;1 número&#10;1 caracter especial"></i>
                            <input type="password" id="pwdPopup" name="pwdPopup" class="inputPopUp contrasena" placeholder="Nueva contraseña">
                            <label for="pwdconfirmPopup" class = "labelPopUp" id="idLabelSkill">Confirmar contraseña: </label>
                            <i class="bi bi-exclamation-circle malPwdConf" style="color:red; display:none" data-bs-toggle="tooltip" data-bs-placement="right" title="Las contraseñas no coinciden"></i>	
                            <input type="password" id="pwdconfirmPopup" name="pwdconfirmPopup" class="inputPopUp contrasenaRpt" placeholder="Confirmar nueva contraseña">
                            <input type="text" id="idusr" name="idusr" hidden>
                            <input type="button" value="Guardar" id="guardarPopupbtn" class="btn btn-secondary">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </form>
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
        var modalDatos = new bootstrap.Modal(document.getElementById("popUpResetPwd"), {});
    </script>
<?php
}else{
    //Redirecciona al index si no hay sesión activa
    header("location: index.php");
    exit();   
}
    include_once 'footer.php';
?>