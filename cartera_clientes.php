<?php include "./class_lib/sesionSecurity.php"; ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <title>Cartera de Clientes</title>
    <?php include "./class_lib/links.php"; ?>
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <link rel="stylesheet" href="plugins/datepicker/css/bootstrap-datepicker3.css">
  </head>
  <body onload="lista_clientes();revisa_caducidades();">

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
            Cartera de Clientes
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Cartera de Clientes.</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <div class='row'>
          <div class='col-md-6'>
           <div class='box box-primary'>
           <div class='box-header with-border'>
           <h3 class='box-title'>Selecciona un clinte de la lista...</h3>
           </div>
           <div class='box-body'>
            <form class='form-horizontal'>
            <div class='input-group'>
             <span class='input-group-addon'>Cliente:</span>
             <div id='pone_clientes'></div>
            </div>
            </form>
           </div>
           <div class='box-footer'>
           <button class='btn btn-primary pull-right btn-raised' onclick="busca_cuentas_cliente();"><i class='fa fa-search'></i> Consultar...</button>
           </div>
           </div>
           </div>

           <div class='col-md-12'>
           <div id='cartera_clientes'></div>
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


      <div class="modal fade" id ="modal_abono_ticket" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title">Abono a venta de Credito.</h4>
          </div>
          <div class="modal-body">
           <input type='hidden' id='elidcliente' val=''>
          <div class='input-group input-group-lg'>
          <span class='input-group-addon bg-blue'><b>Cliente:</b></span>
          <input type='text' id='nombre_c' class='form-control' style="font-size:25px; text-align:center; color:blue; font-weight: bold;" disabled>
          </div>
          <br>
          <div class='input-group'>
          <span class='input-group-addon bg-blue'><b>Se. Ticket:</b></span>
          <input type='text' id='s_ticket' class='form-control' style="font-size:15px; text-align:center; color:blue; font-weight: bold;" disabled>
          </div>
          <div class='input-group'>
          <span class='input-group-addon bg-blue'><b>No. Ticket:</b></span>
          <input type='text' id='n_ticket' class='form-control' style="font-size:15px; text-align:center; color:blue; font-weight: bold;" disabled>
          </div>
          <br>
          <div class='input-group input-group-lg'>
          <span class='input-group-addon bg-blue'><b>Total de la Venta:</b></span>
          <input type='text' id='total_de_ticket' class='form-control' style="font-size:30px; text-align:center; color:red; font-weight: bold;" disabled>
          </div>
          <div class='input-group input-group-lg'>
          <span class='input-group-addon bg-blue'><b>Abonado:</b></span>
          <input type='text' id='abonado' class='form-control' style="font-size:30px; text-align:center; color:red; font-weight: bold;" disabled>
          </div>
          <div class='input-group input-group-lg'>
          <span class='input-group-addon bg-blue'><b>Saldo:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
          <input type='text' id='el_resto' class='form-control' style="font-size:30px; text-align:center; color:red; font-weight: bold;" disabled>
          </div>
          <br>
          <div class='input-group input-group-lg'>
          <span class='input-group-addon bg-blue'><b>Su Abono:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
          <input type='text' id='abono' class='form-control cantidades' style="font-size:30px; text-align:center; color:red; font-weight: bold;" onkeyup="verifica_abono();"
          data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
          </div>
          <br>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-raised" id='btn-procesa-abono' onclick='procesa_abono();' disabled><i class='fa fa-print'></i> Procesar</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id ="modal_revisa_pagos" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title">Revision de pagos realizados.</h4>
          </div>
          <div class="modal-body">
           <input type='hidden' id='elidcliente' val=''>
           <div id='pagos_realizados'></div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-raised" id='btn-print-abonos' onclick='print_pagos();' ><i class='fa fa-print'></i> Imprimir</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- REQUIRED JS SCRIPTS -->
    <div class="MsjAjaxForm"></div>
    <?php include "./class_lib/scripts.php"; ?>
    <script src="plugins/select2/select2.full.min.js"></script>
    <script src="plugins/number/jquery.inputmask.bundle.js"></script>
    <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script src="plugins/printarea/jquery.printarea.js"></script>
    <script src="dist/js/source_init.js"></script>
    <script src="dist/js/source_clients_cartera.js"></script>
    <script src="dist/js/source_init.js"></script>
    <script type='text/javascript'>
      $(document).ready(function(){
        $(".select2").select2();
        $(".cantidades").inputmask();
      });
    </script>
  </body>
</html>
