<?php 

if ( !$custom_product ) $product = wc_get_product( get_the_ID() );

$id_p = $product->get_id();
$k11_pth = [ 'https://tiendakrear3d.com/wp-content/uploads/kyro11/logos/', '.webp' ];
$k11_pn = strtolower( get_the_title( $id_p ) );

switch ( true ) {
	case preg_match( '/polycast|polydissolve|polylite|polyterra|polymax|polymide|polysher|polywood|polysmooth|polybox|polyflex/', $k11_pn ) === 1:
		$k11_pi = 'polymaker'; break;
	case preg_match( '/bambu lab|p1p|x1 carbon|ams/', $k11_pn ) === 1:
		$k11_pi = 'bambu'; break;
	case preg_match( '/bluecast/', $k11_pn ) === 1:
		$k11_pi = 'bluecast'; break;
	case preg_match( '/mellow/', $k11_pn ) === 1:
		$k11_pi = 'mellow';	break;	
	case preg_match( '/phrozen|resina aqua|resina onyx|tr300/', $k11_pn ) === 1:
		$k11_pi = 'phrozen'; break;
	case preg_match( '/anycubic/', $k11_pn ) === 1:
		$k11_pi = 'anycubic'; break;
	case preg_match( '/artillery|hornet|genius|sidewinder|fs31w01/', $k11_pn ) === 1:
		$k11_pi = 'artillery'; break;
	case preg_match( '/raise/', $k11_pn ) === 1:
		$k11_pi = 'raise'; break;
	case preg_match( '/prizma/', $k11_pn ) === 1:
		$k11_pi = 'prizma';	break;
	case preg_match( '/elegoo/', $k11_pn ) === 1:
		$k11_pi = 'elegoo';	break;
	case preg_match( '/capricorn/', $k11_pn ) === 1:
		$k11_pi = 'capricorn'; break;
	case preg_match( '/meanwell/', $k11_pn ) === 1:
		$k11_pi = 'meanwell'; break;
	case preg_match( '/creality|ender|hotend spider|estandar bajo olor|titan ensamblado|extension eje z/', $k11_pn ) === 1:
		$k11_pi = 'creality'; break;
	case preg_match( '/flsun/', $k11_pn ) === 1:
		$k11_pi = 'flsun'; break;
	case preg_match( '/kingroon/', $k11_pn ) === 1:
		$k11_pi = 'kingroon'; break;
	case preg_match( '/xyz/', $k11_pn ) === 1:
		$k11_pi = 'xyz'; break;	
	case preg_match( '/flux|beam/', $k11_pn ) === 1:
		$k11_pi = 'flux'; break;	
	case preg_match( '/lazervida/', $k11_pn ) === 1:
		$k11_pi = 'lazervida'; break;		
	case preg_match( '/hp 3d|hp camara|hp base/', $k11_pn ) === 1:
		$k11_pi = 'hp'; break;
	case preg_match( '/matter and form/', $k11_pn ) === 1:
		$k11_pi = 'matter'; break;
	case preg_match( '/revopoint/', $k11_pn ) === 1:
		$k11_pi = 'revopoint'; break;	
	case preg_match( '/prusa/', $k11_pn ) === 1:
		$k11_pi = 'prusa'; break;
	case preg_match( '/epilog/', $k11_pn ) === 1:
		$k11_pi = 'epilog'; break;
	case preg_match( '/laguna/', $k11_pn ) === 1:
		$k11_pi = 'laguna'; break;
	case preg_match( '/dobot/', $k11_pn ) === 1:
		$k11_pi = 'dobot'; break;
	case preg_match( '/tormach/', $k11_pn ) === 1:
		$k11_pi = 'tormach'; break;
	case preg_match( '/esun/', $k11_pn ) === 1:
		$k11_pi = 'esun'; break;
	case preg_match( '/vallejo/', $k11_pn ) === 1:
		$k11_pi = 'vallejo'; break;
	default:
		$k11_pi = 'empty';
}

$k11_lnk = $k11_pth[0].$k11_pi.$k11_pth[1];

//do_action( 'woocommerce_before_shop_loop_item' ); 
//$image = wp_get_attachment_image_src( get_post_thumbnail_id( $id_p ), 'single-post-thumbnail' );
//<img src="<?php  echo $image[0]; " class="primary-image attachment-shop-catalog wp-post-image wp-post-image--primary" >
?>

<article data-product="<?php echo $id_p; ?>">
	
	<img class="sec-brb" width="96" height="35" alt="<?php echo $k11_pi; ?> logo" src="<?php echo $k11_lnk; ?>">
	<a class="sec-url" href="<?php echo get_permalink( $id_p ); ?>"><?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $id_p ), 'single-post-thumbnail' );?>
		<img src="<?php  echo $image[0]; ?>">
	</a>

	<div class="sec-dtl">
		<a class="sec-nam-url" href="<?php echo get_permalink( $id_p ); ?>"><?php echo get_the_title( $id_p );?></a>
		<div class="sec-prc">
			<?php 
			if ( $product->is_type( 'variable' ) ) {
				$min_price = $product->get_variation_price( 'min' );
				echo 'S/' . $min_price; 
			} else echo get_woocommerce_currency_symbol() . ' ' .  $product->get_price(); 
			?>
		</div>

		<?php 
		
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

        $tmp = get_field('plantilla', $id_p ); 
        $def = true;
        switch ( $tmp ) {
            case 'impfdm':
                $tbl = get_field('impresora_3d_fdm', $id_p ); $tbn = get_field_object('impresora_3d_fdm', $id_p ); break;
            case 'impresin':
                $tbl = get_field('impresora_3d_resina', $id_p ); $tbn = get_field_object('impresora_3d_resina', $id_p ); break;
            case 'filament':
                $tbl = get_field('filamentos', $id_p ); $tbn = get_field_object('filamentos', $id_p ); break;
            case 'resin':
                $tbl = get_field('resinas', $id_p ); $tbn = get_field_object('resinas', $id_p ); break;
            case 'repuesto':
                $tbl = get_field('repuestos', $id_p ); $tbn = get_field_object('repuestos', $id_p ); break;
            case 'film':
                $tbl = get_field('film', $id_p ); $tbn = get_field_object('film', $id_p ); break;
            case 'cortadora':
                $tbl = get_field('cortadoras_laser', $id_p ); $tbn = get_field_object('cortadoras_laser', $id_p ); break;
            default:
                $tbl = get_field('personalizado', $id_p ); $def = false;
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
		?>
		<div class="sec-btn">
			<a href="<?php echo get_permalink($product->get_id()); ?>">Ver producto</a>
			<?php /*<a class="btn btn--only--text primary button-comparar" data-product="<?php echo $product->get_id(); ?>">+ Comparar</a>*/ ?>
			<a href="<?php echo do_shortcode( '[add_to_cart_url id=' . $id_p . ']' ) ?>">Comprar</a>
		</div>
	</div>
</article>
	