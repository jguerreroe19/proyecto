<?php
    include_once 'header.php';
?>
    <script type='text/javascript' src='js/index.js'></script>
    <!--Recaptcha-->
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY; ?>"></script>
<?php
    include_once 'header2.php';
?>  
    <div class="container-fluid bg-imagen"></div><!--Background-->
<?php
    if (isset($_SESSION["idusuario"])){
        ?>
            <div class="bg-texto-sm col-12 col-md-6 col-lg-5 col-xl-5" style="border-radius: 2rem;">   
                <div class="mb-md-5 mt-md-4 pb-5"> 
        <?php
                    echo '<h2 class="fw-bold mb-2"> Bienvenido(a) '.$_SESSION["usernombre"].' </h2>';
        ?>  
                </div>
            </div>

        <?php
        } else {
?>  
        <div class="container-fluid bg-imagen"></div>
        <div class="bg-texto col-12 col-md-6 col-lg-5 col-xl-5" style="border-radius: 2rem;">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h2 class="fw-bold mb-2 text-uppercase">Acceso al sistema</h2>
                                </br>
                                <form action="includes/login.inc.php" method="post" id="formLogin" class="row g-3 needs-validation" novalidate>
                                <div class="form-outline form-white mb-4">
                                    <label for="email" class="form-label labelPopUp"><i class="bi bi-envelope"></i> Email</label>     
                                    <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Ingresa tu Email" required>
                                    <div class="invalid-feedback" id="emailmsg">Revise la estructura del correo electrónico ingresado</div>
                                      
                                </div>
                                <div class="form-outline form-white mb-4">
                                    <label class="form-label labelPopUp" for="pwd"><i class="bi bi-key"></i> Contraseña</label>    
                                    <input type="password" id="pwd" name="pwd" minlength="3" class="form-control form-control-lg" placeholder="Ingresa tu contraseña" required>
                                </div>
                                <div class="col-12">
                                    <button type="button" class="btn btn-link text-white-50" id="PwdRstBtn">¿Olvidaste la contraseña?</button> 
                                </div>
                                <div class="col-12">
                                    <input type="hidden" name="google-response-token" id="google-response-token"> 
                                    <input type="submit" class="buttonEnviar" value="Entrar">
                                </div>
                                
                                <!--<button class="btn btn-outline-light btn-lg px-5" type="submit" id="btnEnviarLogin" >Entrar</button> 
                                    <input type="button" id="btnEnviar" class="buttonEnviar" value="Entrar">
                                -->
                                </form>
                            </div>
                            <div id="respuesta">
                                    <?php
                                    if(isset($_GET["error"])){
                                        if($_GET["error"] == "emptyinput"){
                                            echo '<div class= "alert alert-warning d-flex align-items-center alert-dismissible fade show" role="alert">
                                                      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                                      <div>
                                                        Los campos no pueden estar vacios
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                      </div>
                                                  </div>';
                                        } else if($_GET["error"] == "wronglogin"){
                                            echo '<div class= "alert alert-warning d-flex align-items-center alert-dismissible fade show" role="alert">
                                                      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                                      <div>
                                                        Datos de acceso incorrectos
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                      </div>
                                                  </div>';
                                        } else if($_GET["error"] == "OSE_001"){
                                            echo '<div class= "alert alert-warning d-flex align-items-center alert-dismissible fade show" role="alert">
                                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                                    <div>
                                                        No se pudieron obtener los detalles de la sesión
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>
                                                  </div>';
                                        } else if($_GET["error"] == "OSE_002"){
                                            echo '<div class= "alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                                    <div>
                                                        No fue posible generar la sesión
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>
                                                  </div>';
                                        } else if($_GET["error"] == "errorCaptcha"){
                                            echo '<div class= "alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                                    <div>
                                                        Error en la validación del captcha
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>
                                                  </div>';
                                        } else if($_GET["error"] == "sessionclosed"){
                                            echo '<div class= "alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                                    <div>
                                                        Se ha cerrado la sesión!
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>
                                                  </div>';
                                        }
                                    }
                                    ?>
                            </div>
                            <div>
                                <?php
                                    //Valida si la opción de registro está activa y de ser así la muestra
                                    if (obtieneParametro($dbh, 'registro') == 'checked'){
                                        ?>
                                            <p class="mb-0">¿No tienes acceso? <a href="signup.php" class="text-white-50 fw-bold">Registrate</a></p>
                                        <?php
                                    }
                                ?>
                            </div>
        </div>
        
        

    <!--Ventana emeregente para mostrar la solicitud de restablecimiento de contraseña-->
        <div class="modal fade" id="mResetPwd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="background: #e7e7e7;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Restablecer contraseña</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <input type="email" id="popUpEmail" name="popUpEmail" class="form-control form-control-lg" placeholder="Ingresa tu Email">
                    </div>
                        <div class="modal-footer">
                            <input type="button" value="Enviar" id="btnEnviar" class="btn btn-secondary">
                        </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        
    <script>
        //Variable para obtener los ids de los Modales
        var modalresetPassword = new bootstrap.Modal(document.getElementById("mResetPwd"), {});

        //Botón para mostrar pantalla de restablecimiento de contraseña
        $('#PwdRstBtn').on('click', function(){
                
                console.log('Boton');

                //Muestra la ventana emergente
                modalresetPassword.show();
                
            });
        
        //Recaptcha Script
        grecaptcha.ready(function() {
          grecaptcha.execute('<?php echo SITE_KEY; ?>', {action: 'submit'}).then(function(token) {
              console.log(token);
              $('#google-response-token').val(token);
          });
        });
    
    </script>
<?php
    include_once 'footer.php';
?>