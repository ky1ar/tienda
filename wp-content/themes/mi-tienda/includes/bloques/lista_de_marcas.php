<?php
$taxonomies = get_terms( array(
	'taxonomy' => 'pwb-brand',
	'hide_empty' => true
) );

$dat = '';
$nav = '';	
$let = '';
$str = 0;		
if ( !empty( $taxonomies ) ) {
	foreach( $taxonomies as $category ) {
		
		$cur_brd = $category->name;
		if ( $category->slug != 'xyzprinting' ) {
            $cur_let = substr( $cur_brd, 0, 1 );
            
            if ( $let != $cur_let ) {	
                $let = $cur_let;
				if ( ctype_digit ( $let ) ) {
					$nav .= '<a href="/marcas/#0">#</a> ';
				} else {
					$nav .= '<a href="/marcas/#' .$let. '"> ' .$let. '</a> ';
				}

                if ( $str != 0 ) $dat .= '</ul></div>';
                
				if ( ctype_digit ( $let ) ) {
					$dat .= '<div class="ky1-brd-blc" id="0"><span>#</span><ul>';
				} else {
					$dat .= '<div class="ky1-brd-blc" id="' .$let. '"><span>' .$let. '</span><ul>';
				}
            }
            
            $brand_id = get_term_meta( $category->term_id, 'pwb_brand_image',1 );
            $brand_src = wp_get_attachment_image_src( $brand_id, 'wc_pwb_admin_tab_brand_logo_size', true );
            
            $dat .= '<li>
                <a href="/marca/' .$category->slug. '">
                    <img height="32" class="sec-brb" alt="Brand" src="' .$brand_src[0]. '">'.
                    //'<h4>' .$category->name. '</h4>'.
                '</a>'. 
            '</li>';
        
            $str++;
        }
	}
	$dat .= '</ul></div>';
	
	echo '<section id="kyr-o11-brd-nav"> <div class="kyr-o11-wrp"> <h2>Marcas de productos</h2> <div class="kyr-o11-brd-flx">' .$nav. '</div> </div> </section>';
	echo '<section id="kyr-o11-brd"> <div class="kyr-o11-wrp"> ' .$dat. '</div> </section>';
}
?>