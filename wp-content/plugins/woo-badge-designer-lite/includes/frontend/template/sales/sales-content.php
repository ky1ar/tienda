<?php
$position = isset( $wobd_option[ 'badge_position' ] ) ? esc_attr( $wobd_option[ 'badge_position' ] ) : 'left_top';
$enable_tooltip_check = isset( $wobd_option[ 'wobd_enable_tooltip' ] ) ? esc_attr( $wobd_option[ 'wobd_enable_tooltip' ] ) : '0';
if ( $enable_tooltip_check == '1' ) {
    if ( isset( $wobd_option[ 'badge_tooltip_text' ] ) ) {
        $tooltip_text = $wobd_option[ 'badge_tooltip_text' ];
    }
}
$data_id = rand( 111111111, 999999999 );
if ( isset( $wobd_option[ 'background_type' ] ) && $wobd_option[ 'background_type' ] == 'image-background' ) {
    $image_type = isset( $wobd_option[ 'image_type' ] ) ? esc_attr( $wobd_option[ 'image_type' ] ) : 'pre_existing_image';
    if ( $image_type == 'pre_existing_image' ) {
        $template = isset( $wobd_option[ 'existing_image' ] ) ? esc_attr( $wobd_option[ 'existing_image' ] ) : '1';
        $wobd_text_template = 'wobd-image-' . $template;
    } else {
        $wobd_text_template = 'wobd-custom-image';
    }
    $random_class = 'wobd-' . $data_id;
    $background_class = $random_class . ' wobd-image-bg-wrap ' . $wobd_text_template;
} else {
    $template = isset( $wobd_option[ 'text_design_templates' ] ) ? esc_attr( $wobd_option[ 'text_design_templates' ] ) : 'template-1';
    $wobd_text_template = 'wobd-text-' . $template;
    $random_class = 'wobd-' . $data_id;
    $background_class = $random_class . ' wobd-text-bg-wrap ' . $wobd_text_template;
}
if ( isset( $wobd_option[ 'badge_type' ] ) && $wobd_option[ 'badge_type' ] == 'text' ) {
    $span_class = 'wobd-text ';
} else {
    $span_class = 'wobd-text wobd-icon ';
}
global $product;
$attachment_ids = $product -> get_gallery_image_ids();
if ( ! $attachment_ids ) {
    $attachment_class = '';
} else {
    $attachment_class = 'wobd-attachment-gallery';
}
$badge_type = isset( $wobd_option[ 'badge_type' ] ) ? esc_attr( $wobd_option[ 'badge_type' ] ) : 'text';
$disable_badge = isset( $wobd_option[ 'wobd_disable_badge' ] ) ? esc_attr( $wobd_option[ 'wobd_disable_badge' ] ) : '0';
if ( $disable_badge == 0 ) {
    ?>
    <div class="<?php echo $background_class; ?> wobd-badges <?php
         if ( is_product() ) {
             echo $attachment_class;
         }
         echo ' wobd-position-' . $position;
         if ( $enable_tooltip_check == '1' ) {
             echo ' wobd-tooltip-active';
         }
         ?>" data-id="wobd_<?php echo $data_id;
         ?>"
         <?php if ( $enable_tooltip_check == '1' ) { ?>
             title = "<?php echo esc_attr( $tooltip_text ); ?>"
         <?php } ?>
         >
             <?php
             if ( isset( $wobd_option[ 'background_type' ] ) && $wobd_option[ 'background_type' ] == 'image-background' ) {
                 include(WOBD_PATH . 'includes/frontend/template/sales/sales-image-background.php');
             } else {
                 $text_value = isset( $wobd_option[ 'badge_text' ] ) ? esc_attr( $wobd_option[ 'badge_text' ] ) : '';
                 include(WOBD_PATH . 'includes/frontend/template/sales/sales-text-background.php');
             }
             ?>
    </div>
    <?php
}
include(WOBD_PATH . 'includes/frontend/custom-design.php');
