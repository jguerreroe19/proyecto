<?php
    include_once 'header.php';
?>
<section class="signup-form">
    
    <?php
        if (isset($_SESSION["idusuario"])){
            echo '<h2> Bienvenido(a) '.$_SESSION["usernombre"].' </h2>';
        } else {
    ?>        
    <h2>Log in</h2>
    <form action="includes/login.inc.php" method="post">
        <input type="text" name="email" placeholder="Email"><br><br>
        <input type="password" name="pwd" placeholder="Contraseña"><br><br>
        <button type="submit" name="submit">Log In</button><br><br>
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
        }
    }
    ?>
</section>

<?php
    include_once 'footer.php';
?>