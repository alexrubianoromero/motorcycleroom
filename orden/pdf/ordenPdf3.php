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

 function get_table_assoc($datos)
		{
		 	$arreglo_assoc='';
			$i=0;	
			while($row = mysql_fetch_assoc($datos)){		
			$arreglo_assoc[$i] = $row;
			$i++;
			}
		return $arreglo_assoc;
		}


function traerOrdenId($id,$conexion){
    $sql = " SELECT o.orden,o.fecha,cli.telefono,o.kilometraje,o.observaciones,t.nombre as mecanico,o.id 
             ,o.estado,o.mecanico as idmecanico,cli.nombre as nombrecli, o.placa,
             cli.email as email
             FROM ordenes o 
             LEFT JOIN carros c on c.placa = o.placa
             LEFT JOIN cliente0 cli on cli.idcliente = c.propietario 
             LEFT JOIN tecnicos t on t.idcliente = o.mecanico
             WHERE  o.id = '".$id."'
             ORDER BY  o.id DESC 
             ";
    $consulta = mysql_query($sql,$conexion);  
    $arreglo= mysql_fetch_assoc($consulta);
    return $arreglo;
}

function traerDatosCarroConPlaca($placa,$conexion)
{
    $sql = "select * from carros where placa = '".$placa."' "; 
    $consulta = mysql_query($sql,$conexion); 
    $arrCarro = mysql_fetch_assoc($consulta);
    return $arrCarro;  
}

   
function traerDatosPropietarioConPlaca($id,$conexion)
{
    $sql = "select * from cliente0 where idcliente = '".$id."'   "; 
    $consulta = mysql_query($sql,$conexion); 
    $arrCliente = mysql_fetch_assoc($consulta);
    return $arrCliente; 
}

function traerItemsAsociadosOrdenPorIdOrden($idOrden,$conexion)
{
    $sql = "select * from item_orden where no_factura = '".$idOrden."'  "; 
    $consulta = mysql_query($sql,$conexion); 
    $arreglo = get_table_assoc($consulta); 
    return $arreglo; 

}

function verifiqueCodigoSiExiste($codigo,$conexion)
{
    $sql = "select * from productos where codigo_producto = '".$codigo."' limit 1 "; 
    $consulta = mysql_query($sql,$conexion);
    $filas = mysql_num_rows($consulta);
    if($filas > 0)
    {
        $arregloCodigo = mysql_fetch_assoc($consulta); 
        $result['filas'] = $filas;
        $result['data'] = $arregloCodigo;
    }else{
        $result['filas'] = 0;
        $result['data'] = '';
    }  
    return $result;
}


$datoOrden = traerOrdenId($_REQUEST['idOrden'],$conexion);
$datosCarro = traerDatosCarroConPlaca($datoOrden['placa'],$conexion);
$datosCliente = traerDatosPropietarioConPlaca($datosCarro['propietario'],$conexion); 
$datosItems = traerItemsAsociadosOrdenPorIdOrden($_REQUEST['idOrden'],$conexion); 




// echo '<pre>';
// print_r($datosItems);
// echo '</pre>';
// die();




$pdf=new FPDF();

