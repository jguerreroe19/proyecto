<?php
    include_once 'header.php';
?>

<section class="signup-form">
    <h2> Registro </h2>
    <form action="includes/signup.inc.php" method="post">
        <input type="text" name="name" placeholder="Nombre" required><br><br>
        <input type="text" name="sname" placeholder="Apellidos" required><br><br>
        <input type="text" name="email" placeholder="Email" required><br><br>
        <input type="password" name="pwd" placeholder="Contraseña" required><br><br>
        <input type="password" name="pwdrepeat" placeholder="Confirmar contraseña" required><br><br>
        <button type="submit" name="submit">Registrarse</button><br><br>
    </form>

    <?php
    if(isset($_GET["error"])){
        if($_GET["error"] == "emptyinput"){
            echo "<p>Los campos no deben estar vacios</p>";
        } else if($_GET["error"] == "invaliduser"){
            echo "<p>Elige un nombre de usuario válido </p>";
        } else if($_GET["error"] == "passwordsdontmatch"){
            echo "<p>La contraseña y la confirmación no coinciden</p>";
        } else if($_GET["error"] == "stmtfailed"){
            echo "<p>Algo salió mal, por favor vuelve a intentar.</p>";
        } else if($_GET["error"] == "usrnametaken"){
            echo "<p>El usaurio elegido ya está en uso. Elige otro</p>";
        } else if($_GET["error"] == "stmtfailedinc"){
            $v1=$_GET['msg1'];
            echo "<p>Algo salió mal. Reporta el siguiente código de error al administrador del sistema <br><strong>Error:</strong>'.$v1.'</p>";
        }else if($_GET["error"] == "none"){
            echo "<p>Usuario creado exitosamente!</p>";
        }
    }
    ?>
</section>

<?php
    include_once 'footer.php';
?>