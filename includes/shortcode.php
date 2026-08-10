<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Print a single menu, built from the meta box fields.
 *
 * Rendering from the fields rather than from post_content means the page shows
 * what the form holds even if a save ever failed to regenerate the body. Posts
 * predating the meta box (empty fields) still fall back to their content.
 *
 * @param int $post_id Daily menu post ID.
 * @return string
 */
function dmp_render_menu_body( $post_id ) {
    $values = dmp_get_menu_values( $post_id );

    if ( '' === trim( implode( '', $values ) ) ) {
        return apply_filters( 'the_content', get_the_content( null, false, $post_id ) );
    }

    return wptexturize( dmp_build_menu_content( $values ) );
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
            echo '<div class="daily-menu-content">' . dmp_render_menu_body( get_the_ID() ) . '</div>';
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