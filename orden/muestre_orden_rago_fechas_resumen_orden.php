<?php
session_start();
include('../valotablapc.php');
if(isset($_REQUEST['aexcel']) && $_REQUEST['aexcel']==1)
{
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=nombre_del_archivo.xls");
header("Pragma: no-cache");
header("Expires: 0");
}
$sql_ordenes="select * from $tabla14 where fecha between '".$_REQUEST['fechain']."' and '".$_REQUEST['fechafin']."';
 id_empresa = '".$_SESSION['id_empresa']."' and anulado = '0'  ";
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
			<h2>CONSULTA ORDENES.. </h2>
		</header>
		<?php
		echo '<table border= "1">';
	echo '<tr>';
	echo '<td><h3>No Orden<h3></td><td><h3>Estado</h3></td><td><h3>Linea</h3></td><td><h3>Fecha</h3>

	?>

	</div>	

</body>
</html>


?>