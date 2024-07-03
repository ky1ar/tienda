<?php

add_action('wp_enqueue_scripts', 'template_scripts');

add_action( 'wp_print_styles', function() {
    if (!is_admin_bar_showing()) wp_deregister_style( 'dashicons' );
}, 100);


function template_scripts() {
  
	wp_enqueue_style('Kylar11 CSS', get_template_directory_uri() . '/library/css/kylar11.css?v=12.79', 'null', 'false', 'all');
	
	wp_enqueue_style('ky1ar CSS', get_template_directory_uri() . '/library/css/ky1ar.css?v=1.26', 'null', 'true', 'all');
	wp_enqueue_style('ky1ar Responsive CSS', get_template_directory_uri() . '/library/css/responsive.css?v=1.20', 'null', 'true', 'all');
	
    wp_enqueue_style('IZItoast CSS', get_template_directory_uri() . '/library/css/iziToast.min.css', 'null', 'false', 'all');
    wp_enqueue_script('IziToast', get_template_directory_uri() . '/library/js/iziToast.min.js', array('jquery'), 'false', 'false');
	
	wp_enqueue_style('Swiffy-css', get_template_directory_uri() . '/library/css/swiffy-slider.min.css', 'null', 'false', 'all');
	wp_enqueue_script('Swiffy-js', get_template_directory_uri() . '/library/js/swiffy-slider.min.js', array('jquery'), 'false', 'false');
	wp_enqueue_script('Swiffy-jsex', '//cdn.jsdelivr.net/npm/swiffy-slider@1.6.0/dist/js/swiffy-slider-extensions.min.js', array('jquery'), 'false', 'false');
	
    wp_enqueue_style('fancybox CSS', get_template_directory_uri() . '/library/css/jquery.fancybox.min.css', 'null', 'false', 'all');
    wp_enqueue_script('fancybox JS', get_template_directory_uri() . '/library/js/jquery.fancybox.min.js', array('jquery'), 'false', 'false');

    wp_enqueue_script('Themes JS', get_template_directory_uri() . '/library/js/ky1ar.js?v=1.6', array('jquery'), 'false', 'false');
    wp_localize_script('Themes JS', 'ajax_option', array(
        'ajaxurl'        => admin_url('admin-ajax.php'),
        'home_url'       => home_url(),
        'products'       => null,
        'loadingmessage' => __('Enviando información'),
        'cart_nonce'     => wp_nonce_field('ajax-cart-nonce', "_wpnonce", true, false),
    ));
}

add_action('init', 'mis_menus');

function mis_menus() {
    register_nav_menus(
        array(
            'navegation' => __('Menú de navegación'),
        )
    );
}
add_action('after_setup_theme', 'support_woocommerce_theme');

function support_woocommerce_theme() {
    add_theme_support('woocommerce');
    // add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}

add_action('widgets_init', 'dcms_widget_footer_1');

function dcms_widget_footer_1() {

    register_sidebar(array(

        'name'          => 'Columna footer',

        'id'            => 'widget-footer-1',

        'description'   => 'Área para las widget en el footer',

        'before_widget' => '<section id="%1$s" class="widget %2$s con_tew-widget-area con_tew"><div class="cont-filter-brand filter-cl">',

        'after_widget'  => '</div></section>',

        'before_title'  => '<b>',

        'after_title'   => '</b>',

    ));

}

add_action('widgets_init', 'dcms_widget_footer_2');

function dcms_widget_footer_2() {

    register_sidebar(array(

        'name'          => 'Columna footer',

        'id'            => 'widget-footer-2',

        'description'   => 'Área para las widget en el footer',

        'before_widget' => '<section id="%1$s" class="widget %2$s con_tew-widget-area con_tew"><div class="cont-filter-brand filter-cl">',

        'after_widget'  => '</div></section>',

        'before_title'  => '<b>',

        'after_title'   => '</b>',

    ));

}

add_action('widgets_init', 'dcms_widget_footer_3');

function dcms_widget_footer_3() {

    register_sidebar(array(

        'name'          => 'Columna footer',

        'id'            => 'widget-footer-3',

        'description'   => 'Área para las widget en el footer',

        'before_widget' => '<section id="%1$s" class="widget %2$s con_tew-widget-area con_tew"><div class="cont-filter-brand filter-cl">',

        'after_widget'  => '</div></section>',

        'before_title'  => '<b>',

        'after_title'   => '</b>',

    ));

}

add_action('widgets_init', 'dcms_widget_filter_products_archive');

function dcms_widget_filter_products_archive() {

    register_sidebar(array(

        'name'          => 'Columna filtros para productos',

        'id'            => 'sidebar-filter-produts',

        'description'   => 'Área para las widget en la tienda',

        'before_widget' => '<section id="%1$s" class="widget %2$s con_tew-widget-area con_tew"><div class="cont-filter-brand filter-cl">',

        'after_widget'  => '</div></section>',

        'before_title'  => '<b>',

        'after_title'   => '</b>',

    ));

}

function my_acf_init() {

    acf_update_setting('google_api_key', 'AIzaSyAyPrqZb9nl5EJhvnxMhnZ1Y0lLIUbKe8I');
}

add_action('acf/init', 'my_acf_init');



/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter('loop_shop_per_page', 'new_loop_shop_per_page', 20);

function new_loop_shop_per_page($cols) {
    // $cols contains the current number of products per page based on the value stored on Options -> Reading
    // Return the number of products you wanna show per page.
    $cols = 24;
    return $cols;
}

remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
add_action('woocommerce_simple_after_main_content', 'woocommerce_output_product_data_tabs', 60);

// Change Facebook for WooCommerce feed generation interval
add_filter('wc_facebook_feed_generation_interval', function () {return HOUR_IN_SECONDS * 24;});

// Clear Action Scheduler Weekly
add_filter('action_scheduler_retention_period', 'wpb_action_scheduler_purge');
function wpb_action_scheduler_purge() {
    return WEEK_IN_SECONDS;
}

function randomString() {
    return uniqid('krear_');
}

add_filter('woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1);

function iconic_cart_count_fragments($fragments) {

    $fragments['div.bot-crt-bbb'] = '<div class="bot-crt-bbb">' . WC()->cart->get_cart_contents_count() . '</div>';

    return $fragments;

}

function remove_category($string, $type) {
    if ($type != 'single' && $type == 'category' && (strpos($string, 'category') !== false)) {
        $url_without_category = str_replace("/category/", "/", $string);
        return trailingslashit($url_without_category);
    }

    return $string;
}
// add_filter('user_trailingslashit', 'remove_category', 100, 2);




function woocommerce_maybe_add_multiple_products_to_cart() {
	// Make sure WC is installed, and add-to-cart qauery arg exists, and contains at least one comma.
	if ( ! class_exists( 'WC_Form_Handler' ) || empty( $_REQUEST['add-to-cart'] ) || false === strpos( $_REQUEST['add-to-cart'], ',' ) ) {
		return;
	}
	// Remove WooCommerce's hook, as it's useless (doesn't handle multiple products).
	remove_action( 'wp_loaded', array( 'WC_Form_Handler', 'add_to_cart_action' ), 20 );

	$product_ids = explode( ',', $_REQUEST['add-to-cart'] );
	$count       = count( $product_ids );
	$number      = 0;

	foreach ( $product_ids as $product_id ) {
		if ( ++$number === $count ) {
			// Ok, final item, let's send it back to woocommerce's add_to_cart_action method for handling.
			$_REQUEST['add-to-cart'] = $product_id;

			return WC_Form_Handler::add_to_cart_action();
		}

		$product_id        = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $product_id ) );
		$was_added_to_cart = false;
		$adding_to_cart    = wc_get_product( $product_id );

		if ( ! $adding_to_cart ) {
			continue;
		}

		$add_to_cart_handler = apply_filters( 'woocommerce_add_to_cart_handler', $adding_to_cart->product_type, $adding_to_cart );

		/*
		 * Sorry.. if you want non-simple products, you're on your own.
		 *
		 * Related: WooCommerce has set the following methods as private:
		 * WC_Form_Handler::add_to_cart_handler_variable(),
		 * WC_Form_Handler::add_to_cart_handler_grouped(),
		 * WC_Form_Handler::add_to_cart_handler_simple()
		 *
		 * Why you gotta be like that WooCommerce?
		 */
		if ( 'simple' !== $add_to_cart_handler ) {
			continue;
		}

		// For now, quantity applies to all products.. This could be changed easily enough, but I didn't need this feature.
		$quantity          = empty( $_REQUEST['quantity'] ) ? 1 : wc_stock_amount( $_REQUEST['quantity'] );
		$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

		if ( $passed_validation && false !== WC()->cart->add_to_cart( $product_id, $quantity ) ) {
			wc_add_to_cart_message( array( $product_id => $quantity ), true );
		}
	}
}

 // Fire before the WC_Form_Handler::add_to_cart_action callback.
 add_action( 'wp_loaded',        'woocommerce_maybe_add_multiple_products_to_cart', 15 );




// DISBLE CSS KYRO11
add_filter('use_block_editor_for_post_type', '__return_false', 10);
add_action( 'wp_enqueue_scripts', 'remove_block_css', 100 );

function remove_block_css() {
	wp_dequeue_style( 'wp-block-library' ); // Wordpress core
	wp_dequeue_style( 'wp-block-library-theme' ); // Wordpress core
	wp_dequeue_style( 'wc-block-style' ); // WooCommerce
	wp_dequeue_style( 'storefront-gutenberg-blocks' ); // Storefront theme
}

add_action( 'wp_enqueue_scripts', 'remove_global_styles' );
function remove_global_styles(){
    wp_dequeue_style( 'global-styles' );
}


add_filter( 'woocommerce_cart_item_name', 'quadlayers_product_image_checkout', 9999, 3 ); 
function quadlayers_product_image_checkout ( $name, $cart_item, $cart_item_key ) {
    if ( ! is_checkout() ) 
        {return $name;}
    $product = $cart_item['data'];
    $thumbnail = $product->get_image( array( '50', '50' ), array( 'class' => 'alignleft' ) ); 
    /*Above you can change the thumbnail size by changing array values e.g. array(‘100’, ‘100’) and also change alignment to alignright*/
    return $thumbnail . $name;
}




