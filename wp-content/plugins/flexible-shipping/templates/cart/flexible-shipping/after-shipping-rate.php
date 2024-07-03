<?php
/**
 * Checkout before customer details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/flexible-shipping/after_shipping_rate.php
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<p class="shipping-method-description">
	<?php 
    	$kyr_fnd = ['_','{','}'];
        $kyr_chr =['<br>','<a target="_blank" style="color: #000; font-weight: 600;" href="/terminos/politicas-de-envios-lima-y-provincias/">','</a>'];
        echo str_replace($kyr_fnd,$kyr_chr,esc_html( $method_description ));
	?>
</p>
