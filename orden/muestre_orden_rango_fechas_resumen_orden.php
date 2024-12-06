<?php
session_start();

// echo '<pre>';
// print_r($_REQUEST);
// echo '</pre>';
// die();
include('../valotablapc.php');
if(isset($_REQUEST['aexcel']) && $_REQUEST['aexcel']==1)
{
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=nombre_del_archivo.xls");
header("Pragma: no-cache");
header("Expires: 0");
}


$sql_ordenes="
	select * 
	from $tabla14 o
	left join $tabla4 c on c.placa = o.placa
	left join $tabla3 cli on cli.idcliente = c.propietario 
	where 1=1 "; 
if($_REQUEST['fechain']!=''){
	$sql_ordenes .=" and o.fecha >= '".$_REQUEST['fechain']."'"; 
}	
if($_REQUEST['fechafin']!=''){
	$sql_ordenes .=" and o.fecha <= '".$_REQUEST['fechain']."'"; 
}	
if($_REQUEST['selectclientes']!=''){
	$sql_ordenes .="and cli.idcliente = '".$_REQUEST['selectclientes']."' ";
}
$sql_ordenes .=" and o.id_empresa = '".$_SESSION['id_empresa']."' and o.anulado = '0' "; 
	
// echo '<br>'.$sql_ordenes;
// die();
$consulta_ordenes = mysql_query($sql_ordenes,$conexion);
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
	<div id="contenidos">
		<header>
			<h2>CONSULTA ORDENES </h2>
		</header>
		<?php
		echo '<table border= "1">';
		echo '<tr>';
		echo '<td><h3>No Orden<h3></td><td><h3>Placa<h3></td><td><h3>Fecha</h3></td><td><h3>Ver</h3></td>';
		// echo '<td>';
		// echo '<h3>Total</h3>';
		// echo '</td>';
	    $suma_total_ordenes =0;
	    while($ordenes = mysql_fetch_assoc($consulta_ordenes))
	    	  {
                  $sql_sumar_items="select sum(total_item) as suma from $tabla15 where no_factura = '".$ordenes['id']."'  ";
                //    echo  $sql_sumar_items;
				//    die();
				  $consulta_suma=mysql_query($sql_sumar_items);
                  $arreglo_suma=mysql_fetch_assoc($consulta_suma);
                  echo '<tr>';
                  echo '<td>'.$ordenes['orden'].'</td>';
                  echo '<td>'.$ordenes['placa'].'</td>';
                  echo '<td>'.$ordenes['fecha'].'</td>';
                  echo '<td><a target="_blank();" href="orden_imprimir_honda_cero_sin_sesion.php?idorden='.$ordenes['id'].'">Ver_Orden</a></td>';
                //   echo '<td align="right">'.number_format($arreglo_suma['suma'], 0, ',', '.').'</td>';
                  echo '</tr>';
                  $suma_total_ordenes +=  $arreglo_suma['suma'];
                 } 
	    	  echo '<tr>';
	    	//   echo '<td>Total</td>';
	    	  echo '<td></td>';
	    	  echo '<td></td>';
	    	//    echo '<td align="right" >'.number_format($suma_total_ordenes, 0, ',', '.').'</td>';
	    	  echo '</tr>';
	    
	    echo '</table>';

	    ?>

	</div>	

</body>
</html>


