<?php
include('../valotablapc.php');
/*

echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
  function  consulta_assoc_orden($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }
 $datos_orden = consulta_assoc_orden($tabla14,'id',$_REQUEST['idorden'],$conexion); 
  $datos_moto = consulta_assoc_orden($tabla4,'placa',$datos_orden['placa'],$conexion); 
  $datos_tecnico = consulta_assoc_orden($tabla21,'idcliente',$datos_orden['mecanico'],$conexion); 


  $sql_items = "select * from $tabla15 where no_factura = '".$_REQUEST['idorden']."'   ";
 $con_items = mysql_query($sql_items,$conexion);
?>
<!doctype html>
<html>
<style>
#div_items{
	position: relative;
	width: 90%;
}
#div_datos_secundarios{
	font-size: 20px;
}
</style>
<head>
	<title></title>
</head>
<body>
<div >
	<form>
	<h3><label> ORDEN:</label>  <?php  echo $datos_orden['orden']; 	?> <label>  PLACA:</label>  <?php  echo $datos_orden['placa']; 	?> <label> FECHA</label>  <?php  echo $datos_orden['fecha']; 	?></h3>
	 <div id="div_datos_secundarios">         
	           <label> KILOMETRAJE:</label> <?php  echo $datos_orden['kilometraje']; 	?>
			
				 <label>TECNICO:</label>  <?php  echo $datos_tecnico['nombre']; 	?>
	</div>  
	<textarea cols="100%" rows= "5">
	<?php  echo $datos_orden['observaciones']; 	?>
	</textarea class="form-control">
	<div id="div_items">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<td>COD</td>
					<td>DESCRIPCION</td>
					<td>VALOR UNIT</td>
					<td>CANT</td>
					<td>TOTAL</td>
				</tr>
			</thead>
			<tbody>
       <?php
          
          $total_items= 0;
         while($items = mysql_fetch_assoc($con_items))
         {
         	echo '<tr>';
         	echo '<td>'.$items['codigo'].'</td>';
         	echo '<td>'.$items['descripcion'].'</td>';
         	echo '<td align="right">'.number_format($items['valor_unitario'], 0, ',', '.').'</td>';
         	echo '<td align="center">'.$items['cantidad'].'</td>';
         	echo '<td align="right">'.number_format($items['total_item'], 0, ',', '.').'</td>';
         	echo '</tr>';
         	$total_items += $items['total_item'];


         }
     
       ?>
       <tr>
       	<td></td><td></td><td>TOTAL</td><td></td><td align="right"> <?php echo number_format($total_items, 0, ',', '.') ?></td>
       </tr>
       </tbody>
       </table>
   </form>
	</div>

</div>		
</body>
</html>