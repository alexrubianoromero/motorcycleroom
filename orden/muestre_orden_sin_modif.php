<?php
session_start();
include('../valotablapc.php');
//echo 'id_empresa '.$_SESSION['id_empresa'];
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
<? 




?>
<Div id="contenidos">
		<header>
			<h3>CONSULTA ORDENES  (inicialmente solo se muestran las ordenes de este anio)</h3>
		</header>Estado
	<select id="estado" class="fila_amarilla">
      <?php   colocar_select_general($tabla26,$conexion,'valor_estado','descripcion_estado');
      ?>
	</select>Mecanico
	<select id="id_mecanico" class="fila_amarilla">
      <?php   colocar_select_general($tabla21,$conexion,'idcliente','nombre');
      ?>
	</select>	
	<input type="date" id="fecha_in" class="fila_amarilla"> <input type="date" id="fecha_fin" class="fila_amarilla"> 
	
	<button id="btn_buscar">CONSULTAR</button>
	<BR><BR>
<div id="div_mostrar_ordenes">	
    <?php    include('../orden/mostrar_ordenes_en_div.php')  ?>
</div >
<div id="paginacion"></div>

<?php
//////////////
function colocar_select_general($tabla,$conexion,$campo1,$campo2){
	$sql_general = "select * from $tabla   ";
	//echo '<br>'.$sql_personas;
	$con_general = mysql_query($sql_general,$conexion);
	echo '<option value="" >...</option>';
	while($general  = mysql_fetch_assoc($con_general))
	{
		echo '<option value="'.$general[$campo1].'" >'.$general [$campo2].'</option>';
	}
}

/////////////

?>
	</Div>
</div>	
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
			$(document).ready(function(){

					 $("#btn_buscar").click(function(){
							var data =  'estado=' + $("#estado").val();
							data += '&id_mecanico=' + $("#id_mecanico").val();
							data += '&fecha_in=' + $("#fecha_in").val();
							data += '&fecha_fin=' + $("#fecha_fin").val();
							data += '&buscar=' + '1';
							$.post('mostrar_ordenes_en_div.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_mostrar_ordenes").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////
			});		////finde la funcion principal de script
		
</script>



