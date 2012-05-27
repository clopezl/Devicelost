<?PHP

# check_genero comprueba si un g始ero existe
# valida_nombre_genero comprueba que un nombre sea v�lido para editar o crear g始eros
# crea_genero
# edita_genero
# elimina_genero

require_once('conex.php');
require_once('errores.php');

function check_genero($clave,$valor){
	if($clave=='id' or $clave=='nombre'){
		$sql		= "SELECT * FROM GENEROS WHERE $clave = '$valor' LIMIT 1";
		$registros	= floor(mysql_num_rows(mysql_query($sql,connect())));
		if($registros>0){
			return true;
		}else{
			return false;
		}
		disconnect();
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
		serror('Nombre no v�lido');
		return false;
	}else if(check_genero("nombre",$nombre)){
		serror('El g始ero ya existe');
		return false;
	}else{
		$sql = "INSERT INTO GENEROS (nombre) VALUES ($nombre)";
		if(mysql_query($sql,connect())){
			return true;
		}else{
			serror('Error de mysql al crear el g始ero');
			return false;
		}
	}
	disconnect();
}
function edita_genero($id,$nuevo_nombre){
	if(!check_genero("id",$id) or !valida_nombre_genero($nuevo_nombre)){
		serror('No se ha encontrado el g始ero para editar');
		return false;
	}else{
		$sql = "UPDATE GENEROS SET nombre = '$nuevo_nombre' WHERE id = $id LIMIT 1";
		if(mysql_query($sql,connect())){
			return true;
		}else{
			serror('Error de mysql al editar el g始ero');
			return false;
		}
	}
	disconnect();
}
function elimina_genero($clave,$valor){

	# No comprueba que no hayan discos (el g始ero se guarda ah�) bajo el g始ero especificado,
	# cuando hayan registros se har� una funci溶 que compruebe eso y se usar� en el esta.
	
	if(!check_genero($clave,$valor)){
		serror('No se ha encontrado el g始ero para eliminar');
		return false;
	}else{
		$sql = "DELETE FROM GENEROS WHERE $clave = '$valor' LIMIT 1";
		if(mysql_query($sql,connect())){
			return true;
		}else{
			serror('Error de mysql al eliminar el g始ero');
			return false;
		}
	}
	disconnect();
}
?>