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
?>
    
    <section class="querycongress-form">
      <h2> Consulta de Congresos</h2>
      <div class="container">
        <form name="qCongress" id = "formQueryCongress" action="includes/queryCongress.inc.php" method="post" class="row g-3">
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
              </div>
        </form>
      </div>
      </br>
      <!--Muestra la respuesta que se recibe de Ajax-->
      <div id="mensaje" class="col-md-12 collapse hide" style="background-color: #d3d3d4; padding:0.5rem; font-size: 19px;"></div>
      <!--Muestra la respuesta que se recibe de Ajax-->
      <div id="respuesta"></div>
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
            <h5 class="modal-title" id="staticBackdropLabel">Datos del proyecto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                        <form action="addPonente.inc.php" method="post" id="formTest">
                            <label class = "labelPopUp">Alumno</label>
                <select class="combos inputPopUp" name="alumnos" id="alumnos">
                  <option value="Seleccion" id="0">Selecciona una opción</option>
                    <?php
                      //Llamando a la función para generar los valores del combobox
                      fillComboBoxCongress($dbh);
                    ?>
                </select>
                <label class = "labelPopUp">Comentarios</label> 
                <textarea iplaceholder="Comentarios" class="inputPopUp" name="comentario" id="comentario"></textarea>
                            <input type="hidden" name="idcongreso" id="idcongreso" value="0">
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

    <script>
      //Variable para obtener los ids de los Modales
      var modalDetalles = new bootstrap.Modal(document.getElementById("detallesProyecto"), {});
      var modalAsocia = new bootstrap.Modal(document.getElementById("asociarAlumno"), {});
    </script>

<?php
  } else{
    //Regresa a la página inicial
    header("location: index.php");
    exit();
  }
    include_once 'footer.php';
?>