<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_POST);
echo '<pre>';
*/

$sql_grabar_persona  = "insert into $proveedores (identi,nombre,telefono,direccion,entidad,id_empresa,email,observaci)  
 values(
 	'".$_POST['cedula']."'
 	,'".$_POST['nombre']."'
 	,'".$_POST['telefono']."'
 	,'".$_POST['direccion']."'
	,'".$_POST['entidad']."'
 	,'".$_SESSION['id_empresa']."'
 	,'".$_POST['email']."'
 	,'".$_POST['observaciones']."'
 	)"; 
$consulta_grabar= mysql_query($sql_grabar_persona,$conexion);

//echo '<br>'.$sql_grabar_persona.'<br>';

echo '<H3>GRABACION EXITOSA</H3>';

include('../colocar_links2.php');

?>