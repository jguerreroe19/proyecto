<?php
    include_once 'header.php';
    include_once 'header2.php';
?>
    <section class="vh-100 gradient-custom">
<?php
    if (isset($_SESSION["idusuario"])){
            echo '<h2> Bienvenido(a) '.$_SESSION["usernombre"].' </h2>';
        } else {
?>  
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h2 class="fw-bold mb-2 text-uppercase">Acceso al sistema</h2>
                                </br>
                                <form action="includes/login.inc.php" method="post" id="formLogin">
                                <div class="form-outline form-white mb-4">
                                    <label class="form-label" for="email"><i class="bi bi-envelope"></i> Email</label>    
                                    <input type="text" id="email" name="email" class="form-control form-control-lg" placeholder="Ingresa tu Email">
                                </div>
                                <div class="form-outline form-white mb-4">
                                    <label class="form-label" for="pwd"><i class="bi bi-key"></i> Contraseña</label>    
                                    <input type="password" id="pwd" name="pwd" class="form-control form-control-lg" placeholder="Ingresa tu contraseña">
                                </div>
                                <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">¿Olvidaste la contraseña?</a></p>
                                <button class="btn btn-outline-light btn-lg px-5" type="submit" id="btnEnviarLogin">Entrar</button>
                                </form>
                            </div>
                            <!--Muestra la respuesta que se recibe de Ajax-->
                            <div id="respuesta">
                                    <?php
                                    if(isset($_GET["error"])){
                                        if($_GET["error"] == "emptyinput"){
                                            echo '<p><i class="bi bi-exclamation-circle" style="color:yellow;"></i> Los campos no pueden estar vacios</p>';
                                        } else if($_GET["error"] == "wronglogin"){
                                            echo '<p><i class="bi bi-exclamation-circle" style="color:yellow;"></i> Datos de acceso incorrectos</p>';
                                        } else if($_GET["error"] == "OSE_001"){
                                            echo '<p><i class="bi bi-exclamation-circle" style="color:yellow;"></i> No se pudieron obtener los detalles de la sesión</p>';
                                        } else if($_GET["error"] == "OSE_002"){
                                            echo '<p><i class="bi bi-exclamation-circle" style="color:red;"></i> No fue posible generar la sesión</p>';
                                        } else if($_GET["error"] == "sessionclosed"){
                                            echo '<p><i class="bi bi-exclamation-circle" style="color:yellow;"></i> Se ha cerrado la sesión!</p>';
                                        }
                                    }
                                    ?>
                            </div>
                            <div>
                            <p class="mb-0">¿No tienes acceso? <a href="signup.php" class="text-white-50 fw-bold">Registrate</a>
                            </p>
                            </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <?php
        }
        ?>        
<?php
    include_once 'footer.php';
?>