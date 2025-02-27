<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.2
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_form' );
?>
<div class="container py-5">
    <div class="cont-main no-border formulario--custom">
        <div class="">
<form method="post" class="woocommerce-ResetPassword lost_reset_password form-general">

	<p><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>

	<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
		<div class="form-group ">
			<label for="user_login" class="has-float-label"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?>
			<input class="woocommerce-Input woocommerce-Input--text input-text  form-control line-g alter" type="text" name="user_login" id="user_login" autocomplete="username" />
			</label>
		</div>
	</p>

	<div class="clear"></div>

	<?php do_action( 'woocommerce_lostpassword_form' ); ?>

	<p class="woocommerce-form-row form-row">
		<input type="hidden" name="wc_reset_password" value="true" />
		<div class="button-submit text-center mt-5">
			<button type="submit" class="woocommerce-Button button btn btn-primary btn-line black" value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>">
				<span class="span_toggle_s">
				<?php esc_html_e( 'Reset password', 'woocommerce' ); ?>
				</span>
				</button>
		</div>
	</p>

	<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

</form>

</div>

</div>

</div>
<?php
do_action( 'woocommerce_after_lost_password_form' );