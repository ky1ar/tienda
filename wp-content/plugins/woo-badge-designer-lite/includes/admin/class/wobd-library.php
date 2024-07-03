<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );
if ( ! class_exists( 'WOBD_Library' ) ) {

    class WOBD_Library{

        function __construct(){
            add_action( 'save_post', array( $this, 'wobd_settings_save' ) );
            add_action( 'save_post', array( $this, 'wobd_advance_save' ) );
        }

        /**
         * Prints array in pre format
         *
         * @since 1.0.0
         *
         * @param array $array
         */
        function print_array( $array ){
            echo "<pre>";
            print_r( $array );
            echo "</pre>";
        }

        function wobd_settings_save( $post_id ){

// Checks save status
            $is_autosave = wp_is_post_autosave( $post_id );
            $is_revision = wp_is_post_revision( $post_id );

            $is_valid_nonce = ( isset( $_POST[ 'wobd_badge_nonce' ] ) && wp_verify_nonce( $_POST[ 'wobd_badge_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
// Exits script depending on save status
            if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
                return;
            }

            if ( isset( $_POST[ 'wobd_option' ] ) ) {

                $val = $this -> wobd_sanitize_array( $_POST[ 'wobd_option' ] );
// save data
                update_post_meta( $post_id, 'wobd_option', $val );
            }

            return;
        }

        function wobd_advance_save( $post_id ){

// Checks save status
            $is_autosave = wp_is_post_autosave( $post_id );
            $is_revision = wp_is_post_revision( $post_id );

            $is_valid_nonce = ( isset( $_POST[ 'wobd_badge_nonce' ] ) && wp_verify_nonce( $_POST[ 'wobd_badge_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
// Exits script depending on save status
            if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
                return;
            }

            if ( isset( $_POST[ 'wobd_advance_option' ] ) ) {

                $val = $this -> wobd_sanitize_array( $_POST[ 'wobd_advance_option' ] );
// save data
                update_post_meta( $post_id, 'wobd_advance_option', $val );
            }

            return;
        }

        /**
         * Sanitizes Multi Dimensional Array
         * @param array $array
         * @param array $sanitize_rule
         * @return array
         *
         * @since 1.0.0
         */
        function wobd_sanitize_array( $array = array(), $sanitize_rule = array() ){
            if ( ! is_array( $array ) || count( $array ) == 0 ) {
                return array();
            }

            foreach ( $array as $k => $v ) {
                if ( ! is_array( $v ) ) {

                    $default_sanitize_rule = (is_numeric( $k )) ? 'html' : 'text';
                    $sanitize_type = isset( $sanitize_rule[ $k ] ) ? $sanitize_rule[ $k ] : $default_sanitize_rule;
                    $array[ $k ] = $this -> wobd_sanitize_value( $v, $sanitize_type );
                }
                if ( is_array( $v ) ) {
                    $array[ $k ] = $this -> wobd_sanitize_array( $v, $sanitize_rule );
                }
            }

            return $array;
        }

        /**
         * Sanitizes Value
         *
         * @param type $value
         * @param type $sanitize_type
         * @return string
         *
         * @since 1.0.0
         */
        function wobd_sanitize_value( $value = '', $sanitize_type = 'text' ){
            switch ( $sanitize_type ) {
                case 'html':
                    $allowed_html = wp_kses_allowed_html( 'post' );
                    return wp_kses( $value, $allowed_html );
                    break;
                default:
                    return sanitize_text_field( $value );
                    break;
            }
        }

    }

    new WOBD_Library();
}