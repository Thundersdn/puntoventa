<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db=new ConexionMySQL();

$codigo=test_input($_POST['codigo']);

$cadena="Select * from articulos where codigo='$codigo'";
$exec=$db->consulta($cadena);
if($db->numero_de_registros($exec)>0){
  while($w=$db->buscar_array($exec)){
    $descripcion=$w['descripcion'];
    $costo=$w['costo'];
    $precio=$w['precio'];
    $proveedor=$w['proveedor'];
    $linea=$w['linea'];
    $grupo=$w['grupo'];
    $imagen=$w['imagen'];
    $codigos=$w['codigostock'];
    $fecha_cad=$w['fecha_cad'];
  }

    echo "<div class='form-group'>";
	echo "<label class='col-sm-2 control-label' for='codigostock_cambio'>Codigo de Stock:</label>";
    echo "<div class='col-sm-3'>";
    echo "<input type='text' id='codigostock_cambio' class='form-control' value='$codigos' />";
    echo "</div>";
    echo "</div>";

    echo "<div class='form-group'>";
	echo "<label class='col-sm-2 control-label' for='descripcion_cambio'>Descripcion:</label>";
    echo "<div class='col-sm-6'>";
    echo "<input type='text' id='descripcion_cambio' class='form-control' value='$descripcion' />";
    echo "</div>";
    echo "</div>";

    echo "<div class='form-group'>
                        <label for='codigostock' class='col-sm-2 control-label'>Fecha de Caducidad:</label>
                        <div class='col-sm-3'>
                          <input type='text' class='form-control' id='fecha_caducidad_cambio' placeholder='Fecha de Caducidad' value='$fecha_cad'>
                        </div>
                      </div>";

    echo "<div class='form-group'>";
	echo "<label class='col-sm-2 control-label' for='costo_cambio'>Costo:</label>";
    echo "<div class='col-sm-2'>";
    echo "<input type='text' id='costo_cambio' class='form-control cantidades' value='$costo' />";
    echo "</div>";
    echo "</div>";

    echo "<div class='form-group'>";
	echo "<label class='col-sm-2 control-label' for='precio_cambio'>Precio:</label>";
    echo "<div class='col-sm-2'>";
    echo "<input type='text' id='precio_cambio' class='form-control cantidades' value=$precio />";
    echo "</div>";
    echo "</div>";

    echo "<div class='form-group'>";
    echo "<label class='col-sm-2 control-label' for='proveedor_cambio'>Proveedor:</label>";
    echo "<div class='col-sm-4'>";
    $busca_provs=$db->consulta("Select id,nombre from proveedores where id<>$proveedor order by id");
     if($db->numero_de_registros($busca_provs)>0){
     echo "<select class='form-control select2' id='proveedor_cambio' >";
     $nombre_prov=$db->consulta("Select nombre from proveedores where id=$proveedor");
     while($wq=$db->buscar_array($nombre_prov)){
        $name_prov=$wq['nombre'];
     }
     echo "<option value=$proveedor>$proveedor - $name_prov</option>";
     while($re=$db->buscar_array($busca_provs)){
     echo "<option value=$re[id]>$re[id] - $re[nombre]</option>";
     }
    echo "</select>";
   }else{
    echo "<select class='form-control select2' id='proveedor_cambio' >";
     $nombre_prov=$db->consulta("Select nombre from proveedores where id=$proveedor");
     while($wq=$db->buscar_array($nombre_prov)){
        $name_prov=$wq['nombre'];
     }
    echo "<option value=$proveedor>$proveedor - $name_prov</option>";
    echo "</select>";
   }
    echo "</div>";
    echo "</div>";

    echo "<div class='form-group'>";
    echo "<label class='col-sm-2 control-label' for='linea_cambio'>Linea:</label>";
    echo "<div class='col-sm-4'>";
    $busca_linea=$db->consulta("Select linea,descripcion from lineas where linea<>$linea and grupo=0 order by linea");
    /********************************************************/
     if($db->numero_de_registros($busca_linea)>0){
     echo "<select class='form-control select2' id='linea_cambio' onchange='cambia_grupos();'>";
     $nombre_linea=$db->consulta("Select descripcion from lineas where linea=$linea and grupo=0");
     while($wq=$db->buscar_array($nombre_linea)){
        $name_lin=$wq['descripcion'];
     }
     echo "<option value=$linea>$linea - $name_lin</option>";
     while($re=$db->buscar_array($busca_linea)){
     echo "<option value=$re[linea]>$re[linea] - $re[descripcion]</option>";
     }
    echo "</select>";
   }else{
     echo "<select class='form-control select2' id='linea_cambio' onchange='cambia_grupos();'>";
     $nombre_linea=$db->consulta("Select descripcion from lineas where linea=$linea and grupo=0");
     while($wq=$db->buscar_array($nombre_linea)){
        $name_lin=$wq['descripcion'];
     }
      echo "<option value=$linea>$linea - $name_lin</option>";
      echo "</select>";
   }
   /**********************************************************/
    echo "</div>";
    echo "</div>";

    echo "<div class='form-group' id='grupo_para_cambiar'>";
    echo "<label class='col-sm-2 control-label' for='grupo_cambio'>Grupo:</label>";
    echo "<div class='col-sm-4'>";
    $busca_grupo=$db->consulta("Select grupo,descripcion from lineas where linea=$linea and grupo<>$grupo and grupo<>0 order by grupo");
     if($db->numero_de_registros($busca_grupo)>0){
     echo "<select class='form-control select2' id='grupo_cambio' >";
     $nombre_grupo=$db->consulta("Select descripcion from lineas where linea=$linea and grupo=$grupo");
     while($wq=$db->buscar_array($nombre_grupo)){
        $name_gru=$wq['descripcion'];
     }
     echo "<option value=$grupo>$grupo - $name_gru</option>";
     while($re=$db->buscar_array($busca_grupo)){
     echo "<option value=$re[grupo]>$re[grupo] - $re[descripcion]</option>";
     }
    echo "</select>";
   }
    echo "</div>";
    echo "</div>";


   echo "<div class='form-group'>";
	echo "<label class='col-sm-2 control-label' for=''>Imagen:</label>";
    echo "<div class='col-sm-6'>";
    if($imagen==""){
     echo "No se ha asociado una imagen...";
     } else{
     $src='img_articulos/'.$imagen;
     echo "<img alt='150x150' src='$src'  height='250' width='300'/>";
          }
    echo "</div>";
    echo "</div>";

    echo "<div class='form-group'>";
	echo "<label class='col-sm-2 control-label' for=''>Cambiar Imagen:</label>";
    echo "<div class='col-sm-2'>";
    echo "<div id='cambia_imagen'></div>";
    echo "</div>";
    echo "</div>";
}
?>