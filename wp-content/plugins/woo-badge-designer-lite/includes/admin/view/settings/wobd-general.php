<?php defined( 'ABSPATH' ) or die( "No script kiddies please!" ); ?>
<div class ="wobd-badge-option-wrap">
    <label for="wobd-enable-custom-design" class="wobd-enable-custom-design">
        <?php esc_html_e( 'Enable Custom Design', WOBD_TD ); ?>
    </label>
    <div class="wobd-badge-field-wrap">
        <label class="wobd-switch">
            <input type="checkbox" class="wobd-display-custom wobd-checkbox" value="<?php
            if ( isset( $wobd_option[ 'wobd_enable_custom_design' ] ) ) {
                echo esc_attr( $wobd_option[ 'wobd_enable_custom_design' ] );
            } else {
                echo '0';
            }
            ?>" name="wobd_option[wobd_enable_custom_design]" <?php if ( isset( $wobd_option[ 'wobd_enable_custom_design' ] ) && $wobd_option[ 'wobd_enable_custom_design' ] == '1' ) { ?>checked="checked"<?php } ?>/>
            <div class="wobd-slider round"></div>
        </label>
        <p class="description"> <?php esc_html_e( 'Enable custom design to change color,font size and padding.', WOBD_TD ) ?></p>
    </div>
</div>
<div class="wobd-custom-design-container" <?php if ( isset( $wobd_option[ 'wobd_enable_custom_design' ] ) && $wobd_option[ 'wobd_enable_custom_design' ] == '1' ) { ?> style="display:block;"<?php } else { ?> style="display:none;" <?php } ?>>
    <div class="wobd-badge-option-wrap">
        <label><?php esc_html_e( 'Title Color', WOBD_TD ); ?></label>
        <div class="wobd-badge-field-wrap">
            <input type="text" class="wobd-color-picker wobd-text-color" data-alpha="true" name="wobd_option[wobd_text_color]"  value="<?php
            if ( isset( $wobd_option[ 'wobd_text_color' ] ) ) {
                echo esc_attr( $wobd_option[ 'wobd_text_color' ] );
            } else {
                echo "#ffffff";
            }
            ?>"/>
        </div>
    </div>
    <div class="wobd-badge-option-wrap">
        <label><?php esc_html_e( 'Badge Background Color', WOBD_TD ); ?></label>
        <div class="wobd-badge-field-wrap">
            <input type="text" class="wobd-color-picker wobd-bg-color" data-alpha="true" name="wobd_option[wobd_background_color]"  value="<?php
            if ( isset( $wobd_option[ 'wobd_background_color' ] ) ) {
                echo esc_attr( $wobd_option[ 'wobd_background_color' ] );
            } else {
                echo "#ffffff";
            }
            ?>"/>
            <p class="description"> <?php esc_html_e( 'This is only applicable for Text Background', WOBD_TD ) ?></p>

        </div>
    </div>
    <div class="wobd-badge-option-wrap">
        <label><?php esc_html_e( 'Badge Coner Background Color', WOBD_TD ); ?></label>
        <div class="wobd-badge-field-wrap">
            <input type="text" class="wobd-color-picker wobd-coner-color" data-alpha="true" name="wobd_option[wobd_corner_background_color]"  value="<?php
            if ( isset( $wobd_option[ 'wobd_corner_background_color' ] ) ) {
                echo esc_attr( $wobd_option[ 'wobd_corner_background_color' ] );
            } else {
                echo "#ffffff";
            }
            ?>"/>
            <p class="description"> <?php esc_html_e( 'This is only applicable for Text Background', WOBD_TD ) ?></p>

        </div>
    </div>
    <div class="wobd-badge-option-wrap">
        <label><?php esc_html_e( 'Font Size', WOBD_TD ); ?></label>
        <div class="wobd-badge-field-wrap">
            <input type="number" class="wobd-font-size" min="1" name="wobd_option[wobd_font_size]"  value="<?php
            if ( isset( $wobd_option[ 'wobd_font_size' ] ) ) {
                echo esc_attr( $wobd_option[ 'wobd_font_size' ] );
            }
            ?>"/>
            <div class="wobd-unit-quote"><?php esc_html_e( 'px', WOBD_TD ); ?></div>
        </div>
    </div>
    <div class="wobd-badge-option-wrap">
        <label><?php esc_html_e( 'Image Size', WOBD_TD ); ?></label>
        <div class="wobd-badge-field-wrap">
            <input type="number" class="wobd-image-size" min="1" name="wobd_option[wobd_image_size]"  value="<?php
            if ( isset( $wobd_option[ 'wobd_image_size' ] ) ) {
                echo esc_attr( $wobd_option[ 'wobd_image_size' ] );
            }
            ?>"/>
            <div class="wobd-unit-quote"><?php esc_html_e( 'px', WOBD_TD ); ?></div>
        </div>
    </div>
    <p class="description"> <?php esc_html_e( 'Note : Save to see the changes of custom design', WOBD_TD ) ?></p>
</div>