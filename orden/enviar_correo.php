<?php
//los que yo tenia $headers = "MIME-Version: 1.0\r\n"; 
//los que yo tenia$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
//$headers .= "From: Motorcycle Room <motorcycleroom@gmail.com>\r\n"; 
$headers .= "From: Motorcycle Room <motorcycleroom@arsolutiontechnology.com>\r\n"; 
//$headers .= 'From: Birthday Reminder <birthday@example.com>';
//$headers .= "Cc:Alex <alexrubianoromero@hotmail.com>\r\n";
//$headers .= "Cc:arsolution <gerentegeneral@arsolutiontechnology.com>\r\n";
//$headers .= "Cc: Motorcycle Room <motorcycleroom@alexrubiano.com>\r\n";
//$headers .= "Cc: Motorcycle Room <motorcycleroom@gmail.com>\r\n";
//$headers .= "Cc: Motorcycle Room <ventas@alexrubiano.com>\r\n";
//$headers .= "Bcc: Alex <alexrubianoromero@gmail.com>\r\n"; 
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
echo '<br>email'.$_REQUEST['email'];
//mail ("ventas@molecait.com,$email",$asunto,$mensaje,$cabeceras);
mail($_REQUEST['email'],"BIENVENIDA",$body,$headers); 
mail("motorcycleroom@arsolutiontechnology.com","BIENVENIDA",$body,$headers); 
//mail("alexrubianoromero@gmail.com","BIENVENIDAcopia",$body,$headers); 
?>
