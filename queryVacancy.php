<?php
    include_once 'header.php';
	//Incluyendo archivos externos
	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';
    //Definiendo el idusuario en base a la variable de sesión
	$idusuario = $_SESSION["idusuario"]; 
    $idrol = $_SESSION["idrol"];
?>
    
<section class="queryskills-form">
<h2> Consulta de Vacantes</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

        <label for="title">Titulo: </label>
        <input type="text" name="title" id="title" placeholder = "Buscar por título"></br></br>
        <label for="details">Detalles: </label>
        <input type="text" name="details" id="details" placeholder = "Buscar por detalles"></br></br>
        
        <?php //Muestra el checkbox sólo para el rol Profesor
            if($idrol == 2){
        ?>
                <label for="mine">Registradas por mi</label>
                <input type="checkbox" name="mine" id="mine"></br></br></br>
         <?php    
            }
        ?>
        <input type="hidden" name="iduser" id="iduser" value="<?php echo $idusuario;?>">
        <input type="hidden" name="idrol" id="idrol" value="<?php echo $idrol;?>">
		<button type="submit" name="submit">Buscar</button>
    </form>
		
        <?php
		//Obteniendo el valor seleccionado en el primer combobox
        if(isset($_POST["submit"])){
            //Obtiene los datos del formulario
            $title = $_POST["title"];
            $details = $_POST["details"];
            if(isset($_POST['mine'])){
                $vflag = 'Y';
            } else {
                $vflag = 'N';
            }
            $idusuario = $_POST["iduser"];
            $idrol = $_POST["idrol"];

            //Llamando la función para armar la tabla
            vacancyQueryTable($dbh, $idusuario, $idrol, $title, $details, $vflag);

            }
            ?>

		
		<?php
        //Mostrando mensajes de error o confirmación
		if(isset($_GET["error"])){
				if($_GET["error"] == "noneUpdate"){
					echo "<p>Habilidad actualizada correctamente!</p>";
				}else if($_GET["error"] == "errorUpdate"){
					echo "<p>No se pudo actualizar la habilidad. Intente nuevamente o contacte al administrador.</p>";
				}else if($_GET["error"] == "noneDelete"){
					echo "<p>Habilidad eliminada correctamente!</p>";
				}else if($_GET["error"] == "errorDelete"){
					echo "<p>No se pudo eliminar la habilidad. Intente nuevamente o contacte al administrador.</p>";
				}
		}


		?>
</section>
<?php
    include_once 'footer.php';
?>