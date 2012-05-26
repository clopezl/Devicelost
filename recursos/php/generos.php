<?PHP

# check_genero comprueba si un gŽnero existe
# valida_nombre_genero comprueba que un nombre sea v‡lido para editar o crear gŽneros
# crea_genero
# edita_genero
# elimina_genero

require_once('conex.php');
function check_genero($clave,$valor){
	$sql		= "SELECT id FROM GENEROS WHERE $clave = '$valor' LIMIT 1";
	$registros	= floor(mysql_num_rows(mysql_query($sql)));
	if($registros>0){
		return true;
	}else{
		return false;
	}
}
function valida_nombre_genero($nombre){
	if(
		(strlen($nombre)<=30) &&
		(strlen($nombre)>=3) &&
		(!preg_match('#[0-9]#',$nombre))
	){
		return true;
	}else{
		return false;
	}
}
function crea_genero($nombre){
	if(!valida_nombre_genero($nombre)){
		return false;
	}else{
		$sql = "INSERT INTO GENEROS (nombre) VALUES ($nombre)";
		if(mysql_query($sql,$db)){
			return true;
		}else{
			return false;
		}
	}
}
function edita_genero($id,$nuevo_nombre){
	if(!check_genero("id",$id) or !valida_nombre_genero($nuevo_nombre)){
		return false;
	}else{
		$sql = "UPDATE GENEROS SET nombre = '$nuevo_nombre' WHERE id = $id LIMIT 1";
		if(mysql_query($sql,$db)){
			return true;
		}else{
			return false;
		}
	}
}
function elimina_genero($clave,$valor){

	# No comprueba que no hayan discos (el gŽnero se guarda ah’) bajo el gŽnero especificado,
	# cuando hayan registros se har‡ una funci—n que compruebe eso y se usar‡ en el esta.

	if(check_genero($clave,$valor)){
		return false;
	}else{
		$sql "DELETE FROM GENEROS WHERE $clave = '$valor' LIMIT 1";
		if(mysql_query($sql,$db)){
			return true;
		}else{
			return false;
		}
	}
}
?>