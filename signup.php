<?php
    include_once 'header.php';
?>

<section class="signup-form">
    <h2> Registro </h2>
    <form action="includes/signup.inc.php" method="post">

    <?php
    if(isset($_GET["error"])){
        if (isset($_GET['name'])){
            $name=$_GET['name'];
        }else{
            $name='';
        }

        if (isset($_GET['sname'])){
            $sname=$_GET['sname'];
        }else{
            $sname='';
        }

        if (isset($_GET['email'])){
            $email=$_GET['email'];
        }else{
            $email='';
        }

        ?>
        <label for="name">Nombre(s)</label><br>
        <input type="text" name="name" placeholder="Nombre" value="<?php echo $name;?>" required><br><br>
        <label for="sname">Apellidos</label><br>
        <input type="text" name="sname" placeholder="Apellidos" value="<?php echo $sname;?>" required><br><br>
        <label for="email">Email</label><br>
        <input type="text" name="email" placeholder="Email" value="<?php echo $email;?>" required><br><br>
        <label for="pwd">Contraseña</label><br>
        <input type="password" name="pwd" placeholder="Contraseña" required><br><br>
        <label for="pwdrepeat">Confirmar contraseña</label><br>
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
        <label for="name">Nombre(s)</label><br>
        <input type="text" name="name" placeholder="Nombre" required><br><br>
        <label for="sname">Apellidos</label><br>
        <input type="text" name="sname" placeholder="Apellidos" required><br><br>
        <label for="email">Email</label><br>
        <input type="text" name="email" placeholder="Email" required><br><br>
        <label for="pwd">Contraseña</label><br>
        <input type="password" name="pwd" placeholder="Contraseña" required><br><br>
        <label for="pwdrepeat">Confirmar contraseña</label><br>
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