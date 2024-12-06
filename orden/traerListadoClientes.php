<?php
    
session_start();
include('../valotablapc.php');

$sql = "select c.idcliente , c.nombre as nombre, c.identi as cedula 
    from  cliente0 c
    inner join carros ca on c.idcliente= ca.propietario
    where c.id_empresa = '300'
    order by c.nombre asc
 ";
//  echo $sql;
//  die();
$resul = mysql_query($sql,$conexion);
echo '<option value="">Escoger Cliente</option>';  
while($consul = mysql_fetch_assoc($resul)){
  echo '<option value = "'.$consul['idcliente'].'" > '.$consul['nombre'].' - '.$consul['cedula'].'</option>';
}
?>