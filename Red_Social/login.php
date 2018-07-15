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
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<div class="contenedor-form">
		<h1>Login</h1>
		<form action="<?php echo $_SERVER['PHP_SELF']?>" method = "post">
			<input type = "text" name = "usuario" class = "input-control" placeholder = "Usuario"></input>
			<input type = "password" name = "pass" class = "input-control" placeholder="Contraseña"></input>
			<input type = "submit" name = "acceder" value = "Acceder" class = "log-btn"></input>
		</form>
		<?php 
			//Escribir error si existe
			if(!empty($error)){
				echo "<p class = 'error'>$error</p>";
			};
		?>
		<div class="registrar">
			<p><a href="registro.php" class = "link">¿No tienes cuenta?</a></p>
		</div>
	</div>
</body>
</html>