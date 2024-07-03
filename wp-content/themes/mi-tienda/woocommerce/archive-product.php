<?php defined('ABSPATH') || exit;

get_header('');
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
// do_action( 'woocommerce_before_main_content' );

?>

<?php include get_theme_file_path('/includes/tienda/slidershow.php'); ?>

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
					/**
					 * Hook: woocommerce_before_shop_loop.
					 *
					 * @hooked woocommerce_output_all_notices - 10
					 * @hooked woocommerce_result_count - 20
					 * @hooked woocommerce_catalog_ordering - 30
					 */
					
					
					// woocommerce_product_loop_start();

					if ( wc_get_loop_prop( 'total' ) ) {
						while ( have_posts() ) {
							the_post();

							global $product;
							/**
							 * Hook: woocommerce_shop_loop.
							 *
							 * @hooked WC_Structured_Data::generate_product_data() - 10
							 */
							do_action( 'woocommerce_shop_loop' );
							// wc_get_template_part( 'content', 'product' );

							global $product; ?>
							<div class="k11-prd-itm">
								<?php include get_theme_file_path('/includes/tienda/producto.php');?>
							</div>
						<? 			
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
