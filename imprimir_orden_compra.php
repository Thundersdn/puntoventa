<?php
header("Content-Type: text/html;charset=utf-8");
require('fpdf/fpdf.php');

session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}

$n_orden;

if(isset($_GET["n_orden"])){
	$n_orden = $_GET["n_orden"];
}else{
	echo "No existe numero de orden";
}
error_reporting(1);

require("class_lib/class_conecta_mysql.php");
$db=new ConexionMySQL(); 
require("class_lib/funciones.php");

//Obtener datos de compra
$cadena_comp = "SELECT id as codigo, proveedor, emision, total, referencia as ref FROM compras WHERE id = $n_orden";
$res = $db->consulta($cadena_comp);

if($db->numero_de_registros($res)>0){
	$compra = $db->buscar_array_assoc($res);
}


//Obtener datos de proveedor
//$datos_prov = array("nombre" => "", "telefono" => "", "domicilio" => "", "ciudad" => "");
$id_prov = $compra["proveedor"];
$cadena_prov = "SELECT nombre, telefono, domicilio, ciudad FROM proveedores WHERE id = $id_prov";
$res = $db->consulta($cadena_prov);
if($db->numero_de_registros($res)>0){
	$prov = $db->buscar_array_assoc($res);
}

//Obtener lista de productos 
$id_ref = $compra["ref"];
$cadena_prod = "SELECT k.codigo, a.descripcion, k.costou, k.cantidad FROM articulos a, kardex k WHERE k.referencia = $id_ref AND a.codigo = k.codigo";
$prods = $db->consulta($cadena_prod);
/*
 if($db->numero_de_registros($res)>0){
	$prods = $db->buscar_array_assoc($res);
}
*/
class ORDEN extends FPDF{
// Cabecera de página
function Header(){
	global $n_orden;
	global $compra;
	$this->SetFont('Arial','B',16);
	$this->Cell(0,10,'ORDEN DE COMPRA N° '. $compra["codigo"], 0, 0,'C');
	$this->Ln(20);
}

function Datos_Cliente(){
	$w = 30;
	$h  = 5;
	$r_social = "";
	$ciudad = "";
	$contacto = "";
	$rut = "";
	$dir = "";
	$tel = "";
	
	//Escribir titulo
	$this->SetFont('Arial','B',10);
	$this->SetTextColor(50,50,150);
	$this->Cell(0,10,'CLIENTE Y FACTURA', 0, 0);
	$this->Ln(8);
	//Dibujar celdas
	$this->SetFont('courier','',10);
	$this->SetLineWidth(.1);
	$this->SetTextColor(0,0,0);
	$this->SetFillColor(200,200,200);
	$this->Cell($w,$h,"	Razón social",1,0,"L",true);
	$this->Cell($w*2,$h,$r_social,1,0,"L");
	$this->SetFillColor(200,200,200);
	$this->Cell($w,$h,"	Ciudad",1,0,"L",true);
	$this->Cell($w*2,$h,$ciudad,1,0,"L");
	$this->Ln();
	$this->SetFillColor(200,200,200);
	$this->Cell($w,$h,"	Contacto",1,0,"L",true);
	$this->Cell($w*2,$h,$contacto,1,0,"L");
	$this->SetFillColor(200,200,200);
	$this->Cell($w,$h,"	RUT",1,0,"L",true);
	$this->Cell($w*2,$h,$rut,1,0,"L");
	$this->Ln();
	$this->SetFillColor(200,200,200);
	$this->Cell($w,$h,"	Dirección",1,0,"L",true);
	$this->Cell($w*2,$h,$dir,1,0,"L");
	$this->SetFillColor(200,200,200);
	$this->Cell($w,$h,"	Teléfono",1,0,"L",true);
	$this->Cell($w*2,$h,$tel,1,0,"L");
	$this->Ln(10);
}

function Datos_Prov(){
	global $prov;
	$w = 30;
	$h  = 5;
	$r_social = "";
	$ciudad = $prov["ciudad"];
	$contacto = "";
	$rut = "";
	$dir = $prov["domicilio"];
	$tel = $prov["telefono"];
	
	//Escribir titulo
	$this->SetFont('Arial','B',10);
	$this->SetTextColor(50,50,150);
	$this->Cell(0,10,'PROVEEDOR: '.$prov["nombre"], 0, 0);
	$this->Ln(8);
	//Dibujar celdas
	$this->SetFont('courier','',10);
	$this->SetLineWidth(.05);
	$this->SetTextColor(0,0,0);
	$this->SetFillColor(200,200,200);
	$this->Cell($w,$h,"	Razón social",1,0,"L",true);
	$this->Cell($w*2,$h,$r_social,1,0,"L");
	$this->SetFillColor(200,200,200);
	$this->Cell($w,$h,"	Ciudad",1,0,"L",true);
	$this->Cell($w*2,$h,$ciudad,1,0,"L");
	$this->Ln();
	$this->SetFillColor(200,200,200);
	$this->Cell($w,$h,"	Contacto",1,0,"L",true);
	$this->Cell($w*2,$h,$contacto,1,0,"L");
	$this->SetFillColor(200,200,200);
	$this->Cell($w,$h,"	RUT",1,0,"L",true);
	$this->Cell($w*2,$h,$rut,1,0,"L");
	$this->Ln();
	$this->SetFillColor(200,200,200);
	$this->Cell($w,$h,"	Dirección",1,0,"L",true);
	$this->Cell($w*2,$h,$dir,1,0,"L");
	$this->SetFillColor(200,200,200);
	$this->Cell($w,$h,"	Teléfono",1,0,"L",true);
	$this->Cell($w*2,$h,$tel,1,0,"L");
	$this->Ln(10);
}
	
function Datos_Prods(){
	global $prods, $db;
	$cabecera = array("Codigo", "Descripción del producto", "Precio unitario", "Cantidad", "Precio Total");
	$w = array(25,70,30,25,30);
	$h  = 5;
	
	$neto = 0;
	$iva = 0;
	$total = 0;
	
	//Escribir titulo
	$this->SetFont('Arial','B',10);
	$this->SetTextColor(50,50,150);
	$this->Cell(0,10,'DETALLES DE ESTA COMPRA', 0, 0);
	$this->Ln(8);
	//Dibujar cabecera
	$this->SetLineWidth(.05);
	$this->SetTextColor(0,0,0);
	$this->SetFillColor(200,200,200);
	foreach($cabecera as $i => $t){
		$this->Cell($w[$i],$h, $t, 1,0,"C",true);
		
	}
	$this->Ln();
	//Escribir productos
	$this->SetFont('courier','',10);
	$this->SetLineWidth(.05);
	$this->SetTextColor(0,0,0);
	$this->SetFillColor(255,255,255);
	if($db->numero_de_registros($prods)>0){
		while($prod=$db->buscar_array($prods)){
			$i = 0;
			$this->Cell($w[$i],$h,$prod["codigo"], 1, 0,"L");
			$i = $i+1;
			$this->Cell($w[$i],$h,$prod["descripcion"], 1, 0,"L");
			$i = $i+1;
			$this->Cell($w[$i],$h,"$".number_format($prod["costou"],0,',','.'), 1, 0,"C");
			$i = $i+1;
			$this->Cell($w[$i],$h,number_format($prod["cantidad"],0,',','.'), 1, 0,"C");
			$i = $i+1;
			$this->Cell($w[$i],$h,"$".number_format(($prod["cantidad"]*$prod["costou"]),0,',','.'), 1, 0,"C");
			$neto = $neto + $prod["cantidad"]*$prod["costou"];
			$this->Ln();
		}
	}
	//Escribir NETO, IVA, TOTAL.
	$iva = round($neto * 0.19);
	$total = $neto + $iva;
	$this->SetFont('Arial','B',10);
	$this->SetFillColor(200,200,200);
	$this->Cell($w[0]+$w[1]+$w[2]+$w[3],$h,"NETO", 1, 0,"R", true);
	$this->SetFont('courier','',10);
	$this->Cell($w[4],$h, "$".number_format($neto,0,',','.'),1,0,"C");
	$this->Ln();
	$this->SetFont('Arial','B',10);
	$this->SetFillColor(200,200,200);
	$this->Cell($w[0]+$w[1]+$w[2]+$w[3],$h,"I.V.A.", 1, 0,"R", true);
	$this->SetFont('courier','',10);
	$this->Cell($w[4],$h, "$".number_format($iva,0,',','.'),1,0,"C");
	$this->Ln();
	$this->SetFont('Arial','B',10);
	$this->SetFillColor(200,200,200);
	$this->Cell($w[0]+$w[1]+$w[2]+$w[3],$h,"TOTAL", 1, 0,"R", true);
	$this->SetFont('courier','',10);
	$this->Cell($w[4],$h, "$".number_format($total,0,',','.'),1,0,"C");
	$this->Ln(10);
}

function Firma(){
	$this->SetFont('Arial','B',10);
	$this->SetTextColor(0,0,0);
	$this->SetFillColor(200,200,200);
	$this->SetLineWidth(.3);
	$this->Cell(0,10,"Aceptación de cliente:",0,0,"L");
	$this->Ln(30);
	$this->Cell(30);
	$this->Cell(50,10,"","B",0,"C");
	$this->Cell(30);
	$this->Cell(50,10,"","B",0,"C");
	$this->Ln(10);
	$this->Cell(30);
	$this->Cell(50,10,"Nombre - Cargo",0,0,"L");
	$this->Cell(30);
	$this->Cell(50,10,"Firma ",0,0,"L");
	
	
}

function Logo(){
	$this->Image("logo.png",70,99,70);
	
}
}


$pdf = new ORDEN();
$pdf->AddPage();
$pdf->Logo();
$pdf->Datos_Cliente();
$pdf->Datos_Prov();
$pdf->Datos_Prods();
$pdf->Firma();

$pdf->Output();


?>