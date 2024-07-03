<?php 
//
//ky1ar
//
if ( !$custom_product ) $product = wc_get_product( get_the_ID() ); 

$id_p = $product->get_id();

$brands = wp_get_post_terms( $id_p, 'pwb-brand' );
$brand = $brands[0];
$brand_id = get_term_meta( $brand->term_id, 'pwb_brand_image',1 );

$brand_src = wp_get_attachment_image_src( $brand_id, 'wc_pwb_admin_tab_brand_logo_size', true );
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $id_p ), array('300','300'), true );

$fch = get_field('principal', $id_p);

echo '<article data-product="' .$id_p.'" class="'.( $fch [ 'etiqueta' ] == 1 ? $fch [ 'clase' ] : '' ).'">
    <img height="32" class="sec-brb" alt="Brand" src="' .$brand_src[0]. '">
    <a class="sec-url" href="' .get_permalink( $id_p ). '">
        <img alt="Miniatura" width="192" height="192" src="' .$image[0]. '">
	</a>';
	
	

	if(  $fch [ 'etiqueta' ] ) {
		echo '<div class="k11-bdg '.($fch [ 'clase' ]).' '.( $fch [ 'texto' ] ? 'bdg-prv' : '' ). '">'. ( $fch [ 'texto' ] ). '</div>';
	} else {
		echo '<div class="k11-bdg ' .( $fch [ 'stock' ] == 1 ? '' : 'bdg-prv' ). '">' .( $fch [ 'stock' ] == 1 ? 'En Stock' : 'Preventa' ). '</div>';
	}
	


	
	//echo '<script>console.log("'.$fch [ 'google_merchant' ].'")</script>';
	echo '<div class="sec-dtl ">
		<a class="sec-nam-url" href="' .get_permalink( $id_p ). '">' .get_the_title( $id_p ). '</a>
		<div class="sec-prc">';
			if ( $product->is_type( 'variable' ) ) {
				$min_price = $product->get_variation_price( 'min' );
				echo 'S/' . $min_price; 
			} else {
				echo 'S/ ' .  $product->get_price(); 
				//echo get_woocommerce_currency_symbol() . 'S/ ' .  $product->get_price(); 
			}
		echo '</div>';

		//$short_description = apply_filters( 'woocommerce_short_description', $product->get_short_description() );
		
        $msj = get_field( 'mensaje', $id_p );


        switch ( $msj ) {
            case 'cap':
                $msj_txt = 'Incluye: Capacitación virtual de 6 horas y 24 meses garantía'; break;
            case 'gar':
                $msj_txt = 'Incluye: 24 meses garantía'; break;
            case 'spc':
                $msj_txt = 'Especificaciones'; break;
        }
        echo '<p>' . $msj_txt . '</p>';

        $tmp = get_field( 'plantilla', $id_p ); 

        $def = true;
        switch ( $tmp ) {
            case 'impfdm':
                $tbl = get_field( 'impresora_3d_fdm', $id_p ); $tbn = get_field_object( 'impresora_3d_fdm', $id_p ); break;
            case 'impresin':
                $tbl = get_field( 'impresora_3d_resina', $id_p ); $tbn = get_field_object( 'impresora_3d_resina', $id_p ); break;
            case 'filament':
                $tbl = get_field( 'filamentos', $id_p ); $tbn = get_field_object( 'filamentos', $id_p ); break;
            case 'resin':
                $tbl = get_field( 'resinas', $id_p ); $tbn = get_field_object( 'resinas', $id_p ); break;
            case 'repuesto':
                $tbl = get_field( 'repuestos', $id_p ); $tbn = get_field_object( 'repuestos', $id_p ); break;
            case 'film':
                $tbl = get_field( 'film', $id_p ); $tbn = get_field_object( 'film', $id_p ); break;
            case 'cortadora':
                $tbl = get_field( 'cortadoras_laser', $id_p ); $tbn = get_field_object( 'cortadoras_laser', $id_p ); break;
            case 'polyterra':
                $tbl = get_field( 'plantilla_polyterra', $id_p ); $tbn = get_field_object( 'plantilla_polyterra', $id_p ); break;
            case 'polylitesedoso':
                $tbl = get_field( 'plantilla_polylite_sedoso', $id_p ); $tbn = get_field_object( 'plantilla_polylite_sedoso', $id_p ); break;
            case 'boquilla':
                $tbl = get_field( 'plantilla_boquilla', $id_p ); $tbn = get_field_object( 'plantilla_boquilla', $id_p ); break;
            default:
                $tbl = get_field( 'personalizado', $id_p ); $def = false;
        }
        
        if( $def ) $tbn = $tbn['sub_fields'];
        $key = 0;
        $lmt = 6;
        
        foreach ( $tbl as $data ) {
            if ( !empty( $data ) && $lmt > 0 ) {
                if( $def ) echo '<pre> <em>' . $tbn[ $key ][ 'label' ] . '</em> <em>' . $data . '</em> </pre> ';
                else echo '<pre> <em>' . $data[ 'etiqueta' ] . '</em> <em>' . $data[ 'texto' ] . '</em> </pre> ';
                $lmt--;
            }
            $key++;
        } 

		
		echo '<div class="sec-btn">
            <a href="' .get_permalink( $id_p ). '">Ver producto</a>
            <a href="' .do_shortcode( '[add_to_cart_url id=' . $id_p . ']' ). '">Comprar</a>
        </div>
    </div>
</article>';
?>