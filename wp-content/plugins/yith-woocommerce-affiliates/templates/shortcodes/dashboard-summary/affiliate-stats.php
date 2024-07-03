<?php
/**
 * Affiliate Dashboard Summary - Stats
 *
 * @author YITH <plugins@yithemes.com>
 * @package YITH\Affiliates\Templates
 * @version 2.0.0
 */

/**
 * Template variables:
 *
 * @var $affiliate                YITH_WCAF_Affiliate
 * @var $show_commissions_summary bool
 * @var $number_of_commissions    int
 * @var $show_clicks_summary      bool
 * @var $number_of_clicks         int
 * @var $show_referral_stats      bool
 * @var $clicks                   YITH_WCAF_Clicks_Collection
 * @var $commissions              YITH_WCAF_Commissions_Collection
 */

if ( ! defined( 'YITH_WCAF' ) ) {
	exit;
} // Exit if accessed directly

if ( ! $affiliate || ! $affiliate instanceof YITH_WCAF_Affiliate ) {
	return;
}
$current_user = wp_get_current_user();
$first_name = $current_user->first_name;
?>

<!--AFFILIATE STATS-->
<div class="affiliate-stats kyr-o11-wrp">
    
    <div class="left">
        <div class="hi">
            <p>Afiliado</p>
            <div class="user">
                <img src="https://tiendakrear3d.com/wp-content/uploads/2024/06/s0.svg" alt="perfil" />
            </div>
            <h1><?php echo esc_html( $first_name ); ?></h1>
        </div>
        <?php
        if ( ! yith_plugin_fw_is_true( $show_dashboard_links ) ) {
        	return;
        }
        
        $current_endpoint = YITH_WCAF_Dashboard::get_current_dashboard_endpoint();
        ?>
        <script>
            $(document).ready(function(){
                // Obtener la URL actual de la página
                var currentUrl = window.location.href;
        
                // Recorrer cada enlace y comparar con la URL actual
                $('.yith-wcaf-dashboard-navigation-item a').each(function(){
                    var linkUrl = $(this).attr('href');
                    
                    // Si la URL del enlace coincide con la URL actual
                    if(linkUrl === currentUrl){
                        // Agregar la clase 'is-active' al elemento padre del enlace
                        $(this).parent('.yith-wcaf-dashboard-navigation-item').addClass('is-active');
                    }
                });
            });
        </script>
        <ul class="yith-wcaf-dashboard-navigation">
        	<?php foreach ( YITH_WCAF_Dashboard()->get_dashboard_navigation_menu() as $endpoint => $endpoint_options ) : ?>
        		<li class="yith-wcaf-dashboard-navigation-item <?php echo esc_attr( $endpoint ); ?> <?php echo $endpoint_options['active'] ? 'is-active' : ''; ?>">
        			<a href="<?php echo esc_attr( $endpoint_options['url'] ); ?>">
        				<?php echo esc_html( $endpoint_options['label'] ); ?>
        			</a>
        		</li>
        	<?php endforeach; ?>
        </ul>
    </div>
    
    <div class="right">
    	<div class="stat-box">
    		<div class="stat-item large total">
    			<span class="stat-label">
    				<?php echo esc_html_x( 'Total earnings', '[FRONTEND] Affiliate dashboard', 'yith-woocommerce-affiliates' ); ?>
    			</span>
    			<span class="stat-value">
    				<?php echo wp_kses_post( wc_price( $affiliate->get_earnings() ) ); ?>
    			</span>
    		</div>
    		
    		<div class="tb">
                <table>
                    <tr>
                        <th><?php echo esc_html_x( 'Total paid', '[FRONTEND] Affiliate dashboard', 'yith-woocommerce-affiliates' ); ?></th>
                        <td><?php echo wp_kses_post( wc_price( $affiliate->get_paid() ) ); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo esc_html_x( 'Total refunded', '[FRONTEND] Affiliate dashboard', 'yith-woocommerce-affiliates' ); ?></th>
                        <td><?php echo wp_kses_post( wc_price( $affiliate->get_refunds() ) ); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo esc_html_x( 'Balance', '[FRONTEND] Affiliate dashboard', 'yith-woocommerce-affiliates' ); ?></th>
                        <td><?php echo wp_kses_post( wc_price( $affiliate->get_balance() ) ); ?></td>
                    </tr>
                </table>
            </div>
    	</div>
    
    	<div class="d">
            <div class="data">
                <p><?php echo esc_html_x( 'Commission rate', '[FRONTEND] Affiliate dashboard', 'yith-woocommerce-affiliates' ); ?></p>
                <h1><?php echo esc_html( yith_wcaf_get_formatted_rate( $affiliate ) ); ?></h1>
            </div>
            <div class="data">
                <p><?php echo esc_html_x( 'Conversion rate', '[FRONTEND] Affiliate dashboard', 'yith-woocommerce-affiliates' ); ?></p>
                <h1><?php echo esc_html( yith_wcaf_rate_format( $affiliate->get_conversion_rate() ) ); ?></h1>
            </div>
        
            <?php if ( $show_clicks_summary ) : ?>
            <div class="data">
                <p><?php echo esc_html_x( 'Visits', '[FRONTEND] Affiliate dashboard', 'yith-woocommerce-affiliates' ); ?></p>
                <h1><?php echo esc_html( yith_wcaf_number_format( $affiliate->get_clicks_count() ) ); ?></h1>
            </div>
            <div class="data">
                <p><?php echo esc_html_x( 'Visits today', '[FRONTEND] Affiliate dashboard', 'yith-woocommerce-affiliates' ); ?></p>
                <h1><?php echo esc_html( yith_wcaf_number_format( $affiliate->count_clicks( array( 'interval' => array( 'start_date' => gmdate( 'Y-m-d 00:00:00' ) ) ) ) ) ); ?></h1>
            </div>
            <?php endif; ?>
        </div>
    </div>

</div>
