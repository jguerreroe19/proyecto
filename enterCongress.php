<?php
include_once 'header.php';
?>
    <script type='text/javascript' src='js/enterCongress.js'></script>
<?php
include_once 'header2.php';
//Incluyendo archivos externos
require_once 'includes/dbh.inc.php';
require_once 'includes/functions.inc.php';
//Valida si hay sesión activa, de lo contrario redirecciona al index.
if (isset($_SESSION["sid"])){
?>
    <section class="enterCongress-form debajodelNav">
        <div class="container">
            <form name="fomrEntCong" id ="formEnterCongress" action="#" method="post" class="row g-3 requires-validation" novalidate>
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
                <div class="col-md-6">
                    <label for="cname" class="form-label labelPopUp">Nombre:</label>
                    <input type="text" name="cname" id="cname" class="form-control" placeholder="Nombre del congreso"  required>
                    <div class="invalid-feedback">El nombre del congreso no puede estar vacio</div>
                </div>
                <div class="col-md-6">
                    <label for="sede" class="form-label labelPopUp">Sede:</label></br>    
                    <input type="text" name="sede" id="sede" class="form-control" placeholder="Sede del congreso"  required>
                    <div class="invalid-feedback">Debe especificar la sede</div>
                </div>
                <div class="col-12">
                    <label for="details" class="form-label labelPopUp">Detalles:</label>
                    <textarea name="details" id="details" class="form-control" rows="10" required></textarea>
                    <div class="invalid-feedback">Debe especificar los detalles del congreso</div>
                </div>
                <div class="col-md-6">
                    <label for="finicio" class="form-label labelPopUp">Fecha de inicio:</label>
                    <input type="date" class="form-control" value="<?php echo $hoy; ?>" min="<?php echo $hoy;?>" max="<?php echo $fechaFin;?>" name="finicio" id="finicio" placeholder="Fecha de inicio" required>
                </div>
                <div class="col-md-6">
                    <label for="ffin" class="form-label labelPopUp">Fecha de fin:</label>
                    <input type="date" class="form-control" value="<?php echo $fechaFin; ?>" min="<?php echo $manana;?>" max="<?php echo $fechaFin2;?>" name="ffin" id="ffin" placeholder="Fecha de finalización" required>
                </div>
                <div class="col-md-6">
                    <label for="reco" class="form-label labelPopUp">Reconocimiento a otorgar:</label>
                    <select class="form-select" id="reco" required>
                        <option selected disabled value = "">Elige una opción...</option>
                        <option value="Certificado">Certificado</option>
                        <option value="Constancia">Constancia</option>
                        <option value="Diploma">Diploma</option>
                        <option value="Reconocimiento">Reconocimiento</option>
                        <option value="Título">Título</option>
                    </select>
                    <div class="invalid-feedback">Debe seleccionar una opción</div>
                </div>
                <div class="col-md-6">
                    <label for="pasoc" class="form-label labelPopUp">Proyecto asociado (si aplica):</label>
                    <select class="form-select" id="pasoc" required>
                        <option selected value = "0">Elige una opción...</option>
                        <?php
                            //Función para generar el listado de proyectos activos
                            echo listaProyectos($dbh);
                        ?>
                    </select>
                    <div class="invalid-feedback">Debe seleccionar una opción</div>
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

