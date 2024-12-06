<?php  
session_start();
date_default_timezone_set('America/Bogota');
/*

echo '<pre>';
print_r($_SESSION);
echo '</pre>';
exit();
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<meta name="viewport" content="initial-scale=1">
<script src="js/jquery.js"></script>  
<link rel="stylesheet" href="css/style_menu_navegacion.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/fontello.css">
 <script type="text/javascript" src="js/cssrefresh.js"></script>
</head>
<body>
<?php 
    $sql_empresa = "select * from $tabla10 where id_empresa = '".$_SESSION['id_empresa']."' ";
    $consulta_empresa = mysql_query($sql_empresa,$conexion);
    $ruta_empresa = mysql_fetch_assoc($consulta_empresa);
    $nombre_imagen = $ruta_empresa['ruta_imagen']

?>
 <div align="center"><img src="logos/twister.png" width="150px" height="150px" /></div>
<header>
			
			<input type="checkbox" id="btn-menu">
			<label for="btn-menu" class="entypo-menu"></label>
			<nav class="menu">
			<?php 
			include('pintar_menu_categorias.php');
			?>	
			
				<!--
				<ul>
					<li><a href="#">Item 1</a></li>

					<li class="submenu"><a href="#">Item 2<span class="entypo-down-open"></span></a>
						<ul>
							<li><a href="#">Sub Item 1</a></li>
							<li><a href="#">Sub Item 2</a></li>
							<li><a href="#">Sub Item 3</a></li>
							<li><a href="#">Sub Item 4</a></li>
						</ul>
					</li>
					
					<li class="submenu"><a href="#">Item 3<span class="entypo-down-open"></span></a>
						<ul>
							<li><a href="#">Sub Item 1</a></li>
							<li><a href="#">Sub Item 2</a></li>
							<li><a href="#">Sub Item 3</a></li>
							<li><a href="#">Sub Item 4</a></li>
						</ul>
					</li>
					<li><a href="#">Item 4</a></li>
				</ul>
				-->
			</nav>
		</header>
		<iframe name = "cuadro_principal" width="100%" height="600">
</iframe>
</body>
</html>
<script src="menu.js"></script>  