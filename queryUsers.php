<?php
include_once 'header.php';
?>
	<script type='text/javascript' src='js/queryUsers.js'></script>
<?php
include_once 'header2.php';
//Incluyendo archivos externos
require_once 'includes/dbh.inc.php';
require_once 'includes/functions.inc.php';

//Valida si hay sesión activa, de lo contrario redirecciona al index.
if (isset($_SESSION["sid"])){
?>
    
<section class="queryUsers-form">
	<h2>Consultar Usuarios</h2>
	<div class="container">
		<form name="qUsers" id = "formConsUsuarios" action="#" method="post" class="row g-3">

			<p>Buscar por nombre, apellido o correo electrónico. Dejar el campo en blanco para traer todos los resultados</p>
			</br></br>
			<div class="col-md-6"> 
				<label for="buscar" class="form-label labelPopUp">Buscar: </label>
				<input type="text" name="buscar" id="buscar" class="form-control" placeholder="Usuario a buscar">
			</div>
			<div class="col-12">
				<input type="hidden" name="idrol" id="idrol" value="<?php echo $_SESSION["idrol"];?>">	
				<input type="hidden" name="idsesion" id="idsesion" value="<?php echo $_SESSION["sid"];?>">
				<input type="button" value="Buscar" id="btnBuscar" class="buttonEnviar">
			</div>
		</form>
	</div>
	</br>
	<!--Muestra la respuesta que se recibe de Ajax-->
	<div id="mensajes" class="col-md-12 collapse hide" style="background-color: #d3d3d4; padding:0.5rem; font-size: 19px;"></div>
	<!--Muestra la respuesta que se recibe de Ajax-->
	<div id="tablaResultados" class="col-md-12 collapse hide"></div>
</section>
		
			<?php
			/*
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
			*/
			?>

<?php
}else{
    //Redirecciona al index si no hay sesión activa
    header("location: index.php");
    exit();   
}
    include_once 'footer.php';
?>