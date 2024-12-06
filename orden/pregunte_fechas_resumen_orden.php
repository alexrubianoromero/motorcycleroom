<?php
session_start();
include("../empresa.php");
include('../valotablapc.php');  
include('../funciones.php'); 
$sql_operarios = "select idcliente,nombre from $tabla21 where id_empresa = '".$_SESSION['id_empresa']."' ";
$consulta_operarios =  mysql_query($sql_operarios,$conexion);
?>

<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<Div id="contenidos">
<section>
<article>
<br>

 <div id = "datos">
<h3>
  CONSULTA DE ORDENES POR RAGO DE FECHAS Y PROPIETARIO

</h3>
<br><br>
<form name = "fechas"  method ="post"  action = "muestre_orden_rango_fechas_resumen_orden.php" >
  <div >
    <div class ="row">
        <div class="form-group">
        <div class="col-md-3" align="right">
          <strong> Fecha Inicial </strong> 
        </div>
        <div class="col-md-3" >
          <input type="date" name="fechain"  id = "fechain"  class="form-control">
        </div>
        <div class="col-md-3" align="right">
          <strong> Fecha Final </strong> 
        </div>
        <div class="col-md-3">
          <input type="date" name="fechafin"  id = "fechafin"  class="form-control">
        </div>
      </div>
    </div>
    <br>
    <div class ="row">
      <div class="col-md-3" align="right">
        <strong> Propietario</strong> 
      </div>
      <div class="col-md-5" >
        <select id="selectclientes" name = "selectclientes"> </select>
      </div>
      <div class="col-md-2" >
        <strong> Enviar_Excel</strong> 
      </div>
      <div class="col-md-2" align="left" >
        <input type="checkbox" name="aexcel"  id = "aexcel"  value = '1' >
      </div>
    </div>
    <br>
    <div class ="col-md-12">
      <input type = "submit"  value ="consultar" class="btn btn-primary btn-block">
    </div>

      
      
  </div>

</form>

  </div>   

</article>

</section>

</Div>


</body>

</html>

<script src="../js/modernizr.js"></script>   

<script src="../js/prefixfree.min.js"></script>

<script src="../js/jquery-2.1.1.js"></script> 
<script src="../js/bootstrap.min.js"></script> 





<script language="JavaScript" type="text/JavaScript">

            

			$(document).ready(function(){

               
          //  alert('bienvenido');
					

					/////////////////////////

					$("#consultar_caja").click(function(){

							var data =  'fechain=' + $("#fechain").val();

							data += '&fechafin=' + $("#fechafin").val();

							$.post('muestre_orden_rago_fechas_resumen_orden.php',data,function(a){

							//$(window).attr('location', '../index.php);

							$("#datos").html(a);

								//alert(data);

							});	

						 });
             /////////////////////
          
          function traerCLientes(){
            // alert('buenas ');
            const http=new XMLHttpRequest();
            const url = './traerListadoClientes.php';
            http.onreadystatechange = function(){
              if(this.readyState == 4 && this.status ==200){
                console.log(this.responseText);
                document.getElementById("selectclientes").innerHTML = this.responseText;
              }
            };
            http.open("POST",url);
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            http.send();
               
          };
					////////////////////////

           traerCLientes();
					
				

			});		////finde la funcion principal de script

			
    

			

			

			

			

</script>



