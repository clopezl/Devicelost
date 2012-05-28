<?PHP

# check_genero comprueba si un gnero existe
# valida_nombre_genero comprueba que un nombre sea v‡lido para editar o crear gneros
# crea_genero
# edita_genero
# elimina_genero

require_once('conex.php');
require_once('errores.php');
require_once('fechas.php');

function valida_email($email='' , $checkMX=true , $checkSyntax=true){
	if($checkSyntax){
		if(eregi("^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$",$email)){
			$syntaxValida = true;
		}else{
			$syntaxValida = false;
		}
	}else{
		$syntaxValida = true;
	}
	if($checkMX){
		$domain='provocaErrorPorDefecto';
		@list($user,$domain) = split('@',$email);
		if(!checkdnsrr($domain,"MX")){
			$mxValida = true;
		}else{
			$mxValida = false;
		}
	}else{
		$mxValida = true;
	}
	if($checkMX && $checkSyntax){
		return true;
	}else{
		return false;
	}
}

function check_user($clave,$valor){
	if($clave=='id' or $clave=='nombre'){
		$sql		= "SELECT * FROM USUARIOS WHERE $clave = '$valor' LIMIT 1";
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
function valida_user($user){
	if(
		(strlen($user)<=20) &&
		(strlen($user)>=3) &&
		(preg_match("^[a-zA-Z0-9\-_]{3,20}$",$user))
	){
		return true;
	}else{
		return false;
	}
}
function valida_nivel_usuario($int){
	if($int == 0 || $int == 1 || $int == 2){
		return true;
	}else{
		return false;
	}
}

function crea_usuario($user,$pass,$email){
	if(!valida_user($user)){
		serror('Usuario no v‡lido');
		return false;
	}else if(check_user("nombre",$user)){
		serror('El usuario ya existe');
		return false;
	}else if(valida_email($email, true, true)){
		serror("Email no v‡lido");
		return false;
	}else if(
		(strlen($pass)>30) or
		(strlen($pass)<3)
	){
		serror('Contrase–a no v‡lida');
		return false;
	}else{
		$sql = "INSERT INTO
				USUARIOS (
					user,
					pass,
					email,
					nivel,
					datetime_registro
				) VALUES (
					'$user',
					'".md5($pass)."',
					'$email',
					0,
					'".datetime_now()."'
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
				if(valida_nivel_usuario($valor)){
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
function elimina_usuario($id){

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
			serror('Error de mysql al eliminar el gnero');
			return false;
		}
	}
	disconnect();
}
?>