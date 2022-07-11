<?php
    include_once 'header.php';
?>
<section class="login-form">
    
    <?php
        if (isset($_SESSION["idusuario"])){
            echo '<h2> Bienvenido(a) '.$_SESSION["usernombre"].' </h2>';
        } else {
    ?>        
    <h2>Acceso</h2>
    <form action="includes/login.inc.php" method="post" id="formLogin">
        <label for="email">Email</label><br>
        <input type="text" id="email" name="email" class= "correoe" placeholder="Email">
            <i class="bi bi-asterisk malEmail" style="color:red; display: none; font-size:0.5vw;"> Email no válido</i>
			<i class="bi bi-check-lg okEmail" style="color:green; display: none; font-size:0.5vw;"></i>
        <br><br>
        <label for="pwd">Contraseña</label><br>
        <input type="password" id="pwd" name="pwd" placeholder="Contraseña"><br><br>
        <button type="button" id="btnEnviarLogin">Ingresar</button>
        <br><br>
    </form>
    <?php
        }
    if(isset($_GET["error"])){
        if($_GET["error"] == "emptyinput"){
            echo "<p>Los campos no pueden estar vacios</p>";
        } else if($_GET["error"] == "wronglogin"){
            echo "<p>Datos de acceso incorrectos</p>";
        } else if($_GET["error"] == "OSE_001"){
            echo "<p>No se pudieron obtener los detalles de la sesión</p>";
        } else if($_GET["error"] == "OSE_002"){
            echo "<p>No fue posible generar la sesión</p>";
        } else if($_GET["error"] == "sessionexpired"){
            echo "<p>La sesión expiró</p>";
        }


        
    }
    ?>
</section>

<?php
    include_once 'footer.php';
?>