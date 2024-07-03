<?php //$page_shop = get_options_page_id('pagina-productos');

//echo $page_shop;
	

//echo json_encode($term);;

//$term_id = $term->term_id;	


/*echo $term_id;
echo $tax;*/

//$sliders = get_field('slider', $term_id);
//echo json_encode($sliders);
//

$term = get_queried_object(); 
$tax = $term->taxonomy;	

if ( $tax == 'pwb-brand' ) {
	
	$brand_id = get_term_meta( $term->term_id, 'pwb_brand_banner',1 );
	$brand_src = wp_get_attachment_image_src( $brand_id, 'wc_pwb_admin_tab_brand_logo_size', true );
	
	if ($brand_src): ?>
	<div class="swiffy-slider slider-nav-chevron slider-item-nogap slider-nav-autoplay slider-nav-autopause" data-slider-nav-autoplay-interval="3500" id="swiffy-animation">
		<ul class="slider-container">
			<li style="text-align: center;">
				<picture>
					<!--<source media="(max-width: 768px)" srcset="<?php //echo $slider['imagen_movil'] ?>">
					<source media="(min-width: 769px)" srcset="<?php //echo $slider['imagen_desktop'] ?>">-->
					<img width="1920" height="630" src="<?php echo $brand_src[0] ?>" alt="<?php echo "Slider-" . $key ?>">
					
				</picture>
			</li>
			<?php if ($brand_id == 20167) : ?>
			<li style="text-align: center;">
				<picture>
					<img width="1920" height="630" src="https://tiendakrear3d.com/wp-content/uploads/2024/05/BANNER-2400X400-BAMBULAB.webp" alt="<?php echo "Slider-" . $key ?>">
				</picture>
			</li>
			<?php endif;
			?>
		</ul>
		<button type="button" class="slider-nav"></button>
		<button type="button" class="slider-nav slider-nav-next"></button>
	</div>
	<?php endif;
	
	$taxonomies = get_terms( array(
		'taxonomy' => 'pwb-brand',
		'hide_empty' => true
	) );

	$nav = '';	
	$let = '';
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
					
				}
			}
		}
		echo '<section id="kyr-o11-brd-nav"> <div class="kyr-o11-wrp"> <h2>Marcas de productos</h2> <div class="kyr-o11-brd-flx">' .$nav. '</div> </div> </section>';
	}
}