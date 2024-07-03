<?php defined( 'ABSPATH' ) or die( "No script kiddies please!" ); ?>
<div class="<?php
echo $span_class;
?>" id="wobd-badge"><?php
    if ( $badge_type == 'text' ) {
        include(WOBD_PATH . 'includes/frontend/template/text-template.php');
    } else if ( $badge_type == 'icon' ) {
        include(WOBD_PATH . 'includes/frontend/template/icon-template.php');
    } else {
        include(WOBD_PATH . 'includes/frontend/template/both-template.php');
    }
    ?></div>
