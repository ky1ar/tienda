<?php

defined( 'ABSPATH' ) or die( "No script kiddies please!" );
include(WOBD_PATH . 'includes/frontend/template/icon-template.php');
if ( isset( $wobd_option[ 'badge_text' ] ) ) {
    echo esc_attr( $wobd_option[ 'badge_text' ] );
}

