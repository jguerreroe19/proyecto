<?php
    include_once 'header.php';
	//Incluyendo archivos externos
	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';
    //Definiendo el idusuario en base a la variable de sesión
	$idusuario = $_SESSION["idusuario"]; 
    $idrol = $_SESSION["idrol"];
    //Valida si hay sesión activa, de lo contrario redirecciona al index.
    if (isset($_SESSION["sid"])){
?>
    
<section class="queryvacancy-form">
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

            ?>
            <div id="popup" style="display: none;">     
            <div class="content-popup">        
            <div class="close"><a href="#" id="close">Cerrar</a></div>         
            <div>          
            <h2 id = "tituloPopUp">Título del pop up</h2>             
            <p id = "datosPopUp">Datos de contacto</p>             
            <p id = "datostel">Telefono: </p>             
            <p id = "datosemail">Email: </p>
            <div style="float:left; width:100%;"> </div> </div></div></div>
            <div class="popup-overlay"></div> 
            <?php

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
				}else if($_GET["error"] == "statementerror"){
					echo "<p>Error en el módulo de vacantes. Intente nuevamente o contacte al administrador.</p>";
				}else if($_GET["error"] == "vacancynotexist"){
					echo "<p>No se encontró la vancante seleccionada. Intente nuevamente o contacte al administrador.</p>";
				}else if($_GET["error"] == "applyvacancyerror"){
					echo "<p>Se produjo un error en el proceso de postulación. Intentelo nuevamente</p>";
				}else if($_GET["error"] == "none"){
					echo "<p>Vacante aplicada exitosamente. Consulte las vacantes nuevamete para ver los datos de contacto.</p>";
				}else if($_GET["error"] == "vacancyalreadyapplied"){
					echo "<p>La vacante seleccionada ya fue aplicada</p>";
				}
                
                
                
		}


		?>
</section>

<script>
    //Función para mostrar los datos de contacto cuando una vacante ya fue aplicada
    $(document).ready(function(){
        $(".datos").on('click',function(){
            var currentRow =$(this).closest("tr");
            //var col1=currentRow.find("td:eq(0)").text();
            var col2=currentRow.find("td:eq(1)").text();
            //var col3=currentRow.find("td:eq(2)").text();
            //var col4=currentRow.find("td:eq(3)").text();
            //var col5=currentRow.find("td:eq(4)").text();
            var col6=currentRow.find("td:eq(5)").text();
            var col7=currentRow.find("td:eq(6)").text();
            
            //alert(col1 + "\n" + col2 + "\n" + col3 + "\n" + col4 + "\n" + col5 + "\n" + col6+ "\n" + col7);

            $("#tituloPopUp").text(function(i, origText){
            return "Vacante: " + col2; 
            });
            
            $("#datostel").text(function(i, origText){
            return "Telefono: " + col6;
            });

            $("#datosemail").text(function(i, origText){
            return "Email: " + col7;
            });
            
            $('#popup').fadeIn('slow');         
            $('.popup-overlay').fadeIn('slow');         
            $('.popup-overlay').height($(window).height());         
            return false;
        });

        $('#close').on('click', function(){         
            $('#popup').fadeOut('slow');         
            $('.popup-overlay').fadeOut('slow');         
        return false;     });
    });
</script>

<?php
}else{
    //Redirecciona al index si no hay sesión activa
    header("location: index.php");
    exit();   
}
    include_once 'footer.php';
?>