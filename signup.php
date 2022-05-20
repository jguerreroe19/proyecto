<?php
    include_once 'header.php';
?>

<section class="signup-form">
    <h2> Registro </h2>
    <form action="includes/signup.inc.php" method="post">

    <?php
    if(isset($_GET["error"])){
        $name=$_GET['name'];
        $sname=$_GET['sname'];
        $email=$_GET['email'];
        ?>
        <input type="text" name="name" placeholder="Nombre" value="<?php echo $name;?>" required><br><br>
        <input type="text" name="sname" placeholder="Apellidos" value="<?php echo $sname;?>" required><br><br>
        <input type="text" name="email" placeholder="Email" value="<?php echo $email;?>" required><br><br>
        <input type="password" name="pwd" placeholder="Contraseña" required><br><br>
        <input type="password" name="pwdrepeat" placeholder="Confirmar contraseña" required><br><br>
        <button type="submit" name="submit">Registrarse</button><br><br>
        <?php
        if($_GET["error"] == "emptyinput"){
            echo "<p>Los campos no deben estar vacios</p>";
        } else if($_GET["error"] == "passwordsdontmatch"){
            echo "<p>La contraseña y la confirmación no coinciden</p>";
        } else if($_GET["error"] == "usrnametaken"){
            echo "<p>El correo electrónico ingresado ya está registrado.</p>";
        } else if($_GET["error"] == "stmtfailedinc"){
            $v1=$_GET['msg1'];
            echo "<p>Algo salió mal. Reporta el siguiente código de error al administrador del sistema <br><strong>Error:</strong>'.$v1.'</p>";
        }else if($_GET["error"] == "none"){
            echo "<p>Usuario creado exitosamente!</p>";
        }else if($_GET["error"] == "invalidpassword"){
            $v1=$_GET['msg1'];
            echo '<strong>Error:</strong><br>'.$v1;
        }
    }else{
        ?>
        <input type="text" name="name" placeholder="Nombre" required><br><br>
        <input type="text" name="sname" placeholder="Apellidos" required><br><br>
        <input type="text" name="email" placeholder="Email" required><br><br>
        <input type="password" name="pwd" placeholder="Contraseña" required><br><br>
        <input type="password" name="pwdrepeat" placeholder="Confirmar contraseña" required><br><br>
        <button type="submit" name="submit">Registrarse</button><br><br>
        <?php
    }
    ?>
    </form>
</section>

<?php
    include_once 'footer.php';
?>