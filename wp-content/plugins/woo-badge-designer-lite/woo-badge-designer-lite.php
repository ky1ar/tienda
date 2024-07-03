<?php

defined( 'ABSPATH' ) or die( "No script kiddies please!" );
/**
 * Plugin Name: Badge Designer Lite For Woocommerce
 * Plugin URI:  https://accesspressthemes.com/wordpress-plugins/woo-badge-designer-lite/
 * Description: Badge Designer Lite is your ideal WordPress plugin to transform the default WooCommerce sale badges into more appealing badge designs. This advance plugin helps you add text, image and icon labels to your products in a jiffy. And the labels that can be added via this plugin come in super handy when there is any sale, discount, special features, unique product information.
 * Version:     1.0.6
 * Author:      AccessPress Themes
 * Author URI:  http://accesspressthemes.com/
 * Domain Path: /languages/
 * Text Domain: woo-badge-designer-lite
 * */
if ( ! class_exists( 'WOBD_Class' ) ) {

    class WOBD_Class{

        function __construct(){
            $this -> define_constants();
            $this -> includes();
        }

        /**
         * Define Constants.
         */
        function define_constants(){
            global $wpdb;
            defined( 'WOBD_PATH' ) or define( 'WOBD_PATH', plugin_dir_path( __FILE__ ) );
            defined( 'WOBD_URL' ) or define( 'WOBD_URL', plugin_dir_url( __FILE__ ) );
            defined( 'WOBD_IMG_DIR' ) or define( 'WOBD_IMG_DIR', plugin_dir_url( __FILE__ ) . 'images/' );
            defined( 'WOBD_CSS_DIR' ) or define( 'WOBD_CSS_DIR', plugin_dir_url( __FILE__ ) . 'css/' );
            defined( 'WOBD_JS_DIR' ) or define( 'WOBD_JS_DIR', plugin_dir_url( __FILE__ ) . 'js/' );
            defined( 'WOBD_VERSION' ) or define( 'WOBD_VERSION', '1.0.6' );
            defined( 'WOBD_TD' ) or define( 'WOBD_TD', 'woo-badge-designer-lite' );
        }

        /**
         * Includes all the necessary files
         */
        function includes(){
            include(WOBD_PATH . '/includes/admin/class/wobd-library.php');
            include(WOBD_PATH . '/includes/admin/class/wobd-admin.php');
            include(WOBD_PATH . '/includes/admin/class/wobd-hook.php');
            include(WOBD_PATH . '/includes/admin/class/wobd-enqueue.php');
        }

    }

    $GLOBALS[ 'woo_badges' ] = new WOBD_Class();
    $WOBD_object = new WOBD_Class();
}