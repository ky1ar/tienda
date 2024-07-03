<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );
$existing_images = isset( $wobd_option[ 'existing_image' ] ) ? esc_attr( $wobd_option[ 'existing_image' ] ) : '1';
$image = WOBD_IMG_DIR . 'badges/' . $existing_images . '.png';
?>
<div class="wobd-image-ribbon">
    <img src="<?php echo $image; ?>" alt="">
</div>

