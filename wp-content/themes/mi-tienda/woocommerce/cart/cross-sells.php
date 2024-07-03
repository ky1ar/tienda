<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

defined( 'ABSPATH' ) || exit;

if ( $cross_sells ) : ?>
	<div class="kyr-o11-sld cross-sells-custom">
		<?php 
		$page_option = get_options_page_id('ajustes-generales');
		$title = get_field('titulo_de_productos_relacionados_en_el_carrito', $page_option);
		if ($title) echo $title;
		
		woocommerce_product_loop_start(); ?>
		
		<div class="swiffy-slider slider-item-show2 slider-nav-square slider-nav-dark slider-nav-visible slider-nav-autohide" style="--swiffy-slider-nav-dark:#d16326;">
			<ul class="slider-container">
			<?php foreach ( $cross_sells as $cross_sell ) : ?>
				<li>
				<?php 
					$post_object = get_post( $cross_sell->get_id() );
					$custom_product = true;
					$product       = wc_get_product($cross_sell->get_id());
					include get_theme_file_path('/includes/tienda/producto.php');
				?>
				</li>
			<?php endforeach ?>
			</ul>
			<button type="button" class="slider-nav" aria-label="Go to previous"></button>
    		<button type="button" class="slider-nav slider-nav-next" aria-label="Go to next"></button>

		</div>
		<?php woocommerce_product_loop_end(); ?>
	</div>
	<?php
endif;

wp_reset_postdata();