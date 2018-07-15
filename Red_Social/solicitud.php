<?php 
	require('funciones.php');
	require('clases/clases.php');

	if(isset($_GET['CodAm']) && isset($_GET['accion'])){
		//Aceptar solicitud
		if(isset($_GET['accion']) == 1){
			amigos::aceptar($_GET['CodAm']);
			header('location: index.php');
		}else{
			amigos::eliminar_solicitud($_GET['CodAm']);
		}
	}
?>