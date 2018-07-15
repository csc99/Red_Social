		<section>
			<?php if(!empty($post)): ?>
				<?php foreach ($post as $posts):?>
					<article class="publicacion">
						<div class="publi-info-perfil">
							<table>
								<tr>
									<td><a href="#"><img src="<?php echo $posts['foto_perfil']; ?>" class="publi-img-perfil"></a></td>
									<td><a href="#" class="nombre-usuario"><?php echo $posts['nombre']; ?></a></td>
								</tr>
							</table>
						</div>
						<div class="publi-contenido">
							<p><?php echo $posts['contenido']; ?></p>
						</div>
						<div class="publi-thumb">
							<img src="<?php echo $posts['img']; ?>" alt="">
						</div>
						<p id="like"><?php echo mg::mostrar($posts['CodPost'])[0][0]; ?><span class="icon-heart"></span></p>
						<div id="mostrar-comentarios">
							<?php $comentario = comentarios::mostrar($posts['CodPost']); ?>
							<?php if(!empty($comentario)):  ?>
								<?php foreach ($comentario as $com): ?>
									<p class="comentario-nombre"><?php echo $com['nombre'] . " "; ?><span class="comentarios"><?php echo $com['comentario'];?></span></p>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>	
						<div class="publi-contene-like">
							<?php if(mg::verificar_mg($posts['CodPost'], $_SESSION['CodUsua']) == 0): ?>
								<a href="<?php echo $_SERVER['PHP_SELF']?>?mg=1&&CodPost=<?php echo $posts['CodPost']?>" class="like icon-checkmark2"></a>
							<?php else: ?>
								<a href="<?php echo $_SERVER['PHP_SELF']?>?mg=1&&CodPost=<?php echo $posts['CodPost']?>" class="like icon-checkmark"></a>
							<?php endif; ?>
							<form action="<?php echo $_SERVER['PHP_SELF']?>" class="comentario" method="post">
								<input type="text" name="comentario" id="comentario" placeholder="Comenta algo...">
								<input type="hidden" name="CodPost" id="CodPost" placeholder="Comenta algo..." value="<?php echo $posts['CodPost']; ?>">
							</form>	
						</div>
					</article>
				<?php endforeach; ?>
			<?php endif; ?>
		</section>