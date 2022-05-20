<?php
    include_once 'header.php';
    //Incluyendo archivos externos
    require_once 'includes/dbh.inc.php';
    require_once 'includes/functions.inc.php';
?>
<section class="personal-info-form">
    <h2> Consulta de alumnos </h2>
<?php
//Obteniendo los valores de las variables de sesión
$idusuario = $_SESSION["idusuario"];
$sesid = $_SESSION["sid"];
$idrol = $_SESSION["idrol"];

//Preparando la sentencia para mostrar el listado de alumnos activos
try{
    /***************************************   PARA LA SENTENCIA ES NECESARIO CONTAR CON INFORMACIÓN EN LAS TABLAS DE SKILLS, CONGRESOS Y VACANTES) ************************************/
    $sentencia = $dbh->prepare("SELECT U.*, R.nombre nombrerol FROM USUARIOS U, ROLES R 
                WHERE U.idrol = R.idrol 
                AND (U.fechafin < current_date() OR U.fechafin IS NULL) 
                AND (U.bloqueado <> 'Y' OR U.bloqueado  IS NULL)
                AND U.email = :email");
    $sentencia->bindParam(':email', $email);
    //Ejecutando la sentencia
    $sentencia->execute();
    //Obteniendo los datos
    $usuarios = $sentencia->fetch(PDO::FETCH_ASSOC);

    //Obteniendo la contraseña guardada en la base de datos
    $hashedPwd = $usuarios["CONTRASENA"];
?>

<?php
    if(isset($_GET["error"])){
        if($_GET["error"] == "emptyinput"){
            echo "<p>Los campos no pueden estar vacios</p>";
        }else if($_GET["error"] == "ISE_001"){
            echo "<p>No se pudieron actualizar los datos, vuelve a intentarlo</p>";
        }else if($_GET["error"] == "none"){
            echo "<p>Datos actualizados exitosamente!</p>";
        }
    }
?>
</section>

<?php
    include_once 'footer.php';
?>