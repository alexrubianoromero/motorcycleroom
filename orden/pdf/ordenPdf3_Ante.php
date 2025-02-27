<?php
// echo '<pre>';
// print_r($_REQUEST);
// echo '</pre>';
// die();
$raiz= $_SERVER['DOCUMENT_ROOT'];
// die($raiz); 
date_default_timezone_set('America/Bogota');
require_once($raiz.'/fpdf/fpdf.php');
$ruta = dirname(dirname(dirname(__FILE__)));
require_once($ruta.'/valotablapc.php');

// die($usuario);

// require_once($ruta .'/orden/modelo/OrdenesModelo.class.php');
// require_once($ruta .'/inventario_codigos/modelo/CodigosInventarioModelo.php');
// die('paso aca'); 
// die($ruta);
// require_once($ruta .'/vehiculos/modelo/VehiculosModelo.php');

// $orden = new OrdenesModelo();
// $infoCode = new CodigosInventarioModelo();
// $vehiculo = new VehiculosModelo(); 

function traerOrdenId($id,$conexion){
    $sql = " SELECT o.orden,o.fecha,cli.telefono,o.kilometraje,o.observaciones,t.nombre as mecanico,o.id 
             ,o.estado,o.observacionestecnico,o.mecanico as idmecanico,cli.nombre as nombrecli, o.placa,
             cli.email as email
             FROM ordenes o 
             LEFT JOIN carros c on c.placa = o.placa
             LEFT JOIN cliente0 cli on cli.idcliente = c.propietario 
             LEFT JOIN tecnicos t on t.idcliente = o.mecanico
             WHERE  o.id = '".$id."'
             ORDER BY  o.id DESC 
             ";
    // echo '<br>'.$sql; 
    // $consulta = mysql_query($sql,$conexion);
    $consulta = mysql_query($sql,$conexion);  
    $arreglo= mysql_fetch_assoc($consulta);
    return $arreglo;
}

$datoOrden = $orden->traerOrdenId($_REQUEST['idOrden'],$conexion);




echo '<pre>';
print_r($datoOrden);
echo '</pre>';
die();


// $datosCarro = $orden->traerDatosCarroConPlaca($datoOrden['placa']);
// $datosCliente = $orden->traerDatosPropietarioConPlaca($datosCarro['propietario']); 
// $datosItems = $orden->traerItemsAsociadosOrdenPorIdOrden($_REQUEST['idOrden']); 



$pdf=new FPDF();

$pdf->AddPage();
    $pdf->Ln(5);
    $pdf->Ln(5);
    $pdf->Ln(5);
    $pdf->Ln(5);
    $pdf->Image('../../logos/logokaymo.png',15,20,50);

    $pdf->SetFont('Arial','B',15);
    // Movernos a la derecha
    $pdf->Cell(80);
    // T�tulo
    $pdf->Cell(70,10,'ORDEN DE SERVICIO No ',1,0,'');
    $pdf->Cell(19,10,$datoOrden['orden'],1,1,'');

    
    $pdf->SetFont('Arial','',10);
    $pdf->Ln(5);
$pdf->Cell(80);

$pdf->Cell(40,6,'Cliente',1,0,'C');
$pdf->Cell(25,6,'Identificacion',1,0,'C');
$pdf->Cell(25,6,'Telefono',1,1,'C');

$pdf->Cell(80);
$pdf->Cell(40,6,$datosCliente['nombre'],1,0,'C');
$pdf->Cell(25,6,$datosCliente['identi'],1,0,'C');
$pdf->Cell(25,6,$datosCliente['telefono'],1,1,'C');
$pdf->Cell(80);
$pdf->Cell(90,6,$datosCliente['direccion'],1,1,'C');
$pdf->Cell(17);
$pdf->Cell(22,6,'KAYMO SOFTWARE',0,0,'C');
$pdf->Cell(41);
$pdf->Cell(90,6,'Dir CLiente',1,1,'C');
$pdf->Cell(17);
$pdf->Cell(22,6,'Bogota',0,1,'C');
$pdf->Cell(17);
$pdf->Cell(22,6,'Nit:12345678-4',0,1,'C');


