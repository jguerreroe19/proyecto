<?php
    include_once 'header.php';
	//Incluyendo archivos externos
	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';

	//Variables de sesión
	$sid = $_SESSION["sid"];
?>
    
<section class="addRole-form">
<h2>Consultar Alumnos</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <p>Ingresar la combinación de valores en los campos según los datos a buscar. Dejar los campos en blanco para traer todos los resultados</p>
        </br></br>
        <label for="nombre">Nombre: </label>       
		<input type="text" name="nombre" id="nombre" placeholder="Nombre"></br></br>
        <label for="apellidos">Apellidos: </label>       
		<input type="text" name="apellidos" id="apellidos" placeholder="Apellidos"></br></br>
        <label for="email">Email: </label>       
		<input type="text" name="email" id="email" placeholder="Email"></br></br>
        <label for="telefono">Teléfono: </label>       
		<input type="text" name="telefono" id="telefono" placeholder="Teléfono"></br></br>
        <label for="habilidad">Habilidad o Idioma: </label>       
		<input type="text" name="habilidad" id="habilidad" placeholder="Habilidad o Idioma"></br></br>
        <label for="nivel">Nivel </label>       
		<input type="text" name="nivel" id="nivel" placeholder="Nivel"></br></br>
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
            $name = validaEntrada($_POST["nombre"]);
            $sname = validaEntrada($_POST["apellidos"]);
            $email = validaEntrada($_POST["email"]);
            $phone = validaEntrada($_POST["telefono"]);
            $skill = validaEntrada($_POST["habilidad"]);
            $nivel = validaEntrada($_POST["nivel"]);
			?>    
			<h2>Listado de usuarios</h2>
			<table>
			<tr>
                <th>Apellidos</th>
                <th>Nombre</th>
			    <th>Tipo de conocimiento</th>
                <th>Idioma</th>
                <th>Tecnología</th>
                <th>Nivel</th>
			    <th>Teléfono</th>
			    <th>Teléfono de contacto</th>
			    <th>Email</th>
			    <th>Semestre</th>
			</tr>
			<?php
			queryAlumnos($dbh, $name, $sname, $email, $phone, $skill, $nivel, $sid);
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