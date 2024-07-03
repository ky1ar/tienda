<?php 
$texto1 = $seccion[ 'texto_negro' ]; 
$texto2 = $seccion[ 'texto_naranja' ]; 
$clase = $seccion[ 'clase' ]; 
$productos = $seccion["productos"];
?>
<section class="kyr-o11-sld <?php echo $clase; ?>">
	<div class="kyr-o11-wrp">
		<?php 
		if ( $texto1 ) echo '<h2>' .$texto1. ' <span style="color: #d55d00;">' .$texto2. '</span></h2>';

		if ($productos): ?>
		
		<div class="swiffy-slider slider-item-show5 slider-nav-square slider-nav-dark slider-nav-visible slider-nav-autohide" style="--swiffy-slider-nav-dark:#d16326;">
			<ul class="slider-container">
			<?php foreach ( $productos as $key => $post ): ?>
				<li>
				<?php 
					$product = wc_get_product( $post->ID );
					include get_theme_file_path('/includes/tienda/producto.php');
				?>
				</li>
			<?php endforeach ?>
			</ul>
			<button type="button" class="slider-nav" aria-label="Go to previous"></button>
    		<button type="button" class="slider-nav slider-nav-next" aria-label="Go to next"></button>
			
		</div>
		<?php endif ?>
	</div>
</section>
