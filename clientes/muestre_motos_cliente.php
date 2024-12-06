<?php
session_start();
include('../valotablapc.php');
include('../funciones.php');

$sql_motos_cliente = "select * from $tabla4 where propietario = '".$_REQUEST['idcliente']."'   ";
//echo '<br>'.$sql_motos_cliente;
$consulta_motos = mysql_query($sql_motos_cliente,$conexion);
?>

<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<script src="../js/jquery-2.1.1.js"></script>   
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>	
	<style type="text/css">
	#div_total_muestre_motos{
		padding: 10px;
	}
    #izquierda{
    	position:absolute;
    	top:10%;
    	left:0%;
    	width: 39%;
    	border: 1px solid black;
    	padding: 5px;

    }
    #derecha{
    	position:absolute;
    	top:10%;
    	left:40%;
    	width: 60%;
    	border: 1px solid black;

    }
	</style>
</head>
<body>

<div class="container" id="div_total_muestre_motos">
<div>
<h2>LISTADO DE MOTOS DEL CLIENTE <a href="../clientes/consultacliente_general.php" role="button" class="btn btn-info">VOLVER A CLIENTES</a></h2>
</div>

<div id="izquierda" align="center">
<?php
echo '<table class="table table-striped">';
echo '<tr>';
echo '<td>PLACA</td><td>MARCA</td><td>MODELO</td><td>HISTORIAL</td>';
echo '</tr>';
while($motos = mysql_fetch_assoc($consulta_motos))
		{
			echo '<tr>';
			echo '<td><a href ="../vehiculos/muestre_datos_carro.php?placa='.$motos['placa'].'">'.$motos['placa'].'</a></td>';
			echo '<td>'.$motos['marca'].'</td>';
			echo '<td>'.$motos['modelo'].'</td>';
			//echo '<td><a href="../consultas/muestre_listado_ordenes_por_placa.php?placa123='.$motos['placa'].'">HISTORIAL</a></td>';
			echo '<td><button class="consultar_placa2" id="consultar_placa2" value ="'.$motos['placa'].'" >Ver_Historial</button></td> ';
			echo '</tr>';
		}
echo '</table>';
?>
</div>
<div id="derecha"></div>
</div>
</body>
</html>
<script language="JavaScript" type="text/JavaScript">
$(document).ready(function(){

	$(".consultar_placa2").click(function(){
				            //var plaquita = $(this).attr('value');
							//alert(plaquita);
							var data =  'placa123=' + $(this).attr('value');
							//data += '&descripan=' + $("#descripan").val();
							
							$.post('../consultas/muestre_listado_ordenes_nuevo.php',data,function(a){
							$("#derecha").html(a);
								//alert(data);
							});	
	});


});
</script>	
