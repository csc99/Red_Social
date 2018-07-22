<?php 

session_start();// Inicio una sesión
require('funciones.php');
require('clases/clases.php');

	$error = "";
	//Si existe el botón acceder
	if(isset($_POST['acceder'])){
		$pass = hash('sha512', $_POST['pass']);//Encripto contraseña
		//Creo array con datos, limpiando primero el usuario
		$datos = array(limpiar($_POST['usuario']), $pass);
		//Si no hay datos vacíos
		if(datos_vacios($datos) == false){
			//Si no hay ningún espacio en el usuario
			if(strpos($datos[0], " ") == false){
				$resultados = usuarios::verificar($datos[0]);//Verificar si existe usuario
				if(!empty($resultados)){
					//Si la contraseña es igual a la contraseña de la BD
					if($datos[1] == $resultados[0]["pass"]){
						//Creo sesiones
						$_SESSION['CodUsua'] = $resultados[0]["CodUsua"];
						$_SESSION['nombre'] = $resultados[0]["nombre"];
						//Cambio de página
						header('location: index.php');
					}else{
						$error .= "La contraseña o el usuario no coinciden";
					}//end if
				}else{
					$error .= "Usuario no existente";
				}
					
			}else{
				$error .= "El nombre del usuario contiene espacios";
			}//end if
				
		}else{
			$error.= "Hay datos vacíos";
		}//end if
	}//end if

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login | ShareCar</title>
		<link rel="stylesheet" type="text/css" href="css/login.css">
		<link rel="stylesheet" type="text/css" href="icomoon/style.css">
		<meta charset="utf-8">
	</head>

	<body>
		<div align="center" class="contenedor">
			<div class="contenedor-login">
				<p class="title"><span class="icon-road"></span> ShareCar</p>
				<form action="<?php echo $_SERVER['PHP_SELF']?>" method = "post">
					<input type = "text" name = "usuario" class = "input-control" placeholder = "Usuario, teléfono o correo electrónico"></input><br>
					<input type = "password" name = "pass" class = "input-control" placeholder="Contraseña"></input><br>
					<input type = "submit" name = "acceder" value = "Acceder" class = "log-btn"></input><br>
					<?php 
						//Escribir error si existe
						if(!empty($error)){
							echo "<p class ='error'>$error</p>";
						};
					?>
				</form>

				<div class="recordar-contrasena">
					<p><a href="#" class = "link">¿Olvidaste tu contraseña?</a></p>
				</div>
			</div>
			<div class="contenedor-login">
				<div class="registrar-link">
					<p>¿No tienes una cuenta? <a href="registro.php" class = "link">Regístrate</a></p>
				</div>
			</div>
				
		</div>	
	</body>
</html>