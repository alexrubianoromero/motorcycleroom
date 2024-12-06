<?php
session_start();
include('../valotablapc.php');
include('../funciones.php');

$sql_clientes = "select nombre,telefono,email,direccion,observaci,idcliente,identi 
from $tabla3 as cli  where  cli.id_empresa = '".$_SESSION['id_empresa']."'   ";



//inner join $tabla4 car  on (car.propietario = cli.idcliente)
//,placa,marca,color,modelo
//include('../colocar_links2.php');
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<script src="../js/jquery-2.1.1.js"></script>   
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>	
</head>
<body>
<div class="container" >
<?php
echo '<div id="contenidos>">';
echo '<h3>CONSULTA GENERAL DE CLIENTES <a href = "captura_cliente.php" role="button"  class="btn btn-primary btn-md">NUEVO CLIENTE</a></h3>';
echo '<h3></h3>';

echo '<table class="table table-striped table-hover">';
echo '<tr><td>NOMBRE</td><td>IDENTIFICACION</td><td>TELEFONO</td><td>EMAIL</td><td>DIRECCION</td><td>VER MOTOS</td>';
//echo '<td>PLACA</td><td>MARCA</td><td>MODELO</td><td>HISTORIAL</td></tr>';
$consulta_clientes = mysql_query($sql_clientes,$conexion);
while($clientes = mysql_fetch_array($consulta_clientes))
	{
			echo '<tr>';	
			//echo '<td>'.$clientes[0].'</td>';
			echo '<td><a href ="muestre_datos_cliente.php?idcliente='.$clientes[5].'" >'.$clientes[0].'</a></td>';
			//echo '<a href="orden_detallado.php?idorden='.$ordenes['0'].'">Ver Detalle</a>';
			echo '<td>'.$clientes[6].'</td>';
			echo '<td>'.$clientes[1].'</td>';
			echo '<td>'.$clientes[2].'</td>';
			echo '<td>'.$clientes[3].'</td>';
			echo '<td><a href = "muestre_motos_cliente.php?idcliente='.$clientes[5].'" role="button" class="btn btn-info">VER MOTOS</a></td>';
			/*
			$sql_carros = "select placa,marca,color,modelo from $tabla4   where propietario = '".$clientes[5]."'";	
			$consulta_carros = mysql_query($sql_carros,$conexion);
			$filas = mysql_num_rows($consulta_carros);
			if ($filas >0)
					{
						$carros = mysql_fetch_assoc($consulta_carros); 
						echo '<td><a href ="../vehiculos/muestre_datos_carro.php?placa='.$carros['placa'].'">'.$carros['placa'].'</a></td>';
						
						echo '<td>'.$carros['marca'].'</td>';
						echo '<td>'.$carros['modelo'].'</td>';
						echo '<td><a href="../consultas/muestre_listado_ordenes_por_placa.php?placa123='.$carros['placa'].'">'.$carros['placa'].'</a></td>';
					}
					else
					{
						echo '<td>NO TIENE</td>';
						echo '<td>NO TIENE</td>';
						echo '<td>NO TIENE</td>';
						echo '<td>NO TIENE</td>';
					}
			*/
			echo '</tr>';
	}
echo '</table>';
echo '</div>';
echo '<div id = "muestre">';
echo '</div>';


?>
</div>
</body>
</html>