<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );
if ( ! class_exists( 'WOBD_Enqueue' ) ) {

    class WOBD_Enqueue{

        /**
         * Enqueue all the necessary JS and CSS
         *
         * since @1.0.0
         */
        function __construct(){
            add_action( 'admin_enqueue_scripts', array( $this, 'wobd_register_admin_assets' ) );
            add_action( 'wp_enqueue_scripts', array( $this, 'wobd_register_frontend_assets' ) );
        }

        function wobd_register_admin_assets( $hook ){
            //wp_enqueue_style( 'wobd-font', '//fonts.googleapis.com/css?family=Lato:300,400,700,900|Montserrat', false );
            wp_enqueue_script( 'wobd-alpha-color', WOBD_JS_DIR . '/wp-color-picker-alpha.min.js', array( 'jquery', 'wp-color-picker' ), WOBD_VERSION );
            wp_enqueue_script( 'wobd-iconpicker', WOBD_JS_DIR . '/icon-picker.js', array( 'jquery' ), WOBD_VERSION );
            wp_enqueue_script( 'wobd-admin-script', WOBD_JS_DIR . '/wobd-backend.js', array( 'jquery', 'wp-color-picker', 'wobd-alpha-color', 'wobd-iconpicker' ), WOBD_VERSION );
            wp_enqueue_style( 'elegant-icons', WOBD_CSS_DIR . '/elegant-icons.css', false, WOBD_VERSION );
            wp_enqueue_style( 'linear-style', WOBD_CSS_DIR . '/linear-style.css', false, WOBD_VERSION );
            wp_enqueue_style( 'wobd-iconpicker-style', WOBD_CSS_DIR . '/icon-picker.css', false, WOBD_VERSION );
            wp_enqueue_style( 'wobd-fontawesome-style', WOBD_CSS_DIR . '/font-awesome.min.css', false, WOBD_VERSION );
            wp_enqueue_style( 'wobd-fontawesome1-style', WOBD_CSS_DIR . '/fontawesome.css', false, WOBD_VERSION );
            wp_enqueue_style( 'wobd-fa-brands-style', WOBD_CSS_DIR . '/fa-brands.css', false, WOBD_VERSION );
            wp_enqueue_style( 'wobd-fa-regular-style', WOBD_CSS_DIR . '/fa-regular.css', false, WOBD_VERSION );
            wp_enqueue_style( 'wobd-fa-solid-style', WOBD_CSS_DIR . '/fa-solid.css', false, WOBD_VERSION );
            wp_enqueue_style( 'wobd-jqueryui-style', WOBD_CSS_DIR . '/jquery-ui.css', false, WOBD_VERSION );
            wp_enqueue_style( 'wobd-preview-style', WOBD_CSS_DIR . 'wobd-frontend.css', false, WOBD_VERSION );
            wp_enqueue_media();
            wp_enqueue_style( 'wobd-backend-style', WOBD_CSS_DIR . '/wobd-backend.css', false, WOBD_VERSION );
        }

        function wobd_register_frontend_assets( $hook ){
            //wp_enqueue_style( 'wobd-font', '//fonts.googleapis.com/css?family=Lato:300,400,700,900|Montserrat', false );
            wp_enqueue_script( 'wobd-frontend-script', WOBD_JS_DIR . 'wobd-frontend.js', array( 'jquery' ), WOBD_VERSION );
            //wp_enqueue_style( 'wobd-fontawesome-style', WOBD_CSS_DIR . '/font-awesome.min.css', false, WOBD_VERSION );
            //wp_enqueue_style( 'wobd-fontawesome1-style', WOBD_CSS_DIR . '/fontawesome.css', false, WOBD_VERSION );
            //wp_enqueue_style( 'wobd-fa-brands-style', WOBD_CSS_DIR . '/fa-brands.css', false, WOBD_VERSION );
            //wp_enqueue_style( 'wobd-fa-regular-style', WOBD_CSS_DIR . '/fa-regular.css', false, WOBD_VERSION );
            //wp_enqueue_style( 'wobd-fa-solid-style', WOBD_CSS_DIR . '/fa-solid.css', false, WOBD_VERSION );
            //wp_enqueue_style( 'elegant-icons', WOBD_CSS_DIR . '/elegant-icons.css', false, WOBD_VERSION );
            //wp_enqueue_style( 'linear-style', WOBD_CSS_DIR . '/linear-style.css', false, WOBD_VERSION );
            //wp_enqueue_style( 'wobd-frontend-style', WOBD_CSS_DIR . 'wobd-frontend.css', false, WOBD_VERSION );
            $frontend_ajax_nonce = wp_create_nonce( 'wobd-frontend-ajax-nonce' );
            $frontend_ajax_object = array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'ajax_nonce' => $frontend_ajax_nonce );
            wp_localize_script( 'wobd-frontend-script', 'wobd_frontend_js_params', $frontend_ajax_object );
        }

    }

    new WOBD_Enqueue();
}
