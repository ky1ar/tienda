<?php
/**
 * Affiliate Link Generator
 *
 * @author YITH <plugins@yithemes.com>
 * @package YITH\Affiliates\Templates
 * @version 2.0.0
 */

/**
 * Template variables:
 *
 * @var $affiliate      YITH_WCAF_Affiliate
 * @var $generated_url  string
 * @var $original_url   string
 * @var $share_enabled  bool
 * @var $atts           array
 * @var $share_atts     array
 */

if ( ! defined( 'YITH_WCAF' ) ) {
	exit;
} // Exit if accessed directly


// Obtener el nombre de usuario actual
$current_user = wp_get_current_user();
$first_name = $current_user->first_name;
?>

<div class="yith-wcaf yith-wcaf-link-generator woocommerce">

	<?php
	/**
	 * DO_ACTION: yith_wcaf_before_dashboard_section
	 *
	 * Allows to render some content before the section in the Affiliate Dashboard.
	 *
	 * @param string $section Section.
	 * @param array  $atts    Array with section attributes.
	 */
	//do_action( 'yith_wcaf_before_dashboard_section', 'generate-link', $atts );
	?>

	<?php
	/**
	 * DO_ACTION: yith_wcaf_before_link_generator
	 *
	 * Allows to render some content before the referral link generator in the Affiliate Dashboard.
	 *
	 * @param array $atts Array with section attributes.
	 */
	//do_action( 'yith_wcaf_before_link_generator', $atts );
	?>
    
	<div class="affiliate-stats kyr-o11-wrp link-generator-box <?php echo $affiliate ? 'double-column' : 'single-column'; ?>">

		<?php if ( $affiliate ) : ?>
			<div class="left affiliate-info">
				<div class="hi">
                    <p>Afiliado</p>
                    <div class="user">
                        <img decoding="async" src="https://tiendakrear3d.com/wp-content/uploads/2024/06/s0.svg" alt="perfil" title="Escritorio del afiliado 1">
                    </div>
                    <h1><?php echo esc_html( $first_name ); ?></h1>
                </div>
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
		<?php endif; ?>

		<div class="right link-generator">
		    
		    <div class="d1">
                <h4>
                <?php echo esc_html_x( 'Your affiliate ID is:', '[FRONTEND] Link generator', 'yith-woocommerce-affiliates' ); ?>
                <span class="regular-text"><?php echo esc_html( $affiliate->get_token() ); ?></span>
                </h4>

                <p class="form-row">
                    <label class="bold-text" for="referral_url"><?php echo esc_html_x( 'Your referral URL is:', '[FRONTEND] Link generator', 'yith-woocommerce-affiliates' ); ?></label>
                    <span class="copy-field-wrapper">
                        <?php
                        /**
                         * APPLY_FILTERS: yith_wcaf_referral_link
                         *
                         * Filters the affiliate's referral link.
                         *
                         * @param string $affiliate_referral_link Affiliate's referral link.
                         */
                        ?>
                        <input type="url" id="referral_url" class="copy-target" value="<?php echo esc_attr( apply_filters( 'yith_wcaf_referral_link', $affiliate->get_referral_url() ) ); ?>" readonly/>
                        <a class="copy-trigger">
                            <img src="https://tiendakrear3d.com/wp-content/uploads/2024/07/copy.webp" alt="" />
                            <?php echo esc_html_x( 'Copy URL', '[FRONTEND] Link generator', 'yith-woocommerce-affiliates' ); ?>
                        </a>
                    </span>
                </p>
                
                <div class="div-small">
                    <small>
                        <?php
                        /**
                         * APPLY_FILTERS: yith_wcaf_link_generator_text
                         *
                         * Filters the text in the link generator.
                         *
                         * @param string $text Text.
                         */
                        echo wp_kses_post( apply_filters( 'yith_wcaf_link_generator_text', _x( 'Copy this URL and use it to redirect users to our Home Page with your affiliate ID.', '[FRONTEND] Link generator', 'yith-woocommerce-affiliates' ) ) );
                        ?>
                    </small>

                    <small>
                        <?php echo wp_kses_post( apply_filters( 'yith_wcaf_link_generator_text', _x( 'If you want to redirect users to a specific page (for example: a product page) use the link generator.', '[FRONTEND] Link generator', 'yith-woocommerce-affiliates' ) ) ); ?>
                    </small>
                </div>
                <?php
                /**
                 * DO_ACTION: yith_wcaf_social_share_template
                 *
                 * Allows to render some content in the section to share the referral URL.
                 *
                 * @param array $atts Array with section attributes.
                 */
                do_action( 'yith_wcaf_social_share_template', $atts );
                ?>

                <?php
                /**
                 * DO_ACTION: yith_wcaf_after_social_share_template
                 *
                 * Allows to render some content after the section to share the referral URL.
                 *
                 * @param array $atts Array with section attributes.
                 */
                do_action( 'yith_wcaf_after_social_share_template', $atts );
                ?>
            </div>
			
            <div class="d2">
                <h4><?php echo esc_html_x( 'Generate a custom URL:', '[FRONTEND] Link generator', 'yith-woocommerce-affiliates' ); ?></h4>
                <form method="post">
                    <?php if ( ! $affiliate ) : ?>
                        <p class="form-row">
                            <label for="username"><?php esc_html_e( 'Username', 'yith-woocommerce-affiliates' ); ?></label>
                            <input type="text" name="username" id="username" class="username" value="<?php echo esc_attr( YITH_WCAF_Form_Handler::get_posted_data( 'username' ) ); ?>" />
                        </p>
                    <?php endif; ?>

                    <p class="form-row">
                        <label for="original_url"><?php esc_html_e( 'Page URL', 'yith-woocommerce-affiliates' ); ?></label>
                        <input type="url" name="original_url" id="original_url" class="origin-url" value="<?php echo esc_attr( $original_url ); ?>" />
                    </p>

                    <p class="form-row">
                        <label for="generated_url"><?php esc_html_e( 'Referral URL', 'yith-woocommerce-affiliates' ); ?></label>
                        <span class="copy-field-wrapper">
                            <input type="url" name="generated_url" id="generated_url" class="copy-target generated-url" value="<?php echo esc_attr( $generated_url ); ?>" readonly />
                            <a class="copy-trigger">
                                <img src="https://tiendakrear3d.com/wp-content/uploads/2024/07/copy.webp" alt="" />
                                <?php echo esc_html_x( 'Copy URL', '[FRONTEND] Link generator', 'yith-woocommerce-affiliates' ); ?>
                            </a>
                        </span>
                    </p>
                </form>
            </div>
		</div>

	</div>

	<?php
	/**
	 * DO_ACTION: yith_wcaf_after_link_generator
	 *
	 * Allows to render some content after the referral link generator in the Affiliate Dashboard.
	 *
	 * @param array $atts Array with section attributes.
	 */
	do_action( 'yith_wcaf_after_link_generator', $atts );
	?>

	<?php
	/**
	 * DO_ACTION: yith_wcaf_after_dashboard_section
	 *
	 * Allows to render some content after the section in the Affiliate Dashboard.
	 *
	 * @param string $section Section.
	 * @param array  $atts    Array with section attributes.
	 */
	do_action( 'yith_wcaf_after_dashboard_section', 'link-generator', $atts );
	?>

</div>
