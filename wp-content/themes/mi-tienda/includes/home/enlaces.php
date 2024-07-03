<section id="k11-brd">
<?php $categorias = get_field('categorias_iniciales'); ?>
	<div class="kyr-o11-wrp">
		<div class="kyr-o11-flx">
			<?php foreach ( $categorias as $key => $categoria ):
			$enlace = $categoria["enlace"]; 
			?>
			<div class="brd-itm">
				<a href="<?php echo $enlace["url"];?>" title="<?php echo $enlace["title"] ?>">
					<img width="576" height="121" src="<?php echo $categoria['imagen'] ?>" alt="<?php echo $enlace["title"] ?>">
				</a>
			</div>
			<?php endforeach ?>		
		</div>
	</div>
</section>