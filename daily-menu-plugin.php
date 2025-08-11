<?php
/*
Plugin Name: Daily Menu Plugin
Plugin URI: https://diverzitystudios.sk
Description: A plugin to manage daily menus via a custom post type with default template content and a fill-out form. Accessible for all users.
Version: 0.9.9
Author: Erik Kokinda
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'DMP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'DMP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Include necessary files.
require_once DMP_PLUGIN_DIR . 'includes/cpt.php';
require_once DMP_PLUGIN_DIR . 'includes/default-content.php';
require_once DMP_PLUGIN_DIR . 'includes/meta-boxes.php';
require_once DMP_PLUGIN_DIR . 'includes/shortcode.php';

// Enqueue front-end scripts and styles.
function dmp_enqueue_scripts() {
    wp_enqueue_style( 'dmp-style', DMP_PLUGIN_URL . 'css/style.css', array(), '0.9.5' );
    wp_enqueue_script( 'dmp-script', DMP_PLUGIN_URL . 'js/script.js', array( 'jquery' ), '0.9.5', true );
}
add_action( 'wp_enqueue_scripts', 'dmp_enqueue_scripts' );

// Register REST API endpoint for iOS app
function dmp_register_api_routes() {
    register_rest_route('daily-menu/v1', '/menus', array(
        'methods' => 'GET',
        'callback' => 'dmp_get_daily_menus_api',
        'permission_callback' => '__return_true',
        'args' => array(
            'limit' => array(
                'default' => 14,
                'type' => 'integer',
                'minimum' => 1,
                'maximum' => 30,
            ),
        ),
    ));
}
add_action('rest_api_init', 'dmp_register_api_routes');

// Make custom meta fields available in WordPress REST API
function dmp_register_meta_for_rest_api() {
    register_meta('post', '_dmp_menu_date', array(
        'show_in_rest' => true,
        'type' => 'string',
        'single' => true
    ));
    register_meta('post', '_dmp_soup', array(
        'show_in_rest' => true,
        'type' => 'string',
        'single' => true
    ));
    register_meta('post', '_dmp_soup_weight', array(
        'show_in_rest' => true,
        'type' => 'string',
        'single' => true
    ));
    register_meta('post', '_dmp_soup_allergens', array(
        'show_in_rest' => true,
        'type' => 'string',
        'single' => true
    ));
    register_meta('post', '_dmp_menu1', array(
        'show_in_rest' => true,
        'type' => 'string',
        'single' => true
    ));
    register_meta('post', '_dmp_menu1_weight', array(
        'show_in_rest' => true,
        'type' => 'string',
        'single' => true
    ));
    register_meta('post', '_dmp_menu1_price', array(
        'show_in_rest' => true,
        'type' => 'string',
        'single' => true
    ));
    register_meta('post', '_dmp_menu1_allergens', array(
        'show_in_rest' => true,
        'type' => 'string',
        'single' => true
    ));
    register_meta('post', '_dmp_menu2', array(
        'show_in_rest' => true,
        'type' => 'string',
        'single' => true
    ));
    register_meta('post', '_dmp_menu2_weight', array(
        'show_in_rest' => true,
        'type' => 'string',
        'single' => true
    ));
    register_meta('post', '_dmp_menu2_price', array(
        'show_in_rest' => true,
        'type' => 'string',
        'single' => true
    ));
    register_meta('post', '_dmp_menu2_allergens', array(
        'show_in_rest' => true,
        'type' => 'string',
        'single' => true
    ));
    register_meta('post', '_dmp_business_lunch', array(
        'show_in_rest' => true,
        'type' => 'string',
        'single' => true
    ));
    register_meta('post', '_dmp_business_lunch_weight', array(
        'show_in_rest' => true,
        'type' => 'string',
        'single' => true
    ));
    register_meta('post', '_dmp_business_lunch_price', array(
        'show_in_rest' => true,
        'type' => 'string',
        'single' => true
    ));
    register_meta('post', '_dmp_business_lunch_allergens', array(
        'show_in_rest' => true,
        'type' => 'string',
        'single' => true
    ));
}
add_action('init', 'dmp_register_meta_for_rest_api');

// API callback function to get daily menus
function dmp_get_daily_menus_api(WP_REST_Request $request) {
    $limit = $request->get_param('limit') ?: 14;
    
    // Query daily menu posts
    $args = array(
        'post_type' => 'daily_menu',
        'posts_per_page' => intval($limit),
        'orderby' => 'date',
        'order' => 'ASC',
        'post_status' => 'publish'
    );
    
    $query = new WP_Query($args);
    $menus = array();
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            
            // Get all meta fields for this daily menu
            $menu_data = array(
                'id' => $post_id,
                'title' => get_the_title(),
                'date' => get_post_meta($post_id, '_dmp_menu_date', true),
                'soup' => array(
                    'name' => get_post_meta($post_id, '_dmp_soup', true),
                    'weight' => get_post_meta($post_id, '_dmp_soup_weight', true),
                    'allergens' => get_post_meta($post_id, '_dmp_soup_allergens', true)
                ),
                'menu1' => array(
                    'name' => get_post_meta($post_id, '_dmp_menu1', true),
                    'weight' => get_post_meta($post_id, '_dmp_menu1_weight', true),
                    'price' => get_post_meta($post_id, '_dmp_menu1_price', true),
                    'allergens' => get_post_meta($post_id, '_dmp_menu1_allergens', true)
                ),
                'menu2' => array(
                    'name' => get_post_meta($post_id, '_dmp_menu2', true),
                    'weight' => get_post_meta($post_id, '_dmp_menu2_weight', true),
                    'price' => get_post_meta($post_id, '_dmp_menu2_price', true),
                    'allergens' => get_post_meta($post_id, '_dmp_menu2_allergens', true)
                ),
                'business_lunch' => array(
                    'name' => get_post_meta($post_id, '_dmp_business_lunch', true),
                    'weight' => get_post_meta($post_id, '_dmp_business_lunch_weight', true),
                    'price' => get_post_meta($post_id, '_dmp_business_lunch_price', true),
                    'allergens' => get_post_meta($post_id, '_dmp_business_lunch_allergens', true)
                )
            );
            
            $menus[] = $menu_data;
        }
    }
    
    wp_reset_postdata();
    
    return rest_ensure_response(array(
        'success' => true,
        'message' => 'Daily menus retrieved successfully',
        'data' => $menus,
        'count' => count($menus)
    ));
}