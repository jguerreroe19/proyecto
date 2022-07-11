<?php
    include_once 'header.php';
    //Incluyendo archivos externos
    require_once 'includes/dbh.inc.php';
    require_once 'includes/functions.inc.php';
?>
<section class="personal-info-form">
    <h2> Información personal </h2>
    <p> Ingresa o edita tus datos </p>
    <form name="dpersonales" id = "dpersonales" action="includes/profile.inc.php" method="post">
<?php
//Obteniendo el valor del id de usuario de las variables de sesión.
$idusuario = $_SESSION["idusuario"];
try{
    //Sentencia para traer los datos almacenados en la BD y poder mostrar los que ya existan
    $sentencia = $dbh->prepare("SELECT NVL(nombre, '') nombre, NVL(apellidos, '') apellidos, NVL(fechanacimiento, '') fechanacimiento
                                , NVL(telefono, '') telefono, NVL(email, '') email, NVL(telcontacto, '') telcontacto, NVL(semestre, '') semestre
                                , NVL(numeromatricula, '') numeromatricula, NVL(numeroempleado, '') numeroempleado
                                FROM usuarios WHERE idusuario = :idusuario");
    $sentencia->bindParam(':idusuario', $idusuario);
    //Ejecutando la sentencia
    $sentencia->execute();
    //Obteniendo los datos
    $usuario = $sentencia->fetch(PDO::FETCH_ASSOC);
?>
        <label for="name">Nombre:</label></br>    
        <input type="text" name="name" id="name" placeholder="Nombre" value= "<?php echo $usuario["nombre"];?>" required><br><br>
        <label for="sname">Apellidos:</label></br>
        <input type="text" name="sname" id="sname" placeholder="Apellidos" value= "<?php echo $usuario["apellidos"];?>" required><br><br>
        <label for="bdate">Fecha de nacimiento:</label></br>
        <input type="date" name="bdate" id="bdate" placeholder="Fecha de nacimiento" value= "<?php echo $usuario["fechanacimiento"];?>"><br><br>
        <label for="phone">Teléfono:</label></br>
        <input type="text" name="phone" id="phone" placeholder="Teléfono" value= "<?php echo $usuario["telefono"];?>"><br><br>
        <label for="email">Email:</label></br>
        <input type="text" name="email" id="email" placeholder="Email" value= "<?php echo $usuario["email"];?>" readonly><br><br>
        <label for="cphone">Teléfono de contacto:</label></br>
        <input type="text" name="cphone" id="cphone" placeholder="Teléfono de contacto" value= "<?php echo $usuario["telcontacto"];?>"><br><br>
<?php        
        if (isset($_SESSION["idrol"])){
                if ($_SESSION["idrol"] == '1'){
?>      
        <label for="semEmp">Semestre:</label></br>
        <input type="text" name="semEmp" id="semEmp" placeholder="Semestre" value= "<?php echo $usuario["semestre"];?>"><br><br>
        
<?php        
                }else{
?>
        <label for="semEmp">No. de empleado:</label></br>
        <input type="text" name="semEmp" id="semEmp" placeholder="No de empleado" value= "<?php echo $usuario["numeroempleado"];?>"><br><br>
<?php        
                }
        }
?>
        <label for="matricula">Matricula:</label></br>
        <input type="text" name="matricula" id="matricula" placeholder="Matricula" value= "<?php echo $usuario["numeromatricula"];?>"><br><br>
        <input type="hidden" name="iduser" id="iduser" value="<?php echo $idusuario;?>">
        <input type="hidden" name="idsesion" id="idsesion" value="<?php echo $_SESSION["sid"];?>">
        <input type="hidden" name="idrol" id="idrol" value="<?php echo $_SESSION["idrol"];?>">
        
<?php
} catch (PDOException $e) {
    ErrorLog($dbh, $idsesion, 'No se pudieron recuperar los datos del usuario. '.$e, 'OSE_004');
}
?>
         <button type="button" id="btnEnviar">Guardar</button>
         <br><br>
         <!--<button type="submit" name="submit">Guardar</button>-->
    </form>
</section>

<!--Muestra la respuesta que se recibe de Ajax-->
<div id="respuesta"></div>


<?php
    /*
    if(isset($_GET["error"])){
        if($_GET["error"] == "emptyinput"){
            echo "<p>Los campos no pueden estar vacios</p>";
        }else if($_GET["error"] == "ISE_001"){
            echo "<p>No se pudieron actualizar los datos, vuelve a intentarlo</p>";
        }else if($_GET["error"] == "none"){
            echo "<p>Datos actualizados exitosamente!</p>";
        }
    }
    */
?>

<script>
			$('#btnEnviar').click(function(){  
			
			var vName = $('#name').val();
			var vSname = $('#sname').val();
			var correo = $('#email').val();
            var fecnac = $('#bdate').val();
			var tel = $('#phone').val();
            var telcont = $('#cphone').val();

            var semEmp = $('#semEmp').val();
            var mat = $('#matricula').val();
            var idusr = $('#iduser').val();
            var idsesn = $('#idsesion').val();
            var idrl = $('#idrol').val();

            
			
			var ruta = "name="+vName
                      +"&sname="+vSname
                      +"&email="+correo
                      +"&bdate="+fecnac
                      +"&phone="+tel
                      +"&cphone="+telcont
                      +"&semEmp="+semEmp
                      +"&matricula="+mat
                      +"&iduser="+idusr
                      +"&idsesion="+idsesn
                      +"&idrol="+idrl;
			
			$.ajax({
				url: 'includes/profile.inc.php',
				type: 'POST',
				data: ruta,
			})
			.done(function(res){
				$('#respuesta').html(res)
			})
			.fail(function(){
				console.log("Fallo");
			})
			.always(function(){
				console.log("Complete");
			});
			
			});
	
	</script>

<?php
    include_once 'footer.php';
?>