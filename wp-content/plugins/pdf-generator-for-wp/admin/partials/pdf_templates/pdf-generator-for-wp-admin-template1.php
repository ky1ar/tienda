<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://wpswings.com/
 * @since      1.0.0
 *
 * @package    Pdf_Generator_For_Wp
 * @subpackage Pdf_Generator_For_Wp/admin/partials
 */

if ( ! defined( 'ABSPATH' ) ) {

	exit(); // Exit if accessed directly.
}
/**
 * Function contains html for template 1;
 *
 * @param int    $post_id post id.
 * @param string $template_name template name to be used.
 * @since 1.0.0
 *
 * @return string
 */
 

function return_ob_html( $post_id, $template_name = '' ) {
	
	$post = get_post( $post_id );
	if ( is_object( $post ) ) {
		$html .= '
<head>
    <style>
        ::selection {
            color: #fff !important;
            background: #ec8d5e !important;
        }
        body {
            font-family: sans-serif;
            margin: 0 auto;
            width: 794px;
            height: 1123px;
            font-size: 0.9rem;
            position: relative;
            background-image: url("https://tiendakrear3d.com/wp-content/uploads/kyro11/BG.png");
            background-size: cover;
            background-repeat: no-repeat;
            position: relative;
        }
        @page  {
            margin: 0;
        }
        .k11-pdf-ttl {
            text-transform: uppercase;
            position: absolute;
            top: 62px;
            left: 577px;
            font-size: 24px;
            color: #fff;
        }
        .k11-pdf-tt2 {
            text-transform: uppercase;
            position: absolute;
            top: 536px;
            left: 278px;
            font-size: 15.5px;
            color: #fff;
        }
        .k11-pdf-nme {
            text-transform: uppercase;
            position: absolute;
            top: 176px;
            left: 360px;
            font-weight: 700;
            font-size: 19px;
        }
        .k11-pdf-cap {
            position: absolute;
            top: 225px;
            left: 387px;
            font-weight: 700;
            font-size: 12px;
            color: #fff;
        }
        .k11-pdf-wsp {
            text-transform: uppercase;
            position: absolute;
            top: 456px;
            left: 368px;
            font-size: 15px;
            color: #fff;
            text-decoration: none;
            padding: 8px 88px;
        }
        .k11-pdf-brd {
            position: absolute;
            top: 164px;
            right: 40px;
            width: 128px;
            height: 42px;
        }
        .k11-pdf-itm {
            position: absolute;
            top: 182px;
            left: 39px;
            width: 288px;
            height: 288px;
        }
        .k11-pdf-lk1 {
            position: absolute;
            color: #fff;
            text-decoration: none;
            top: 5px;
            left: 56px;
        }
        .k11-pdf-lk2 {
            position: absolute;
            color: #fff;
            text-decoration: none;
            top: 5px;
            left: 242px;
        }
        .k11-pdf-lk3 {
            position: absolute;
            color: #fff;
            text-decoration: none;
            top: 5px;
            left: 562px;
        }
        .k11-pdf-lk4 {
            position: absolute;
            color: #fff;
            text-decoration: none;
            top: 5px;
            left: 679px;
        }
        .k11-pdf-ftr {
            position: absolute;
            color: #fff;
            bottom: 12px;
            left: 19px;
            font-size: 13.5px;
        }
        .k11-pdf-spc {
            position: absolute;
            left: 362px;
            top: 254px;
            width: 390px;
        }
        .k11-pdf-spc ul {
            padding: 0;
            margin: 0;
            list-style: none;
            text-align: center;
        }
        .k11-pdf-spc ul li {
            display: INLINE-BLOCK;
            width: 50%;
            padding: 8px 0;
            font-size: 13.5px;
        }
        .k11-pdf-spc pre {
            margin: 0;
            paddding: 0;
            display: block;
            text-align: center;
        }
        .k11-pdf-spc pre em {
            font-family: sans-serif;
            font-style: normal;
            display: INLINE-BLOCK;
            width: 50%;
            margin: 0;
            padding: 8px 0;
            font-size: 13.5px;
        }
        .k11-pdf-spc p {
            display: none;
        }
        .k11-pdf-web {
            position: absolute;
            left: 35px;
            top: 5px;
        }
        .k11-pdf-map {
            position: absolute;
            left: 223px;
            top: 5px;
        }
        .k11-pdf-wsp1 {
            position: absolute;
            left: 542px;
            top: 5px;
        }
        .k11-pdf-wsp2 {
            position: absolute;
            left: 659px;
            top: 5px;
        }
        
        .k11-pdf-fti {
            position: absolute;
            left: 596px;
            bottom: 13px;
        }
        .k11-pdf-ftt {
            position: absolute;
            left: 649px;
            bottom: 13px;
        }
        .k11-pdf-ftf {
            position: absolute;
            left: 702px;
            bottom: 13px;
        }
        .k11-pdf-fty {
            position: absolute;
            left: 755px;
            bottom: 13px;
        }
        .k11-pdf-k3d {
            position: absolute;
            width: 190px;
            left: 32px;
            top: 44px;
        }
        .k11-pdf-dta {
            position: absolute;
            top: 566px;
            left: 17px;
            width: 762px;
            font-size: 14px;
        }
        .k11-pdf-dta .k11-box {
            position: absolute;
            background-color: #fff;
            border-radius: 4px;
            border: 1px solid #ebebeb;
            border-left: 4px solid #213337;
            width: 174px;

        }
        .k11-pdf-dta .k11-bx0 {
            top: 8px;
            left: 8px;
        }
        .k11-pdf-dta .k11-bx1 {
            top: 8px;
            left: 198px;
        }
        .k11-pdf-dta .k11-bx2 {
            top: 8px;
            left: 388px;
        }
        .k11-pdf-dta .k11-bx3 {
            top: 8px;
            left: 578px;
        }
        
        .k11-pdf-dta .k11-bx4 {
            top: 90px;
            left: 8px;
        }
        .k11-pdf-dta .k11-bx5 {
            top: 90px;
            left: 198px;
        }
        .k11-pdf-dta .k11-bx6 {
            top: 90px;
            left: 388px;
        }
        .k11-pdf-dta .k11-bx7 {
            top: 90px;
            left: 578px;
        }
        
        .k11-pdf-dta .k11-bx8 {
            top: 172px;
            left: 8px;
        }
        .k11-pdf-dta .k11-bx9 {
            top: 172px;
            left: 198px;
        }
        .k11-pdf-dta .k11-bx10 {
            top: 172px;
            left: 388px;
        }
        .k11-pdf-dta .k11-bx11 {
            top: 172px;
            left: 578px;
        }
        
        .k11-pdf-dta .k11-bx12 {
            top: 254px;
            left: 8px;
        }
        .k11-pdf-dta .k11-bx13 {
            top: 254px;
            left: 198px;
        }
        .k11-pdf-dta .k11-bx14 {
            top: 254px;
            left: 388px;
        }
        .k11-pdf-dta .k11-bx15 {
            top: 254px;
            left: 578px;
        }
        
        .k11-pdf-dta .k11-bx16 {
            top: 336px;
            left: 8px;
        }
        .k11-pdf-dta .k11-bx17 {
            top: 336px;
            left: 198px;
        }
        .k11-pdf-dta .k11-bx18 {
            top: 336px;
            left: 388px;
        }
        .k11-pdf-dta .k11-bx19 {
            top: 336px;
            left: 578px;
        }
        
        .k11-pdf-dta .k11-bx20 {
            top: 418px;
            left: 8px;
        }
        .k11-pdf-dta .k11-bx21 {
            top: 418px;
            left: 198px;
        }
        .k11-pdf-dta .k11-bx22 {
            top: 418px;
            left: 388px;
        }
        .k11-pdf-dta .k11-bx23 {
            top: 418px;
            left: 578px;
        }
        
        .k11-pdf-dta span ul {
            margin: 0;
            list-style: none;
            text-align: center;
            padding: 13px 0;
        }
        .k11-pdf-dta span ul li{
            white-space: pre;
            text-overflow: ellipsis;
            overflow: hidden;
            display: block;
            line-height: 20px;
        }
        .k11-pdf-dta span ul li + li{
            /*font-weight: 700;*/
        }
    </style>
</head>';

$pth_img = get_the_post_thumbnail_url( $post );
$pth_img = str_replace( '.webp', '.jpg', $pth_img );

    
/************************** BRAND NAME ********************************/

$str_brand = [];

$str_k11_pth = "https://tiendakrear3d.com/wp-content/uploads/kyro11";
$str_name = strtolower( str_replace(" ", "-", $post->post_title ) );

$tmp = get_field( 'plantilla', $post_id );
$def = true;

switch ( $tmp ) {
    case 'impfdm':
        $tbl = get_field('impresora_3d_fdm', $post_id ); $tbn = get_field_object('impresora_3d_fdm', $post_id ); break;
    case 'impresin':
        $tbl = get_field('impresora_3d_resina', $post_id ); $tbn = get_field_object('impresora_3d_resina', $post_id ); break;
    case 'filament':
        $tbl = get_field('filamentos', $post_id ); $tbn = get_field_object('filamentos', $post_id ); break;
    case 'resin':
        $tbl = get_field('resinas', $post_id ); $tbn = get_field_object('resinas', $post_id ); break;
    case 'repuesto':
        $tbl = get_field('repuestos', $post_id ); $tbn = get_field_object('repuestos', $post_id ); break;
    case 'film':
        $tbl = get_field('film', $post_id ); $tbn = get_field_object('film', $post_id ); break;
    case 'cortadora':
        $tbl = get_field('cortadoras_laser', $post_id ); $tbn = get_field_object('cortadoras_laser', $post_id ); break;
    default:
        $tbl = get_field('personalizado', $post_id ); $def = false;
}

if( $def ) $tbn = $tbn['sub_fields'];
$key = 0; $lmt = 6; $str_desc = '';

foreach ( $tbl as $data ) {
    if ( !empty( $data ) && $lmt > 0 ) {
        if( $def ) $str_desc .= '<pre><em>' . $tbn[ $key ][ 'label' ] . '</em><em>' . $data . '</em></pre>';
        else $str_desc .= '<pre><em>' . $data[ 'etiqueta' ] . '</em><em>' . $data[ 'texto' ] . '</em></pre>';
        $lmt--;
    }
    $key++;
} 
 

function shortStr( $str, $lim ){
    if( strlen( $str ) > $lim ){
        return substr($str, 0, $lim) . '...';
    }
    return $str;
}


$tmp = get_field( 'plantilla', $post_id );
$def = true;
switch ( $tmp ) {
    case 'impfdm':
        $tbl = get_field('impresora_3d_fdm', $post_id ); $tbn = get_field_object('impresora_3d_fdm', $post_id ); break;
    case 'impresin':
        $tbl = get_field('impresora_3d_resina', $post_id ); $tbn = get_field_object('impresora_3d_resina', $post_id ); break;
    case 'filament':
        $tbl = get_field('filamentos', $post_id ); $tbn = get_field_object('filamentos', $post_id ); break;
    case 'resin':
        $tbl = get_field('resinas', $post_id ); $tbn = get_field_object('resinas', $post_id ); break;
    case 'repuesto':
        $tbl = get_field('repuestos', $post_id ); $tbn = get_field_object('repuestos', $post_id ); break;
    case 'film':
        $tbl = get_field('film', $post_id ); $tbn = get_field_object('film', $post_id ); break;
    case 'cortadora':
        $tbl = get_field('cortadoras_laser', $post_id ); $tbn = get_field_object('cortadoras_laser', $post_id ); break;
    default:
        $tbl = get_field('personalizado', $post_id ); $def = false;
}

if( $def ) $tbn = $tbn['sub_fields'];

$key = 0; $css=0; $tab= '';
foreach ( $tbl as $data ) {
    if ( !empty( $data ) ) {
        if( $def ) $tab .= '<span class="k11-box k11-bx' . $css . '"> <ul> <li>' . shortStr( $tbn[ $key ][ 'label' ], 22 ) . '</li> <li>' . shortStr( $data, 20 ) . '</li> </ul> </span>';
        else $tab .= '<span class="k11-box k11-bx' . $css . '"> <ul> <li>' . shortStr( $data[ 'etiqueta' ], 22 ) . '</li> <li>' . shortStr( $data[ 'texto' ], 20 ) . '</li> </ul> </span>';
        $css++;
    }
    $key++;
} 

preg_match( '/anycubic|artillery|bambu-lab|creality|dobot|uniformation|elegoo|epilog|flsun|flux|hp|kingroon|laguna|matter|phrozen|prusa|raise-3d|revopoint|tormach|shining-3d|xyz-printing|sovol|/', $str_name, $str_brand );
$str_brand = $str_brand[0];

$str_tittle = str_replace('-', ' ', str_replace($str_brand, '', $str_name));  

$html .='

<body>
    
    <img class="k11-pdf-k3d" src="'.$str_k11_pth.'/logosp/k3d.png">
    
    <img class="k11-pdf-web" src="'.$str_k11_pth.'/svg1/web.svg">
    <a class="k11-pdf-lk1" href="https://tiendakrear3d.com" target="_blank">www.tiendakrear3d.com</a>
    
    <img class="k11-pdf-map" src="'.$str_k11_pth.'/svg1/map.svg">
    <a class="k11-pdf-lk2" href="https://bit.ly/2ZzWUeK" target="_blank">Calle Javier Fernández 262 Miraflores - Lima</a>
    
    <img class="k11-pdf-wsp1" src="'.$str_k11_pth.'/svg1/wsp.svg">
    <a class="k11-pdf-lk3" href="https://api.whatsapp.com/send?phone=51934760404" target="_blank">934 760 404</a>
    
    <img class="k11-pdf-wsp2" src="'.$str_k11_pth.'/svg1/wsp.svg">
    <a class="k11-pdf-lk4" href="https://api.whatsapp.com/send?phone=51982001288" target="_blank">982 001 288</a>
    
    <span class="k11-pdf-ttl"><b>FICHA TÉCNICA</b></span>
    <span class="k11-pdf-nme">'.$str_tittle.'</span>
    <span class="k11-pdf-cap">Incluye: Capacitación virtual de 6 horas y 24 meses garantía</span>
    <span class="k11-pdf-spc">'.$str_desc.'</span>
    <span class="k11-pdf-tt2"><b>ESPECIFICACIONES TÉCNICAS</b></span>
    
    <span class="k11-pdf-dta">'.$tab.'</span>
    
    <img class="k11-pdf-brd" src="'.$str_k11_pth.'/logosp/'.$str_brand.'.png">
    <img class="k11-pdf-itm" src="'.$pth_img.'">
    <a class="k11-pdf-wsp" href="https://api.whatsapp.com/send?phone=51934760404" target="_blank"><b>Comprar por Whatsapp</b></a>
    <span class="k11-pdf-ftr">Fabricaciones Digitales del Perú S.A. © 2023. Todos los derechos reservados.</span>
    
    <a class="k11-pdf-fti" href="https://www.instagram.com/krear3d_peru/" target="_blank"><img src="'.$str_k11_pth.'/svg1/ins.svg"></a>
	<a class="k11-pdf-ftt" href="https://www.tiktok.com/@krear3d_peru " target="_blank"><img  src="'.$str_k11_pth.'/svg1/tik.svg"></a>		
	<a class="k11-pdf-ftf" href=" https://facebook.com/krear3d/" target="_blank"><img  src="'.$str_k11_pth.'/svg1/fbk.svg"></a>												
    <a class="k11-pdf-fty" href="https://www.youtube.com/user/Krear3D" target="_blank"><img src="'.$str_k11_pth.'/svg1/you.svg"></a>
													
</body>';

	}

	return $html;
}
