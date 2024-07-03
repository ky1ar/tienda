<?php defined( 'ABSPATH' ) or die( "No script kiddies please!" ); ?>
<div class="wobd-settings-wrapper">
    <div class="wobd-badge-option-wrap">
        <label><?php esc_html_e( 'Badge Position', WOBD_TD ); ?></label>
        <div class="wobd-badge-field-wrap">
            <div class="wobd-badge-field-inner-wrap">
                <select name="wobd_option[badge_position]" class="wobd-badge-position">
                    <option value="left_top"  <?php if ( isset( $wobd_option[ 'badge_position' ] ) && $wobd_option[ 'badge_position' ] == 'left_top' ) echo 'selected=="selected"'; ?>><?php esc_html_e( 'Left Top', WOBD_TD ) ?></option>
                    <option value="left_center"  <?php if ( isset( $wobd_option[ 'badge_position' ] ) && $wobd_option[ 'badge_position' ] == 'left_center' ) echo 'selected=="selected"'; ?>><?php esc_html_e( 'Left Center', WOBD_TD ) ?></option>
                    <option value="left_bottom"  <?php if ( isset( $wobd_option[ 'badge_position' ] ) && $wobd_option[ 'badge_position' ] == 'left_bottom' ) echo 'selected=="selected"'; ?>><?php esc_html_e( 'Left Bottom', WOBD_TD ) ?></option>
                    <option value="right_top"  <?php if ( isset( $wobd_option[ 'badge_position' ] ) && $wobd_option[ 'badge_position' ] == 'right_top' ) echo 'selected=="selected"'; ?>><?php esc_html_e( 'Right Top', WOBD_TD ) ?></option>
                    <option value="right_center"  <?php if ( isset( $wobd_option[ 'badge_position' ] ) && $wobd_option[ 'badge_position' ] == 'right_center' ) echo 'selected=="selected"'; ?>><?php esc_html_e( 'Right Center', WOBD_TD ) ?></option>
                    <option value="right_bottom"  <?php if ( isset( $wobd_option[ 'badge_position' ] ) && $wobd_option[ 'badge_position' ] == 'right_bottom' ) echo 'selected=="selected"'; ?>><?php esc_html_e( 'Right Bottom', WOBD_TD ) ?></option>
                </select>
            </div>
        </div>
    </div>
    <div class="wobd-badge-option-wrap">
        <label><?php
            esc_html_e( 'Background Type', WOBD_TD );
            $background_type = isset( $wobd_option[ 'background_type' ] ) ? esc_attr( $wobd_option[ 'background_type' ] ) : 'text-background';
            ?></label>
        <div class="wobd-badge-field-wrap">
            <label><input type="radio" value="text-background" name="wobd_option[background_type]" <?php
                checked( $background_type, 'text-background' );
                ?> class="wobd-background-type"/><?php esc_html_e( "Text Background", WOBD_TD ); ?></label>
            <label><input type="radio" value="image-background" name="wobd_option[background_type]" <?php
                checked( $background_type, 'image-background' );
                ?>  class="wobd-background-type"/><?php esc_html_e( 'Image Background', WOBD_TD ); ?></label>
        </div>
    </div>
    <div class="wobd-badge-image-settings-wrap" <?php if ( $background_type == 'image-background' ) { ?> style="display: block;" <?php } else { ?> style="display: none;" <?php } ?>>
        <div class="wobd-existing-image-wrap">
            <div class="wobd-badge-option-wrap">
                <label><?php esc_html_e( 'Image Template', WOBD_TD ); ?></label>
                <div class="wobd-badge-field-wrap">
                    <?php
                    $wobd_existing_images = array( 1, 2, 3, 4, 5 );
                    foreach ( $wobd_existing_images as $wobd_existing_image ) :
                        ?>
                        <div class="wobd-hide-radio">
                            <input type="radio" id="<?php echo $wobd_existing_image; ?>" name="wobd_option[existing_image]" class="wobd-existing-image" value="<?php echo $wobd_existing_image; ?>" <?php if ( isset( $wobd_option[ 'existing_image' ] ) && $wobd_option[ 'existing_image' ] == $wobd_existing_image ) { ?>checked="checked"<?php } ?> <?php if ( ! isset( $wobd_option[ 'existing_image' ] ) ) { ?>checked="checked"<?php } ?> />
                            <label class="wobd-existing-images-demo" for="<?php echo $wobd_existing_image; ?>">
                                <img src="<?php echo WOBD_IMG_DIR . '/badges/' . $wobd_existing_image . '.png' ?>">
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="wobd-text-background-wrap" <?php if ( $background_type == 'text-background' ) { ?>style="display:block;" <?php } else { ?>style="display:none;" <?php } ?>>
        <div class="wobd-badge-option-wrap">
            <label><?php esc_html_e( 'Text Template', WOBD_TD ); ?></label>
            <div class="wobd-badge-field-wrap">
                <?php
                $wobd_text_designs = array(
                    'template-1',
                    'template-2',
                    'template-3',
                    'template-4',
                    'template-5'
                );
                $t = 1;
                foreach ( $wobd_text_designs as $wobd_text_design ) :
                    ?>
                    <div class="wobd-hide-radio">
                        <input type="radio" id="<?php echo $t; ?>" name="wobd_option[text_design_templates]" class="wobd-text-design" value="<?php echo $wobd_text_design; ?>" <?php if ( isset( $wobd_option[ 'text_design_templates' ] ) && $wobd_option[ 'text_design_templates' ] == $wobd_text_design ) { ?>checked="checked"<?php } ?> <?php if ( ! isset( $wobd_option[ 'text_design_templates' ] ) ) { ?>checked="checked"<?php } ?> />
                        <label class="wobd-existing-images-demo" for="<?php echo $t; ?>">
                            <img src="<?php echo WOBD_IMG_DIR . 'text-design/' . $t . '.png' ?>">
                        </label>
                    </div>
                    <?php
                    $t ++;
                endforeach;
                ?>
            </div>
        </div>
    </div>
    <div class="wobd-badge-option-wrap">
        <label><?php
            esc_html_e( 'Badge Type', WOBD_TD );
            $badge_type = isset( $wobd_option[ 'badge_type' ] ) ? esc_attr( $wobd_option[ 'badge_type' ] ) : 'text';
            ?></label>
        <div class="wobd-badge-field-wrap">
            <label><input type="radio" value="text" name="wobd_option[badge_type]" <?php
                checked( $badge_type, 'text' );
                ?> class="wobd-badge-type"/><?php esc_html_e( "Text Only", WOBD_TD ); ?></label>
            <label><input type="radio" value="icon" name="wobd_option[badge_type]" <?php
                checked( $badge_type, 'icon' );
                ?>  class="wobd-badge-type"/><?php esc_html_e( 'Icon Only', WOBD_TD ); ?></label>
            <label><input type="radio" value="both" name="wobd_option[badge_type]" <?php
                checked( $badge_type, 'both' );
                ?>  class="wobd-badge-type"/><?php esc_html_e( 'Both', WOBD_TD ); ?></label>
        </div>
    </div>
    <div class="wobd-badge-text-settings-wrap" <?php if ( $badge_type == 'icon' ) { ?> style="display: none;" <?php } else { ?> style="display: block;" <?php } ?>>
        <div class="wobd-badge-option-wrap">
            <label><?php esc_html_e( 'Badge Text', WOBD_TD ); ?></label>
            <div class="wobd-badge-field-wrap">
                <input type="text" class="wobd-badge-text" value="<?php
                if ( isset( $wobd_option[ 'badge_text' ] ) ) {
                    echo esc_attr( $wobd_option[ 'badge_text' ] );
                } else {
                    echo esc_html_e( 'Sale', WOBD_TD );
                }
                ?>" name='wobd_option[badge_text]'>
            </div>
        </div>
        <div class="wobd-badge-second-text-wrap">
            <div class="wobd-badge-option-wrap">
                <label><?php esc_html_e( 'Badge Second Text', WOBD_TD ); ?></label>
                <div class="wobd-badge-field-wrap">
                    <input type="text" class="wobd-second-badge-text" value="<?php
                    if ( isset( $wobd_option[ 'badge_second_text' ] ) ) {
                        echo esc_attr( $wobd_option[ 'badge_second_text' ] );
                    }
                    ?>" name='wobd_option[badge_second_text]'>
                </div>
            </div>
        </div>
    </div>

    <div class="wobd-badge-icon-settings-wrap" <?php if ( $badge_type == 'text' ) { ?> style="display: none;" <?php } else { ?> style="display: block;" <?php } ?>>
        <div class="wobd-badge-option-wrap">
            <label><?php esc_html_e( 'Choose Icon', WOBD_TD ); ?></label>
            <div class="wobd-badge-field-wrap">
                <div data-target="icon-picker" class="button icon-picker <?php
                if ( ! empty( $wobd_option[ 'badge_icon' ] ) ) {
                    $value = $wobd_option[ 'badge_icon' ];
                    $v = explode( '|', $value );
                    if ( isset( $v[ 1 ] ) ) {
                        echo $v[ 0 ] . ' ' . $v[ 1 ];
                    }
                } else {
                    echo esc_attr( 'dashicons dashicons-plus' );
                }
                ?>"></div>
                <input class="icon-picker-input" type="text" name="wobd_option[badge_icon]"
                       value="<?php
                       if ( isset( $wobd_option[ 'badge_icon' ] ) ) {
                           echo esc_attr( $wobd_option[ 'badge_icon' ] );
                       } else {
                           echo esc_attr( 'dashicons dashicons-plus' );
                       }
                       ?>"/>
            </div>
        </div>
    </div>
</div>