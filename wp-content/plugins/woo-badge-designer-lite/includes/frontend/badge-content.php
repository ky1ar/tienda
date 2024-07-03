<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );
$position = isset( $wobd_option[ 'badge_position' ] ) ? esc_attr( $wobd_option[ 'badge_position' ] ) : 'left_top';
$data_id = rand( 111111111, 999999999 );
if ( isset( $wobd_option[ 'background_type' ] ) && $wobd_option[ 'background_type' ] == 'image-background' ) {

    $template = isset( $wobd_option[ 'existing_image' ] ) ? esc_attr( $wobd_option[ 'existing_image' ] ) : '1';
    $wobd_text_template = 'wobd-image-' . $template;

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
if (!empty($wobd_option)):
?>

<div class="<?php echo $background_class; ?> wobd-badges <?php
     if ( is_product() ) {
         echo $attachment_class;
     }
     echo ' wobd-position-' . $position;
     ?>" data-id="wobd_<?php echo $data_id;
     ?>"><?php
         if ( isset( $wobd_option[ 'background_type' ] ) && $wobd_option[ 'background_type' ] == 'image-background' ) {
             include(WOBD_PATH . 'includes/frontend/template/image-background.php');
         } else {
             $text_value = isset( $wobd_option[ 'badge_text' ] ) ? esc_attr( $wobd_option[ 'badge_text' ] ) : '';
             include(WOBD_PATH . 'includes/frontend/template/text-background.php');
         }
         ?></div><?php 
         endif; 
         include(WOBD_PATH . 'includes/frontend/custom-css.php'); ?>