<?PHP
function serror($msg){
	$GLOBALS['error'] = $msg;
}
function rerror(){
	if(isset($GLOBALS['error'])){
		return $GLOBALS['error'];
	}else{
		return false;
	}
}
?>