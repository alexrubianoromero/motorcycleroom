<?php
/*
echo '<pre>';
print_r($_REQUEST);
echo '<pre>';
*/
include('../valotablapc.php');
$sql_ordenes = "select * from $tabla14 where placa = '".$_REQUEST['placa123']."'  order by fecha desc";
$con_ordenes = mysql_query($sql_ordenes);
$filas = mysql_num_rows($con_ordenes);

//echo '<br>'.$filas;
//$datos_ordenes = consulta_assoc($tabla14,'placa',$_REQUEST['placa123'],$conexion);
/*
echo 'arreglo<pre>';
print_r($arr_assoc);
echo '<pre>';
*/
  function  consulta_assoc($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

$datos_moto = consulta_assoc($tabla4,'placa',$_REQUEST['placa123'],$conexion);
?>
<!doctype html>
<html>
<head>
	<title></title>
	<style type="text/css">
		#div_vencimientos{
			background-color: black;
			color: white;
			font-size: 15px;
			font-family: verdana;
		}
	</style>
	
</head>
<body>
<div>
	<div id="div_vencimientos" align="center">
	<label> Vencimiento Soat: </label> <?php echo $datos_moto['vencisoat']  ?> <label>  Vencimiento Tecnomecanica: </label>  <?php echo $datos_moto['revision']  ?> 
	</div>
<table class="table table-striped table-hover">
	<thead>
<tr>
	<td>PLACA</td>
	<td>ORDEN</td>
	<td>FECHA</td>
	<td>KILOMETRAJE</td>
	<td>ESTADO</td>
	<td>CONSULTAR</td>

</tr>
	</thead>
	<tbody>

<?php
while ($ordenes = mysql_fetch_assoc($con_ordenes)){
  //echo '<br>'.$ordenes['placa'];
	 $estados_ordenes =  consulta_assoc($tabla26,'valor_estado',$ordenes['estado'],$conexion);
  echo '<tr>';
  echo '<td>'.$ordenes['placa'].'</td>';
  echo '<td>'.$ordenes['orden'].'</td>';
  echo '<td>';

  echo $ordenes['fecha'];
  echo '</td>';
   echo '<td align="right">'.number_format($ordenes['kilometraje'], 0, ',', '.').'</td>';
   echo '<td>'.$estados_ordenes['descripcion_estado'].'</td>';
   echo '<td><button id="consultar" class=" btn btn-info consultar" value = "'.$ordenes['id'].'">CONSULTAR</button></td>';
  echo '</tr>';
}

?>
</tbody>
</table>
</div>
</body>
</html>
<script src="../js/jquery-2.1.1.js"></script>   
<script language="JavaScript" type="text/JavaScript">
$(document).ready(function(){
//////////////////////////////	
	$(".consultar").click(function(){
							//alert('asdasdasd');
							var data =  'idorden=' + $(this).attr('value');
							//data += '&factupan=' + $("#orden_numero").val();
							//$.post('prueba_ver.php',data,function(a){
								$.post('../consultas/ver_informacion_orden.php',data,function(a){
									//$.post('../orden/orden_detallado.php',data,function(a){
								$("#derecha").html(a);
								//alert(data);
							});	
						 });

///////////////////////	
});
</script>	



