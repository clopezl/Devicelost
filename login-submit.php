<?PHP
require_once("recursos/php/usuarios.php");
if(login($_POST['user'],$_POST['pass'])){
	echo 'OK';
}else{
	echo rerror();
}
?>