<?PHP
function serror($msg){
	$GLOBALS['error'] = $msg;
}
function rerror(){
	return $GLOBALS['error'];
}
?>