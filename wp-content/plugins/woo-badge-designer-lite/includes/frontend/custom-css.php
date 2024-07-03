<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );
if ( isset( $wobd_option[ 'wobd_enable_custom_design' ] ) && $wobd_option[ 'wobd_enable_custom_design' ] == '1' ) {
    $title_color = $wobd_option[ 'wobd_text_color' ];
    $background_color = isset( $wobd_option[ 'wobd_background_color' ] ) ? esc_attr( $wobd_option[ 'wobd_background_color' ] ) : '#fff';
    $corner_bg_color = isset( $wobd_option[ 'wobd_corner_background_color' ] ) ? esc_attr( $wobd_option[ 'wobd_corner_background_color' ] ) : '#fff';
    $font_size = isset( $wobd_option[ 'wobd_font_size' ] ) ? esc_attr( $wobd_option[ 'wobd_font_size' ] ) : '15';
    $image_size = isset( $wobd_option[ 'wobd_image_size' ] ) ? esc_attr( $wobd_option[ 'wobd_image_size' ] ) : '90';
    
}
