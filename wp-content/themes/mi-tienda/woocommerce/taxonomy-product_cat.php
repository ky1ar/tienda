<?php
/**
 * The Template for displaying products in a product category. Simply includes the archive template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/taxonomy-product-cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     4.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
get_header('');
?>

<?php include get_theme_file_path('/includes/taxonomy/slidershow.php'); ?>
	
<section class="kyr-o11-sld">
	<div class="kyr-o11-wrp kyr-o11-flx-wrp">
		<div id="k11-prd-mnu">
			<div id="k11-sid-bar">
				<?php dynamic_sidebar( 'sidebar-filter-produts' ); ?>
			</div>
			<div id="k11-mnu-bar">
				<button id="k11-mnu-bar-btn">Filtros</button>
				<?php dynamic_sidebar( 'sidebar-filter-produts' ); ?>
			</div>
			<script>
			var mbb = document.getElementById("k11-mnu-bar-btn");
			  mbb.addEventListener("click", function() {
				this.classList.toggle("k11-act");
				var panel = this.nextElementSibling;
				if (panel.style.maxHeight) {
				  panel.style.maxHeight = null;
				} else {
				  panel.style.maxHeight = panel.scrollHeight + "px";
				} 
			  });

			</script>
		</div>

		<div id="k11-prd-grd" class="kyr-o11-flx-wrp">
			<?php include get_theme_file_path('/includes/tienda/comparar.php');
			
				if ( woocommerce_product_loop() ) {

					if ( wc_get_loop_prop( 'total' ) ) {
						
						while ( have_posts() ) {
							the_post();
							do_action( 'woocommerce_shop_loop' );
							// wc_get_template_part( 'content', 'product' );
							global $product; 
							?>
							<div class="k11-prd-itm">
								<?php include get_theme_file_path('/includes/tienda/producto.php');?>
							</div>
						<?php 
						} 
					}
					do_action( 'woocommerce_after_shop_loop' );

				} else {
					do_action( 'woocommerce_no_products_found' );
				}
				do_action( 'woocommerce_after_main_content' );

				?>
		</div>
	</div>	
</section>	

<?php get_footer();?>
