<?php
session_start();
date_default_timezone_set('America/bogota');

// echo '<pre>';
// print_r($_REQUEST);
// echo '</pre>';


$fechapan =  time();
$anio = date("Y", $fechapan);

//echo 'estado '.$_REQUEST['estado'].'---';
include("../empresa.php"); 
include('../valotablapc.php');
include('../funciones.php');
$sql_muestre_ordenes = "select id as No_Orden,
fecha,
placa,
id,
orden,
kilometraje,
estado,
mecanico,
pagada
from $tabla14 ";

$sql_muestre_ordenes .=
"where id_empresa = '".$_SESSION['id_empresa']."' and tipo_orden < '2' and anulado = '0' ";

if(!isset($_REQUEST['buscar'])){
	// echo 'mostrar solo el ultimo año';
	$sql_muestre_ordenes .= " and year(fecha) >= '".$anio."' ";
}

// echo '<br>'.$sql_muestre_ordenes;
// die();
if(isset($_REQUEST['estado']) && $_REQUEST['estado'] != '')
	{
	$sql_muestre_ordenes .= " and estado = '".$_REQUEST['estado']."' ";
}

if(isset($_REQUEST['id_mecanico']) && $_REQUEST['id_mecanico'] != '')
	{
	$sql_muestre_ordenes .= " and mecanico = '".$_REQUEST['id_mecanico']."' ";
}

if(isset($_REQUEST['fecha_in']) && $_REQUEST['fecha_in'] != '')
	{
	    $sql_muestre_ordenes .= " and fecha >= '".$_REQUEST['fecha_in']."' ";
    }
if(isset($_REQUEST['fecha_fin']) && $_REQUEST['fecha_fin'] != '')
	{
	    $sql_muestre_ordenes .= " and fecha <= '".$_REQUEST['fecha_fin']."' ";
    }





$sql_muestre_ordenes .= " order by id desc";

//echo '<br>'.$sql_muestre_ordenes.'<br>';
$consulta_ordenes = mysql_query($sql_muestre_ordenes,$conexion);

?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Muestre Ordenes</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php
//include('../colocar_links2.php');
	echo '<table border= "1">';
	echo '<tr>';
	echo '<td><h3>Orden<h3></td><td><h3>Estado</h3></td><td><h3>Linea</h3></td><td><h3>Fecha</h3></td>';
	echo  '<td><h3>Placa</h3></td>';
	echo  '<td><h3>Total</h3></td>';
	echo  '<td><h3>Tecnico</h3></td>';
	echo  '<td><h3>modificar_honda</h3></td>';
	echo '<td><h3>Vista Impresion</h3></td>'; 
		 //echo '<td><h3>Ver Pre Forma</h3></td>'; 
	
	echo '<tr>';
		while($ordenes = mysql_fetch_array($consulta_ordenes))
			{
				
				$sql_suma_items = "select sum(total_item) as total   from $tabla15  where no_factura = '".$ordenes['0']."'";
				$con_total = mysql_query($sql_suma_items,$conexion);
				$arr_total = mysql_fetch_assoc($con_total); 



				$nombre_estado = busque_estado($tabla26,$ordenes[6],$_SESSION['id_empresa'],$conexion);
				$sql_traer_tipo  = "select tipo from $tabla4 where placa='".$ordenes['2']."' and id_empresa = '".$_SESSION['id_empresa']."' ";
				$consulta_tipo = mysql_query($sql_traer_tipo,$conexion);
				$linea_tipo = mysql_fetch_assoc($consulta_tipo);
				$linea_tipo = $linea_tipo['tipo'];
				//////////////////////////////////
				$nombre_mecanico = buscar_mecanico($tabla21,$ordenes['7'],$id_empresa,$conexion);
				/////////////////////////////////
				//aqui se definiran los colores a usar
				
				if($ordenes[6] == 0){ echo '<tr class="fila_blanca">'; }
				if($ordenes[6] == 1){ echo '<tr class="fila_amarilla">'; }
				if($ordenes[6] == 2){ echo '<tr class="fila_verde">'; }
				if($ordenes[8] == 1){ echo '<tr class="fila_azul">'; }
				
				echo '<td><h3>'.$ordenes['4'].'</h3></td><td><h3>'.$nombre_estado.'</h3></td>';
				echo '<td><h3>'.$linea_tipo.'</h3></td><td><h3>'.$ordenes['1'].'</h3></td>';
				echo '<td><h3>'.$ordenes['2'].'</h3></td>';
				echo '<td><h3>'.$arr_total['total'].'</h3></td>';
				echo  '<td><h3>'.$nombre_mecanico.'</h3></td>';
				/*
				 echo  '<td><h3>';
				echo '<a href="orden_modificar_honda.php?idorden='.$ordenes['0'].'">Modificar</a>';
				echo '</h3></td>';
				*/
		
				
					echo '<td><h3><a href="orden_modificar_honda.php?idorden='.$ordenes['0'].'"  target = "_blank">Modificar_Orden</a></h3></td>';
					echo '<td><h3><a href="orden_imprimir_honda_cero_sin_sesion.php?idorden='.$ordenes['0'].'"  target = "_blank">Imprimir_Orden</a></h3></td>';
					
					echo '</h3></td>'; 
				echo '<tr>';
			}
echo '<table border= "1">';



//////////////////
//////////////



function busque_estado($tabla26,$id_estado,$id_empresa,$conexion)
	{
	  $sql_estados= "select descripcion_estado from $tabla26 where valor_estado  =   '".$id_estado."'   and id_empresa = '".$id_empresa ."' ";
	  $consulta_estados = mysql_query($sql_estados,$conexion);
	  $resultado = mysql_fetch_assoc($consulta_estados);
	  $nombre_estado = $resultado['descripcion_estado'];
	  return $nombre_estado;
	}
	
/////////////
function buscar_mecanico($tabla21,$id_mecanico,$id_empresa,$conexion)
{
 $sql_nombre_mecanico = "select * from $tabla21 where idcliente = '".$id_mecanico."'";
		$consulta_mecanico = mysql_query($sql_nombre_mecanico,$conexion);
		$filas_mecanico = mysql_num_rows($consulta_mecanico);
					if($filas_mecanico > 0)
						{
							$datos_mecanico = mysql_fetch_assoc($consulta_mecanico);
							$nombre_mecanico = $datos_mecanico['nombre'];
						}
					else {  $nombre_mecanico = 'NO_REGISTRADO';}	
					return $nombre_mecanico;
}//fin de la funcion


?>

</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script> 	