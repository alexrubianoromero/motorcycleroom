<?php
include('../valotablapc.php');
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';

$sql_placas = "select cli.nombre as nombrecli,cli.identi as clidenti,cli.direccion,cli.telefono,car.placa,car.marca,car.modelo,car.color,car.tipo,car.chasis,
 o.fecha,o.observaciones,o.radio,o.antena,o.repuesto,o.herramienta,o.otros,o.iva as iva ,o.orden,o.kilometraje,o.mecanico,o.id,
 e.identi,e.telefonos as telefonos_empresa ,e.direccion as direccion_empresa,o.kilometraje_cambio,e.tipo_taller,cli.email,e.condiciones_orden,
 o.fecha_entrega, o.fecha_salida , e.email_empresa,e.razon_social,o.abono,cli.entidad,car.sigla
from $tabla4 as car
inner join $tabla3 as cli on (cli.idcliente = car.propietario)
inner join $tabla14 as o  on (o.placa = car.placa)
inner join $tabla10 as e on  (e.id_empresa = o.id_empresa) 
 where o.id = '".$_REQUEST['idorden']."'    ";
 //echo '<br>'.$sql_placas.'<br>';
$datos = mysql_query($sql_placas,$conexion);
$filas = mysql_num_rows($datos); 
$datos_orden = mysql_fetch_assoc($datos);

$body ='';

$body .= "
placa ".$datos_orden['placa'];
$body .= "
orden ".$datos_orden['orden'];
$body .= "
orden ".$datos_orden['observaciones'];

echo $body;
include('enviar_correo_cotiza.php');
?>


