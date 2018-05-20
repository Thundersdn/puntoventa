<?php include "./class_lib/sesionSecurity.php"; ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <title>Articulos</title>
    <?php include "./class_lib/links.php"; ?>
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="plugins/datepicker/css/bootstrap-datepicker3.css">
  </head>
  <body onload="pone_provs();pone_lineas();lista_articulos();">

    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <?php
        include('class_lib/nav_header.php');
        ?>

      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <?php
        include('class_lib/sidebar.php');


        ?>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Mantenimiento de Articulos.
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mtto. de Articulos.</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <div class='row'>
           <div class='col-md-12'>
             <div class='nav-tabs-custom'>
                  <ul class="nav nav-tabs pull-right">
                  <li><a href="#cambios" data-toggle="tab">Cambios</a></li>
                  <li><a href="#bajas" data-toggle="tab">Baja</a></li>
                  <li class="active"><a href="#altas" data-toggle="tab">Alta</a></li>

                  <li class="pull-left header"><i class="fa fa-file-text"></i> Operaciones con Articulos.</li>
                </ul>
               <div class="tab-content">
                  <div class="tab-pane active" id="altas">
                    <form class="form-horizontal">

                    <div class='form-group'>
                    <label for="codigo" class="col-sm-2 control-label">Codigo:</label>
                    <div class="col-sm-3">
                    <input type="text" class="form-control" id='codigo' placeholder='Codigo del articulo...'>
                    </div>
                    </div>

                    <div class='form-group'>
                    <label for="codigostock" class="col-sm-2 control-label">Codigo de Stock:</label>
                    <div class="col-sm-3">
                    <input type="text" class="form-control" id='codigostock' placeholder='Codigo de stock...'>
                    </div>
                    </div>

                    <div class='form-group'>
                    <label for="descripcion" class="col-sm-2 control-label">Descripcion:</label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" id='descripcion' placeholder='Descripcion del articulo...'>
                    </div>
                    </div>

                      <div class='form-group'>
                        <label for="codigostock" class="col-sm-2 control-label">Fecha de Caducidad:</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id='fecha_caducidad' placeholder='Fecha de Caducidad'>
                        </div>
                      </div>


                    <div class='form-group'>
                    <label for="costo" class="col-sm-2 control-label">Costo:</label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control cantidades" id='costo' placeholder='Costo del articulo...'
                     data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
                    </div>
                    </div>

                    <div class='form-group'>
                    <label for="precio" class="col-sm-2 control-label">Precio:</label>
                    <div class="col-sm-2">
                    <input type="text" class="form-control cantidades" id='precio' placeholder='Precio al publico del articulo...'
                     data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
                    </div>
                    </div>
                    <?php 
                      include "./class_lib/class_conecta_mysql.php";
                      $cons= new ConexionMySQL();
                    ?>

                    <div class='form-group'>
                    <label for="proveedor" class="col-sm-2 control-label">Proveedor:</label>
                    <div class="col-sm-4">
                    <div id='pone_provs'></div>
                    </div>
                    </div>

                    <div class='form-group'>
                    <label for="linea" class="col-sm-2 control-label">Linea:</label>
                    <div class="col-sm-4">
                    <div>
                      <select name="linea" id="linea" class="form-control">
                        <?php 
                          $selectLinea=$cons->consulta("SELECT * FROM lineas");
                          while($rowLineas=mysql_fetch_array($selectLinea)){
                            echo '<option value="'.$rowLineas['linea'].'">'.$rowLineas['linea'].'</option>';
                          }
                        ?>
                      </select>
                    </div>
                    </div>
                    </div>

                    <div class='form-group'>
                    <label for="grupo" class="col-sm-2 control-label">Grupo:</label>
                    <div class="col-sm-4">
                    <div>
                      <select name="grupo" id="grupo" class="form-control">
                        <?php 
                          $selectGrupo=$cons->consulta("SELECT * FROM lineas");
                          while($rowGrupo=mysql_fetch_array($selectGrupo)){
                            echo '<option value="'.$rowGrupo['grupo'].'">'.$rowGrupo['grupo'].'</option>';
                          }
                        ?>
                      </select>
                    </div>
                    </div>
                    </div>

                    <!-- <div class='form-group'>
                    <label for="imagen" class="col-sm-2 control-label">Imagen:</label>
                    <div class="col-sm-2">
                    <div id='btn-imagen'></div>
                    </div>
                    </div> -->
                    <br>
                    <div class="btn-group">
                    <button type='button' class='btn btn-raised btn-primary btn-lg' onclick='alta_articulo();' id='btn-altas'><i class='fa fa-check-circle'></i> Registrar el articulo.</button>
                    <button type='button' class='btn btn-danger btn-raised btn-lg' onclick='cancela_alta_articulo();' id='btn-alta-cancela'><i class='fa fa-times'></i> Cancelar.</button>
                    </div>
                    </form>
                  </div><!-- /.tab-pane -->

                  <div class="tab-pane" id="bajas">
                    <form class='form-horizontal' onkeypress="return anular(event)">
                    <div class='form-group'>
                    <label for="codigo_busqueda" class="col-sm-2 control-label">Codigo:</label>
                    <div class="col-sm-3">
                    <input type="text" class="form-control" id='codigo_busqueda' onchange="busca_articulo();" placeholder='Codigo del articulo...'>
                    </div>
                    </div>

                    <div id='info_articulo'></div>
                    <br>
                    <div class="btn-group">
                    <button type='button' class='btn btn-primary btn-lg' onclick='busca_articulo();' id='btn-buscar'><i class='fa  fa-search'></i> Buscar...</button>
                    <button type='button' class='btn btn-success btn-lg' onclick='elimina_articulo();' id='btn-procede-baja' disabled><i class='fa   fa-times'></i> Eliminar...</button>
                    <button type='button' class='btn btn-danger btn-lg' onclick='cancela_eliminacion();' id='btn-cancela-baja' disabled><i class='fa  fa-recycle'></i> Cancelar...</button>
                    </div>

                    </form>
                  </div><!-- /.tab-pane -->


                  <div class="tab-pane" id="cambios">
                    <form class='form-horizontal' onkeypress="return anular(event)">
                    <div class='form-group'>
                    <label for="codigo_busqueda_cambio" class="col-sm-2 control-label">Codigo:</label>
                    <div class="col-sm-3">
                    <input type="text" class="form-control" id='codigo_busqueda_cambio' onchange='busca_articulo_cambio();'  placeholder='Codigo del articulo...'>
                    </div>
                    </div>

                    <div id='info_articulo_cambio'></div>
                    <br>
                    <div class="btn-group">
                    <button type='button' class='btn btn-primary btn-lg' onclick='busca_articulo_cambio();' id='btn-buscar-cambio'><i class='fa fa-search'></i> Buscar...</button>
                    <button type='button' class='btn btn-success btn-lg' onclick='procede_cambio();' id='btn-procede-cambio' disabled><i class='fa fa-check-circle'></i> Actualizar...</button>
                    <button type='button' class='btn btn-danger btn-lg' onclick='cancela_cambios();' id='btn-cancela-cambio' disabled><i class='fa fa-recycle'></i> Cancelar...</button>
                    </div>

                    </form>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->

             </div>
           </div>

           <div class='col-md-12'>
           <div id='lista_articulos'>
           </div>
           </div>
          </div>


        </section><!-- /.content -->
         </div><!-- /.content-wrapper -->


      <!-- Main Footer -->
      <?php
      include('class_lib/main_fotter.php');
      ?>


      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
    <div class="MsjAjaxForm"></div>
    <?php include "./class_lib/scripts.php"; ?>
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script src="plugins/number/jquery.inputmask.bundle.js"></script>
    <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script src="plugins/uploadify/jquery.uploadify.js"></script>
    <script src="plugins/select2/select2.full.min.js"></script>
    <script src="plugins/datepicker/js/bootstrap-datepicker.js"></script>
    <script src="plugins/datepicker/locales/bootstrap-datepicker.es.min.js"></script>
    <script src="dist/js/source_articles.js"></script>
    <script>
      $(document).ready(function(){
      $(".cantidades").inputmask();
      });

      $("#fecha_caducidad").datepicker({
        language: "es",
        format: "yyyy-mm-dd"
      });
    </script>
  </body>
</html>
