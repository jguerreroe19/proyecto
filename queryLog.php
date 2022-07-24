<?php
    include_once 'header.php';
	//Incluyendo archivos externos
	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';
    //Valida si hay sesión activa, de lo contrario redirecciona al index.
    if (isset($_SESSION["sid"])){
	//Variables de sesión
	$sid = $_SESSION["sid"];

    
    // Obteniendo la fecha actual del servidor
    $date = date('Y-m-d');
    //echo $date;
    
?>
    
<section class="addRole-form">
<h2>Consultar Bitácora</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

        <label for="Tipo">Buscar por correo electrónico (usuario) o host. Dejar el campo en blanco para traer todos los resultados</label>
        </br></br>
		<label for="buscar">Buscar:</label>
        <input type="text" name="buscar" id="buscar" placeholder="Buscar"></br></br>
        
        <input type="checkbox" id="cfechas" name="cfechas" value="yes" onClick="DisableDates();"> <label for="cfechas">Consultar por rango de fechas</label></br></br>
        
        <label for="fechaini">Fecha Inicio:</label>
        <input type="date" name="fechaini" id='fechaini' value="<?php echo $date; ?>" min="2022-04-01" max="<?php echo $date; ?> " disabled>
        <label for="fechafin">Fecha Fin:</label>
        <input type="date" name="fechafin" id='fechafin' value="<?php echo $date; ?>" min="2022-04-01" max="<?php echo $date; ?> " disabled></br></br>
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
            
            //Si el check está marcado
            if (isset($_POST['cfechas'])){
                $check = $_POST["cfechas"];
                $fechaini = $_POST["fechaini"];
                $fechafin = $_POST["fechafin"];
                

            } else {
                $check = 'no';
                $fechaini = '0';
                $fechafin = '0';
            }

			?>    
			<h2>Bitácora de accesos</h2>
			<table>
			<tr>
			  <th>ID Sesión</th>
			  <th>ID Usuario</th>
			  <th>Usuario</th>
			  <th>Host</th>
			  <th>Fecha de inicio</th>
			  <th>Fecha de fin</th>
			  <th>Duración en segundos</th>
			</tr>
			<?php
			queryLog($dbh, $dato, $sid, $check, $fechaini, $fechafin);
			?>	
		  </table>
		  <br><br>
		  <br><br>
		  <?php
        }
		?>
</section>
<script>
    //Función para activar / desactivar los campos de fechas
    function DisableDates(){
    if (document.getElementById('cfechas').checked) 
    {
        document.getElementById("fechaini").disabled = false;
        document.getElementById("fechafin").disabled = false;        
    } else {
        document.getElementById("fechaini").disabled = true;
        document.getElementById("fechafin").disabled = true;
    }
    }
</script>

<?php
    }else{
        //Redirecciona al index si no hay sesión activa
        header("location: index.php");
        exit();   
    }
    include_once 'footer.php';
?>