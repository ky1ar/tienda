<?php
//
//ky1ar
//

$id_p = $product->get_id();
$galeria_de_video = get_field('galeria_de_video');

$pre = get_field( 'prelaunch' );

if( $pre ) {
	$vid = get_field( 'galeria_de_videos' );

	echo '<section class="' .( $vid['presentacion'] || $vid['resena'] || $vid['unboxing'] ? '' : 'k11-hdn' ). '" id="k11-prd-gly">
		<h2>Galería</h2>
		<div class="kyr-o11-flx-wrp">';
		$key = 0;
		foreach ( $vid as $data ) {
			if ( !empty( $data ) ) { 
				switch ( $key ) {
					case 1: $lbl = 'Unboxing'; break;
					case 2: $lbl = 'Reseña'; break;
					default: $lbl = 'Presentación';
				}
				echo '<div class="k11-gly-npd">
					<div class="k11-gly-ovr">
						<a data-fancybox="" href="https://www.youtube.com/watch?v=' .$data. '"><img src="http://tiendakrear3d.com/wp-content/uploads/kyro11/svg/ply.svg"></a>
					</div>';
					echo '<img class="prd-gly-img" src="https://img.youtube.com/vi/' .$data. '/maxresdefault.jpg" alt="">
					<span>' . $lbl . '</span>
				</div>';
			}
			$key++;
		}
		echo '</div>
	</section>';
	
} else {
	echo '<section class="' .( $galeria_de_video ? '' : 'k11-hdn' ). '" id="k11-prd-gly">
		<h2>Galería</h2>
		<div class="kyr-o11-flx-wrp">';
		foreach ($galeria_de_video as $key => $video) {
			echo '<div class="k11-gly-pad">
				<div class="k11-gly-ovr">
					<a data-fancybox="" href="https://www.youtube.com/watch?v=' .$video['codigo_de_youtube']. '"><img src="http://tiendakrear3d.com/wp-content/uploads/kyro11/svg/ply.svg"></a>
				</div>';
				if ( $video['imagen_desde'] == 'youtube' ) {
					echo '<img class="prd-gly-img" src="https://img.youtube.com/vi/' .$video['codigo_de_youtube']. '/maxresdefault.jpg" alt="">';
				} else {
					echo '<img src="' .$video['imagen']. '" alt="">';
				}
			echo '</div>';
		}
		echo '</div>
	</section>';
}


?>