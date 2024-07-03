<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */
defined( 'ABSPATH' ) || exit;
/*
 * @hooked wc_empty_cart_message - 10
 */?>

<div class="k11-emp-crt">
	 <div class="kyr-o11-wrp kyr-o11-flx">
		 <?php do_action( 'woocommerce_cart_is_empty' );
		 if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
			<img src="/wp-content/uploads/kyro11/svg/ect.svg">	
			<p>Añade algo y regresa</p>
			<a href="/productos/impresoras3d"><?php esc_html_e( 'Return to shop', 'woocommerce' ); ?></a>
		<?php endif; ?>
	</div>
</div>