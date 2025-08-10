<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function dmp_set_default_daily_menu_content( $content, $post ) {
    if ( $post->post_type === 'daily_menu' ) {
        $default  = '<p><strong>Dátum:</strong> [insert day and date]</p>';
        $default .= '<p><strong>Polievka:</strong> [insert soup] &nbsp;&nbsp;&nbsp;&nbsp; <strong>Váha/Objem:</strong> [insert weight/volume]</p>';
        $default .= '<p style="font-size:0.8em;"><strong>Alergény:</strong> [insert alergens for soup]</p>';
        $default .= '<br />';
        $default .= '<p><strong>Menu 1:</strong> [insert main dish] &nbsp;&nbsp;&nbsp;&nbsp; <strong>Váha/Objem:</strong> [insert weight/volume] &nbsp;&nbsp;&nbsp;&nbsp; <strong>Cena:</strong> [insert price]</p>';
        $default .= '<p style="font-size:0.8em;"><strong>Alergény:</strong> [insert alergens for menu 1]</p>';
        $default .= '<br />';
        $default .= '<p><strong>Menu 2:</strong> [insert main dish] &nbsp;&nbsp;&nbsp;&nbsp; <strong>Váha/Objem:</strong> [insert weight/volume] &nbsp;&nbsp;&nbsp;&nbsp; <strong>Cena:</strong> [insert price]</p>';
        $default .= '<p style="font-size:0.8em;"><strong>Alergény:</strong> [insert alergens for menu 2]</p>';
        $default .= '<br />';
        $default .= '<p><strong>Business Lunch:</strong> [insert business lunch dish] &nbsp;&nbsp;&nbsp;&nbsp; <strong>Váha/Objem:</strong> [insert weight/volume] &nbsp;&nbsp;&nbsp;&nbsp; <strong>Cena:</strong> [insert price]</p>';
        $default .= '<p style="font-size:0.8em;"><strong>Alergény:</strong> [insert alergens for business lunch]</p>';
        return $default;
    }
    return $content;
}
add_filter( 'default_content', 'dmp_set_default_daily_menu_content', 10, 2 );