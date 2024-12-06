<? 
echo 'buenas este es idex3 ';
echo '<pre>va,valores recibidos ';
print_r($_REQUEST);
echo '</pre>';

/*
mail("alexrubianoromero@gmail.com,alexrubianoromero@hotmail.com","asuntillo12","Este es el cuerpo del mensaje12") 
*/

mail($_REQUEST['correo'],$_REQUEST['asunto'],$_REQUEST['cuerpo']) 


?>