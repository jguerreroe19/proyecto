<?php
    include_once 'header.php';
?>

<section class="signup-form">
    <h2> Registro de usuarios nuevos</h2>
    </br></br>
    <div class="form-holder d-flex align-items-baseline">
    <form action="includes/signup.inc.php" method="post" id="formSignUp" class="row g-3 needs-validation" novalidate>
		    <div class="col-12">
                <label for="name" class="form-label labelPopUp">Nombre(s)</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Ingresa tu nombre" required>
            </div>
            <div class="col-12">
                <label for="sname" class="form-label labelPopUp">Apellidos</label>
                <input type="text" class="form-control" name="sname" id="sname" placeholder="Ingresa tus apellidos" required>
            </div>
            <div class="col-12">
                <label for="email" class="form-label labelPopUp">Email</label>
                <input type="text" class="form-control correoe" name="email" id="email" placeholder="Ingresa tu Email" required>
                <div class="invalid-feedback malEmail">
                Email no válido
                </div>
            </div>
            <div class="col-md-6">
                <label for="pwd" class="form-label labelPopUp">Contraseña</label>
                <input type="password" class="form-control contrasena" name="pwd" id="pwd" placeholder="Ingresa una contraseña" required>
                <div class="invalid-feedback malPwd">
                La contraseña debe contener al menos:</br> 8 dígitos</br> 1 mayúscula</br> 1 minúscula</br> 1 número</br> 1 caracter especial
                </div>
            </div>
            <div class="col-md-6">
                <label for="pwdrepeat" class="form-label labelPopUp">Confirmar contraseña</label>
                <input type="password" class="form-control contrasenaRpt" name="pwdrepeat" id="pwdrepeat" placeholder="Confirma la contraseña" required>
                <div class="invalid-feedback malPwdConf">
                Las contraseñas no coinciden
                </div>
            </div>
            <div class="col-12">
                <input type="button" id="btnRegistrar" class="buttonEnviar" value="Registrar">
            </div>
            <!--Muestra la respuesta que se recibe de Ajax-->
            <div id="respuesta" class="alert alert-dark col-md-12" role="alert"></div>
    </form>
    </div>
</section>



<script>
		$('#btnRegistrar').click(function(){  

        var valorCorreo = $('#email').val(); //Obtiene el valor del correo
		var resultado  = $.fn.validaEmail(valorCorreo); //Obtiene el rasultado de la validación del correo
		
		//alert('RESULTADO validación correo: ' + resultado);
		
		//Validación de la estructura de la contraseña
		var valorPwd = $('#pwd').val(); //Obtiene el valor de la contraseña
		resultado = resultado + $.fn.validaPwd(valorPwd); //Obtiene el resultado de la validación
		
		//alert('RESULTADO validación contraseña: ' + resultado);
				
		//Validación de password y confirmación iguales
		resultado = resultado + $.fn.validaPwdRpt();
		
		//alert('RESULTADO validación passwords: ' + resultado);
		
		//Validación de campos vacios
		var form = $(this).parents("#formSignUp");
		resultado = resultado + $.fn.checkCampos(form);

		
		//alert('RESULTADO validación final: ' + resultado);
		
		
		//Valida que los campos cumplan con todas las características para poder enviar el formulario
		//alert('Valor del resultado: ' + resultado);
		if (resultado == 4) {
			//$('#formSignUp')[0].submit(); //Submit Form
		
			
			var vName = $('#name').val();
			var vSname = $('#sname').val();
			var vCorreo = $('#email').val();
            var vPwd = $('#pwd').val();
			var vPwdrepeat = $('#pwdrepeat').val();
			
			var ruta = "name="+vName
                      +"&sname="+vSname
                      +"&email="+vCorreo
                      +"&pwd="+vPwd
                      +"&pwdrepeat="+vPwdrepeat;
			
			$.ajax({
				url: 'includes/signup.inc.php',
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

        }
            
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

	</script>

<?php
    include_once 'footer.php';
?>