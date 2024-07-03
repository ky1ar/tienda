<?php

defined( 'ABSPATH' ) or die( "No script kiddies please!" );
$labels = array(
    'name' => _x( 'Badge Designer lite For WooCommerce', 'post type general name', WOBD_TD ),
    'singular_name' => _x( 'Badge Designer lite For WooCommerce', 'post type singular name', WOBD_TD ),
    'menu_name' => _x( 'Badge Designer lite For WooCommerce', 'admin menu', WOBD_TD ),
    'name_admin_bar' => _x( 'Badge Designer lite For WooCommerce', 'add new on admin bar', WOBD_TD ),
    'add_new' => _x( 'Add Badge', 'Badge', WOBD_TD ),
    'add_new_item' => __( 'Add New Badge', WOBD_TD ),
    'new_item' => __( 'New Badge', WOBD_TD ),
    'edit_item' => __( 'Edit Badge', WOBD_TD ),
    'view_item' => __( 'View Badge', WOBD_TD ),
    'all_items' => __( 'All Badge', WOBD_TD ),
    'search_items' => __( 'Search Badge', WOBD_TD ),
    'parent_item_colon' => __( 'Parent Badge Designer lite For WooCommerce:', WOBD_TD ),
    'not_found' => __( 'Badge not found.', WOBD_TD ),
    'not_found_in_trash' => __( 'No Badge found in Trash.', WOBD_TD )
);

$args = array(
    'labels' => $labels,
    'description' => __( 'Description.', WOBD_TD ),
    'public' => false,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_icon' => 'dashicons-awards',
    'query_var' => true,
    'rewrite' => array( 'slug' => WOBD_TD ),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title' )
);
register_post_type( 'wobd-badge-designer', $args );
