<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header( '' ); ?>

<div id="kyr-o11-prd" class="kyr-o11-wrp">	
	<?php
	do_action( 'woocommerce_before_main_content' );
	
	while ( have_posts() ) {
		the_post(); 
		wc_get_template_part( 'content', 'single-product' ); 
	}
	include get_theme_file_path('/includes/tienda/producto/descripcion.php');
	include get_theme_file_path('/includes/tienda/producto/galeria.php');
	?>

	
			<?php
			do_action( 'woocommerce_after_main_content' );
			do_action( 'woocommerce_simple_after_main_content' );
			?>
	
			
</div>
<?php 
include get_theme_file_path('/includes/tienda/producto/relacionados.php');
get_footer( '' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */