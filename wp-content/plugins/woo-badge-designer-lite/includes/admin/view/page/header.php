<?php defined( 'ABSPATH' ) or die( "No script kiddies please!" ); ?>
<div class="wobd-header">
    <div>
        <div id="wobd-fb-root"></div>
        <script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));</script>
        <script>!function(d, s, id){var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location)?'http':'https'; if (!d.getElementById(id)){js = d.createElement(s); js.id = id; js.src = p + '://platform.twitter.com/widgets.js'; fjs.parentNode.insertBefore(js, fjs); }}(document, 'script', 'twitter-wjs');</script>
    </div>
    <div class="wobd-header-section">
        <div class="wobd-header-left">
            <div class="wobd-title"><?php esc_html_e( 'Badge Designer Lite For WooCommerce', WOBD_TD ); ?></div>
            <div class="wobd-version-wrap">
                <span><?php esc_html_e( "Version", WOBD_TD ); ?> <?php echo WOBD_VERSION; ?></span>
            </div>
        </div>
        <div class="wobd-header-social-link">
            <p class="wobd-follow-us"><?php esc_html_e( 'Follow us for new updates', WOBD_TD ); ?></p>
            <div class="fb-like" data-href="https://www.facebook.com/accesspressthemes" data-layout="button" data-action="like" data-show-faces="true" data-share="false"></div>
            <a href="https://twitter.com/accesspressthemes" class="twitter-follow-button" data-show-count="false"><?php esc_html_e( "Follow @accesspressthemes", WOBD_TD ); ?></a>
        </div>
    </div>
</div>