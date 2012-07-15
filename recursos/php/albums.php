<?PHP

# valida_email
# check_user comprueba si un usuario existe
# valida_user comprueba que un nombre sea v‡lido para editar o crear usuarios
# valida_nivel_user comprueba que un nivel sea v‡lido para editar o crear usuarios
# crea_user
# edita_user
# elimina_user

require_once('conex.php');
require_once('errores.php');
require_once('fechas.php');

require_once('autores.php');
require_once('generos.php');

function check_album($clave,$valor){
	if($clave=='id' or $clave=='nombre'){
		$sql		= "SELECT * FROM ALBUMS WHERE $clave = '$valor' LIMIT 1";
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
function valida_album($album){
	if(
		(strlen($album)<=50) &&
		(strlen($album)>=1)
	){
		return true;
	}else{
		return false;
	}
}
function valida_ano($ano){
	if(
		($ano<=date('Y') &&
		($ano>=0)
	){
		return true;
	}else{
		return false;
	}
}
function crea_album($titulo,$ano,$genero){
	if(!valida_album($titulo)){
		serror('Titulo de album no v‡lido');
		return false;
	}else if(valida_ano()){
		serror('A–o no v‡lido para el ‡lbum');
		return false;
	}else if(check_album("titulo",$titulo)){
		serror("Ya existe un ‡lbum con ese nombre");
		return false;
	}else if(check_genero()){
		serror("No se ha encontrado el gŽnero indicado");
		return false;
	}else{
		$sql = "INSERT INTO
				ALBUMS (
					titulo,
					ano,
					genero
				) VALUES (
					titulo,
					ano,
					genero
				)";
		if(mysql_query($sql,connect())){
			return true;
		}else{
			serror('Error de mysql al crear el usuario');
			return false;
		}
	}
	disconnect();
}
function edita_user($campo,$user,$clave,$valor){
	# Campo es la columna por la que se buscar‡ el usuario a editar
	# User es el valor que se buscar‡ en la columna especificada
	# Clave es la columna que se editar‡
	# Valor es el nuevo valor para la columna especificada
	if(!check_user($clave,$valor)){
		serror('No se ha encontrado el usuario a editar');
		return false;
	}else{
		switch($clave){
			case 'pass':
				if((strlen($pass)>30) or (strlen($pass)<3)){
					$sql = "UPDATE USUARIOS SET $clave = '".md5($valor)."' WHERE id = $id LIMIT 1";
				}else{
					serror('Nueva contrase–a de usuario no v‡lida');
					return false;
				}			
			break;
			case 'email':
				if(valida_email($email, true, true)){
					$sql = "UPDATE USUARIOS SET $clave = '$valor' WHERE id = $id LIMIT 1";
				}else{
					serror('Nuevo email no v‡lido');
					return false;
				}			
			break;
			case 'nivel':
				if(valida_nivel_user($valor)){
					$sql = "UPDATE USUARIOS SET $clave = '$valor' WHERE id = $id LIMIT 1";
				}else{
					serror('Nuevo nivel de usuario no valido');
					return false;
				}			
			break;
		}
		if(mysql_query($sql,connect())){
			return true;
		}else{
			serror('Error de mysql al editar el usuario');
			return false;
		}
	}
	disconnect();
}
function elimina_user($id){

	# No se ha planteado que pasa con el contenido subido por el usuario eliminado.
	
	if(!check_user("id",$id)){
		serror('No se ha encontrado el usuario para eliminar');
		return false;
	}else{
		$sql	= "DELETE FROM USUARIOS WHERE id = '$id' LIMIT 1";
		$sql2	= "DELETE FROM LISTAS WHERE id_user = '$id' LIMIT 1";
		$sql3	= "DELETE FROM REL_ALBUMS_ORIGINALES WHERE id_user = '$id' LIMIT 1";
		if(
			mysql_query($sql,connect()) &&
			mysql_query($sql2,connect()) &&
			mysql_query($sql3,connect())
		){
			return true;
		}else{
			serror('Error de mysql al eliminar el gŽnero');
			return false;
		}
	}
	disconnect();
}
?>