<?PHP
function connect(){
	$host	= 'localhost';
	$user	= 'devicelost';
	$pass	= 'fZFpda6(^-{U';
	$db		= mysql_connect($host,$user,$pass);
	mysql_select_db("devicelost4",$db);
	return $db;
}
?>