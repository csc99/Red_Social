	<?php 
	function conexion($usuario, $contra){
		try{
			//Hago conexion con PDO
			$con = new PDO('mysql:host=localhost;dbname=red_social', $usuario, $contra);
			return $con;

		} catch(PDOException $e){
			return $e->getMessage();//Mensaje de error
		}
	}//end function
	
	function datos_vacios($datos){
		$vacio = false;
		$tam = count($datos);
		for($i=0; $i<$tam; $i++){
			//Si algún dato está vacío
			if(empty($datos[$i])){
				$vacio = true;
				break;
			}//end if
		}//end for
		return $vacio;
	}//end function

	function limpiar($datos){
		$tam = count($datos);
		for($i=0; $i<$tam; $i++){
			if($i != 2){
				if(isset($datos[$i])){
					//Limpiar datos de espacios, etc.
					$datos[$i] = htmlspecialchars($datos[$i]);
					$datos[$i] = trim($datos[$i]);
					$datos[$i] = stripcslashes($datos[$i]);
				}
				
			}//end if
		}//end for
		return $datos;
	}//end function

	function verificar_session(){
		if(!isset($_SESSION['CodUsua'])){
			header('location: login.php');
			return false;
		}//end if
	}//end function
?>