<?php
    include_once 'header.php';
?>
    <script type='text/javascript' src='js/signup.js'></script>
<?php
    include_once 'header2.php';
?>

<section class="signup-form debajodelNav">
    </br></br>
    <div class="form-holder d-flex align-items-baseline">
    <form action="includes/signup.inc.php" method="post" id="formSignUp" class="row g-3 needs-validation" novalidate>
		    <div class="col-12">
                <label for="name" class="form-label labelPopUp">Nombre(s)</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Ingresa tu nombre" required>
            </div>
            <div class="col-12">
                <label for="sname" class="form-label labelPopUp">Apellidos</label>
                <input type="text" class="form-control" name="sname" id="sname" placeholder="Ingresa tus apellidos" required>
            </div>
            <div class="col-12">
                <label for="email" class="form-label labelPopUp">Email</label>
                <input type="text" class="form-control correoe" name="email" id="email" placeholder="Ingresa tu Email" required>
                <div class="invalid-feedback malEmail">
                Email no válido
                </div>
            </div>
            <div class="col-md-6">
                <label for="pwd" class="form-label labelPopUp">Contraseña</label>
                <input type="password" class="form-control contrasena" name="pwd" id="pwd" placeholder="Ingresa una contraseña" required>
                <div class="invalid-feedback malPwd">
                La contraseña debe contener al menos:</br> 8 dígitos</br> 1 mayúscula</br> 1 minúscula</br> 1 número</br> 1 caracter especial
                </div>
            </div>
            <div class="col-md-6">
                <label for="pwdrepeat" class="form-label labelPopUp">Confirmar contraseña</label>
                <input type="password" class="form-control contrasenaRpt" name="pwdrepeat" id="pwdrepeat" placeholder="Confirma la contraseña" required>
                <div class="invalid-feedback malPwdConf">
                Las contraseñas no coinciden
                </div>
            </div>
            <div class="col-12">
                <input type="button" id="btnRegistrar" class="buttonEnviar" value="Registrar">
            </div>
            <!--Muestra la respuesta que se recibe de Ajax-->
            <div id="respuesta" class="alert alert-dark col-md-12" role="alert"></div>
    </form>
    </div>
</section>

<?php
    include_once 'footer.php';
?>