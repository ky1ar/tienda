<?php
/**
 * Affiliate Dashboard
 *
 * @author YITH <plugins@yithemes.com>
 * @package YITH\Affiliates\Templates
 * @version 2.0.0
 */

/**
 * Template variables:
 *
 * @var $section string
 * @var $atts    array
 */

if ( ! defined( 'YITH_WCAF' ) ) {
	exit;
} // Exit if accessed directly
?>

<?php
$section = $section ?? 'summary';
$atts    = $atts ?? array();
?>
<style>
   .yith-wcaf.yith-wcaf-dashboard.woocommerce .banner-in{
        width: 100%;
        margin-bottom: 1rem;
   }
   @media only screen and (max-width: 768px) {
       .banner-in{
           content: url(https://tiendakrear3d.com/wp-content/uploads/2024/06/BANNER-2400X800-AFILIADOS-2_11zon.webp);
       }
   }
   
</style>
<div class="yith-wcaf yith-wcaf-dashboard woocommerce">
    <img class="banner-in" src="https://tiendakrear3d.com/wp-content/uploads/2024/06/BANNER-2400X400-AFILIADOS-2_11zon.webp" alt="banner-in">
	<?php
	/**
	 * DO_ACTION: yith_wcaf_before_dashboard
	 *
	 * Allows to render some content before the dashboard section in the Affiliate Dashboard.
	 *
	 * @param string $section Section.
	 * @param array  $atts    Array with section attributes.
	 */
	do_action( 'yith_wcaf_before_dashboard', $section, $atts );
	?>
	<div class="yith-wcaf-section yith-wcaf-dashboard-<?php echo esc_attr( $section ); ?>">
		<?php
		/**
		 * DO_ACTION: yith_wcaf_dashboard_content
		 *
		 * Allows to output section content in the Affiliate Dashboard.
		 *
		 * @param string $section Section.
		 * @param array  $atts    Array with section attributes.
		 */
		do_action( 'yith_wcaf_dashboard_content', $section, $atts );
		?>
	</div>

	<?php
	/**
	 * DO_ACTION: yith_wcaf_after_dashboard
	 *
	 * Allows to render some content after the dashboard section in the Affiliate Dashboard.
	 *
	 * @param string $section Section.
	 * @param array  $atts    Array with section attributes.
	 */
	do_action( 'yith_wcaf_after_dashboard', $section, $atts );
	?>
</div>
