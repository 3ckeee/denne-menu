<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function dmp_daily_menu_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'limit' => 14,
    ), $atts, 'daily_menu' );
    
    $args = array(
        'post_type'      => 'daily_menu',
        'posts_per_page' => intval( $atts['limit'] ),
        'orderby'        => 'date',
        'order'          => 'ASC',  // ASC orders oldest to newest.
    );
    
    $query = new WP_Query( $args );
    ob_start();
    
    echo '<div class="daily-menu-list">';
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            echo '<div class="daily-menu-item">';
            echo '<h2>' . get_the_title() . '</h2>';
            echo '<div class="daily-menu-content">' . apply_filters('the_content', get_the_content()) . '</div>';
            echo '</div>';
        }
    } else {
        echo '<p>No daily menus found.</p>';
    }
    echo '</div>';
    
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode( 'daily_menu', 'dmp_daily_menu_shortcode' );