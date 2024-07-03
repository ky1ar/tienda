<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );
if ( ! class_exists( 'WOBD_Setup' ) ) {

    class WOBD_Setup extends WOBD_Library{

        /**
         * Includes all the backend functionality
         *
         * @since 1.0.0
         */
        function __construct(){

            add_filter( 'gettext', array( $this, 'wobd_change_publish_button' ), 10, 2 );
            add_action( 'admin_head-post.php', array( $this, 'wobd_hide_publishing_actions' ) );
            add_action( 'admin_head-post-new.php', array( $this, 'wobd_hide_publishing_actions' ) );
            add_action( 'add_meta_boxes', array( $this, 'wobd_add_badges_setup' ) ); //added blog showcase metabox
            add_action( 'add_meta_boxes', array( $this, 'wobd_badge_preview' ) ); //added blog showcase metabox
            add_action( 'add_meta_boxes', array( $this, 'wobd_upgrade_pro' ) ); //added blog showcase metabox
            add_action( 'add_meta_boxes', array( $this, 'wobd_individual_badge_settings' ) ); //added blog showcase metabox
            add_filter( 'post_row_actions', array( $this, 'wobd_remove_row_actions' ), 10, 1 );
            add_filter( 'manage_wobd-badge-designer_posts_columns', array( $this, 'wobd_columns_head' ) );
            add_action( 'manage_wobd-badge-designer_posts_custom_column', array( $this, 'wobd_columns_content' ), 10, 2 );
            add_action( 'woocommerce_before_single_product_summary', array( $this, 'wobd_display_single_page_badges' ), 10 );
            add_action( 'admin_post_wobd_settings_save', array( $this, 'wobd_form_settings' ) );
            add_filter( 'woocommerce_sale_flash', array( $this, 'wobd_custom_sale_text' ), 2, 2 );
            add_filter( 'post_thumbnail_html', array( $this, 'wobd_badge_on_product' ), 999, 1 );
            add_filter( 'woocommerce_product_get_image', array( $this, 'wobd_badge_on_product' ), 999, 1 );
        }

        function wobd_change_publish_button( $translation, $text ){
            if ( 'wobd-badge-designer' == get_post_type() )
                if ( $text == 'Publish' || $text == 'Update' )
                    return 'Save';
            return $translation;
        }

        function wobd_hide_publishing_actions(){
            $my_post_type = 'wobd-badge-designer';
            global $post;
            if ( $post -> post_type == $my_post_type ) {
                echo '
                <style type="text/css">
                    #misc-publishing-actions,
                    #minor-publishing-actions{
                        display:none;
                    }
                    #view-post-btn, .updated a,#screen-meta-links .screen-meta-toggle
                {
                display: none;
                }
                </style>
            ';
            }
        }

        function wobd_add_badges_setup(){
            add_meta_box( 'wobd_add_badges', __( 'Badge Designer Lite For WooCommerce', WOBD_TD ), array( $this, 'wobd_add_action' ), 'wobd-badge-designer', 'normal', 'low' );
        }

        function wobd_add_action( $post ){
            wp_nonce_field( basename( __FILE__ ), 'wobd_badge_nonce' );
            include(WOBD_PATH . 'includes/admin/view/wobd-add-setting.php');
        }

        function wobd_badge_preview(){
            add_meta_box( 'wobd_preview_badges', __( 'Badge Preview', WOBD_TD ), array( $this, 'wobd_preview_action' ), 'wobd-badge-designer', 'side', 'default' );
        }

        function wobd_preview_action( $post ){
            wp_nonce_field( basename( __FILE__ ), 'wobd_badge_nonce' );
            include(WOBD_PATH . 'includes/admin/view/wobd-preview.php');
        }

        function wobd_upgrade_pro(){
            add_meta_box( 'wobd_upgrade_badges', __( 'Upgrade to Woo Badge Designer', WOBD_TD ), array( $this, 'wobd_upgrade_action' ), 'wobd-badge-designer', 'side', 'default' );
        }

        function wobd_upgrade_action( $post ){
            wp_nonce_field( basename( __FILE__ ), 'wobd_badge_nonce' );
            include(WOBD_PATH . 'includes/admin/view/wobd-upgrade.php');
        }

        function wobd_individual_badge_settings(){
            add_meta_box( 'wobd_each_badges_settings', __( 'Badge Designer Lite For WooCommerce Setting', WOBD_TD ), array( $this, 'wobd_each_badge_action' ), 'product', 'normal', 'low' );
        }

        function wobd_each_badge_action( $post ){
            wp_nonce_field( basename( __FILE__ ), 'wobd_badge_nonce' );
            include(WOBD_PATH . 'includes/admin/view/wobd-each-badges.php');
        }

        function wobd_remove_row_actions( $actions ){
            if ( get_post_type() == 'wobd-badge-designer' ) { // choose the post type where you want to hide the button
                unset( $actions[ 'view' ] ); // this hides the VIEW button on your edit post screen
                unset( $actions[ 'inline hide-if-no-js' ] );
            }
            return $actions;
        }

        /* Add custom column to post list */

        function wobd_columns_head( $columns ){
            unset( $columns[ 'date' ] );
            $columns[ 'badge_type' ] = __( 'Badge Type', WOBD_TD );
            $columns[ 'badge_text_letter' ] = __( 'Badges', WOBD_TD );
            $columns[ 'badge_date' ] = __( 'Date', WOBD_TD );
            return $columns;
        }

        function wobd_columns_content( $column, $post_id ){
            $id = $post_id;
            $wobd_option = get_post_meta( $post_id, 'wobd_option', true );
            if ( $column == 'badge_type' ) {
                if ( isset( $wobd_option[ 'background_type' ] ) && $wobd_option[ 'background_type' ] == 'text-background' ) {
                    $value = $wobd_option[ 'text_design_templates' ];
                    $template = explode( '-', $value );
                    ?>
                    <img class="wobd-live-image" src="<?php echo WOBD_IMG_DIR . 'text-design/' . $template[ 1 ] . '.png' ?>">
                    <?php
                } else {
                    ?>
                    <img class="wobd-live-image" src="<?php echo WOBD_IMG_DIR . 'badges/' . $wobd_option[ 'existing_image' ] . '.png' ?>">
                    <?php
                }
            }
            if ( $column == 'badge_text_letter' ) {

                if ( isset( $wobd_option[ 'badge_type' ] ) && $wobd_option[ 'badge_type' ] == 'text' ) {
                    echo $wobd_option[ 'badge_text' ];
                }
            }
            if ( $column == 'badge_date' ) {
                echo get_the_date( 'l, F j, Y', $post_id ) . "<br>" . get_post_status( $post_id );
            }
        }

        function wobd_display_single_page_badges(){
            remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
            include(WOBD_PATH . 'includes/frontend/template/single-product.php');
            if ($wobd_common_settings['wobd_default_sale_badge'] != 'disable' && $wobd_common_settings['wobd_default_sale_badge'] != 'default') {
                    if ($product->is_on_sale() && $product->is_in_stock()) {
                        $wobd_post_id = $wobd_common_settings['wobd_default_sale_badge'];
                        $wobd_option = get_post_meta($wobd_post_id, 'wobd_option', true);
                        include(WOBD_PATH . 'includes/frontend/template/sales/sales-content.php');
                    }
                }
                if (isset($wobd_common_settings['wobd_stock_badge']) && $wobd_common_settings['wobd_stock_badge'] != 'default') {
                    if (!$product->is_in_stock()) {
                        remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
                        $wobd_stock_id = $wobd_common_settings['wobd_stock_badge'];
                        $wobd_option = get_post_meta($wobd_stock_id, 'wobd_option', true);
                        include(WOBD_PATH . 'includes/frontend/badge-content.php');
                    }
                }
        }

        function wobd_display_thumbnail_badges( $html ){
            $wobd_common_settings = get_option( 'wobd_common_settings' );
            if ( isset( $wobd_common_settings[ 'wobd_enable_single_page_badge' ] ) && $wobd_common_settings[ 'wobd_enable_single_page_badge' ] == '1' ) {
                include(WOBD_PATH . 'includes/frontend/badges.php');
            }
            return $html;
        }

        /**
         * Add form value in database
         *
         * @since 1.0.1
         * */
        function wobd_form_settings(){
            if ( isset( $_POST[ 'wobd_form_nonce_field' ] ) && wp_verify_nonce( $_POST[ 'wobd_form_nonce_field' ], 'wobd_form_nonce' ) ) {

                if ( isset( $_POST[ 'wobd_common_settings' ] ) ) {
// sanitize array
                    $wobd_common_option = array_map( 'sanitize_text_field', $_POST[ 'wobd_common_settings' ] );
// save data
                    update_option( 'wobd_common_settings', $wobd_common_option );
                }
            }
            wp_redirect( admin_url( 'admin.php?page=wobd-badges-settings&message=1' ) );
            exit;
        }

        function wobd_custom_sale_text( $text, $flash ){
            $wobd_common_settings = get_option( 'wobd_common_settings' );
            if ( $wobd_common_settings[ 'wobd_default_sale_badge' ] == 'disable' ) {
                $text = '';
                return $text;
            } else if ( $wobd_common_settings[ 'wobd_default_sale_badge' ] == 'default' ) {
                return $text;
            }
        }

        function wobd_badge_on_product( $html ){
            ob_start();
            global $post, $product;
            if ( $product ) {
                $wobd_common_settings = get_option( 'wobd_common_settings' );
                include(WOBD_PATH . 'includes/frontend/badges.php');
                if ( $product -> is_on_sale() ) {
                    $sale_badge = isset( $wobd_common_settings[ 'wobd_default_sale_badge' ] ) ? esc_attr( $wobd_common_settings[ 'wobd_default_sale_badge' ] ) : 'disable';
                    if ( ($sale_badge != 'disable') && ($sale_badge != 'default') ) {
                        $wobd_post_id = $wobd_common_settings[ 'wobd_default_sale_badge' ];
                        $wobd_option = get_post_meta( $wobd_post_id, 'wobd_option', true );
                        include(WOBD_PATH . 'includes/frontend/badge-content.php');
                    }
                }
                if ( isset( $wobd_common_settings[ 'wobd_stock_badge' ] ) && $wobd_common_settings[ 'wobd_stock_badge' ] != 'default' ) {
                    if ( ! $product -> is_in_stock() ) {
                        $wobd_stock_id = $wobd_common_settings[ 'wobd_stock_badge' ];
                        $wobd_option = get_post_meta( $wobd_stock_id, 'wobd_option', true );
                        include(WOBD_PATH . 'includes/frontend/badge-content.php');
                    }
                }
                $data = ob_get_contents();
                if ( is_admin() ) {
                    $html = $html;
                } else {
                    if ( is_product() ) {
                        if ( did_action( woocommerce_before_single_product_summary ) ) {
                            $html = '<div class="wobd-badges-wrapper">' . $data . $html . '</div>';
                        }
                    } else {
                        $html = '<div class="wobd-badges-wrapper">' . $data . $html . '</div>';
                    }
                }
                ob_end_clean();
                return $html;
            }
        }

    }

    new WOBD_Setup();
}