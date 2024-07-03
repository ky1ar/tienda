<?php
if ( isset( $wobd_option[ 'text_design_templates' ] ) && $wobd_option[ 'text_design_templates' ] == 'template-24' ) {
    ?>
    <div class="wobd-text-main-wrap">
        <div class="wobd-text-inner-wrap">
            <?php
        }
        ?>
        <div class="<?php
        echo $span_class;
        ?>" id="wobd-badge">
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
        <?php
        if ( isset( $wobd_option[ 'text_design_templates' ] ) && $wobd_option[ 'text_design_templates' ] == 'template-24' ) {
            ?>
        </div>
    </div>
    <?php
}