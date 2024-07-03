<?php
defined('ABSPATH') or die("No script kiddies please!");
$wobd_common_settings = get_option('wobd_common_settings');
?>  <div class='wobd-message-display-area'>
<?php if (isset($_GET['message']) && $_GET['message'] == '1') { ?>
        <div class="notice notice-success is-dismissible">
            <p><strong><?php esc_html_e('Settings saved successfully.', WOBD_TD); ?></strong></p>
            <button type="button" class="notice-dismiss">
                <span class="screen-reader-text"><?php esc_html_e('Dismiss this notice.', WOBD_TD); ?></span>
            </button>
        </div>
    <?php } ?>
</div>
<?php include(WOBD_PATH . 'includes/admin/view/page/header.php'); ?>
<div class="wobd-common-setting">
    <form method="post" id="wobd-save-form" action="<?php echo admin_url('admin-post.php'); ?>"  >
        <input type="hidden" name="action" value="wobd_settings_save"/>
        <div class="wobd-heading">
            <?php esc_html_e('WooCommerce Badges Settings', WOBD_TD) ?>
        </div>
        <div class="wobd-badge-option-wrap">
            <label><?php esc_html_e('Archive/Shop/Other Page Badge Configure', WOBD_TD); ?></label>
            <div class="wobd-badge-field-wrap">
                <div class="wobd-badge-field-inner-wrap">
                    <select name="wobd_common_settings[wobd_shop_configure_option]" class="wobd-badge-configure">
                        <option value="method_one"  <?php if (isset($wobd_common_settings['wobd_shop_configure_option']) && $wobd_common_settings['wobd_shop_configure_option'] == 'method_one') echo 'selected=="selected"'; ?>><?php esc_html_e('Method One', WOBD_TD) ?></option>
                        <option value="method_two"  <?php if (isset($wobd_common_settings['wobd_shop_configure_option']) && $wobd_common_settings['wobd_shop_configure_option'] == 'method_two') echo 'selected=="selected"'; ?>><?php esc_html_e('Method Two', WOBD_TD) ?></option>
                        <option value="method_three"  <?php if (isset($wobd_common_settings['wobd_shop_configure_option']) && $wobd_common_settings['wobd_shop_configure_option'] == 'method_three') echo 'selected=="selected"'; ?>><?php esc_html_e('Method Three', WOBD_TD) ?></option>
                    </select>
                </div>
                <p class="description"> <?php esc_html_e('Note: If badge doesnot display on shop/archive or any other page with method one then choose method two and respectively with method three', WOBD_TD) ?></p>
            </div>
        </div>
        
        <div class="wobd-badge-option-wrap">
            <label><?php esc_html_e('Single Product Page Configure', WOBD_TD); ?></label>
            <div class="wobd-badge-field-wrap">
                <div class="wobd-badge-field-inner-wrap">
                    <select name="wobd_common_settings[wobd_page_configure_option]" class="wobd-badge-configure">
                        <option value="method_one"  <?php if (isset($wobd_common_settings['wobd_page_configure_option']) && $wobd_common_settings['wobd_page_configure_option'] == 'method_one') echo 'selected=="selected"'; ?>><?php esc_html_e('Method One', WOBD_TD) ?></option>
                        <option value="method_two"  <?php if (isset($wobd_common_settings['wobd_page_configure_option']) && $wobd_common_settings['wobd_page_configure_option'] == 'method_two') echo 'selected=="selected"'; ?>><?php esc_html_e('Method Two', WOBD_TD) ?></option>
                        <option value="method_three"  <?php if (isset($wobd_common_settings['wobd_page_configure_option']) && $wobd_common_settings['wobd_page_configure_option'] == 'method_three') echo 'selected=="selected"'; ?>><?php esc_html_e('Method Three', WOBD_TD) ?></option>
                    </select>
                </div>
                <p class="description"> <?php esc_html_e('Note: If badge doesnot display on single product page with method one then choose method two and respectively with method three', WOBD_TD) ?></p>
            </div>
        </div>
        <div class="wobd-badge-option-wrap">
            <label><?php esc_html_e('Sale', WOBD_TD); ?></label>
            <div class="wobd-badge-field-wrap">
                <div class="wobd-badge-field-inner-wrap">
                    <select name ="wobd_common_settings[wobd_default_sale_badge]" class ="wobd-sale-badge">
                        <option value="disable" <?php if (!empty($wobd_common_settings['wobd_default_sale_badge'])) selected($wobd_common_settings['wobd_default_sale_badge'], 'disable'); ?>><?php esc_html_e('Disable', WOBD_TD); ?></option>
                        <option value="default" <?php if (!empty($wobd_common_settings['wobd_default_sale_badge'])) selected($wobd_common_settings['wobd_default_sale_badge'], 'default'); ?>><?php esc_html_e('Default', WOBD_TD); ?></option>
                        <?php
                        $args = array(
                            'post_type' => 'wobd-badge-designer',
                            'posts_per_page' => -1,
                            'post_status' => 'publish',
                        );
                        $query = new WP_Query($args);
                        if ($query->have_posts()) {
                            while ($query->have_posts()) {

                                $query->the_post();
                                $badge_post_id = get_the_ID();
                                $wobd_option = get_post_meta($badge_post_id, 'wobd_option', true);
                                ?>
                                <option value="<?php echo $badge_post_id; ?>" <?php if (!empty($wobd_common_settings['wobd_default_sale_badge'])) selected($wobd_common_settings['wobd_default_sale_badge'], $badge_post_id); ?>><?php the_title(); ?></option>
                                <?php
                            }
                        }
                        wp_reset_postdata();
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="wobd-auto-percentage-wrapper" <?php if (isset($wobd_common_settings['wobd_enable_auto_calculate_badge']) && $wobd_common_settings['wobd_enable_auto_calculate_badge'] == '1') { ?> style="display:block;"<?php } else { ?>style="display:none;"<?php } ?>>
            <div class ="wobd-badge-option-wrap">
                <label for="wobd-show-badges-single-page" class="wobd-show-badges">
                    <?php esc_html_e('Auto Calculate Types', WOBD_TD); ?>
                </label>
                <div class="wobd-badge-field-wrap">
                    <label><input type="radio" value="percentage-cal" name="wobd_common_settings[auto_cal_type]" <?php
                        checked($wobd_common_settings['auto_cal_type'], 'percentage-cal');
                        ?> class="wobd-background-type"/><?php esc_html_e("Auto Calculate % Off in Sale Price", WOBD_TD); ?></label>
                    <label><input type="radio" value="price-cal" name="wobd_common_settings[auto_cal_type]" <?php
                        checked($wobd_common_settings['auto_cal_type'], 'price-cal');
                        ?>  class="wobd-background-type"/><?php esc_html_e('Auto Calculate $(Price) Off in Sale Price', WOBD_TD); ?></label>
                </div>
            </div>
            <div class ="wobd-badge-option-wrap">
                <label for="wobd-show-badges-single-page" class="wobd-show-badges">
                    <?php esc_html_e('Enable Extra Text', WOBD_TD); ?>
                </label>
                <div class="wobd-badge-field-wrap">
                    <label class="wobd-switch">
                        <input type="checkbox" class="wobd-enable-extra-text wobd-checkbox" value="<?php
                        if (isset($wobd_common_settings['wobd_enable_extra_text'])) {
                            echo esc_attr($wobd_common_settings['wobd_enable_extra_text']);
                        } else {
                            echo '0';
                        }
                        ?>" name="wobd_common_settings[wobd_enable_extra_text]" <?php if (isset($wobd_common_settings['wobd_enable_extra_text']) && $wobd_common_settings['wobd_enable_extra_text'] == '1') { ?>checked="checked"<?php } ?>/>
                        <div class="wobd-slider round"></div>
                    </label>
                    <p class="description"> <?php esc_html_e('Enable to include extra text in the above auto calculation for eg OFF.', WOBD_TD) ?></p>
                </div>
            </div>
            <div class="wobd-extra-text-wrapper" <?php if (isset($wobd_common_settings['wobd_enable_extra_text']) && $wobd_common_settings['wobd_enable_extra_text'] == '1') { ?> style="display:block;"<?php } else { ?>style="display:none;"<?php } ?>>
                <div class ="wobd-badge-option-wrap">
                    <label for="wobd-show-badges-single-page" class="wobd-show-badges">
                        <?php esc_html_e('Extra Text', WOBD_TD); ?>
                    </label>
                    <div class="wobd-badge-field-wrap">
                        <input type="text" class="wobd-badge-text-extra" value="<?php
                        if (isset($wobd_common_settings['wobd_extra_text'])) {
                            echo esc_attr($wobd_common_settings['wobd_extra_text']);
                        }
                        ?>" name='wobd_common_settings[wobd_extra_text]'>
                    </div>
                </div>
            </div>
            <div class ="wobd-badge-option-wrap">
                <label for="wobd-show-badges-single-page" class="wobd-show-badges">
                    <?php esc_html_e('Enable Minus Sign', WOBD_TD); ?>
                </label>
                <div class="wobd-badge-field-wrap">
                    <label class="wobd-switch">
                        <input type="checkbox" class="wobd-enable-minus wobd-checkbox" value="<?php
                        if (isset($wobd_common_settings['wobd_enable_minus_sign'])) {
                            echo esc_attr($wobd_common_settings['wobd_enable_minus_sign']);
                        } else {
                            echo '0';
                        }
                        ?>" name="wobd_common_settings[wobd_enable_minus_sign]" <?php if (isset($wobd_common_settings['wobd_enable_minus_sign']) && $wobd_common_settings['wobd_enable_minus_sign'] == '1') { ?>checked="checked"<?php } ?>/>
                        <div class="wobd-slider round"></div>
                    </label>
                    <p class="description"> <?php esc_html_e('Enable to include - sign in offer calculation sale price.', WOBD_TD) ?></p>
                </div>
            </div>
        </div>
        <div class="wobd-badge-option-wrap">
            <label><?php esc_html_e('Out of Stock', WOBD_TD); ?></label>
            <div class="wobd-badge-field-wrap">
                <div class="wobd-badge-field-inner-wrap">
                    <select name = "wobd_common_settings[wobd_stock_badge]" class = "wobd-sale-badge">
                        <option value="default" <?php if (!empty($wobd_common_settings['wobd_stock_badge'])) selected($wobd_common_settings['wobd_stock_badge'], 'default'); ?>><?php esc_html_e('Default', WOBD_TD); ?></option>
                        <?php
                        $args = array(
                            'post_type' => 'wobd-badge-designer',
                            'posts_per_page' => -1,
                            'post_status' => 'publish',
                        );
                        $query = new WP_Query($args);
                        if ($query->have_posts()) {
                            while ($query->have_posts()) {
                                $query->the_post();
                                $badge_post_id = get_the_ID();
                                $wobd_option = get_post_meta($badge_post_id, 'wobd_option', true);
                                ?>
                                <option value="<?php echo $badge_post_id; ?>" <?php if (!empty($wobd_common_settings['wobd_stock_badge'])) selected($wobd_common_settings['wobd_stock_badge'], $badge_post_id); ?>><?php the_title(); ?></option>
                                <?php
                            }
                        }
                        wp_reset_postdata();
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class ="wobd-badge-option-wrap">
            <label for="wobd-show-badges-single-page" class="wobd-show-badges">
                <?php esc_html_e('Enable Custom Badges on Single Page', WOBD_TD); ?>
            </label>
            <div class="wobd-badge-field-wrap">
                <label class="wobd-switch">
                    <input type="checkbox" class="wobd-display-badges-single wobd-checkbox" value="<?php
                    if (isset($wobd_common_settings['wobd_enable_single_page_badge'])) {
                        echo esc_attr($wobd_common_settings['wobd_enable_single_page_badge']);
                    } else {
                        echo '0';
                    }
                    ?>" name="wobd_common_settings[wobd_enable_single_page_badge]" <?php if (isset($wobd_common_settings['wobd_enable_single_page_badge']) && $wobd_common_settings['wobd_enable_single_page_badge'] == '1') { ?>checked="checked"<?php } ?>/>
                    <div class="wobd-slider round"></div>
                </label>
                <p class="description"> <?php esc_html_e('Enable badges to show on single product page.', WOBD_TD) ?></p>
            </div>
        </div>
        <div class="wobd-save-buton">
            <?php wp_nonce_field('wobd_form_nonce', 'wobd_form_nonce_field'); ?>
            <a class="button button-primary button-large" href="javascript:;" onclick="document.getElementById('wobd-save-form').submit();"><span><?php esc_html_e('Save', WOBD_TD); ?></span></a>
        </div>
    </form>
</div>
