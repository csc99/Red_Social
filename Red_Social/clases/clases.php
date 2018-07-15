<?php 
	class usuarios{
		
		//Registrar datos a la BD
		public static function registrar($datos){
			$con = conexion("root", "root");//Hago la conexion
			//Hago la consulta
			$consulta = $con->prepare("insert into usuarios(CodUsua, nombre, usuario, pass, pais, profesion, edad, foto_perfil) values(null, :nombre, :usuario, :pass, :pais, :profesion, :edad, :foto_perfil)");
			//Ejecuto la consulta
			$consulta->execute(array(
								':nombre'=>$datos[0],
								':usuario'=>$datos[1],
								':pass'=>$datos[2],
								':pais'=>$datos[3],
								':profesion'=>$datos[4],
								':edad'=>$datos[5],
								':foto_perfil' => 'img/sinperfil.jpg'
			));
		}//end function

		//Verificar si existe
		public static function verificar($usuario){
			$con = conexion("root", "root");
			
			$consulta = $con->prepare("select * from usuarios where usuario = :usuario");
			$consulta->execute(array(':usuario' => $usuario));
			$resultado = $consulta->fetchAll();
			return $resultado;
		}//end function

		public static function editar($CodUsua, $datos){
			$con = conexion("root", "root");
			
			$consulta = $con->prepare("update usuarios set nombre = :nombre, usuario = :usuario, profesion = :profesion, pais = :pais, foto_perfil = :foto_perfil where CodUsua = :CodUsua");
			$consulta->execute(array(
								':nombre'=>$datos[0],
								':usuario'=>$datos[1],
								':profesion'=>$datos[2],
								':pais'=>$datos[3],
								':foto_perfil'=>$datos[4],
								':CodUsua' => $CodUsua
			));
			$resultado = $consulta->fetchAll();
			return $resultado;
		}

		public static function usuario_por_codigo($CodUsua){
			$con = conexion("root", "root");
			
			$consulta = $con->prepare("select * from usuarios where CodUsua = :CodUsua");
			$consulta->execute(array(':CodUsua' => $CodUsua));
			$resultado = $consulta->fetchAll();
			return $resultado;
		}

	}


	class post{
		public static function agregar($CodUsua, $contenido, $img){
			$con = conexion("root", "root");
			
			$consulta = $con->prepare("insert into post(CodPost, CodUsua, contenido, img) values (null, :CodUsua, :contenido, :img)");
			$consulta->execute(array(':CodUsua' => $CodUsua,
									 ':contenido' => $contenido,
									 ':img' => $img
									));
		}

		public static function post_por_usuario($CodUsua){
			$con = conexion("root", "root");
			
			$consulta = $con->prepare("select U.CodUsua, U.nombre, U.foto_perfil, P.CodPost, P.contenido, P.img FROM usuarios U INNER JOIN post P ON U.CodUsua = P.CodUsua WHERE P.CodUsua = :CodUsua ORDER BY P.CodPost DESC");
			$consulta->execute(array(':CodUsua' => $CodUsua));
			$resultado = $consulta->fetchAll();
			return $resultado;
		}

		public static function mostrar_todo($amigos){
			$con = conexion("root", "root");
			
			$consulta = $con->prepare("select U.CodUsua, U.nombre, U.foto_perfil, P.CodPost, P.contenido, P.img FROM usuarios U INNER JOIN post P ON U.CodUsua = P.CodUsua WHERE P.CodUsua in($amigos) ORDER BY P.CodPost DESC");
			//La variable $amigos está puesto directamente en la consulta ya que así lo indentifica como un entero. En el execute lo identificaría como un string
			$consulta->execute();
			$resultado = $consulta->fetchAll();
			return $resultado;
		}

		public static function mostrar_por_codigo($CodPost){
			$con = conexion("root", "root");
			
			$consulta = $con->prepare("select U.CodUsua, U.nombre, U.foto_perfil, P.CodPost, P.contenido, P.img FROM usuarios U INNER JOIN post P ON U.CodUsua = P.CodUsua WHERE P.CodPost = :CodPost ORDER BY P.CodPost DESC");
			//La variable $amigos está puesto directamente en la consulta ya que así lo indentifica como un entero. En el execute lo identificaría como un string
			$consulta->execute(array(':CodPost' => $CodPost));
			$resultado = $consulta->fetchAll();
			return $resultado;
		}
	}


	class comentarios{
		public static function agregar($comentario, $CodUsua, $CodPost){
			$con = conexion("root", "root");
			
			$consulta = $con->prepare("INSERT INTO comentarios(comentario, CodUsua, CodPost) VALUES (:comentario, :CodUsua, :CodPost)");
			$consulta->execute(array(':comentario' => $comentario,
									 ':CodUsua' => $CodUsua,
									 ':CodPost' => $CodPost));
			$resultado = $consulta->fetchAll();
			return $resultado;
		}

		public static function mostrar($CodPost){
			$con = conexion("root", "root");
			
			$consulta = $con->prepare("SELECT U.nombre, C.comentario FROM usuarios U INNER JOIN comentarios C ON U.CodUsua = C.CodUsua WHERE C.CodPost = :CodPost");
			$consulta->execute(array(':CodPost' => $CodPost));
			$resultado = $consulta->fetchAll();
			return $resultado;
		}
	}


	class mg{
		public static function agregar($CodPost, $CodUsua){
			$con = conexion("root", "root");
			
			$consulta = $con->prepare("INSERT INTO mg(CodLike, CodPost, CodUsua) VALUES (null, :CodPost, :CodUsua)");
			$consulta->execute(array(':CodPost' => $CodPost,
									 ':CodUsua' => $CodUsua));
		}

		public static function mostrar($CodPost){
			$con = conexion("root", "root");
			
			$consulta = $con->prepare("SELECT COUNT(*) FROM mg WHERE CodPost = :CodPost");
			$consulta->execute(array(':CodPost' => $CodPost));
			$resultado = $consulta->fetchAll();
			return $resultado;	
		}

		public static function verificar_mg($CodPost, $CodUsua){
			$con = conexion("root", "root");
			
			$consulta = $con->prepare("SELECT CodLike FROM mg WHERE CodPost = :CodPost AND CodUsua = :CodUsua");
			$consulta->execute(array(':CodPost' => $CodPost,
									 ':CodUsua' => $CodUsua));
			$resultado = $consulta->fetchAll();
			return count($resultado);
		}

	}


	class notificaciones{
		public static function agregar($accion, $CodPost, $CodUsua){
			$con = conexion("root", "root");
			
			$consulta = $con->prepare("INSERT INTO notificaciones(CodNot, accion, CodPost, CodUsua, visto) VALUES(null, :accion, :CodPost, :CodUsua, 0)");
			$consulta->execute(array(':accion' => $accion,
									 ':CodPost' => $CodPost,
									 ':CodUsua' => $CodUsua));
		}

		public static function mostrar($CodUsua){
			$con = conexion("root", "root");
			
			$consulta = $con->prepare("SELECT U.CodUsua, U.nombre, N.CodNot, N.accion, N.CodPost FROM notificaciones N INNER JOIN usuarios U ON U.CodUsua = N.CodUsua WHERE N.CodPost IN(SELECT CodPost FROM post WHERE CodUsua = :CodUsua) AND N.visto = 0 AND N.CodUsua != :CodUsua");
			$consulta->execute(array(':CodUsua' => $CodUsua));
			$resultados = $consulta ->fetchAll();
			return $resultados;
		}

		public static function vistas($CodPost){
			$con = conexion("root", "root");
			
			$consulta = $con->prepare("UPDATE notificaciones SET visto = 1 WHERE CodPost = :CodPost");
			$consulta->execute(array(':CodPost' => $CodPost));
		}
	}


	class amigos{
		public static function agregar($usua_enviador, $usua_receptor){
			$con = conexion("root", "root");
			
			$consulta = $con->prepare("INSERT INTO amigos(CodAm, usua_enviador, usua_receptor, status, solicitud) VALUES (null, :usua_enviador, :usua_receptor, :status, :solicitud)");
			$consulta->execute(array(':usua_enviador' => $usua_enviador,
									 ':usua_receptor' => $usua_receptor,
									 ':status' => '',
									 ':solicitud' => 1));
		}

		public static function verificar($usua_enviador, $usua_receptor){
			$con = conexion("root", "root");
			
			$consulta = $con->prepare("SELECT * FROM amigos WHERE (usua_enviador = :usua_enviador AND usua_receptor = :usua_receptor) OR (usua_enviador = :usua_receptor and usua_receptor = :usua_enviador	)");
			$consulta->execute(array(':usua_enviador' => $usua_enviador,
									 ':usua_receptor' => $usua_receptor));
			$resultados = $consulta ->fetchAll();
			return $resultados;
		}

		public static function codigos_amigos($CodUsua){
			$con = conexion("root", "root");
			
			$consulta = $con->prepare("SELECT group_concat(usua_enviador, ',', usua_receptor) as amigos FROM amigos WHERE (usua_enviador = :CodUsua or usua_receptor = :CodUsua) AND status = 1");
			$consulta->execute(array(':CodUsua' => $CodUsua));
			$resultados = $consulta ->fetchAll();
			return $resultados;
		}

		public static function solicitudes($CodUsua){
			$con = conexion("root", "root");
			
			$consulta = $con->prepare("SELECT U.CodUsua, U.nombre, A.CodAm FROM usuarios U INNER JOIN amigos A ON U.CodUsua = A.usua_enviador WHERE A.usua_receptor = :CodUsua AND A.status != 1");
			$consulta->execute(array(':CodUsua' => $CodUsua));
			$resultados = $consulta ->fetchAll();
			return $resultados;
		}

		public static function aceptar($CodAm){
			$con = conexion("root", "root");
			
			$consulta = $con->prepare("UPDATE amigos SET status = 1 WHERE CodAm = :CodAm");
			$consulta->execute(array(':CodAm' => $CodAm));
		}

		public static function eliminar_solicitud($CodAm){
			$con = conexion("root", "root");
			
			$consulta = $con->prepare("DELETE FROM amigos WHERE CodAm = :CodAm");
			$consulta->execute(array(':CodAm' => $CodAm));
		}

		public static function cantidad_amigos($CodUsua){
			$con = conexion("root", "root");
			
			$consulta = $con->prepare("SELECT COUNT(*) FROM amigos WHERE (usua_enviador = :CodUsua or usua_receptor = :CodUsua) AND status = 1");
			$consulta->execute(array(':CodUsua' => $CodUsua));
			$resultados = $consulta ->fetchAll();
			return $resultados;
		}
	}
?>