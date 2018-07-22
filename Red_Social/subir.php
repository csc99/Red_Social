
		<div class="subir">
			<div class="publi-info-perfil">
				<table>
					<tr>
						<td><a href="perfil.php?CodUsua=<?php echo $_SESSION['CodUsua'];?>"><img src="<?php echo usuarios::usuario_por_codigo($_SESSION['CodUsua'])[0]['foto_perfil']; ?>" class="publi-img-perfil"></a></td>
						<td><a href="perfil.php?CodUsua=<?php echo $_SESSION['CodUsua'];?>" class="nombre-usuario"><?php echo $_SESSION['nombre']?></a></td>
					</tr>
				</table>
			</div>
			<form action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data" method="post">
				<input type="text" name="contenido" id="contenido" placeholder="Escribe un pie de foto...">
				<label for="archivo" class="boton-subir icon-camera"></label>
					<input type="file" name="archivo" id="archivo" style="display:none">
				<label for="publicar" class="boton-subir icon-upload "></label>
					<input type="submit" name="publicar" id="publicar" style="display:none">
			</form>
		</div>