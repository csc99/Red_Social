<!DOCTYPE html>
<html>
	<head>
		<title>ShareCar | <?php echo $_SESSION['nombre'] ?></title>
		<link rel="stylesheet" type="text/css" href="css/header.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="icomoon/style.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<header>
			<h1 class="titulo"><a href="index.php"><span class="icon-road"></span> ShareCar</a></h1>

			<form action = "buscar.php" method = "get" id = "buscar">
				<input type="text" name="busqueda" placeholder = "Buscar amigos">
			</form>
			<nav>
				<ul>
					<li id="info-solicitud">
						<?php $soli = amigos::solicitudes($_SESSION['CodUsua']); ?>
						<a href="#"><span class="icon-users"></span>
							<span class="no-leido">
							<?php  if(count($soli) > 0){
								//Tiene solicitudes de amistad y las muestro
								echo count($soli);
							}?>
							</span></a>
						<?php if(count($soli) > 0): ?>
						<ul id="nav-solicitud">
							<?php foreach($soli as $solicitudes): ?>
							<li><a href="perfil.php?CodUsua=<?php echo $solicitudes['CodUsua']; ?>"><?php echo $solicitudes['nombre']; ?></a></li>
							<ul id="solicitud-confirmar">

								<li><a href="solicitud.php?CodAm=<?php echo $solicitudes['CodAm'] ?>&&accion=1" class="icon-checkmark"></a></li>
								<li><a href="solicitud.php?CodAm=<?php echo $solicitudes['CodAm'] ?>&&accion=2" class="icon-cross"></a></li>
							</ul>
						<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					</li>

					<li id="info-notificaciones">
						<?php $not = notificaciones::mostrar($_SESSION['CodUsua']); ?>
						<a href="#" class="icon-bell">
							<span class="no-leido">
								<?php if(!empty($not)) echo count($not)?>
							</span>
						</a>
						<?php  if(!empty($not)):?>
						<ul id="nav-notificaciones">
							<li>
								<?php foreach($not as $notificaciones): ?>
								<a href="post.php?CodPost=<?php echo $notificaciones['CodPost']; ?>">
									<?php echo $notificaciones['nombre']; ?>
									<?php if($notificaciones['accion'] == 0): ?>
											<p>Le gusta una publicación tuya</p>
										<?php else: ?>
											<p>Ha comentado una publicacion tuya</p>
									<?php endif; ?>
								</a>
								<?php endforeach; ?>
							</li>
						</ul>
						<?php endif; ?>
					</li>

					<li class="info_usuario">
						<a href="#"><span class="icon-user"></span></a>
						<ul id="nav-perfil">
							<li><a href="perfil.php?CodUsua=<?php echo $_SESSION['CodUsua'];?>">Perfil</a></li>
							<li><a href="cerrar.php">Cerrar</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</header>