<?php

$secciones = get_field( 'secciones' );
foreach ($secciones as $key => $seccion) {
	$type = $seccion["acf_fc_layout"];
	switch ( $type ) {
		case "lista_de_productos":
			include get_theme_file_path('includes/bloques/lista_de_productos.php');
			break;
		case "lista_de_marcas":
			include get_theme_file_path('includes/bloques/lista_de_marcas.php');
			break;
		case "seccion_de_codigo":
			include get_theme_file_path('includes/bloques/seccion_de_codigo.php');
			break;
		case "carrusel_de_productos":
			include get_theme_file_path('includes/bloques/carrusel_de_productos.php');
			break;
		case "carrusel_personalizado":
			include get_theme_file_path('includes/bloques/carrusel_personalizados.php');
			break;
	}
} 

?>