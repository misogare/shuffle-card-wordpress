<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://mesvak.software
 * @since      1.0.0
 *
 * @package    Card
 * @subpackage Card/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Card
 * @subpackage Card/includes
 * @author     mesvak <mesvakc@gmail.com>
 */
function add_card_meta_box() {
    add_meta_box(
        'card_meta_box',
        'Card Details',
        'show_card_meta_box',
        'card',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'add_card_meta_box' );

function show_card_meta_box() {
    global $post;

    // Nonce field to validate form request came from current site
    wp_nonce_field( basename( __FILE__ ), 'card_fields' );

    // Get the card data if it's already been entered
    $card_icon = get_post_meta( $post->ID, 'card_icon', true );
    $card_description = get_post_meta( $post->ID, 'card_description', true );

    // Output the field
    echo '<label for="card_icon">Card Icon</label>';
    echo '<input type="text" id="card_icon" name="card_icon" value="' . esc_textarea( $card_icon )  . '" />';

    echo '<label for="card_description">Card Description</label>';
    echo '<textarea id="card_description" name="card_description">' . esc_textarea( $card_description ) . '</textarea>';
}

function save_card_meta( $post_id ) {
    // Verify nonce
    if ( !isset( $_POST['card_fields'] ) || !wp_verify_nonce( $_POST['card_fields'], basename( __FILE__ ) ) )
        return $post_id;

    // Check for autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $post_id;

    // Check the user's permissions
    if ( !current_user_can( 'edit_post', $post_id ) )
        return $post_id;

    // Update the meta field in the database
    update_post_meta( $post_id, 'card_icon', sanitize_text_field( $_POST['card_icon'] ) );
    update_post_meta( $post_id, 'card_description', sanitize_text_field( $_POST['card_description'] ) );
}
add_action( 'save_post', 'save_card_meta' );
