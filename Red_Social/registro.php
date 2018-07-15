<?php 

	require('funciones.php');//Funciones
	require('clases/clases.php');//Clases
	$error = "";//String del error
	$registradoCorrectamente = "";

	//Recoger datos cuando existan
	if(isset($_POST['registrar'])){
		$contra = hash('sha512', $_POST['contra']);//Encripto contraseña
		//Array donde guardo los datos
		$datos = array(
				$_POST['nombre'],
				$_POST['usuario'],
				$contra,
				$_POST['pais'],
				$_POST['profe'],
				$_POST['edad']
		);

		//Comprobar si hay algún dato vacío
		if(datos_vacios($datos) == false){
			$datos = limpiar($datos);//Limpiar datos: espacios...
			//Si el usuario no contiene espacios
			if(strpos($datos[1], " ") == false){
				//Verificar si el usuario existe en la BD
				if(empty(usuarios::verificar($datos[1]))){
					//Si no existe lo registramos
					usuarios::registrar($datos);
					$registradoCorrectamente = "¡Te has registrado correctamente!";
				}else{
					$error .= "Usuario existente";
				}
			}else{
				$error .= "Usuario con espacios";
			}
		}//end if
		else{
			$error .= "Hay campos vacíos";
		}
		
	}//end if
?>
 <!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Registro</title>
		<link rel="stylesheet" href="css/login.css">
	</head>
	<body>
		<div class="contenedor-form">
			<h1>Registrar</h1>
			<form action = "<?php echo $_SERVER['PHP_SELF']?>" method = "post" >
				<input type="text" name="nombre" class = "input-control" placeholder = "Nombre">
				<input type="text" name="usuario" class = "input-control" placeholder = "Usuario">
				<input type="password" name="contra" class = "input-control" placeholder = "Contraseña">
				<input type="text" name="pais" class = "input-control" placeholder = "País">
				<input type="text" name="profe" class = "input-control" placeholder = "Profesión">
				<p id = "edad">Edad:</p>
				<select name = "edad" id = "">
					<?php 
						for($i=10; $i<=100; $i++){
							echo "<option value = '$i'>$i</option>";
						}
					?>	
				</select>
				<input type="submit" name="registrar" value = "Registrar" class = "log-btn">
			</form>
			<?php 
				//Escribir error si existe
				if(!empty($error)){
					echo "<p class = 'error'>$error</p>";
				};
				if(!empty($registradoCorrectamente)){
					echo "<a href='login.php'><p class='registro-correcto'>$registradoCorrectamente</p></a>";
				}
			?>
			<div class="registrar">
				<p><a href="login.php" class = "link">¿Tienes cuenta?</a></p>
			</div>
		</div>
	</body>
</html>