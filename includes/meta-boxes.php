<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add the meta box to the Daily Menu post type.
 */
function dmp_add_daily_menu_meta_box() {
    add_meta_box(
        'dmp_daily_menu_meta',
        __( 'Daily Menu Details', 'dmp-textdomain' ),
        'dmp_render_daily_menu_meta_box',
        'daily_menu',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'dmp_add_daily_menu_meta_box' );

/**
 * Render the meta box form.
 */
function dmp_render_daily_menu_meta_box( $post ) {
    // Use nonce for verification.
    wp_nonce_field( 'dmp_daily_menu_meta_box', 'dmp_daily_menu_meta_box_nonce' );

    // Retrieve existing meta data if available.
    $menu_date      = get_post_meta( $post->ID, '_dmp_menu_date', true );
    $soup           = get_post_meta( $post->ID, '_dmp_soup', true );
    $soup_weight    = get_post_meta( $post->ID, '_dmp_soup_weight', true );
    $soup_allergens = get_post_meta( $post->ID, '_dmp_soup_allergens', true );
    
    $menu1          = get_post_meta( $post->ID, '_dmp_menu1', true );
    $menu1_weight   = get_post_meta( $post->ID, '_dmp_menu1_weight', true );
    $menu1_price    = get_post_meta( $post->ID, '_dmp_menu1_price', true );
    $menu1_allergens= get_post_meta( $post->ID, '_dmp_menu1_allergens', true );
    
    $menu2          = get_post_meta( $post->ID, '_dmp_menu2', true );
    $menu2_weight   = get_post_meta( $post->ID, '_dmp_menu2_weight', true );
    $menu2_price    = get_post_meta( $post->ID, '_dmp_menu2_price', true );
    $menu2_allergens= get_post_meta( $post->ID, '_dmp_menu2_allergens', true );
    
    $business_lunch          = get_post_meta( $post->ID, '_dmp_business_lunch', true );
    $business_lunch_weight   = get_post_meta( $post->ID, '_dmp_business_lunch_weight', true );
    $business_lunch_price    = get_post_meta( $post->ID, '_dmp_business_lunch_price', true );
    $business_lunch_allergens= get_post_meta( $post->ID, '_dmp_business_lunch_allergens', true );
    ?>
    <div id="dmp_daily_menu_meta">
        <p>
            <label for="dmp_menu_date"><strong>Dátum:</strong></label><br />
            <input type="text" id="dmp_menu_date" name="dmp_menu_date" value="<?php echo esc_attr( $menu_date ); ?>" placeholder="Pondelok 17.03.2025" style="width:100%;" />
        </p>
        <hr />
        <p>
            <label for="dmp_soup"><strong>Polievka:</strong></label><br />
            <input type="text" id="dmp_soup" name="dmp_soup" value="<?php echo esc_attr( $soup ); ?>" placeholder="Hŕstková" style="width:100%;" />
        </p>
        <p>
            <label for="dmp_soup_weight"><strong>Váha/Objem:</strong></label><br />
            <input type="text" id="dmp_soup_weight" name="dmp_soup_weight" value="<?php echo esc_attr( $soup_weight ); ?>" placeholder="250ml" style="width:100%;" />
        </p>
        <p>
            <label for="dmp_soup_allergens" style="font-size:0.8em;"><strong>Alergény:</strong></label><br />
            <input type="text" id="dmp_soup_allergens" name="dmp_soup_allergens" value="<?php echo esc_attr( $soup_allergens ); ?>" placeholder="1,9" style="width:100%; font-size:0.8em;" />
        </p>
        <hr />
        <p>
            <label for="dmp_menu1"><strong>Menu 1:</strong></label><br />
            <input type="text" id="dmp_menu1" name="dmp_menu1" value="<?php echo esc_attr( $menu1 ); ?>" placeholder="Kuracia rolka ..." style="width:100%;" />
        </p>
        <p>
            <label for="dmp_menu1_weight"><strong>Váha/Objem:</strong></label>
            <input type="text" id="dmp_menu1_weight" name="dmp_menu1_weight" value="<?php echo esc_attr( $menu1_weight ); ?>" placeholder="350g" style="width:30%;" />
            <label for="dmp_menu1_price"><strong>Cena:</strong></label>
            <input type="text" id="dmp_menu1_price" name="dmp_menu1_price" value="<?php echo esc_attr( $menu1_price ); ?>" placeholder="10,90€" style="width:30%;" />
        </p>
        <p>
            <label for="dmp_menu1_allergens" style="font-size:0.8em;"><strong>Alergény:</strong></label><br />
            <input type="text" id="dmp_menu1_allergens" name="dmp_menu1_allergens" value="<?php echo esc_attr( $menu1_allergens ); ?>" placeholder="7" style="width:100%; font-size:0.8em;" />
        </p>
        <hr />
        <p>
            <label for="dmp_menu2"><strong>Menu 2:</strong></label><br />
            <input type="text" id="dmp_menu2" name="dmp_menu2" value="<?php echo esc_attr( $menu2 ); ?>" placeholder="Zeleninové fašírky..." style="width:100%;" />
        </p>
        <p>
            <label for="dmp_menu2_weight"><strong>Váha/Objem:</strong></label>
            <input type="text" id="dmp_menu2_weight" name="dmp_menu2_weight" value="<?php echo esc_attr( $menu2_weight ); ?>" placeholder="350g" style="width:30%;" />
            <label for="dmp_menu2_price"><strong>Cena:</strong></label>
            <input type="text" id="dmp_menu2_price" name="dmp_menu2_price" value="<?php echo esc_attr( $menu2_price ); ?>" placeholder="10,90€" style="width:30%;" />
        </p>
        <p>
            <label for="dmp_menu2_allergens" style="font-size:0.8em;"><strong>Alergény:</strong></label><br />
            <input type="text" id="dmp_menu2_allergens" name="dmp_menu2_allergens" value="<?php echo esc_attr( $menu2_allergens ); ?>" placeholder="1" style="width:100%; font-size:0.8em;" />
        </p>
        <hr />
        <p>
            <label for="dmp_business_lunch"><strong>Business Lunch:</strong></label><br />
            <input type="text" id="dmp_business_lunch" name="dmp_business_lunch" value="<?php echo esc_attr( $business_lunch ); ?>" placeholder="Grilované LÚPANÉ tigrie krevety ..." style="width:100%;" />
        </p>
        <p>
            <label for="dmp_business_lunch_weight"><strong>Váha/Objem:</strong></label>
            <input type="text" id="dmp_business_lunch_weight" name="dmp_business_lunch_weight" value="<?php echo esc_attr( $business_lunch_weight ); ?>" placeholder="350g" style="width:30%;" />
            <label for="dmp_business_lunch_price"><strong>Cena:</strong></label>
            <input type="text" id="dmp_business_lunch_price" name="dmp_business_lunch_price" value="<?php echo esc_attr( $business_lunch_price ); ?>" placeholder="19,90€" style="width:30%;" />
        </p>
        <p>
            <label for="dmp_business_lunch_allergens" style="font-size:0.8em;"><strong>Alergény:</strong></label><br />
            <input type="text" id="dmp_business_lunch_allergens" name="dmp_business_lunch_allergens" value="<?php echo esc_attr( $business_lunch_allergens ); ?>" placeholder="1,2" style="width:100%; font-size:0.8em;" />
        </p>
    </div>
    <?php
}

/**
 * Save the meta box data when the post is saved.
 */
function dmp_save_daily_menu_meta_box_data( $post_id ) {
    // Check if our nonce is set.
    if ( ! isset( $_POST['dmp_daily_menu_meta_box_nonce'] ) ) {
        return;
    }
    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['dmp_daily_menu_meta_box_nonce'], 'dmp_daily_menu_meta_box' ) ) {
        return;
    }
    // Prevent autosave from overwriting our data.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Check user permissions.
    if ( isset( $_POST['post_type'] ) && 'daily_menu' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }
    
    // Define the meta fields to be saved.
    $fields = array(
        'dmp_menu_date'               => '_dmp_menu_date',
        'dmp_soup'                    => '_dmp_soup',
        'dmp_soup_weight'             => '_dmp_soup_weight',
        'dmp_soup_allergens'          => '_dmp_soup_allergens',
        'dmp_menu1'                   => '_dmp_menu1',
        'dmp_menu1_weight'            => '_dmp_menu1_weight',
        'dmp_menu1_price'             => '_dmp_menu1_price',
        'dmp_menu1_allergens'         => '_dmp_menu1_allergens',
        'dmp_menu2'                   => '_dmp_menu2',
        'dmp_menu2_weight'            => '_dmp_menu2_weight',
        'dmp_menu2_price'             => '_dmp_menu2_price',
        'dmp_menu2_allergens'         => '_dmp_menu2_allergens',
        'dmp_business_lunch'          => '_dmp_business_lunch',
        'dmp_business_lunch_weight'   => '_dmp_business_lunch_weight',
        'dmp_business_lunch_price'    => '_dmp_business_lunch_price',
        'dmp_business_lunch_allergens'=> '_dmp_business_lunch_allergens'
    );
    
    foreach( $fields as $field_name => $meta_key ) {
        if ( isset( $_POST[ $field_name ] ) ) {
            update_post_meta( $post_id, $meta_key, sanitize_text_field( $_POST[ $field_name ] ) );
        }
    }
    
    // Build the final post content from meta fields.
    $content  = "<p><strong>Dátum:</strong> " . get_post_meta( $post_id, '_dmp_menu_date', true ) . "</p>";
    $content .= "<p><strong>Polievka:</strong> " . get_post_meta( $post_id, '_dmp_soup', true ) . " &nbsp;&nbsp;&nbsp;&nbsp;<strong>Váha/Objem:</strong> " . get_post_meta( $post_id, '_dmp_soup_weight', true ) . "</p>";
    $content .= "<p style='font-size:0.8em;'><strong>Alergény:</strong> " . get_post_meta( $post_id, '_dmp_soup_allergens', true ) . "</p>";
    $content .= "<hr />";
    $content .= "<p><strong>Menu 1:</strong> " . get_post_meta( $post_id, '_dmp_menu1', true ) . " &nbsp;&nbsp;&nbsp;&nbsp;<strong>Váha/Objem:</strong> " . get_post_meta( $post_id, '_dmp_menu1_weight', true ) . " &nbsp;&nbsp;&nbsp;&nbsp;<strong>Cena:</strong> " . get_post_meta( $post_id, '_dmp_menu1_price', true ) . "</p>";
    $content .= "<p style='font-size:0.8em;'><strong>Alergény:</strong> " . get_post_meta( $post_id, '_dmp_menu1_allergens', true ) . "</p>";
    $content .= "<hr />";
    $content .= "<p><strong>Menu 2:</strong> " . get_post_meta( $post_id, '_dmp_menu2', true ) . " &nbsp;&nbsp;&nbsp;&nbsp;<strong>Váha/Objem:</strong> " . get_post_meta( $post_id, '_dmp_menu2_weight', true ) . " &nbsp;&nbsp;&nbsp;&nbsp;<strong>Cena:</strong> " . get_post_meta( $post_id, '_dmp_menu2_price', true ) . "</p>";
    $content .= "<p style='font-size:0.8em;'><strong>Alergény:</strong> " . get_post_meta( $post_id, '_dmp_menu2_allergens', true ) . "</p>";
    $content .= "<hr />";
    $content .= "<p><strong>Business Lunch:</strong> " . get_post_meta( $post_id, '_dmp_business_lunch', true ) . " &nbsp;&nbsp;&nbsp;&nbsp;<strong>Váha/Objem:</strong> " . get_post_meta( $post_id, '_dmp_business_lunch_weight', true ) . " &nbsp;&nbsp;&nbsp;&nbsp;<strong>Cena:</strong> " . get_post_meta( $post_id, '_dmp_business_lunch_price', true ) . "</p>";
    $content .= "<p style='font-size:0.8em;'><strong>Alergény:</strong> " . get_post_meta( $post_id, '_dmp_business_lunch_allergens', true ) . "</p>";
    
    // Prevent recursive triggering of save_post by temporarily removing our action.
    remove_action( 'save_post', 'dmp_save_daily_menu_meta_box_data' );
    wp_update_post( array(
        'ID'           => $post_id,
        'post_content' => $content,
    ) );
    add_action( 'save_post', 'dmp_save_daily_menu_meta_box_data' );
}
add_action( 'save_post', 'dmp_save_daily_menu_meta_box_data' );