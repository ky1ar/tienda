<?php $title = $seccion["titulo"]; ?>
<?php $productos = $seccion["productos"]; ?>
<?php $id = randomString(); ?>
<section class="kyr-o11-sld" id="k11-prm-cnt">
	<div class="kyr-o11-wrp">
		<?php if ($title) echo $title; ?>
		<ul class="k11-cnt">
		<?php 
		if ($productos){
			foreach ($productos as $key => $post) {
				echo '<li class="k11-itm">';
				$product = wc_get_product($post->ID);
				include get_theme_file_path('/includes/tienda/producto.php');
				echo '</li>';	       
			}
		}
		?>
		</ul>
	</div>
</section>