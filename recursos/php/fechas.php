<?PHP
function datetime_now(){
	return date('Y-m-d H:i:s');
}
function datetime2es($datetime){
	// Convierte el formato de datetime AAAA-MM-DD HH:MM:SS al espa–ol, DD-MM-AA HH:MM:SS
	return date("d-m-Y H:i:s",strtotime($datetime));
}
function fecha2humano($date){
	if(empty($date)){
		return "Fecha no especificada";
	}
	$periods	= array("segundo", "minuto", "hora", "d&iacute;a", "semana", "mese", "a&ntilde;o", "d&eacute;cada");
	$lengths	= array("60","60","24","7","4.35","12","10");

	$now		= time();
	if(is_int($date)){
		$unix_date	= $date;
	}else{
		$unix_date	= strtotime($date);
	}

	if(empty($unix_date)) {
		return "Fecha incorrecta";
	}
	if($now > $unix_date) {
		$difference  = $now - $unix_date;
		$tense		 = "Hace ";
	}else{
		$difference  = $unix_date - $now;
		$tense		 = "Dentro de ";
	}
	for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
		$difference /= $lengths[$j];
	}
	$difference = round($difference);
	if($difference != 1) {
		$periods[$j].= "s";
	}
	return "{$tense} $difference $periods[$j] ";
}
?>