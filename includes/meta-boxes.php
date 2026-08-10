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
 * The meta box fields, keyed by request field name.
 *
 * @return array<string,string> Field name => meta key.
 */
function dmp_get_menu_fields() {
    return array(
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
}

/**
 * Read every menu field for a post, keyed by meta key.
 *
 * @param int $post_id Daily menu post ID.
 * @return array<string,string>
 */
function dmp_get_menu_values( $post_id ) {
    $values = array();
    foreach ( dmp_get_menu_fields() as $meta_key ) {
        $values[ $meta_key ] = (string) get_post_meta( $post_id, $meta_key, true );
    }
    return $values;
}

/**
 * Render the menu as HTML.
 *
 * This is the single source of the daily menu markup: it is stored in
 * post_content on save (so the REST API and the app keep working) and is what
 * the shortcode prints, so the page can never drift from the form.
 *
 * @param array<string,string> $values Meta key => value, as from dmp_get_menu_values().
 * @return string
 */
function dmp_build_menu_content( $values ) {
    $get = static function ( $meta_key ) use ( $values ) {
        return isset( $values[ $meta_key ] ) ? esc_html( $values[ $meta_key ] ) : '';
    };
    $gap = ' &nbsp;&nbsp;&nbsp;&nbsp;';

    $content  = "<p><strong>Dátum:</strong> " . $get( '_dmp_menu_date' ) . "</p>";
    $content .= "<p><strong>Polievka:</strong> " . $get( '_dmp_soup' ) . $gap . "<strong>Váha/Objem:</strong> " . $get( '_dmp_soup_weight' ) . "</p>";
    $content .= "<p style='font-size:0.8em;'><strong>Alergény:</strong> " . $get( '_dmp_soup_allergens' ) . "</p>";
    $content .= "<hr />";
    $content .= "<p><strong>Menu 1:</strong> " . $get( '_dmp_menu1' ) . $gap . "<strong>Váha/Objem:</strong> " . $get( '_dmp_menu1_weight' ) . $gap . "<strong>Cena:</strong> " . $get( '_dmp_menu1_price' ) . "</p>";
    $content .= "<p style='font-size:0.8em;'><strong>Alergény:</strong> " . $get( '_dmp_menu1_allergens' ) . "</p>";
    $content .= "<hr />";
    $content .= "<p><strong>Menu 2:</strong> " . $get( '_dmp_menu2' ) . $gap . "<strong>Váha/Objem:</strong> " . $get( '_dmp_menu2_weight' ) . $gap . "<strong>Cena:</strong> " . $get( '_dmp_menu2_price' ) . "</p>";
    $content .= "<p style='font-size:0.8em;'><strong>Alergény:</strong> " . $get( '_dmp_menu2_allergens' ) . "</p>";
    $content .= "<hr />";
    $content .= "<p><strong>Business Lunch:</strong> " . $get( '_dmp_business_lunch' ) . $gap . "<strong>Váha/Objem:</strong> " . $get( '_dmp_business_lunch_weight' ) . $gap . "<strong>Cena:</strong> " . $get( '_dmp_business_lunch_price' ) . "</p>";
    $content .= "<p style='font-size:0.8em;'><strong>Alergény:</strong> " . $get( '_dmp_business_lunch_allergens' ) . "</p>";

    return $content;
}

/**
 * Save the meta box data when the post is saved.
 */
function dmp_save_daily_menu_meta_box_data( $post_id ) {
    // save_post also fires for the revision WordPress takes before the update
    // and for autosaves; writing the form into those corrupts the revision and
    // leaves the real post untouched.
    if ( wp_is_post_revision( $post_id ) || wp_is_post_autosave( $post_id ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( 'daily_menu' !== get_post_type( $post_id ) ) {
        return;
    }
    // Check that our nonce is set and valid.
    if ( ! isset( $_POST['dmp_daily_menu_meta_box_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['dmp_daily_menu_meta_box_nonce'] ) ), 'dmp_daily_menu_meta_box' ) ) {
        return;
    }
    // Check user permissions.
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Save the submitted fields, and keep the values so the content below is
    // built from what was just posted rather than from a second DB read.
    $values = array();
    foreach ( dmp_get_menu_fields() as $field_name => $meta_key ) {
        if ( ! isset( $_POST[ $field_name ] ) ) {
            $values[ $meta_key ] = (string) get_post_meta( $post_id, $meta_key, true );
            continue;
        }
        $value = sanitize_text_field( wp_unslash( $_POST[ $field_name ] ) );
        update_post_meta( $post_id, $meta_key, $value );
        $values[ $meta_key ] = $value;
    }

    $content = dmp_build_menu_content( $values );

    if ( $content === get_post_field( 'post_content', $post_id ) ) {
        return;
    }

    // Prevent recursive triggering of save_post by temporarily removing our action.
    remove_action( 'save_post', 'dmp_save_daily_menu_meta_box_data' );
    wp_update_post( array(
        'ID'           => $post_id,
        'post_content' => wp_slash( $content ),
    ) );
    add_action( 'save_post', 'dmp_save_daily_menu_meta_box_data' );
}
add_action( 'save_post', 'dmp_save_daily_menu_meta_box_data' );