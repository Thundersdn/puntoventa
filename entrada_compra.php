<?php include "./class_lib/sesionSecurity.php"; ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <title>Almacen|Entradas</title>
    <?php include "./class_lib/links.php"; ?>
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <link rel="stylesheet" href="plugins/datepicker/css/bootstrap-datepicker3.css">
  </head>
  <body onload="pone_num_entrada();lista_proveedores();revisa_entrada_ini();">

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
            Almacen | Entradas X Compra
            <small><div id='num_entrada' style='color: #C20000'></div></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Entrada X Compra.</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <div class='row'>
          <div class='col-md-4'>
           <div class='box box-primary'>
           <div class='box-header with-border'>
           <h3 class='box-title'>Datos de la Entrada...</h3>
           </div>
           <div class='box-body'>
            <form class='form-horizontal'>
            <div class='input-group'>
             <span class='input-group-addon bg-purple'>Proveedor:</span>
             <div id='pone_provs'></div>
            </div>
            <br>
            <div class='input-group'>
             <span class='input-group-addon bg-purple'><i class="fa fa-calendar"></i> Fecha:</span>
             <input type="text" class="form-control pull-right" id="fecha" onchange="actualiza_fecha_temp();" autocomplete="off">
            </div>
             <br>
             <div class='input-group'>
             <span class='input-group-addon bg-purple'><i class="fa fa-sticky-note-o"></i> # de Nota/Fact:</span>
             <input type="text" class="form-control" id="factura" onchange="actualiza_num_fac_entrada_temp();">
            </div>
            <br>
            <div class='input-group'>
             <span class='input-group-addon bg-purple'><i class="fa fa-database"></i> Impuesto:</span>
             <select class='form-control select2' id='impuesto' style='width: 100%;' onchange="actualiza_impuesto_temp();">
             <option value='0'>Sin impuesto</option>
             <option value='8'>8 % de Impuesto</option>
             <option value='16'>16 % de Impuesto</option>
             </select>
            </div>
            <br>
            <div class='input-group'>
             <span class='input-group-addon bg-purple'><i class="fa fa-plus"></i> Descuento (% en porc.):</span>
             <input type="text" class="form-control cantidades" id="descuento" onchange="actualiza_descuento_temp();"
             data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
            </div>
            </form>
           </div>
           </div>
           </div>

           <div class='col-md-4'>
           <div class='box box-primary'>
           <div class='box-header with-border'>
           <h3 class='box-title'>Articulo.</h3>
           </div>
           <div class='box-body'>
           <div class='input-group'>
             <span class='input-group-addon bg-purple'><i class="fa fa-barcode"></i> Codigo:</span>
             <input type="text" class="form-control pull-right" id="codigo" onchange='busca_articulo();'
             style="font-size:20px; text-align:center; color:blue; font-weight: bold;" >
            </div>
            <br>
            <div class='input-group'>
             <span class='input-group-addon bg-purple'><i class="fa fa-code"></i> Desc.:</span>
             <input type="text" class="form-control pull-right" id="descripcion" value='' disabled>
            </div>
            <br>
            <div class='input-group'>
             <span class='input-group-addon bg-purple'><i class="fa fa-usd"></i> Costo:</span>
             <input type="text" class="form-control pull-right cantidades" id="costo"
             data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'"
             style="font-size:20px; text-align:center; color:blue; font-weight: bold;" disabled>
            </div>
            <br>
            <div class='input-group'>
             <span class='input-group-addon bg-purple'><i class="fa fa-calculator"></i> Cantidad:</span>
             <input type="text" class="form-control pull-right cantidades" id="cantidad"
             data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'"
             style="font-size:20px; text-align:center; color:blue; font-weight: bold;" disabled>
            </div>
            <br>
            <div class='btn-group'>
            <button class='btn btn-primary' type='button' onclick='agrega_a_lista();' id='btn-add-article' disabled><i class='fa fa-download'></i> Agregar...</button>
            <button class='btn btn-danger' type='button' onclick='cancela_add();' id='btn-cancel-article' disabled><i class='fa fa-times'></i> Cancelar...</button>
            </div>
           </div>
           </div>
           </div>

           <div class='col-md-4'>
           <div class='box box-primary'>
           <div class='box-header with-border'>
            <div class='btn-group'>
           <button class='btn btn-primary' type='button' onclick='procesa_entrada();' id='btn-procesa' disabled><i class='fa fa-external-link'></i> Procesar entrada.</button>
            <button class='btn btn-danger' type='button' onclick='cancela_entrada_all();' id='btn-cancela' disabled><i class='fa fa-times'></i> Cancelar entrada.</button>
           </div>
           </div>
           <div class='box-body'>
           <div class='input-group'>
             <span class='input-group-addon bg-purple'><i class="fa fa-file-text-o"></i> Monto:</span>
             <input type="text" class="form-control pull-right" id="net" value=''
             style="font-size:20px; text-align:center; color:blue; font-weight: bold;" disabled>
            </div>

            <div class='input-group'>
             <span class='input-group-addon bg-purple'><i class="fa fa-dollar"></i> Descuento:</span>
             <input type="text" class="form-control pull-right" id="des" value=''
             style="font-size:20px; text-align:center; color:blue; font-weight: bold;" disabled>
            </div>

            <div class='input-group'>
             <span class='input-group-addon bg-purple'><i class="fa  fa-repeat"></i> Monto + IVA:</span>
             <input type="text" class="form-control pull-right" id="tot" value=''
             style="font-size:20px; text-align:center; color:blue; font-weight: bold;" disabled>
            </div>

            <div class='input-group'>
             <span class='input-group-addon bg-purple'><i class="fa fa-list-ol"></i> Articulos:</span>
             <input type="text" class="form-control pull-right" id="arts" value=''
             style="font-size:20px; text-align:center; color:blue; font-weight: bold;" disabled>
            </div>
           </div>
           </div>
           </div>

           <div class='col-md-12'>
           <div class='box box-success'>
           <div class='box-header with-border'>
           <h3 class='box-title'>Articulos en la entrada.</h3>
           </div>
           <div class='box-body table-responsice no-padding'>
           <table id='tabla_articulos' class='table table-hover'>
           <thead>
           <tr>
           <th>Codigo</th>
           <th>Descripcion</th>
           <th>Cantidad</th>
           <th>Costo U.</th>
           <th>Costo T.</th>
           <th>Descuento</th>
           <th>Eliminar</th>
           </tr>
           </thead>
           <tbody>

           </tbody>
           </table>
           </div>
           </div>
           </div>
           <input type='hidden' id='num_entrada2' value='0'>
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
    <script src="plugins/select2/select2.full.min.js"></script>
    <script src="plugins/datepicker/js/bootstrap-datepicker.js"></script>
    <script src="plugins/datepicker/locales/bootstrap-datepicker.es.min.js"></script>
    <script src="plugins/number/jquery.inputmask.bundle.js"></script>
    <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script src="dist/js/source_almacen.js"></script>
    <script type='text/javascript'>
    $("#fecha").datepicker({
      language: "es",
      format: "yyyy-mm-dd"
    });

    $(document).ready(function(){
    $(".cantidades").inputmask();
    });

    $(document).ready(function(){
    $(".select2").select2();

    $(window).bind('beforeunload', function(){
         return 'Deseas salir de Entradas X Compra ? Si eliges que si y hay registros agregados a la entrada, quedara guardada pero no procesada, a menos que canceles la entrada temporalmente...';
        });
    });
    </script>
  </body>
</html>