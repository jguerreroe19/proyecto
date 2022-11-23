<?php
    include_once 'header.php';
    ?>
        <script type='text/javascript' src='js/enterVacancy.js'></script>
    <?php
    include_once 'header2.php';
    //Incluyendo archivos externos
    require_once 'includes/dbh.inc.php';
    require_once 'includes/functions.inc.php';
    //Valida si hay sesión activa, de lo contrario redirecciona al index.
    if (isset($_SESSION["sid"])){
?>
    <section class="enterVacancy-form debajodelNav">
        <div class="container">
        <form name="dvacancy" id ="dvacancy" action="#" method="post" class="row g-3 needs-validation" novalidate>
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
            <div class="col-md-12">
                <label for="name" class="form-label labelPopUp">Título:</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Ingresa el título"  required>
                <div class="invalid-feedback">Debe especificar el título de la vacante</div>
            </div>
            <div class="col-12">
                <label for="sname" class="form-label labelPopUp">Detalles:</label>
                <textarea name="details" id="details" rows="10" class="form-control" required></textarea>
                <div class="invalid-feedback">Debe ingresar los detalles de la vacante</div>
            </div>
            <div class="col-md-6">
                <label for="bdate" class="form-label labelPopUp">Fecha de publicación:</label>
                <input type="date" name="pdate" id="pdate" class="form-control" placeholder="Fecha de publicación" value="<?php echo $hoy; ?>" min="<?php echo $hoy;?>" max="<?php echo $fechaFin;?>" required>
            </div>
            <div class="col-md-6">
                <label for="bdate" class="form-label labelPopUp">Fecha de vencimiento:</label>
                <input type="date" name="edate" id="edate" class="form-control" placeholder="Fecha de vencimiento" value="<?php echo $fechaFin; ?>" min="<?php echo $manana;?>" max="<?php echo $fechaFin2;?>" required>
            </div>
            
            <div class="col-12">
                <hr>
                <p style="text-align: center; font-weight: bold;" class="labelPopUp"> Datos de contacto </p>
            </div>
            
            <div class="col-md-6">
                <label for="phone" class="form-label labelPopUp">Teléfono:</label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="Ingresa el teléfono" maxlength=10 required>
                <div class="invalid-feedback">Debe ingresar el teléfono de contacto</div>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label labelPopUp">Email:</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Ingresa el email" required>
                <div class="invalid-feedback" id="emailmsg">La estructura del correo electrónico es incorrecta</div>
            </div>
            <div style="text-align: center;" class="col-12">
                <input type="hidden" name="iduser" id="iduser" value="<?php echo $idusuario;?>">
                <input type="hidden" name="idsesion" id="idsesion" value="<?php echo $_SESSION["sid"];?>">
                <input type="hidden" name="idrol" id="idrol" value="<?php echo $_SESSION["idrol"];?>">
                <input type="button" id="btnGuardar" class="buttonEnviar" value="Guardar">
            </div>
        </form>
        <br><br>
    </section>

<?php
    }else{
        //Redirecciona al index si no hay sesión activa
        header("location: index.php");
        exit();   
    }
    include_once 'footer.php';
?>

