<?php
    include_once 'header.php';
?>
    <script type='text/javascript' src='js/queryCongress.js'></script>
<?php
    include_once 'header2.php';
	//Incluyendo archivos externos
	require_once 'includes/dbh.inc.php';
	require_once 'includes/functions.inc.php';
  if(isset($_SESSION["sid"])){
    //Definiendo el idusuario en base a la variable de sesión
    $idusuario = $_SESSION["idusuario"]; 
    $idrol = $_SESSION["idrol"];

    //Obteniendo la fecha actual y calculándola a 60 días para mostrar las fechas por default
    $hoy = date("Y-m-d");
    $d=strtotime("+1 Months");
    $d2=strtotime("+2 Months");
    $m=strtotime("+1 Days");
    $fechaFin = date("Y-m-d", $d);
    $manana = date("Y-m-d", $m);
    $fechaFin2 = date("Y-m-d", $d2);
?>
    
    <section class="querycongress-form debajodelNav">
      <div class="container">
        <form name="qCongress" id="formQueryCongress" action="#" method="post" class="row g-3">
          <div class="col-md-6">            
            <label for="cname" class="form-label labelPopUp">Nombre: </label>
            <input type="text" name="cname" id="cname" class="form-control" placeholder = "Buscar por nombre">
          </div>
          <div class="col-md-6">
            <label for="details" class="form-label labelPopUp">Detalles: </label>
            <input type="text" name="details" id="details" class="form-control" placeholder = "Buscar por detalles">
          </div>    
            <?php //Muestra el checkbox sólo para el rol Profesor
              if($idrol == 2){
            ?>
              <div class="col-12">
                <div class="form-check">
                            <input type="checkbox" name="mine" id="mine" class="form-check-input">
                            <label class="form-check-label" for="mine">Registrados por mi</label>
                </div>            
              </div>
              <div class="col-12">
                <div class="form-check">
                            <input type="checkbox" name="activo" id="activo" class="form-check-input">
                            <label class="form-check-label" for="activo"> Sólo congresos activos</label>
                </div>            
              </div>
            <?php    
              }
            ?>
                    <input type="hidden" name="iduser" id="iduser" value="<?php echo $idusuario;?>">
                    <input type="hidden" name="idrol" id="idrol" value="<?php echo $idrol;?>">
                    <input type="hidden" name="idsesion" id="idsesion" value="<?php echo $_SESSION["sid"];?>">
                    
              <div class="col-12"> 
                <input type="button" value="Buscar" id="btnBuscar" class="buttonEnviar">
                <input type="button" value="Limpiar campos" id="limpiaCampos" class="buttonEnviar limpiaCampos">
              </div>
        </form>
      </div>
      </br>
      <!--Muestra la respuesta que se recibe de Ajax-->
      <div id="mensaje" class="col-md-12 collapse hide" style="background-color: #d3d3d4; padding:0.5rem; font-size: 19px;"></div>
      <!--Muestra la respuesta que se recibe de Ajax-->
      <div id="respuesta" class="container-xl collapse hide" style="padding-top: 30px;"></div>
    </section>

    <!--Ventana emeregente para mostrar los detalles de los proyectos-->
    <div class="modal fade" id="detallesProyecto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" style="background: #e7e7e7;">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Datos del proyecto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                            <label class = "labelPopUp">Nombre: </label>
                            <p id = "datosPopUp0" class = "textPopUp"></p>
                            <label class = "labelPopUp">Descripción:</label>
                            <p id = "descProy0" class = "textPopUp"></p>
                            <label class = "labelPopUp">Tipo:</label>
                            <p id = "tipoProy0" class = "textPopUp"></p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!--Ventana emeregente para mostrar la asignación de los alumnos a los congresos-->
    <div class="modal fade" id="asociarAlumno" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" style="background: #e7e7e7;">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Asociar alumno</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                        <form action="addPonente.inc.php" method="post" id="formTest">
                            <label class = "labelPopUp">Alumno</label>
                <select class="combos inputPopUp" name="alumnos" id="alumnos">
                <option selected disabled id="0" value = "">Selecciona una opción...</option>  
                    <?php
                      //Llamando a la función para generar los valores del combobox
                      fillComboBoxCongress($dbh);
                    ?>
                </select>
                <label class = "labelPopUp">Comentarios</label> 
                <textarea iplaceholder="Comentarios" class="inputPopUp" name="comentario" id="comentario"></textarea>
                <input type="hidden" name="idcongreso" id="idcongreso" value="0">
                <input type="hidden" name="idsesion" id="idsesion" value="<?php echo $_SESSION["sid"];?>">
                <input type="hidden" name="iduser" id="iduser" value="<?php echo $idusuario;?>">
                <input type="button" value="Asociar" id="enviar" class="btn btn-secondary">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <!--<button class ="boton" id="enviar" >Enviar</button>-->
              </form>
            </div>
            <div class="modal-footer">
                <!--Muestra la respuesta que se recibe de Ajax-->
                <div id="confirma"></div>        
          </div>
        </div>
      </div>
    </div>

    <!--Ventana emeregente para editar la información de los congresos-->
    <div class="modal fade" id="editarCongreso" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background: #e7e7e7;">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Editar congreso</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="#" name="fomrEditCong" id ="formEditCongress"  method="post" class="row g-3 requires-validation" novalidate>
            <div class="modal-body">
              <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <label for="editcname" class="form-label labelPopUp">Nombre:</label>
                        <input type="text" name="editcname" id="editcname" class="form-control" placeholder="Nombre del congreso"  required>
                        <div class="invalid-feedback">El nombre del congreso no puede estar vacio</div>
                    </div>
                    <div class="col-md-6">
                        <label for="editsede" class="form-label labelPopUp">Sede:</label></br>    
                        <input type="text" name="editsede" id="editsede" class="form-control" placeholder="Sede del congreso"  required>
                        <div class="invalid-feedback">Debe especificar la sede</div>
                    </div>
                  </div>
                  <div class="col-12">
                      <label for="editdetails" class="form-label labelPopUp">Detalles:</label>
                      <textarea name="details" id="editdetails" class="form-control" rows="10" required></textarea>
                      <div class="invalid-feedback">Debe especificar los detalles del congreso</div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                        <label for="editfinicio" class="form-label labelPopUp">Fecha de inicio:</label>
                        <input type="date" class="form-control" name="editfinicio" id="editfinicio" placeholder="Fecha de inicio" required>
                    </div>
                    <div class="col-md-6">
                        <label for="editffin" class="form-label labelPopUp">Fecha de fin:</label>
                        <input type="date" class="form-control" name="editffin" id="editffin" placeholder="Fecha de finalización" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                        <label for="editreco" class="form-label labelPopUp">Reconocimiento a otorgar:</label>
                        <select class="form-select" id="editreco" required>
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
                        <label for="editpasoc" class="form-label labelPopUp">Proyecto asociado (si aplica):</label>
                        <select class="form-select" id="editpasoc" required>
                            <option selected disabled value = "0">Elige una opción...</option>
                            <?php
                                //Función para generar el listado de proyectos activos
                                echo listaProyectos($dbh);
                            ?>
                        </select>
                        <div class="invalid-feedback">Debe seleccionar una opción</div>
                    </div>
                  </div>
                  <div style="text-align: center;" class="col-12">
                    <input type="hidden" name="idcongress" id="idcongress">
                    <input type="hidden" name="idproyecto" id="idproyecto">
                    <input type="hidden" name="iduser" id="iduser" value="<?php echo $idusuario;?>">
                    <input type="hidden" name="idsesion" id="idsesion" value="<?php echo $_SESSION["sid"];?>">
                    <input type="hidden" name="idrol" id="idrol" value="<?php echo $_SESSION["idrol"];?>">
                  </div>
              </div>
            </div>
            <div class="modal-footer">
                <div style="text-align: center;" class="col-12">
                    <input type="button" id="btnEditar" class="buttonEnviar" value="Guardar">
                    <input type="button" id="btnCancelar" class="buttonEnviar" data-bs-dismiss="modal"  value="Cancelar">
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>
      //Variable para obtener los ids de los Modales
      var modalDetalles = new bootstrap.Modal(document.getElementById("detallesProyecto"), {});
      var modalAsocia = new bootstrap.Modal(document.getElementById("asociarAlumno"), {});
      var modalEdita = new bootstrap.Modal(document.getElementById("editarCongreso"), {});
    </script>

<?php
  } else{
    //Regresa a la página inicial
    header("location: index.php");
    exit();
  }
    include_once 'footer.php';
?>