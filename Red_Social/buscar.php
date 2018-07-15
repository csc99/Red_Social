<?php
	session_start();
	require('funciones.php');
	require('clases/clases.php');
	require('header.php');
	verificar_session();

	if(isset($_GET['busqueda'])){
		$nombre = $_GET['busqueda'];
		$con = conexion("root", "root");
		$consulta = $con->prepare("SELECT * FROM usuarios WHERE nombre LIKE :nombre");
		$consulta->execute(array(':nombre' => "%$nombre%"));
		$resultados = $consulta->fetchAll();
	}
?>
		<div class="resultados-busqueda">
			<?php  if(!empty($resultados)):?>
				<?php foreach ($resultados as $r): ?>
					<div class="usuarios">
						<div class="img">
							<a href="perfil.php?CodUsua=<?php echo $r['CodUsua']; ?>"><img src="<?php echo $r['foto_perfil']; ?>"></a>
						</div>
						<div class="nombre">
							<a href="perfil.php?CodUsua=<?php echo $r['CodUsua']; ?>"><?php echo $r['nombre'];?></a>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else: ?>
				<h1 class="no-resultados">No se han encontrado resultados</h1>
			<?php endif; ?>
		</div>
		
	</body>
</html>