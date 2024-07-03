<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );
global $post;
$post_id = $post -> ID;
$wobd_option = get_post_meta( $post_id, 'wobd_option', true );
?>
<div class="wobd-settings-wrapper">
    <ul class="wobd-settings-tab">
        <li data-menu="layout-settings" class="wobd-settings-tigger wobd-settings-active">
            <span class="icon_ribbon_alt" aria-hidden="true"></span>
<?php esc_html_e( 'Badges Layout', WOBD_TD ) ?>
        </li>
        <li data-menu="general-settings" class="wobd-settings-tigger">
            <span class="icon_cog" aria-hidden="true"></span>
<?php esc_html_e( 'General Settings', WOBD_TD ) ?>
        </li>
    </ul>
</div>
<div class="wobd-badge-tab-setting-wrap wobd-active-badge-setting" data-menu-ref="layout-settings">
<?php include(WOBD_PATH . 'includes/admin/view/settings/wobd-layout.php'); ?>
</div>
<div class="wobd-badge-tab-setting-wrap" data-menu-ref="general-settings">
<?php include(WOBD_PATH . 'includes/admin/view/settings/wobd-general.php'); ?>
</div>

