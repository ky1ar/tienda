<?php 

$texto1 = $seccion[ 'texto_negro' ]; 
$texto2 = $seccion[ 'texto_naranja' ]; 
$clase = $seccion[ 'clase' ]; 
$imagenes = $seccion[ 'imagenes' ]; 
?>

<section class="kyr-o11-sld <?php echo $clase; ?>">
	<div class="kyr-o11-wrp">
		<?php 
		if ( $texto1 ) echo '<h2>' .$texto1. ' <span style="color: #d55d00;">' .$texto2. '</span></h2>'; 
		
		if ( $imagenes ): ?>
		<div class="sec-sld swiffy-slider slider-item-show4 slider-item-nogap slider-item-snapstart slider-nav-autoplay slider-nav-mousedrag" data-slider-nav-autoplay-interval="2000">
			<ul class="slider-container">
			<?php foreach ($imagenes as $key => $post): ?>
				<li><img src="<?php echo $post[ 'logos' ]; ?>" alt="Logo" width="192" height="48"/></li>
			<?php endforeach ?>
			</ul>	
		</div>
		<?php endif ?>
	</div>
</section>
