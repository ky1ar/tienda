<?php defined( 'ABSPATH' ) or die( "No script kiddies please!" ); ?>
<div class="wobd-badge-preview-wrapper">
    <div class="wobd-text-preview-wrap">
        <div class="wobd-badges-wrapper wobd-smaller-wrap">
            <?php
            $post_id = $post -> ID;
            $wobd_option = get_post_meta( $post_id, 'wobd_option', true );
            $position = isset( $wobd_option[ 'badge_position' ] ) ? esc_attr( $wobd_option[ 'badge_position' ] ) : 'left_top';
            $data_id = rand( 111111111, 999999999 );
            if ( isset( $wobd_option[ 'background_type' ] ) && $wobd_option[ 'background_type' ] == 'image-background' ) {
                $template = isset( $wobd_option[ 'existing_image' ] ) ? esc_attr( $wobd_option[ 'existing_image' ] ) : '1';
                $wobd_text_template = 'wobd-image-' . $template;
                $background_class = 'wobd-image-bg-wrap ' . $wobd_text_template;
            } else {
                $template = isset( $wobd_option[ 'text_design_templates' ] ) ? esc_attr( $wobd_option[ 'text_design_templates' ] ) : 'template-1';
                $wobd_text_template = 'wobd-text-' . $template;
                $wobd_text_template = 'wobd-text-' . $template;
                $background_class = 'wobd-text-bg-wrap ' . $wobd_text_template;
            }
            $badge_type = isset( $wobd_option[ 'badge_type' ] ) ? esc_attr( $wobd_option[ 'badge_type' ] ) : 'text';
            if ( $badge_type == 'text' ) {
                $span_class = 'wobd-text ';
            } else if ( $badge_type == 'icon' ) {
                $span_class = 'wobd-icon ';
            } else {
                $span_class = 'wobd-text wobd-icon ';
            }
            $disable_badge = isset( $wobd_option[ 'wobd_disable_badge' ] ) ? esc_attr( $wobd_option[ 'wobd_disable_badge' ] ) : '0';
            if ( $disable_badge != '1' ) {
                ?>
                <div class="<?php echo $background_class; ?> wobd-badges <?php echo ' wobd-position-' . $position; ?>" data-id="wobd_<?php echo $data_id;
                ?>">
                     <?php
                     if ( isset( $wobd_option[ 'background_type' ] ) && $wobd_option[ 'background_type' ] == 'image-background' ) {
                         include(WOBD_PATH . 'includes/frontend/template/image-background.php');
                     } else {
                         $text_value = isset( $wobd_option[ 'badge_text' ] ) ? esc_attr( $wobd_option[ 'badge_text' ] ) : 'Sale';
                         include(WOBD_PATH . 'includes/frontend/template/text-background.php');
                     }
                     ?>
                </div>
            <?php } ?>
            <img src="<?php echo WOBD_IMG_DIR ?>hoodie.jpg">
            <?php include(WOBD_PATH . 'includes/frontend/custom-css.php'); ?>
        </div>
    </div>
</div>


