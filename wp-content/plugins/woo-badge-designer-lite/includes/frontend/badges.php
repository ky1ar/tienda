<?php

defined( 'ABSPATH' ) or die( "No script kiddies please!" );
global $product;
$post_id = $product -> id;
$wobd_advance_option = get_post_meta( $post_id, 'wobd_advance_option', true );
$individual_badges = isset( $wobd_advance_option[ 'wobd_badge_each_position' ] ) ? esc_attr( $wobd_advance_option[ 'wobd_badge_each_position' ] ) : 'none';
if ( $individual_badges != 'none' ) {
    $wobd_post_id = $wobd_advance_option[ 'wobd_badge_each_position' ];
    $wobd_option = get_post_meta( $wobd_post_id, 'wobd_option', true );
    include(WOBD_PATH . 'includes/frontend/badge-content.php');
}
include(WOBD_PATH . 'includes/frontend/custom-design.php');
