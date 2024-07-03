<?php
/**
 * Affiliate Dashboard - Settings
 *
 * @author  YITH <plugins@yithemes.com>
 * @package YITH\Affiliates\Templates
 * @version 2.0.0
 */

/**
 * Template variables:
 *
 * @var $section      string
 * @var $atts         array
 * @var $affiliate    YITH_WCAF_Affiliate
 */

if ( ! defined( 'YITH_WCAF' ) ) {
	exit;
} // Exit if accessed directly
?>

<?php
/**
 * DO_ACTION: yith_wcaf_before_dashboard_section
 *
 * Allows to render some content before the section in the Affiliate Dashboard.
 *
 * @param string $section Section.
 * @param array  $atts    Array with section attributes.
 */
do_action( 'yith_wcaf_before_dashboard_section', 'settings', $atts );
?>

<form method="post" class="yith_wcaf_settings_box">

	<div class="settings-box single-column">

		<?php
		/**
		 * DO_ACTION: yith_wcaf_settings_form_start
		 *
		 * Allows to render some content before the settings section in the Affiliate Dashboard.
		 */
		do_action( 'yith_wcaf_settings_form_start' );
		?>

		<?php
		/**
		 * APPLY_FILTERS: yith_wcaf_payment_email_required
		 *
		 * Filters whether the payment email field is required.
		 *
		 * @param bool $is_payment_email_required Whether payment email is required or not.
		 */
		if ( apply_filters( 'yith_wcaf_payment_email_required', true ) ) :
			?>
			<div class="settings-box">
				<h3><?php echo esc_html_x( 'Payment info', '[FRONTEND] Dashboard Settings', 'yith-woocommerce-affiliates' ); ?></h3>

				
			</div>
		<?php endif; ?>

		<?php
		/**
		 * DO_ACTION: yith_wcaf_settings_form_after_payment_email
		 *
		 * Allows to render some content after the payment email in the settings form in the Affiliate Dashboard.
		 */
		do_action( 'yith_wcaf_settings_form_after_payment_email' );
		?>

		<?php
		/**
		 * DO_ACTION: yith_wcaf_settings_form_before_additional_info
		 *
		 * Allows to render some content before the additional info in the settings form in the Affiliate Dashboard.
		 */
		do_action( 'yith_wcaf_settings_form_before_additional_info' );
		?>

		<?php
		/**
		 * DO_ACTION: yith_wcaf_settings_form_after_additional_info
		 *
		 * Allows to render some content after the additional info in the settings form in the Affiliate Dashboard.
		 */
		do_action( 'yith_wcaf_settings_form_after_additional_info' );
		?>

		<?php
		/**
		 * DO_ACTION: yith_wcaf_settings_form
		 *
		 * Allows to render some content in the settings form in the Affiliate Dashboard.
		 */
		do_action( 'yith_wcaf_settings_form' );
		?>

	</div>

	<?php wp_nonce_field( 'yith-wcaf-save-affiliate-settings', 'save_affiliate_settings' ); ?>

	<input type="submit" id="wcaf_settings_submit" name="settings_submit" value="<?php echo esc_attr_x( 'Guardar', '[FRONTEND] Dashboard Settings', 'yith-woocommerce-affiliates' ); ?>"/>
</div>
</form>

<?php
/**
 * DO_ACTION: yith_wcaf_after_dashboard_section
 *
 * Allows to render some content after the section in the Affiliate Dashboard.
 *
 * @param string $section Section.
 * @param array  $atts    Array with section attributes.
 */
do_action( 'yith_wcaf_after_dashboard_section', 'settings', $atts );
