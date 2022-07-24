<?php
    include_once 'header.php';
	//Incluyendo archivos externos
	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';
    //Valida si hay sesión activa, de lo contrario redirecciona al index.
    if (isset($_SESSION["sid"])){
    //Definiendo el idusuario en base a la variable de sesión
	$idusuario = $_SESSION["idusuario"]; 
    $idRol = $_SESSION["idrol"];
?>
    
<section class="addRole-form">
<h2>Asignar Roles</h2>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>Fecha de registro</th>
            <th>Rol</th>
            <th>Guardar</th>
        </tr>
        <?php
            //Llamando la función para armar el cuerpo de la tabla
            queryUserRole($dbh, $idRol);
        ?>	
    </table>
    <br><br>
    <br><br>
    <?php
        //Mostrando mensajes de error o confirmación
		if(isset($_GET["error"])){
				if($_GET["error"] == "none"){
					echo "<p>Rol asignado correctamente!</p>";
				}else if($_GET["error"] == "errorUpdate"){
					echo "<p>No se pudo actualizar el rol. Intente nuevamente o contacte al administrador.</p>";
				}else if($_GET["error"] == "nochanges"){
					echo '<p>Selecciona un rol diferente a "Registrado".</p>';
				}
		}
	?>
</section>
<?php
}else{
    //Redirecciona al index si no hay sesión activa
    header("location: index.php");
    exit();   
}
    include_once 'footer.php';
?>