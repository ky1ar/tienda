<?php

defined( 'ABSPATH' ) or die( "No script kiddies please!" );
$wobd_common_settings = get_option( 'wobd_common_settings' );
$wobd_post_id = $wobd_common_settings[ 'wobd_default_sale_badge' ];
if ( isset( $wobd_post_id ) && $wobd_post_id != 'none' ) {
    $wobd_option = get_post_meta( $wobd_post_id, 'wobd_option', true );
    include(WOBD_PATH . 'includes/frontend/badge-content.php');
}

