<?php
session_start();
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
echo '---------------------------------------------------------------------------';
*/
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
//exit();


/*
'".$_POST['orden_numero']."',
'".$_POST['placa']."',
'".$_POST['clave']."',
'".$_POST['fecha']."',
'".$_POST['descripcion']."',
'".$_POST['radio']."',
'".$_POST['antena']."',
'".$_POST['repuesto']."',
'".$_POST['herramienta']."',
'".$_POST['otros']."'
*/
if ($_POST['cambiar_mecanico']== 'undefined'){$_POST['cambiar_mecanico'] = 0;}
if ($_POST['checkbox_pagada']== 'undefined'){$_POST['checkbox_pagada'] = 0;}
////por si se desea enviar un nuevo correo con la descripcion de la orden 
if ($_POST['enviar_correo']== 'undefined'){$_POST['enviar_correo'] = 0;}

if($_POST['cambiar_mecanico'] == 1)
{$_POST['mecanico'] = $_POST['mecanico_nuevo'];}
/*
$estados_diferentes = 0;
$estado_a_grabar  = $_POST['estado'];


if($ultimo_estado != '')
		{
				echo '<br>es estado es diferente de puntos suspensivos<br>';
				
				if($_POST['estado']<>$_POST['ultimo_estado'])
				  {
					 //echo 'los dos estados son diferentes';
					 $estado_a_grabar  = $_POST['ultimo_estado'];
					 //se coloca unindicado de que eran diferentes 
					 $estados_diferentes = 1;
					 
					 //
				  }
				 else
				 {   $estado_a_grabar  = $_POST['estado'];
				 } 
  
		}// fin de if($ultimo_estado <> '...')
		
*/		
		
//echo '<br>valor de cambiar_mecanico'.$_POST['cambiar_mecanico'];

include('../valotablapc.php');
//$sql_actualizar_orden = "update  $tabla14  set (factura,placa,sigla,fecha,observaciones,radio,antena,repuesto,herramienta,otros) 
$sql_actualizar_orden = "update  $tabla14  set 
observaciones = '".$_POST['descripcion']."',
iva = '".$_POST['iva']."'
,kilometraje = '".$_POST['kilometraje']."'
,mecanico = '".$_POST['mecanico']."'
,kilometraje_cambio = '".$_POST['kilometraje_cambio']."'
,abono = '".$_POST['abono']."'
,estado = '".$_POST['estado']."'
,formapago = '".$_POST['formapago']."'
,comercial = '".$_POST['comercial']."'  
,cotiza = '".$_POST['valor_estimado']."'  
";

if($_POST['checkbox_pagada']==1)
{ $sql_actualizar_orden .= ", pagada = '1' ";}

$sql_actualizar_orden .= " where id = '".$_POST['id_orden']."'
";

echo '<br>'.$sql_actualizar_orden;
//exit();

$consulta_grabar = mysql_query($sql_actualizar_orden,$conexion); 

actualizar_inventario_estado_vehiculo($tabla24,$tabla25,$_SESSION['id_empresa'],$id_orden,$conexion);

echo "<br><br><h2>ORDEN  ACTUALIZADA</h2>";
include('../colocar_links2.php');

//<a href="#">#</a>
//tabla24 nombres_items_carros
//tabla25 relacion_orden_inventario
function actualizar_inventario_estado_vehiculo($tabla24,$tabla25,$id_empresa,$id_orden,$conexion)
{
  // echo '<br>pasoooooooooooooooooooooooooooo11111<br>';
   $sql_nombres_inventario = "select * from $tabla24 where id_empresa = '".$id_empresa."' order by id_nombre_inventario";
   //echo '<br>'.$sql_nombres_inventario.'<br>';
   $consulta_nombres_inventario = mysql_query($sql_nombres_inventario,$conexion);
   while ($nombres_items = mysql_fetch_assoc($consulta_nombres_inventario))
   		{
			//echo 'pasooooooo2222222222222222222222';
			//echo '<br>1 '.$nombres_items['id_nombre_inventario'];
			$id_de_nombre = $nombres_items['id_nombre_inventario'];
			//echo '<br>idnombre'.$id_de_nombre;
			$cantidad = 'cantidad_'.$id_de_nombre;
			//echo '<br>cantidad123 '.$cantidad;
			
			$consulta_actualizar_valor_cantidad ="update $tabla25  set   
					valor = '".$_REQUEST[$id_de_nombre]."',
					cantidad = '".$_REQUEST[$cantidad]."'
					where id_nombre_inventario = '".$id_de_nombre."'   
					and id_orden = '".$_REQUEST['id_orden']."' 
					and id_empresa = '".$_SESSION['id_empresa']."' ";
			//echo '<br>consulta_actualizar'.$consulta_actualizar_valor_cantidad.'<br>';
			$consulta_actulizar_valores = mysql_query($consulta_actualizar_valor_cantidad,$conexion);		
		}// fin del while 
   
   

}// fin de la funcion de actualizar_inventario_estado_vehiculo 

