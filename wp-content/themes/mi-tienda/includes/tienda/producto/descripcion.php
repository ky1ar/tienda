<?php 

$id_p = $product->get_id();

$pre = get_field( 'prelaunch' );
$datos_de_descripcion = get_field( 'datos_de_descripcion' );
$datos_comparacion = get_field( 'datos_de_comparacion' );

if( $pre ) {
	
	$tmp = get_field( 'plantilla' );
	$def = true;
	switch ( $tmp ) {
		case 'impfdm':
			$tbl = get_field( 'impresora_3d_fdm' ); $tbn = get_field_object( 'impresora_3d_fdm' ); break;
		case 'impresin':
			$tbl = get_field( 'impresora_3d_resina' ); $tbn = get_field_object( 'impresora_3d_resina' ); break;
		case 'filament':
			$tbl = get_field( 'filamentos' ); $tbn = get_field_object( 'filamentos' ); break;
		case 'resin':
			$tbl = get_field( 'resinas' ); $tbn = get_field_object( 'resinas'); break;
		case 'repuesto':
			$tbl = get_field( 'repuestos' ); $tbn = get_field_object( 'repuestos' ); break;
		case 'film':
			$tbl = get_field( 'film' ); $tbn = get_field_object( 'film' ); break;
		case 'cortadora':
			$tbl = get_field( 'cortadoras_laser' ); $tbn = get_field_object( 'cortadoras_laser' ); break;
		case 'polyterra':
			$tbl = get_field( 'plantilla_polyterra' ); $tbn = get_field_object( 'plantilla_polyterra' ); break;
		case 'polylitesedoso':
			$tbl = get_field( 'plantilla_polylite_sedoso' ); $tbn = get_field_object( 'plantilla_polylite_sedoso' ); break;
		case 'boquilla':
			$tbl = get_field( 'plantilla_boquilla' ); $tbn = get_field_object( 'plantilla_boquilla' ); break;
		default:
			$tbl = get_field( 'personalizado' ); $def = false;
	}
	
	//echo "<script>console.log('Debug Objects: " . json_encode($tbn) . "' );</script>";
	echo '<section id="k11-prd-dsc">
			<div class="kyr-o11-flx-wrp">';
	
	if( $def ) $tbn = $tbn[ 'sub_fields' ];
	
	$key = 0; $ttl = true;
	foreach ( $tbl as $data ) {
		if ( !empty( $data ) ) {
			if ( $ttl ) { echo '<h2>Especificaciones Técnicas</h2>'; $ttl = false; }
			
			if( $def ) echo '<span> <ul> <li>' . $tbn[ $key ][ 'label' ] . '</li> <li>' . $data . '</li> </ul> </span>';
			else echo '<span> <ul> <li>' . $data[ 'etiqueta' ] . '</li> <li>' . $data[ 'texto' ] . '</li> </ul> </span>';
		}
		$key++;
	} 
	echo '</div>
	</section>';
	
} elseif ( $datos_comparacion ) {
	
	$tbn = ['Tecnología', 'Volumen de Impresión', 'Resolución de Capa', 'Velocidad Máxima', 'Tipo de Extrusor', 'Diámetro de boquilla', 'Temp. máx. de Extrusor', 'Temp. máx. de Plataforma', 'Materiales Compatibles', 'Diámetro de Filamento', 'Conectividad', 'Software Compatibles', 'Formatos Compatibles', 'Dimensiones del Producto', 'Peso del Producto', 'Tipo de pantalla', 'Consumo Eléctrico', 'Dimensiones de la Caja', 'Peso de la Caja', 'Tipo de Impresora', 'Retomar Impresión', 'Sensor de Filamento', 'Tipo de Plataforma', 'Cantidad de Extrusores', 'Fuente de Luz'];
	
	echo '<section id="k11-prd-dsc">
		<div class="kyr-o11-flx-wrp">';
	$c=0;
	$ttl=0;
	foreach ( $datos_comparacion as $key => $data ) {
		if ( $ttl == 0 && !empty($data) ) {
			echo '<h2>Especificaciones Técnicas</h2>';
			$ttl++;
		}
		if ( !empty($data ) ) {
			echo '<span> <ul> <li>' . $tbn [ $c ] . ' </li> <li> ' . $data . '</li> </ul> </span>';
		}
		$c++;
	}
	echo '</div>
	</section>';
	
}
