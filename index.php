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
    <form action="includes/login.inc.php" method="post">
        <label for="email">Email</label><br>
        <input type="text" name="email" placeholder="Email"><br><br>
        <label for="pwd">Contraseña</label><br>
        <input type="password" name="pwd" placeholder="Contraseña"><br><br>
        <button type="submit" name="submit">Ingresar</button><br><br>
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