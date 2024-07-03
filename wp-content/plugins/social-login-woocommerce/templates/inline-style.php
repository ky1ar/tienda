<?php
/**
 * Responsible for settings styling
 *
 * This template can be overridden by copying it to yourtheme/templates/social-login-woocommerce/inline-style.php.
 *
 * HOWEVER, on occasion we will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen.
 * @see     https://docs.xootix.com/easy-login-woocommerce/
 * @version 1.1
 */


$settings 	= xoo_sl_helper()->get_general_option();
$btnRow 	= esc_html( $settings['gl-btn-layout'] );

?>


<?php if( $btnRow === 'one_line' ): ?>

	.xoo-sl-btns-container{
		display: flex;
		align-items: center;
		justify-content: center;
		flex-wrap: wrap;
	}

	.xoo-sl-button{
		margin-right: 10px;
	}

<?php else: ?>

	.xoo-sl-btns-container{
		display: table;
		margin: 0 auto;
	}

	.xoo-sl-button{
		margin: 10px auto;
		display: table;
	}

<?php endif; ?>
