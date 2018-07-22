<?php
	session_start();
	require('funciones.php');
	require('clases/clases.php');
	verificar_session();	
	require('header.php');
	

	if(isset($_GET['CodUsua'])){
		$usuario = usuarios::usuario_por_codigo($_GET['CodUsua']);
		if(empty($usuario)){
			header('location: index.php');
		}
		$verificar_amigos = amigos::verificar($_SESSION['CodUsua'], $_GET['CodUsua']);
		$post = post::post_por_usuario($_GET['CodUsua']);

	}

	if(isset($_GET['agregar'])){
		amigos::agregar($_SESSION['CodUsua'], $_GET['CodUsua']);
		header('location: perfil.php?CodUsua=' . $_GET['CodUsua']);
	}

	if(isset($_POST['comentario'])){
		if(!empty($_POST['comentario'])){
			comentarios::agregar($_POST['comentario'], $_SESSION['CodUsua'], $_POST['CodPost']);
			notificaciones::agregar(1, $_POST['CodPost'], $_SESSION['CodUsua']);
			header('location: index.php');
		}
	}

	if(isset($_GET['mg'])){
		if(mg::verificar_mg($_GET['CodPost'], $_SESSION['CodUsua']) > 0){
			$con = conexion("root", "root");
			$consulta = $con->prepare("delete from  mg where CodPost = :CodPost and CodUsua = :CodUsua");
			$consulta->execute(array(':CodPost'=>$_GET['CodPost'], ':CodUsua'=>$_SESSION['CodUsua']));
		}else{
			mg::agregar($_GET['CodPost'], $_SESSION['CodUsua']);
			notificaciones::agregar(false, $_GET['CodPost'], $_SESSION['CodUsua']);
		
		}
		header('location: index.php');
	}
?>


		<div class="perfil">
			<ul>
				<li><img src="<?php echo $usuario[0]['foto_perfil'];?>" id="img"></li>
				<li>
					<h3 class="nombre"><?php echo $usuario[0]['usuario'] ?></h3>
					<ul>
						<li class="nombre-descripcion"><?php echo $usuario[0]['nombre'] ?></li>
						<li><?php echo $usuario[0]['edad'] ?></li>
						<li><?php echo $usuario[0]['profesion'] ?></li>
						<li><?php echo $usuario[0]['pais'] ?></li>
						<li>Amigos: 
							<span>
								<?php if(!empty(amigos::cantidad_amigos($_GET['CodUsua'])))
										echo amigos::cantidad_amigos($_GET['CodUsua'])[0][0];
										else echo "0";
								?>
									
							</span>
						</li>
					</ul>
				</li>
				<?php if($_GET['CodUsua'] != $_SESSION['CodUsua'] ): ?>
					<?php if(empty($verificar_amigos)): //No son amigos?>
						<li><a href="perfil.php?CodUsua=<?php echo $_GET['CodUsua'] ?>&&agregar=<?php echo $_GET['CodUsua'];?>">Agregar</a></li>
					<?php elseif($verificar_amigos[0]['status'] == true)://Son amigos ?>
						<li><a href="#">Amigos</a></li>
					<?php else: ?>
						<li><a href="#">Solicitud enviada</a></li>
					<?php endif; ?>
				<?php else://Propietario del perfil ?>
					<li><a href="editar-perfil.php" >Editar</a></li>
				<?php endif; ?>
			</ul>
		</div>
		<?php require('publicacion.php'); ?>
	</body>
</html>