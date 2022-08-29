<?php
    include_once 'header.php';
?>
	<script type='text/javascript' src='js/addRole.js'></script>
<?php
    include_once 'header2.php';
	//Incluyendo archivos externos
	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';
    //Valida si hay sesión activa, de lo contrario redirecciona al index.
    if (isset($_SESSION["sid"])){
    //Definiendo el idusuario en base a la variable de sesión
	$idusuario = $_SESSION["idusuario"]; 
    $idRol = $_SESSION["idrol"];
?>
    
    <section class="addRole-form">
        <h2>Asignar Roles</h2>
        <div class="container">
            <form name="qLog" id = "formAddRole" action="#" method="post" class="row g-3">
                <label for="Tipo">Seleccione el rol y presione el botón guardar o ingrese el valor a buscar para filtrar los datos</label>
                <div class="col-md-6"> 
				    <label for="buscar" class="form-label labelPopUp">Buscar: </label>
				    <input type="text" name="addRoleFilter" id="addRoleFilter" class="form-control" placeholder="Filtrar datos">
			    </div>
                <div class="col-12">
				    <input type="hidden" name="idrol" id="idrol" value="<?php echo $idRol;?>">	
				    <input type="hidden" name="idsesion" id="idsesion" value="<?php echo $_SESSION["sid"];?>">
                </div> 	
            </form>
        </div> 
        </br></br>
        <div id="Tabla">
        <table id="roleTable" class="table-responsive"><thead><tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Email</th>
                                <th>Fecha de registro</th>
                                <th>Rol</th>
                                <th></th>
                                </tr></thead><tbody>
        <?php
                //Llamando la función para armar el cuerpo de la tabla
                queryUserRole($dbh, $idRol);
            ?>	
        </tbody></table>
        </div> 
    </section>

<?php
}else{
    //Redirecciona al index si no hay sesión activa
    header("location: index.php");
    exit();   
}
    include_once 'footer.php';
?>