$kilometraje = $datoOrden['kilometraje'];
$pdf->Ln(5);
$pdf->Cell(25);
$pdf->Cell(22,6,'Fecha',1,0,'C');
$pdf->Cell(22,6,'Factura',1,0,'C');
$pdf->Cell(20);
$pdf->Cell(22,6,'Moto',1,0,'C');
$pdf->Cell(22,6,'placa',1,0,'C');
$pdf->Cell(22,6,'Kilometraje',1,1,'C');
$pdf->Cell(25);
$pdf->Cell(22,6,$datoOrden['fecha'],1,0,'C');
$pdf->Cell(22,6,$datoOrden['orden'],1,0,'C');
$pdf->Cell(20);
$pdf->Cell(22,6,$datosCarro['marca'],1,0,'C');
$pdf->Cell(22,6,$datoOrden['placa'],1,0,'C');
$pdf->Cell(22,6,number_format($kilometraje, 0, ',', '.'),1,1,'C');


$pdf->SetFont('Arial','B',9);
$pdf->Ln(5);
$pdf->Cell(5);
$pdf->Cell(50,6,'Referencia',1,0,'C');
$pdf->Cell(50,6,'Descripcion',1,0,'C');
$pdf->Cell(22,6,'Vr. Unitario',1,0,'C');
$pdf->Cell(20,6,'Cantidad',1,0,'C');
$pdf->Cell(22,6,'Total',1,1,'C');
$suma = 0;
$filas = count($datosItems); 
$pdf->SetFont('Arial','',9);
    foreach ($datosItems as $datosItem)    
    {
      $vrUnit =   $datosItem['valor_unitario'];
      $vrTotal = $datosItem['total_item'];
    $datosCodigo = $infoCode->verifiqueCodigoSiExiste($datosItem['codigo']);    
	$pdf->Cell(5);
	$pdf->Cell(50,6,$datosCodigo['data']['referencia'],1,0,'C');
	$pdf->Cell(50,6,$datosItem['descripcion'],1,0,'C');
	$pdf->Cell(22,6,number_format($vrUnit, 0, ',', '.'),1,0,'C');
	$pdf->Cell(20,6,$datosItem['cantidad'],1,0,'C');
	$pdf->Cell(22,6,number_format($vrTotal, 0, ',', '.'),1,1,'C');
    $suma = $suma + $vrTotal;
}
$pdf->Cell(5);
$pdf->Cell(50,6,'',1,0,'C');
$pdf->Cell(50,6,'',1,0,'C');
$pdf->Cell(22,6,'',1,0,'C');
$pdf->Cell(20,6,'Subtotal: ',1,0,'C');
$pdf->Cell(22,6,number_format($suma, 0, ',', '.'),1,1,'C');


$pdf->Ln(5);
$pdf->Cell(5);
$pdf->Cell(50,6,'Recibido',0,0,'');
$pdf->Cell(40,6,'___________________',0,1,'');
$pdf->Ln(5);
$pdf->Cell(5);
$pdf->Cell(50,6,'Observaciones',0,1,'');
$pdf->SetFont('Arial','',6);
$pdf->Cell(5);
$pdf->MultiCell(180,8,'TODA REPARACION DEBE SER CANCELADA ESTRICTAMENTE DE CONTADO. NUESTRO REPUESTO NO CONSTITUYE UNA OBLIGACION DE NUESTRA PARTE YA QUE, YA QUE AL INICIAR LOS TRABAJOS PUEDEN APARECER NUEVAS REPARACIONES QUE NO SON EVIDENTES EN LA PRIMERA INSPECCION',0,1,'');
$pdf->Output();

?>