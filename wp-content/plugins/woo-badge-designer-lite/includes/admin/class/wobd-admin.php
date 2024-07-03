<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );
if ( ! class_exists( 'WOBD_Admin' ) ) {

    class WOBD_Admin extends WOBD_Library{

        /**
         * Includes all the backend functionality
         *
         * @since 1.0.0
         */
        function __construct(){

            add_action( 'admin_menu', array( $this, 'wobd_register_menu' ) );
            add_action( 'init', array( $this, 'wobd_register_custom_post' ) );
            add_filter( 'admin_footer_text', array( $this, 'wobd_admin_footer_text' ) );
            add_filter( 'plugin_row_meta', array( $this, 'wobd_plugin_row_meta' ), 10, 2 );
            add_action( 'admin_init', array( $this, 'wobd_redirect_to_site' ), 1 );
        }

        function wobd_register_custom_post(){
            include(WOBD_PATH . 'includes/admin/view/wobd-post-action.php');
        }

        function wobd_register_menu(){
            add_submenu_page( 'edit.php?post_type=wobd-badge-designer', __( 'Settings', WOBD_TD ), __( 'Settings', WOBD_TD ), 'manage_options', 'wobd-badges-settings', array( $this, 'wobd_badge_settings' ) );
            add_submenu_page( 'edit.php?post_type=wobd-badge-designer', __( 'About The Plugin', WOBD_TD ), __( 'About The Plugin', WOBD_TD ), 'manage_options', 'wobd-about-us', array( $this, 'wobd_about_us' ) );
            add_submenu_page( 'edit.php?post_type=wobd-badge-designer', __( 'Documentation', WOBD_TD ), __( 'Documentation', WOBD_TD ), 'manage_options', 'wobd-documentation-wp', '__return_false', null, 9 );
            add_submenu_page( 'edit.php?post_type=wobd-badge-designer', __( 'Check Premium Version', WOBD_TD ), __( 'Check Premium Version', WOBD_TD ), 'manage_options', 'wobd-premium-wp', '__return_false', null, 9 );
        }

        function wobd_badge_settings(){
            include(WOBD_PATH . 'includes/admin/view/settings/wobd-common-settings.php');
        }

        function wobd_about_us(){
            include(WOBD_PATH . 'includes/admin/view/page/about.php');
        }

        function wobd_redirect_to_site(){
            if ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == 'wobd-documentation-wp' ) {
                wp_redirect( 'https://accesspressthemes.com/documentation/woo-badge-designer-lite/' );
                exit();
            }
            if ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] == 'wobd-premium-wp' ) {
                wp_redirect( 'https://accesspressthemes.com/wordpress-plugins/woo-badge-designer/' );
                exit();
            }
        }

        function wobd_admin_footer_text( $text ){
            global $post;
            if ( (isset( $_GET[ 'post_type' ] ) && $_GET[ 'post_type' ] == 'wobd-badge-designer' ) ) {
                $link = 'https://wordpress.org/support/plugin/woo-badge-designer-lite/reviews/#new-post';
                $pro_link = 'https://accesspressthemes.com/wordpress-plugins/woo-badge-designer/';
                $text = 'Enjoyed Badge Designer Lite For WooCommerce? <a href="' . $link . '" target="_blank">Please leave us a ★★★★★ rating</a> We really appreciate your support! | Try premium version of <a href="' . $pro_link . '" target="_blank">Woo Badge Designer</a> - more features, more power!';
                return $text;
            } else {
                return $text;
            }
        }

        function wobd_plugin_row_meta( $links, $file ){

            if ( strpos( $file, 'woo-badge-designer-lite.php' ) !== false ) {
                $new_links = array(
                    'demo' => '<a href="http://demo.accesspressthemes.com/wordpress-plugins/woo-badge-designer-lite" target="_blank"><span class="dashicons dashicons-welcome-view-site"></span>Live Demo</a>',
                    'doc' => '<a href="https://accesspressthemes.com/documentation/woo-badge-designer-lite/" target="_blank"><span class="dashicons dashicons-media-document"></span>Documentation</a>',
                    'support' => '<a href="http://accesspressthemes.com/support" target="_blank"><span class="dashicons dashicons-admin-users"></span>Support</a>',
                    'pro' => '<a href="https://accesspressthemes.com/wordpress-plugins/woo-badge-designer/" target="_blank"><span class="dashicons dashicons-cart"></span>Premium version</a>'
                );

                $links = array_merge( $links, $new_links );
            }

            return $links;
        }

    }

    new WOBD_Admin();
}