echo '<h2><a href="orden_imprimir_honda_cero.php?idorden='.$_REQUEST['id_orden'].'" target="blank">VISTA IMPRESION ORDEN</a></h2>';
//echo '<h2><a href="orden_imprimir_preforma.php?idorden='.$_REQUEST['id_orden'].'" target="blank">VISTA PRE FORMA </a></h2>';







/*


if ($_POST['enviar_correo'] > 0)
{ 
/////////////////////
$body = '

�MOTORCYCLE ROOM!

De antemano queremos agradecer tu confianza en nosotros, y en respuesta a ello hemos dispuesto de los mejores t�cnicos, insumos y experiencia, para satisfacer completamente tus requerimientos hacia nuestro servicio. 

Hemos creado una orden con la siguiente informaci�n.


Placa: '.$_REQUEST['placa'].' Orden Numero : '.$_REQUEST['orden_numero'].' 

TRABAJO A REALIZAR : 
'.$_REQUEST['descripcion'].'
Si tienes alguna duda, comentario, o quieres conocer mas del proceso que estamos llevando a tu motocicleta, claro que puedes contactarnos!

MOTORCYCLE ROOM 
Taller Multimarca 
3142536548 

O env�anos un E-mail a motorcycleroom@gmail.com <br>
Recuerda, estamos ubicados en la Av. calle 80 20c- 49.
';

/////////////////////
		//echo '<br>Se enviara el correo de que esta se ha modificado <br>';
   include('enviar_correo.php');  
  
}//fin de if ($_POST['enviar_correo'] >0)

*/
/*

if($_REQUEST['estado']>0)
{
	$body= '
	   MOTORCYCLE ROOM Te informa!
	   
	   Que tu moto de placa '.$_REQUEST['placa'].' recibida bajo el numero de orden'.$_REQUEST['orden_numero'].'
	   
	   Ya esta lista! 
	   
	   Si tienes alguna duda, comentario, o quieres conocer mas del proceso que estamos llevando a tu motocicleta, claro que puedes	 contactarnos!

MOTORCYCLE ROOM 
Taller Multimarca 
3142536548 

O env�anos un E-mail a motorcycleroom@gmail.com <br>
Recuerda, estamos ubicados en la Av. calle 80 20c- 49.
	';
	//echo '<br>Se enviara el correo de que esta lista <br>';
	include('enviar_correo.php');  
	
	
}//fin de si se envia correo 
*/
/*
if($_POST['enviar_correo'] > 0)
{
$body= '
	   MOTORCYCLE ROOM Te informa!!!
	   
	   MODIFICACION/COTIZACION

	   Que tu moto de placa '.$_REQUEST['placa'].' recibida bajo el numero de orden'.$_REQUEST['orden_numero'].'
	   
	   OBSERVACIONES
	   
	   
	   Si tienes alguna duda, comentario, o quieres conocer mas del proceso que estamos llevando a tu motocicleta, claro que puedes	 contactarnos!

MOTORCYCLE ROOM 
Taller Multimarca 
3142536548 

O env�anos un E-mail a motorcycleroom@gmail.com <br>
Recuerda, estamos ubicados en la Av. calle 80 20c- 49.
	';
	//echo '<br>Se enviara el correo de que esta lista <br>';
	include('enviar_correo_cotiza.php');  
	
} //fin de if($_POST['enviar_correo'] == 1)
*/
?>