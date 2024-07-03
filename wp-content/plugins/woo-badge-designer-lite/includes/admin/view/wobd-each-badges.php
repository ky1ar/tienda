<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );
global $post;
$post_id = $post -> ID;
$wobd_advance_option = get_post_meta( $post_id, 'wobd_advance_option', true );
?>
<div class="wobd-each-badge-container">
    <div class ="wobd-badge-option-wrap">
        <label><?php
            esc_html_e( 'Badge ', WOBD_TD );
            ?></label>
        <div class="wobd-badge-field-wrap">
            <div class="wobd-badge-field-inner-wrap">
                <select name = "wobd_advance_option[wobd_badge_each_position]" class = "wobd-advance-position">
                    <option value="none" <?php if ( ! empty( $wobd_advance_option[ 'wobd_badge_each_position' ] ) ) selected( $wobd_advance_option[ 'wobd_badge_each_position' ], 'none' ); ?>><?php esc_html_e( 'None', WOBD_TD ); ?></option>
                    <?php
                    $position = $badges_list_name;
                    $args = array(
                        'post_type' => 'wobd-badge-designer',
                        'posts_per_page' => -1,
                        'post_status' => 'publish',
                    );
                    $query = new WP_Query( $args );
                    if ( $query -> have_posts() ) {
                        while ( $query -> have_posts() ) {
                            $query -> the_post();
                            $badge_post_id = get_the_ID();
                            $wobd_option = get_post_meta( $badge_post_id, 'wobd_option', true );
                            ?>
                            <option value="<?php echo $badge_post_id; ?>" <?php if ( ! empty( $wobd_advance_option[ 'wobd_badge_each_position' ] ) ) selected( $wobd_advance_option[ 'wobd_badge_each_position' ], $badge_post_id ); ?>><?php the_title(); ?></option>
                            <?php
                        }
                    }
                    wp_reset_postdata();
                    ?>
                </select>
            </div>
        </div>
    </div>
</div>
