<?PHP
if (!isset($_SESSION)) {
	session_start();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8">
		<title>Devicelost 4</title>
		<! Plugins y librer’as >
		<script src="recursos/js/jquery.min.js" charset="utf-8"></script>
		<! Scripts y hojas de estilos >
		<script src="recursos/js/main.js" charset="utf-8"></script>
		<link rel="stylesheet" href="recursos/css/main.css" type="text/css" charset="utf-8">
	</head>
	<body>
	
	<div id="header">
		<h1>Devicelost</h1>
		
		<ul <? if(!isset($_SESSION['id'])){ echo 'style="display:none;"';} ?>>
			<li><a href="#">Sobre Devicelost</a></li>
			<li><a href="#">Opciones</a></li>
			<li><a href="login-logout.php" id="logout">Cerrar sesi&oacute;n</a></li>
		</ul>
		
	</div>
	
	<div id="main">
		
		<?PHP
		if(!isset($_SESSION['id'])){
			include('login-form.php');
		}else{
			include('reproductor.php');
		}
		?>
		
	</div>
	
	</body>
</html>