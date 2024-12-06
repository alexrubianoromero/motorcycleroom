<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/

$sql_traer_codigos = "select * from $tabla12 where descripcion like '%".$_REQUEST['descricodigo']."%'  and id_empresa = '".$_SESSION['id_empresa']."'  ";
$consulta_codigos = mysql_query($sql_traer_codigos,$conexion);

echo '<table border="1" width="75%">';
 echo '<tr>';
  echo '<td></td>';
    echo '<td>CODIGO</td>';
	  echo '<td>DESCRIPCION</td>';
	    echo '<td>PRECIO</td>';
		  echo '<td>CANTIDAD</td>';
   echo '</tr>';
while($codigos = mysql_fetch_assoc($consulta_codigos))
{
  echo '<tr>';
  echo '<td></td>';
  echo '<td>'.$codigos['codigo_producto'].'</td>';
  echo '<td>'.$codigos['descripcion'].'</td>';
  echo '<td>'.$codigos['valorventa'].'</td>';
   echo '<td>'.$codigos['cantidad'].'</td>';
  echo '</tr>';
  
}
echo '</table>';
?>
