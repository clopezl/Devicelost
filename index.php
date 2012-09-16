<?PHP
if (!isset($_SESSION)) {
	session_start();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8">
		<title>Devicelost</title>
		<! Plugins y librerías >
		<script src="recursos/js/jquery.min.js" charset="utf-8"></script>
		<script src="recursos/js/jquery-ui.min.js" charset="utf-8"></script>
		<script src="recursos/js/nanoscroller.js" charset="utf-8"></script>
		<script src="recursos/uploadify-v3.1/jquery.uploadify-3.1.js" charset="utf-8"></script>
		<! Scripts y hojas de estilos >
		<script src="recursos/js/main.js" charset="utf-8"></script>
		<link rel="stylesheet" href="recursos/css/main.css" type="text/css" charset="utf-8">
	</head>
	<body>
	
	<div id="header">
		<h1>Devicelost</h1>
		
		<?PHP
		if(isset($_SESSION['id'])){
			include('menu.php');
		}
		?>		
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