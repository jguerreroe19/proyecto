<?php
    include_once 'header.php';
	//Incluyendo archivos externos
	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';

	//Variables de sesión
	$sid = $_SESSION["sid"];
?>
    
<section class="addRole-form">
<h2>Consultar Usuarios</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

        <p>Buscar por nombre, apellido o correo electrónico. Dejar el campo en blanco para traer todos los resultados</p>
        </br></br>
		<input type="text" name="buscar" id="buscar" placeholder="Buscar">
		<button type="submit" name="submit">Buscar</button>
    </form>
	
	
		<?php
        //Mostrando mensajes de error o confirmación
		if(isset($_GET["error"])){
				if($_GET["error"] == "statementerror"){
					echo "<p>Error al ejecutar la consulta. Intente nuevamente o reportelo con el administrador</p>";
				}
		}

        if(isset($_POST["submit"])){
            //Obtiene los datos del formulario
            $dato = $_POST["buscar"];
			?>    
			<h2>Listado de usuarios</h2>
			<table>
			<tr>
			  <th>Nombre</th>
			  <th>Apellidos</th>
			  <th>Fecha de Nacimiento</th>
			  <th>Teléfono</th>
			  <th>Teléfono de contacto</th>
			  <th>Email</th>
			  <th>Rol</th>
			  <th>Semestre</th>
			  <th>Número de empleado</th>
			  <th>Número de matricula</th>
			  <th>Fecha de registro</th>
			  <th>Fecha de inactivación</th>
			  <th>Bloqueado</th>
			</tr>
			<?php
			queryUsers($dbh, $dato, $sid);
			?>	
		  </table>
		  <br><br>
		  <br><br>
		  <?php
        }
		?>
</section>
<?php
    include_once 'footer.php';
?>