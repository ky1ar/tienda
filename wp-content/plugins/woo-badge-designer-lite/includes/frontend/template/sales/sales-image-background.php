<div class="<?php
echo $span_class;
?>" id="wobd-badge">

    <?php
    include(WOBD_PATH . 'includes/frontend/template/image-template.php');
    ?>
    <div class="wobd-inner-text-container">
        <?php
        if ( isset( $wobd_common_settings[ 'wobd_enable_auto_calculate_badge' ] ) && $wobd_common_settings[ 'wobd_enable_auto_calculate_badge' ] == '1' ) {
            include(WOBD_PATH . 'includes/frontend/sales-calculate.php');
        } else {
            if ( $badge_type == 'text' ) {
                include(WOBD_PATH . 'includes/frontend/template/text-template.php');
            } else if ( $badge_type == 'icon' ) {
                include(WOBD_PATH . 'includes/frontend/template/icon-template.php');
            } else {
                include(WOBD_PATH . 'includes/frontend/template/both-template.php');
            }
        }
        ?>
    </div>
</div>
