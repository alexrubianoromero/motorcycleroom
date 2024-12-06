<?php
//los que yo tenia $headers = "MIME-Version: 1.0\r\n"; 
/*
$headers = "Content-type: text/html; charset=iso-8859-1\r\n"; 
$headers .= "From: Motorcycle Room <motorcycleroom@gmail.com>\r\n"; 
*/

$cabeceras  = 'MIME-Version: 1.0' . "\r\n";  
$cabeceras .= 'Content-type: text/html;  charset=iso-8859-1' . "\r\n";
///////////////////////////////$cabeceras .= 'From: Alex Rubiano <alexrubianoromero@gmail.com>' . "\r\n";
//$cabeceras .= 'From: Formulario de Contacto Moleca IT <ventas@molecait.com>' . "\r\n";
//$cabeceras .= 'From: Formulario de Contacto Moleca IT <alexrubianoromero@gmail.com>' . "\r\n";
//$cabeceras .= 'From: Alex Rubiano <motorcycleroom@gmail.com>' . "\r\n";
//$cabeceras .= "From: Motorcycle Room <motorcycleroom@gmail.com>\r\n"; 
mail("alexrubianoromero@gmail.com","COTIZACION",$body,$cabeceras); 

?>
