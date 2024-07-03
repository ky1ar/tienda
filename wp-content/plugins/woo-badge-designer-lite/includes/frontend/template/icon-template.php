<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );
if ( ! empty( $wobd_option[ 'badge_icon' ] ) ) {
    $v = explode( '|', $wobd_option[ 'badge_icon' ] );
    if ( isset( $v[ 1 ] ) ) {
        $font = $v[ 0 ] . ' ' . $v[ 1 ];
    }
} else {
    $font = '';
}
?>
<i class="<?php echo esc_attr( $font ); ?>" aria-hidden="true"></i>