$pdf->AddPage();
    $pdf->Ln(5);
    $pdf->Ln(5);
    // $pdf->Ln(5);
    // $pdf->Ln(5);
    $pdf->Image('../../logos/twister.png',15,20,45);
    $pdf->Image('../../imagenes/honda_orden/todosjuntos.jpg',65,20,80);

    $pdf->SetFont('Arial','B',15);
    // Movernos a la derecha
    $pdf->Cell(134);
    // T�tulo
    $pdf->Cell(35,10,'ORDEN  No ',1,1,'C');
    $pdf->Cell(134);
    $pdf->Cell(35,10,$datoOrden['orden'],1,1,'C');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(134);
    $pdf->Cell(35,8,$datoOrden['fecha'],1,1,'C');

    
    $pdf->SetFont('Arial','B',10);
    $pdf->Ln(15);
    $pdf->Cell(5);
    
    $pdf->Cell(40,6,'Cliente',1,0,'C');
    $pdf->Cell(25,6,'Identificacion',1,0,'C');
    $pdf->Cell(25,6,'Entidad',1,0,'C');
    $pdf->Cell(25,6,'Telefono',1,0,'C');
    $pdf->Cell(48,6,'Direccion',1,1,'C');
    // $pdf->Cell(25,6,'Telefono',1,1,'C');
    
    $pdf->Cell(5);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(40,6,$datosCliente['nombre'],1,0,'C');
    $pdf->Cell(25,6,$datosCliente['identi'],1,0,'C');
    $pdf->Cell(25,6,$datosCliente['entidad'],1,0,'C');
    $pdf->Cell(25,6,$datosCliente['telefono'],1,0,'C');
    $pdf->Cell(48,6,$datosCliente['direccion'],1,1,'C');
    
    // $pdf->Cell(17);
    // $pdf->Cell(22,6,'3105387544',0,1,'C');
    // $pdf->Cell(17);
    // $pdf->Cell(22,6,'Av Cll 80 No 22-59',0,1,'C'); //aqui vendria el nit
    
    
    $pdf->Ln(5);
    $kilometraje = $datoOrden['kilometraje'];
    // $pdf->Ln(5);
  
   
    $pdf->Cell(35);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(22,6,'placa',1,0,'C');
    $pdf->Cell(22,6,'Marca',1,0,'C');
    $pdf->Cell(22,6,'Tipo',1,0,'C');
    $pdf->Cell(22,6,'Color',1,0,'C');
    $pdf->Cell(22,6,'Kilometraje',1,1,'C');
    $pdf->Cell(35);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(22,6,$datoOrden['placa'],1,0,'C');
    $pdf->Cell(22,6,$datosCarro['marca'],1,0,'C');
    $pdf->Cell(22,6,$datosCarro['tipo'],1,0,'C');
    $pdf->Cell(22,6,$datosCarro['color'],1,0,'C');
    $pdf->Cell(22,6,number_format($kilometraje, 0, ',', '.'),1,1,'C');

    // $pdf->SetFont('Arial','B',9);
    $pdf->Ln(5);
    $pdf->Cell(5);
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(164,6,'DESCRIPCION DEL TRABAJO ',1,1,'C');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(5);
    $pdf->MultiCell(164,6,$datoOrden['observaciones'],1,1,'j');

    $pdf->SetFont('Arial','B',9);
    $pdf->Ln(5);
    $pdf->Cell(5);
    $pdf->Cell(100,6,'Referencia',1,0,'C');
    // $pdf->Cell(50,6,'Descripcion',1,0,'C');
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
        $datosCodigo = verifiqueCodigoSiExiste($datosItem['codigo'],$conexion);    
        $pdf->Cell(5);
        $pdf->Cell(100,6,$datosItem['descripcion'],1,0,'C');
        // $pdf->Cell(50,6,$datosCodigo['data']['referencia'],1,0,'C');
        $pdf->Cell(22,6,number_format($vrUnit, 0, ',', '.'),1,0,'C');
        $pdf->Cell(20,6,$datosItem['cantidad'],1,0,'C');
        $pdf->Cell(22,6,number_format($vrTotal, 0, ',', '.'),1,1,'R');
        $suma = $suma + $vrTotal;
    }
    $pdf->Cell(5);
    $pdf->Cell(100,6,'',1,0,'C');
    // $pdf->Cell(50,6,'',1,0,'C');
    $pdf->Cell(22,6,'',1,0,'C');
    $pdf->Cell(20,6,'Subtotal: ',1,0,'C');
    $pdf->Cell(22,6,number_format($suma, 0, ',', '.'),1,1,'R');
    
    $pdf->Cell(5);
    $pdf->MultiCell(180,6,'                                                     Av Cll 80 No 22-59   Cel 3105387544',0,1,'C');
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