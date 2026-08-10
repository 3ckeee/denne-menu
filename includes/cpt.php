<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function dmp_create_daily_menu_cpt() {
    $labels = array(
        'name'                  => _x( 'Daily Menus', 'Post Type General Name', 'dmp-textdomain' ),
        'singular_name'         => _x( 'Daily Menu', 'Post Type Singular Name', 'dmp-textdomain' ),
        'menu_name'             => __( 'Daily Menus', 'dmp-textdomain' ),
        'name_admin_bar'        => __( 'Daily Menu', 'dmp-textdomain' ),
        'archives'              => __( 'Daily Menu Archives', 'dmp-textdomain' ),
        'attributes'            => __( 'Daily Menu Attributes', 'dmp-textdomain' ),
        'parent_item_colon'     => __( 'Parent Daily Menu:', 'dmp-textdomain' ),
        'all_items'             => __( 'All Daily Menus', 'dmp-textdomain' ),
        'add_new_item'          => __( 'Add New Daily Menu', 'dmp-textdomain' ),
        'add_new'               => __( 'Add New', 'dmp-textdomain' ),
        'new_item'              => __( 'New Daily Menu', 'dmp-textdomain' ),
        'edit_item'             => __( 'Edit Daily Menu', 'dmp-textdomain' ),
        'update_item'           => __( 'Update Daily Menu', 'dmp-textdomain' ),
        'view_item'             => __( 'View Daily Menu', 'dmp-textdomain' ),
        'view_items'            => __( 'View Daily Menus', 'dmp-textdomain' ),
        'search_items'          => __( 'Search Daily Menu', 'dmp-textdomain' ),
        'not_found'             => __( 'Not found', 'dmp-textdomain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'dmp-textdomain' ),
    );
    $args = array(
        'label'                 => __( 'Daily Menu', 'dmp-textdomain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-food',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rest_base'             => 'daily_menu',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    );
    register_post_type( 'daily_menu', $args );
}
add_action( 'init', 'dmp_create_daily_menu_cpt', 0 );

/**
 * Force the classic edit screen for daily menus.
 *
 * The menu body is regenerated from the meta box on every save, so the post
 * editor is not a place the menu can actually be typed — whatever is entered
 * there is thrown away. On top of that, the block editor saves meta boxes in a
 * SECOND request that runs after its own REST save, so the editor keeps showing
 * the pre-save content and can post that stale content back on the next save.
 * The classic screen submits the meta box together with the post in a single
 * request, which removes both problems.
 *
 * 'editor' stays in the post type's supports array so the REST API keeps
 * exposing `content` for the mobile app; it is only dropped from the admin UI
 * below (admin_init does not run for REST requests).
 *
 * @param bool   $use_block_editor Whether to use the block editor.
 * @param string $post_type        Post type being edited.
 * @return bool
 */
function dmp_disable_block_editor( $use_block_editor, $post_type ) {
    return ( 'daily_menu' === $post_type ) ? false : $use_block_editor;
}
add_filter( 'use_block_editor_for_post_type', 'dmp_disable_block_editor', 10, 2 );

/**
 * Hide the content editor on the daily menu screen so the meta box is the only
 * place the menu can be edited.
 */
function dmp_remove_editor_support() {
    remove_post_type_support( 'daily_menu', 'editor' );
}
add_action( 'admin_init', 'dmp_remove_editor_support' );
