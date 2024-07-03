<?php
//
//ky1ar
//
if ( !defined( 'ABSPATH' ) ) {	exit; }
global $post;

$idp = $post->ID;
$pro = wc_get_product( $idp );
$pri = $pro->get_price();

//echo '<div>' . $pro->get_sku() . '</div>';

//echo '<split-payment-previous subscription-key="1bc471a425514f32878506da4a08cb9d" amount="' . $pri .'" logo-url="https://tiendakrear3d.com/wp-content/uploads/2021/01/LOGO-300x90.jpg" currency="PEN"></split-payment-previous>';

$fch = get_field( 'principal' );

if(  $fch [ 'etiqueta' ] ) {
	echo '<div class="k11-bdg '.($fch [ 'clase' ]).' '.( $fch [ 'texto' ] ? 'bdg-prv' : '' ). '">'. ( $fch [ 'texto' ] ). '</div>';
} else {
	echo '<div class="k11-bdg ' .( $fch [ 'stock' ] == 1 ? '' : 'bdg-prv' ). '">' .( $fch [ 'stock' ] == 1 ? 'En Stock' : 'Preventa' ). '</div>';
}

if ( $fch [ 'ficha_tecnica' ] ) echo do_shortcode( "[WORDPRESS_PDF]" );

$dsc = get_field( 'descripcion' );
if ( $dsc ) echo '<p class="sdesc">' . $dsc . '</p>';

$blq = get_field( 'bloque_unico' );
if ( $blq [ 'bloque' ] ) {
    $bnf_dat = [ 
        ['cap', 'Capacitación Virtual', 'Te ofrecemos una capacitación personalizada con nuestros expertos.' ],
        ['gar', 'Garantía de 24 meses', 'Te brindamos la mayor garantía del mercado peruano.'],
        ['Servicio de Calibración', 'Servicio de Armado', 'El costo se añadirá en el carrito de compras.'],
    ];

    $assembly = $blq [ 'precio' ];
    switch ( $assembly ) {
        case 'fdms': $spc = '100'; $spr = '16281';break;
        case 'fdmm': $spc = '150'; $spr = '16283';break;
        case 'fdml': $spc = '200'; $spr = '16284'; break;
        case 'resins': $spc = '80'; $spr = '16285';break;
        case 'resinm': $spc = '120'; $spr = '16287';break;
        case 'resinl': $spc = '180'; $spr = '16288'; break;
        case 'prusa': $spc = '350'; $spr = '16289'; break;
		case 's1500': $spc = '1500'; $spr = '18274 '; break;
		case 's1000': $spc = '1000'; $spr = '18275 '; break;
		case 's500': $spc = '500'; $spr = '18311 '; break;
    }
    
    $srv_fld = $blq [ 'servicio' ];
    echo '
    <div id="k11-fbx-flx">
        <div class="k11-fbx fbx-a">
            <h4>Beneficios de Krear 3D</h4>
            <div class="fbx-cnt">
                <div id="k11-fbx-one" class="fbx-itm">
                    <img src="http://tiendakrear3d.com/wp-content/uploads/kyro11/svg/' . $bnf_dat[ 0 ][ 0 ] . '.svg">
                    <div>
                        <h5>' . $bnf_dat[ 0 ][ 1 ] . '</h5>
                        <p>' . $bnf_dat[ 0 ][ 2 ] . '</p>
                    </div>	
                </div>

                <div id="k11-fbx-two" class="fbx-itm">
                    <img src="http://tiendakrear3d.com/wp-content/uploads/kyro11/svg/' . $bnf_dat[ 1 ][ 0 ] . '.svg">
                    <div>
                        <h5>' . $bnf_dat[ 1 ][ 1 ] . '</h5>
                        <p>' . $bnf_dat[ 1 ][ 2 ] . '</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="k11-fbx fbx-b">
            <h4>Agrega</h4>
            <div class="fbx-cnt">
                <div id="k11-fbx-thr" class="fbx-itm" data-pro="' . $post->ID . '" data-srv="' . $spr . '">
                    <span class="fbx-cnt-mny">S/' . $spc . '</span>
                    <div>
                        <h5>'; echo $srv_fld == 1 ? $bnf_dat[ 2 ][ 1 ] : $bnf_dat[ 2 ][ 0 ]; echo '</h5>
                        <p>' . $bnf_dat[ 2 ][ 2 ] . '</p>
                    </div>
                </div>
            </div>
        </div>
    </div>';
}  else {
    if ( !$blq [ 'especificaciones' ] ) {
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
                $tbl = get_field( 'resinas' ); $tbn = get_field_object( 'resinas' ); break;
            case 'repuesto':
                $tbl = get_field( 'repuestos' ); $tbn = get_field_object( 'repuestos' ); break;
            case 'film':
                $tbl = get_field( 'film' ); $tbn = get_field_object( 'film' ); break;
            case 'cortadora':
                $tbl = get_field( 'cortadoras_laser' ); $tbn = get_field_object( 'cortadoras_laser' );  break;
            case 'polyterra':
                $tbl = get_field( 'plantilla_polyterra' ); $tbn = get_field_object( 'plantilla_polyterra' ); break;
            case 'polylitesedoso':
                $tbl = get_field( 'plantilla_polylite_sedoso' ); $tbn = get_field_object( 'plantilla_polylite_sedoso' ); break;
            case 'boquilla':
                $tbl = get_field( 'plantilla_boquilla' ); $tbn = get_field_object( 'plantilla_boquilla' ); break;
            default:
                $tbl = get_field( 'personalizado' ); $def = false;
        }
    
        if( $def ) $tbn = $tbn[ 'sub_fields' ];
        $key = 0;
        $lmt = 6;

        echo '<div id="k11-sht-spc">
            <h4>Características Principales</h4>';
        foreach ( $tbl as $data ) {
            if ( !empty( $data ) && $lmt > 0 ) {
                if( $def ) echo '<pre> <em>' . $tbn[ $key ][ 'label' ] . '</em> <em>' . $data . '</em> </pre> ';
                else echo '<pre> <em>' . $data[ 'etiqueta' ] . '</em> <em>' . $data[ 'texto' ] . '</em> </pre> ';
                $lmt--;
            }
            $key++;
        } 
        echo '</div>';
    } else {
        echo $blq [ 'especificaciones' ][ 'descripcion_personalizada' ];
    }
}

?>
<!--<split-payment-previous subscription-key="1bc471a425514f32878506da4a08cb9d" amount="1800" logo-url="https://tiendakrear3d.com/wp-content/uploads/2021/01/LOGO-300x90.jpg" currency="PEN"></split-payment-previous>-->
