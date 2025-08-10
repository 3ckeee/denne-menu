<?php
/*
Plugin Name: Daily Menu Plugin
Plugin URI: https://diverzitystudios.sk
Description: A plugin to manage daily menus via a custom post type with default template content and a fill-out form. Accessible for all users.
Version: 0.9.7
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