<!doctype html>
<html>
<head>
	<title></title>
	<style >
	#container{
		position:absolute;
		top:0%;
		left:0%;
		width: 100%;
		height: 95%;
		/*border: 1px solid blue;*/
		padding: 5px;


	}
	#parte_superior{
		position: absolute;
		background-color: #c0c0c0;
		top:0%;
         left:0%;
         width: 100%;
		height: 9%;
		/*border: 2px solid red;*/
		padding: 10px;
		font-size: 25px;
		color:black;

	}
	#abajo{
		position: absolute;
		top:10%;
		bottom: 10px;
		width: 100%;
		/*height: 80%;*/
		/*border: 1px solid green;*/
		padding: 5px;

	}
	#derecha{
		position: absolute;
		top:0%;
		left:40%;
		width: 60%;
		/*height: 95%;*/
		border: 1px solid black;
		padding: 5px;

	}
	#izquierda{
		position: absolute;
		background-color: #e6e6e6;
		top:0%;
		left:0%;
		width: 39%;
		/*height: 95%;*/
		/*border: 1px solid black;*/
		padding: 5px;
	}
	</style>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<script src="../js/jquery-2.1.1.js"></script>   
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</head>
<body>
<div class="container" id="container">
	<div id="parte_superior" align="center">

		HISTORICO ORDENES
		<input type="text" id="placa_consultar_123" placeholder="placa" size="6px"> <button id="btn_consultar_placa" class="btn btn-info btn-lg" >Consultar</button>
	</div>
	<div id="abajo">
		<div id="derecha"></div>
		<div id="izquierda"></div>
	</div>	
</div>
</body>
</html>


<script language="JavaScript" type="text/JavaScript">
$(document).ready(function(){

	$("#btn_consultar_placa").click(function(){
							var data =  'placa123=' + $("#placa_consultar_123").val();
							//data += '&descripan=' + $("#descripan").val();
							
							$.post('../consultas/muestre_listado_ordenes_nuevo.php',data,function(a){
							$("#izquierda").html(a);
								//alert(data);
							});	
	});


});
</script>	


