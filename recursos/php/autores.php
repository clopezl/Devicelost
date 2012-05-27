<?PHP

# check_autor comprueba si un autor existe
# valida_nombre_autor comprueba que un nombre sea v‡lido para editar o crear autores
# valida_nivel_politica
# crea_autor
# edita_autor
# elimina_autor

require_once('conex.php');
require_once('errores.php');

function check_autor($clave,$valor){
	if($clave == 'id' or $clave == 'nombre'){
		$sql		= "SELECT * FROM AUTORES WHERE $clave = '$valor' LIMIT 1";
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
function valida_nombre_autor($nombre){
	if(
		(strlen($nombre)<=30) &&
		(strlen($nombre)>=2)
	){
		return true;
	}else{
		return false;
	}
}
function valida_nivel_politica($int){
	if($int == 0 || $int == 1 || $int == 2){
		return true;
	}else{
		return false;
	}
}
function crea_autor($nombre,$nivel_politica){
	if(!valida_nombre_autor($nombre) || !valida_nivel_politica($nivel_politica)){
		serror('Nombre de autor o nivel de politica no v‡lidos');
		return false;
	}else if(check_autor("nombre",$nombre)){
		serror('El autor ya existe.');
		return false;
	}else{
		$sql = "INSERT INTO AUTORES (nombre,nivel_politica) VALUES ('$nombre',$nivel_politica)";
		if(mysql_query($sql,connect())){
			return true;
		}else{
			echo mysql_error();	
			return false;
		}
	}
	disconnect();
}
function edita_autor($clave,$valor,$nuevo_nombre=null,$nuevo_nivel_politica=null){
	if(!isset($nuevo_nombre) or !isset($nuevo_nivel_politica)){
		serror('Nombre de autor o nivel de politica no v‡lidos');
		return false;
	}else{
		if(!check_autor($clave,$valor)){
			serror('El autor a editar no existe');
			return false;
		}else if(!valida_nombre_autor($nuevo_nombre)){
			serror('El nuevo nombre no es v‡lido');
			return false;
		}else{
			if(!isset($nuevo_nombre) && isset($nuevo_nivel_politica)){
				$sql = "UPDATE AUTORES
						SET nivel_politica = $nuevo_nivel_politica
						WHERE $clave = '$valor'
						LIMIT 1";
			}else if(isset($nuevo_nombre) && !isset($nuevo_nivel_politica)){
				$sql = "UPDATE AUTORES
						SET nombre = '$nuevo_nombre'
						WHERE $clave = '$valor'
						LIMIT 1";
			}else if(isset($nuevo_nombre) && isset($nuevo_nivel_politica)){
				$sql = "UPDATE AUTORES
						SET nombre = '$nuevo_nombre',
							nivel_politica = $nuevo_nivel_politica
						WHERE $clave = '$valor'
						LIMIT 1";
			}
			if(mysql_query($sql,connect())){
				return true;
			}else{
				serror('Error de mysql al editar el autor');
				return false;
			}
		}
		disconnect();
	}
}
function elimina_autor($clave,$valor){

	# Falta hacer que compruebe que el autor no tenga discos ni canciones, habr‡ que ver.

	if(!check_autor($clave,$valor)){
		return false;
	}else{
		$sql = "DELETE FROM AUTORES WHERE $clave = '$valor' LIMIT 1";
		if(mysql_query($sql,connect())){
			return true;
		}else{
			return false;
		}
	}
	disconnect();
}
?>