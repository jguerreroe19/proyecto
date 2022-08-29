<?php
include_once 'header.php';
?>
	<script type='text/javascript' src='js/consAlumnos.js'></script>
<?php
include_once 'header2.php';

//Incluyendo archivos externos
require_once 'includes/dbh.inc.php';
require_once 'includes/functions.inc.php';
	
//Valida si hay sesión activa, de lo contrario redirecciona al index.
if (isset($_SESSION["sid"])){
?>
    
<section class="consAlumnos-form">
	<h2>Consultar Alumnos</h2>
	<div class="container">
		<form name="qAlumnos" id = "formConsAlumnos" action="#" method="post" class="row g-3">
			<p>Ingresar la combinación de valores en los campos según los datos a buscar. </br>Dejar los campos en blanco para traer todos los resultados</p>
			</br></br>
			<div class="col-md-6"> 
				<label for="nombre" class="form-label labelPopUp">Nombre: </label>       
				<input type="text" name="nombre" id="nombre" class="form-control" placeholder="Buscar nombre">
			</div>
			<div class="col-md-6"> 
				<label for="apellidos" class="form-label labelPopUp">Apellidos: </label>       
				<input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Buscar apellidos">
			</div>
			<div class="col-md-6"> 
				<label for="email" class="form-label labelPopUp">Email: </label>       
				<input type="text" name="email" id="email" class="form-control" placeholder="Buscar email">
			</div>
			<div class="col-md-6"> 
				<label for="telefono" class="form-label labelPopUp">Teléfono: </label>       
				<input type="text" name="telefono" id="telefono" class="form-control" placeholder="Buscar teléfono">
			</div>
			<div class="col-md-6"> 
				<label for="habilidad" class="form-label labelPopUp">Habilidad o Idioma: </label>       
				<input type="text" name="habilidad" id="habilidad" class="form-control" placeholder="Buscar habilidad o idioma">
			</div>
			<div class="col-md-6"> 
				<label for="nivel" class="form-label labelPopUp">Nivel </label>       
				<input type="text" name="nivel" id="nivel" class="form-control" placeholder="Buscar nivel">
			</div>
			<div class="col-12">
				<input type="hidden" name="idrol" id="idrol" value="<?php echo $_SESSION["idrol"];?>">	
				<input type="hidden" name="idsesion" id="idsesion" value="<?php echo $_SESSION["sid"];?>">
				<!--<button type="submit" name="submit">Buscar</button>-->
				<input type="button" value="Buscar" id="btnBuscar" class="buttonEnviar">
				<input type="button" value="Limpiar campos" id="limpiaCampos" class="buttonEnviar limpiaCampos">
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
}else{
    //Redirecciona al index si no hay sesión activa
    header("location: index.php");
    exit();   
}
    include_once 'footer.php';
?>