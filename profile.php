<?php
    include_once 'header.php';
    //Incluyendo archivos externos
    require_once 'includes/dbh.inc.php';
    require_once 'includes/functions.inc.php';
    //Valida si hay sesión activa, de lo contrario redirecciona al index.
    if (isset($_SESSION["sid"])){
?>
<section class="personal-info-form">
    <h2> Información personal </h2>
    <h4> Ingresa o edita tus datos </h4>
     <!--<form name="dpersonales" id = "dpersonales" action="includes/profile.inc.php" method="post">-->
    <div class="form-holder d-flex align-items-baseline ">
    <form action="includes/profile.inc.php" method="post" name="dpersonales" id = "dpersonales"  class="row g-3 needs-validation" novalidate>
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
		    <div class="col-12">
                <label for="name" class="form-label labelPopUp">Nombre(s)</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Ingresa tu nombre" value= "<?php echo $usuario["nombre"];?>" required>
            </div>
            <div class="col-12">
                <label for="sname" class="form-label labelPopUp">Apellidos</label>
                <input type="text" class="form-control" name="sname" id="sname" placeholder="Ingresa tus apellidos" value= "<?php echo $usuario["apellidos"];?>" required>
            </div>
            <div class="col-md-6">
                <label for="bdate" class="form-label labelPopUp">Fecha de nacimiento</label>
                <input type="date" class="form-control" name="bdate" id="bdate" placeholder="Ingresa tu fecha de nacimiento" value= "<?php echo $usuario["fechanacimiento"];?>">
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label labelPopUp">Teléfono</label>
                <input type="text" class="form-control" name="phone" id="phone" placeholder="Ingresa tu teléfono" value= "<?php echo $usuario["telefono"];?>">
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label labelPopUp">Email</label>
                <input type="text" class="form-control correoe" name="email" id="email" placeholder="Ingresa tu Email" value= "<?php echo $usuario["email"];?>">
            </div>
            <div class="col-md-6">
                <label for="cphone" class="form-label labelPopUp">Teléfono de contacto</label>
                <input type="text" class="form-control" name="cphone" id="cphone" placeholder="Ingresa tu teléfono de contacto" value= "<?php echo $usuario["telcontacto"];?>">
            </div>
<?php        
        if (isset($_SESSION["idrol"])){
                if ($_SESSION["idrol"] == '1'){
?>      
            <div class="col-md-6">
                <label for="semEmp" class="form-label labelPopUp">Semestre</label>
                <input type="text" class="form-control" name="semEmp" id="semEmp" placeholder="Ingresa tu Semestre" value= "<?php echo $usuario["semestre"];?>">
            </div>
<?php        
                }else{
?>
            <div class="col-md-6">
                <label for="semEmp" class="form-label labelPopUp">No. de empleado</label>
                <input type="text" class="form-control" name="semEmp" id="semEmp" placeholder="Ingresa tu número de empleado" value= "<?php echo $usuario["numeroempleado"];?>">
            </div>
<?php        
                }
        }
?>
        <div class="col-md-6">
                <label for="matricula" class="form-label labelPopUp">Matricula</label>
                <input type="text" class="form-control" name="matricula" id="matricula" placeholder="Ingresa tu número de matricula" value= "<?php echo $usuario["numeromatricula"];?>">
        </div>
        <input type="hidden" name="iduser" id="iduser" value="<?php echo $idusuario;?>">
        <input type="hidden" name="idsesion" id="idsesion" value="<?php echo $_SESSION["sid"];?>">
        <input type="hidden" name="idrol" id="idrol" value="<?php echo $_SESSION["idrol"];?>">
        
<?php
} catch (PDOException $e) {
    ErrorLog($dbh, $idsesion, 'No se pudieron recuperar los datos del usuario. '.$e, 'OSE_004');
}
?>
         
        <div class="col-12">
                <input type="button" id="btnEnviar" class="buttonEnviar" value="Guardar">
        </div>
            <!--Muestra la respuesta que se recibe de Ajax-->
            <div id="respuesta" class="alert alert-dark col-md-12" role="alert"></div>

    </form>
    </div>
</section>

<!--Muestra la respuesta que se recibe de Ajax
<div id="respuesta"></div>-->


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
        
        //Validar sólo números en el campo de teléfono
        $("#phone").on('input', function (evt) {
		    // Permite sólo números
            this.value = (this.value + '').replace(/[^0-9]/g, '');
	    });

        //Validar sólo letras en el campo de nombre
        $("#name").on('input', function (evt) {
		    // Permite sólo letras
            this.value = (this.value + '').replace(/[^a-zA-Z ]/g, '');
	    });

        //Validar sólo letras en el campo de Apellidos
        $("#sname").on('input', function (evt) {
		    // Permite sólo letras
            this.value = (this.value + '').replace(/[^a-zA-Z ]/g, '');
	    });

         //Validar sólo números en el campo de teléfono
         $("#matricula").on('input', function (evt) {
		    // Permite dos letras mayúsculas y 10 números
            //this.value = (this.value + '').replace(/[A-Z]{3}|[0-9]{11}/g, '');
            this.value = (this.value + '').replace(/[^A-Z0-9]/g, '');
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