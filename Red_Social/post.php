<?php
	session_start();
	require('funciones.php');
	require('clases/clases.php');
	verificar_session();

	require('header.php');
	if(isset($_GET['CodPost'])){
		notificaciones::vistas($_GET['CodPost']);
		$post = post::mostrar_por_codigo($_GET['CodPost']);
		require('publicacion.php');
	}
?>
	</body>
</html>