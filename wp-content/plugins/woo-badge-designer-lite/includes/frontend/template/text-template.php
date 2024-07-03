<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );
$image_template = isset( $wobd_option[ 'existing_image' ] ) ? esc_attr( $wobd_option[ 'existing_image' ] ) : '1';
if ( isset( $wobd_option[ 'background_type' ] ) && $wobd_option[ 'background_type' ] == 'image-background' ) {
    if ( ! empty( $wobd_option[ 'badge_text' ] ) ) {
        ?>
        <div class="wobd-first-text">
            <?php
            echo esc_attr( $wobd_option[ 'badge_text' ] );
            ?>
        </div>
        <?php
    }
    if ( ! empty( $wobd_option[ 'badge_second_text' ] ) ) {
        ?>
        <div class="wobd-second-text">
            <?php
            echo esc_attr( $wobd_option[ 'badge_second_text' ] );
            ?>
        </div>
        <?php
    }
} else {
    $text_template = isset( $wobd_option[ 'text_design_templates' ] ) ? esc_attr( $wobd_option[ 'text_design_templates' ] ) : 'template-1';
    echo $text_value;
    if ( isset( $wobd_option[ 'badge_second_text' ] ) ) {
        ?><div class="wobd-second-text"><?php echo esc_attr( $wobd_option[ 'badge_second_text' ] ); ?></div><?php
    }
}