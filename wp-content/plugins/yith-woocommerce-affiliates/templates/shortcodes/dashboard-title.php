<?php
/**
 * Affiliate Title
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
 * @var $title   string
 */

if ( ! defined( 'YITH_WCAF' ) ) {
	exit;
} // Exit if accessed directly


// Obtener el nombre de usuario actual
$current_user = wp_get_current_user();
$first_name = $current_user->first_name;
?>
<div class="affiliate-stats kyr-o11-wrp">
    <div class="left">
        <div class="hi">
            <p>Afiliado</p>
            <div class="user">
                <img decoding="async" src="https://tiendakrear3d.com/wp-content/uploads/2024/06/s0.svg" alt="perfil" title="Escritorio del afiliado 1">
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
