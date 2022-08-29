<?php
    include_once 'header.php';
    include_once 'header2.php';
    //Incluyendo archivos externos
    require_once 'includes/dbh.inc.php';
    require_once 'includes/functions.inc.php';
    //Valida si hay sesión activa, de lo contrario redirecciona al index.
    if (isset($_SESSION["sid"])){
?>
<section class="personal-info-form">
    <h2> Captura de vacantes </h2>
    <p> Ingresa los datos de la vacante </p>
    <form name="dvacancy" id = "dvacancy" action="includes/enterVacancy.inc.php" method="post">
<?php
//Obteniendo el valor del id de usuario de las variables de sesión.
$idusuario = $_SESSION["idusuario"];
//Obteniendo la fecha actual y calculándola a 60 días para mostrar las fechas por default
$hoy = date("Y-m-d");
$d=strtotime("+1 Months");
$d2=strtotime("+2 Months");
$m=strtotime("+1 Days");
$fechaFin = date("Y-m-d", $d);
$manana = date("Y-m-d", $m);
$fechaFin2 = date("Y-m-d", $d2);
?>
        <label for="name">Título:</label></br>    
        <input type="text" name="title" id="title" placeholder="Título"  required><br><br>
        <label for="sname">Detalles:</label></br>
        <textarea name="details" id="details" rows="10" cols="50">
        </textarea><br><br>
        <label for="bdate">Fecha de publicación:</label></br>
        <input type="date" value="<?php echo $hoy; ?>" min="<?php echo $hoy;?>" max="<?php echo $fechaFin;?>" name="pdate" id="pdate" placeholder="Fecha de publicación" required><br><br>
        <label for="bdate">Fecha de vencimiento:</label></br>
        <input type="date" value="<?php echo $fechaFin; ?>" min="<?php echo $manana;?>" max="<?php echo $fechaFin2;?>" name="edate" id="edate" placeholder="Fecha de vencimiento" required><br><br>
        <p> Datos de contacto </p>
        <label for="phone">Teléfono:</label></br>
        <input type="text" name="phone" id="phone" placeholder="Teléfono" required><br><br>
        <label for="email">Email:</label></br>
        <input type="text" name="email" id="email" placeholder="Email" required><br><br>

        <input type="hidden" name="iduser" id="iduser" value="<?php echo $idusuario;?>">
        <input type="hidden" name="idsesion" id="idsesion" value="<?php echo $_SESSION["sid"];?>">
        <input type="hidden" name="idrol" id="idrol" value="<?php echo $_SESSION["idrol"];?>">
        
        <button type="submit" name="submit">Guardar</button><br><br>
        <!--<input type="submit" name="submit" value="Guardar"/>-->
    </form>
<?php
    if(isset($_GET["error"])){
        if($_GET["error"] == "emptyinput"){
            echo "<p>Los campos no pueden estar vacios</p>";
        }else if($_GET["error"] == "vacancyDuplicated"){
            echo "<p>Ya existe una vacante registrada con los mismos datos</p>";
        }else if($_GET["error"] == "statementerror"){
            echo "<p>Error al tratar de gusardar la vacante. Intentelo nuevamente o reportelo con el administrador.</p>";
        }else if($_GET["error"] == "none"){
            echo "<p>Vacante guardada exitosamente!</p>";
        }
    }
?>
</section>

<script>
    //Asigna el valor de la fecha de publicación como valor minimo para la fecha de finalización
    $("#pdate").change(function () {
        //Obteniendo los valores actuales de las fechas
        var value = $(this).val();
        var endDate = $('#edate').val();
        //console.log('pDATE: ', value);
        //console. log('eDATE: ', endDate);
        
        //Creando una nueva variable para incrementar 15 días
        var date = new Date(value);
        var dateM = new Date(value);
        var dateF = new Date(value);
        date. setDate(date.getDate() + 15); //Fecha seleccionada del campo de expiración
        dateM. setDate(dateM.getDate() + 2); //Fecha minima del campo de expiración
        dateF. setDate(dateF.getDate() + 60); //Fecha maxima del campo de expiración
        
        var day = date.getDate();
        var dayM = dateM.getDate();
        var dayF = dateF.getDate();
        var month = date.getMonth() + 1;
        var monthM = dateM.getMonth() + 1;
        var monthF = dateF.getMonth() + 1;
        var year = date.getFullYear();
        var yearM = dateM.getFullYear();
        var yearF = dateF.getFullYear();
                
        //Agregando 0s al día y el mes
        if (day < 10) {
            day = "0" + day;
        }
        if (month < 10) {
            month = "0" + month;
        }

        if (dayM < 10) {
            dayM = "0" + dayM;
        }
        if (monthM < 10) {
            monthM = "0" + monthM;
        }

        if (dayF < 10) {
            dayF = "0" + dayF;
        }
        if (monthF < 10) {
            monthF = "0" + monthF;
        }



        //Formando nueva fecha
        var nuevaFecha = year + "-" + month + "-" + day;
        var nuevaFechaM = yearM + "-" + monthM + "-" + dayM;
        var nuevaFechaF = yearF + "-" + monthF + "-" + dayF;

        /*console.log('nuevaFecha', nuevaFecha);
        console.log('nuevaFechaM', nuevaFechaM);
        console.log('nuevaFechaF', nuevaFechaF);*/
        

        //Actualizando el valor de la fecha de expiración de la vacante
        $("#edate").attr("min", nuevaFechaM);
        $("#edate").attr("max", nuevaFechaF);
        $("#edate").val(nuevaFecha);
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

