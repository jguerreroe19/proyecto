$(document).ready(function(){

	//Función para cambiar el color de los campos vacios / llenos
	$.fn.cambiaColorInput = function(elemento, valor){ 
		//var colorOriginal = elemento.css("border-color");
		//alert (colorOriginal);
		if (valor == 0){
			elemento.css("border-color", "red");
		} else {
			elemento.css("border-color", "#CED4DA");
		}
	}

	//Función para Validar la estructura del correo electrónico
	$.fn.validaEmail = function(correoE){ 
		var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
		var regreso = 1;
		if (testEmail.test(correoE)) {
			$('.malEmail').hide();
			regreso = 1;
			//alert('Valor regreso: ' + regreso);
		}else{
			$('.malEmail').show();			
			regreso = 0;
			//alert('Valor regreso: ' + regreso);
		}
		return regreso;
    }
	
	//Función para Validar la estructura de la contraseña
	$.fn.validaPwd = function(contrasena){ 
		var testPwd = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/;
		var regreso = 1;
		if (testPwd.test(contrasena)) {
			$('.malPwd').hide();
			regreso = 1;
			//alert('Valor regreso: ' + regreso);
		}else{
			$('.malPwd').show();			
			regreso = 0;
			//alert('Valor regreso: ' + regreso);
		}
		return regreso;
    }
	
	//Función para validar que las contraseñas empaten
	$.fn.validaPwdRpt = function(){ 
		var pwd = $('.contrasena').val(); //Obtiene el valor del campo de la contraseña
		var pwdRpt = $('.contrasenaRpt').val(); //Obtiene el valor del campo de la confirmación de la contraseña
		var regreso = 1;
		if (pwd == pwdRpt) {
			$('.malPwdConf').hide();
			regreso = 1;
			//alert('Valor regreso: ' + regreso);
		}else{
			$('.malPwdConf').show();			
			regreso = 0;
			//alert('Valor regreso: ' + regreso);
		}
		return regreso;
    }
	
	//Función para validar la longitud del valor ingresado en el campo
	$.fn.checkCampos = function(obj){ 
		var camposRellenados = true;
		obj.find("input").each(function() {

			var $this = $(this);
			if( $this.val().length <= 1 ) {
				$.fn.cambiaColorInput($this, 0); // Cambio de color a rojo
				//$this.css("border-color", "red");
				camposRellenados = 0;
				//$('.campoVacio').show();
				//$('.campoOk').hide();
				return camposRellenados;
			}else{
				$.fn.cambiaColorInput($this, 1); // Cambio de color a negro
			}
		});
		if(camposRellenados == 0) {
			return camposRellenados;
		} else {
			return camposRellenados;
		}
	}
		
	
	
	//Función para validar la estructura del correo electrónico al quitar el foco del campo
	$('.correoe').blur(function() {
		$.fn.validaEmail(this.value);
	});
	
	//Función para validar la estructura de la contraseña al quitar el foco del campo
	$('.contrasena').blur(function() {
		$.fn.validaPwd(this.value);
	});
	
	//Función para que coincidan las contraseñas
	$('.contrasenaRpt').blur(function() {
		$.fn.validaPwdRpt();
	});

	
	//Función para validar los campos en blanco al teclear en cualquier campo del formulario de registro
	
	$('#formSignUp input').keyup(function() {
		//Validación de campos vacios
		var form = $(this).parents("#formSignUp");
		$.fn.checkCampos(form);
	});
	

	//Función para validar campos antes de enviar el formulario de LOGIN
	$('#btnEnviarLogin').click(function(){        
		$('#formLogin')[0].submit(); //Submit Form
	});

	/*
	//Función para validar campos antes de enviar el formulario de REGISTRO
	$('#btnEnviarRegistro').click(function(){        
		//Validación de la estructura del correo
		var valorCorreo = $('.correoe').val(); //Obtiene el valor del correo
		var resultado  = $.fn.validaEmail(valorCorreo); //Obtiene el rasultado de la validación del correo
		
		//alert('RESULTADO validación correo: ' + resultado);
		
		//Validación de la estructura de la contraseña
		var valorCorreo = $('#contrasena').val(); //Obtiene el valor de la contraseña
		resultado = resultado + $.fn.validaPwd(valorCorreo); //Obtiene el resultado de la validación
		
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
			$('#formSignUp')[0].submit(); //Submit Form
		}
		
	});
	*/	
	
	
});

