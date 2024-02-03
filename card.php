<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://mesvak.software
 * @since             1.0.0
 * @package           Card
 *
 * @wordpress-plugin
 * Plugin Name:       shuffle card
 * Plugin URI:        https://mesvak.software
 * Description:       this is a shuffle card for reading people's mind and helping them through their problems 
 * Version:           1.0.0
 * Author:            mesvak
 * Author URI:        https://mesvak.software/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       card
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CARD_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-card-activator.php
 */
function activate_card() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-card-activator.php';
	Card_Activator::activate();
	global $wpdb;
    $table_name = $wpdb->prefix . 'cards';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL,
        icon varchar(255) NOT NULL,
        description text,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);

	$cards = array(
        array('name' => 'Card 1', 'icon' => 'http://localhost/wordpress/wp-content/uploads/2024/02/4R-11-Adventure.jpg', 'description' => 'Description 1'),
        array('name' => 'Card 2', 'icon' => 'http://localhost/wordpress/wp-content/uploads/2024/02/4R-12-Slowing-Down.jpg', 'description' => 'Description 2'),
        array('name' => 'Card 3', 'icon' => 'http://localhost/wordpress/wp-content/uploads/2024/02/4R-13-Flowering.jpg', 'description' => 'Description 3'),
        array('name' => 'Card 4', 'icon' => 'http://localhost/wordpress/wp-content/uploads/2024/02/4R-14-Abundance.jpg', 'description' => 'Description 4'),
        array('name' => 'Card 5', 'icon' => 'http://localhost/wordpress/wp-content/uploads/2024/02/1W-07-Projections.jpg', 'description' => 'Description 5'),
        array('name' => 'Card 6', 'icon' => 'http://localhost/wordpress/wp-content/uploads/2024/02/1W-08-Letting-Go.jpg', 'description' => 'Description 6'),
        array('name' => 'Card 7', 'icon' => 'http://localhost/wordpress/wp-content/uploads/2024/02/1W-09-Laziness.jpg', 'description' => 'Description 7'),
        array('name' => 'Card 8', 'icon' => 'http://localhost/wordpress/wp-content/uploads/2024/02/1W-10-Harmony.jpg', 'description' => 'Description 8'),
        // Add more cards as needed
    );

    global $wpdb;
    $table_name = $wpdb->prefix . 'cards';

    foreach ($cards as $card) {
        $wpdb->insert($table_name, $card);
    }
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-card-deactivator.php
 */
function deactivate_card() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-card-deactivator.php';
	Card_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_card' );
register_deactivation_hook( __FILE__, 'deactivate_card' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-card.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
 function display_cards() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'cards';

    $cards = $wpdb->get_results("SELECT * FROM $table_name");

    ob_start();

    // Start of the container
    echo '<div class="cards-container">';

    if ($cards) {
        foreach ($cards as $card) {
            echo '<div class="card" data-id="' . esc_attr($card->id) . '">';
            echo '<div class="front">';
            echo '<img src="' . esc_url($card->icon) . '" alt="' . esc_attr($card->name) . '">';
            echo '</div>';
            echo '<div class="back">';
            echo '<img src="../wp-content/uploads/2024/02/osho-zen-card-back.jpg" alt="Back of card">';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo 'No cards found.';
    }

    // End of the container
    echo '</div>';

    return ob_get_clean();
}


add_shortcode('display_cards', 'display_cards');

function picked_card() {
    if (!defined('DOING_AJAX') || !DOING_AJAX) {
                error_log('Not doing AJAX');

        return;
    }
    global $wpdb;
    $table_name = $wpdb->prefix . 'cards';
    if (!isset($_POST['card_id'])) {
                error_log('No card ID in POST data');

        echo 'No card picked yet.';
        wp_die();
    }
    $card_id = intval($_POST['card_id']);
        error_log('Card ID: ' . $card_id); // Log the card ID

    $card = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $card_id");

    ob_start();

    if ($card) {
                error_log('Card found: ' . print_r($card, true)); // Log the card data

        echo '<div class="picked-card">';
        echo '<div class="front">';
        echo '<img src="' . esc_url($card->icon) . '" alt="' . esc_attr($card->name) . '">';
        echo '</div>';
        echo '<div class="back">';
        echo '<img src="../wp-content/uploads/2024/02/osho-zen-card-back.jpg" alt="Back of card">';
        echo '</div>';
        echo '<button class="remove-card">Remove</button>'; // Add this line

        echo '</div>';
    } else {
                error_log('No card found with ID: ' . $card_id); // Log if no card found

        echo 'No card found.';
    }

    echo ob_get_clean();
    wp_die(); // This is required to terminate immediately and return a proper response
}
add_action('wp_ajax_picked_card', 'picked_card');
add_action('wp_ajax_nopriv_picked_card', 'picked_card');


// In class-card.php

// In class-card.php

function enqueue_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-dialog'); // Add this line
        wp_enqueue_script('ajax-script', plugin_dir_url(__FILE__). '/js/ajax.js', array('jquery'), '1.0', true);

    wp_enqueue_script('card-shuffle', plugin_dir_url(__FILE__) . 'js/card-shuffle.js', array('jquery', 'jquery-ui-dialog'), '1.0', true); // Add 'jquery-ui-dialog' to the dependencies array
        wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

    // Pass the AJAX URL to script.js
    wp_localize_script('card-shuffle', 'card_shuffle', array('ajax_url' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'enqueue_scripts');


// Create an AJAX endpoint for shuffling cards
add_action('wp_ajax_card_shuffle', 'card_shuffle_callback');

// In class-card.php

function card_shuffle_callback() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'cards';

    $cards = $wpdb->get_results("SELECT * FROM $table_name ORDER BY RAND() LIMIT 3");

    if ($cards) {
        foreach ($cards as $card) {
            // Include card ID in the div for the shuffled card
            echo '<div class="shuffled-card" data-card-id="' . esc_attr($card->id) . '">';
            echo '<img src="' . esc_url($card->icon) . '" alt="' . esc_attr($card->name) . '">';
            echo '<h3>' . esc_html($card->name) . '</h3>';
            echo '<p>' . esc_html($card->description) . '</p>';
            echo '</div>';
        }
	echo '<input type="email" id="user-email" placeholder="Enter your email" />';

    } else {
        echo 'No cards found.';
    }

    wp_die(); // This is required to terminate immediately and return a proper response
}

function send_cards_to_email() {
    $email_address = $_POST['email'];
    $card_ids = isset($_POST['card_ids']) ? $_POST['card_ids'] : [];

    global $wpdb;
    $table_name = $wpdb->prefix . 'cards';

    // Fetch specific cards by IDs
    $cards = $wpdb->get_results("SELECT * FROM $table_name WHERE id IN (" . implode(',', array_map('intval', $card_ids)) . ")");

    $message = '';
    if ($cards) {
        $message .= '<html><body>';
        foreach ($cards as $card) {
            $message .= '<div class="shuffled-card">';
            $message .= '<img src="' . esc_url($card->icon) . '" alt="' . esc_attr($card->name) . '" style="width:100px;height:auto;">';
            $message .= '<h3>' . esc_html($card->name) . '</h3>';
            $message .= '<p>' . esc_html($card->description) . '</p>';
            $message .= '</div>';
        }
        $message .= '</body></html>';
    } else {
        $message = 'No cards found.';
    }

    // Set content-type header for HTML email
    $headers = array('Content-Type: text/html; charset=UTF-8');

    // Use WordPress function to send email
    wp_mail($email_address, 'Shuffled Cards', $message, $headers);
 $admin_email_address = get_option('admin_email');

    // Send email to the owner (admin)
    wp_mail($admin_email_address, $subject, $message, $headers);

    wp_die(); // End AJAX request properly
}
add_action('wp_ajax_send_cards_to_email', 'send_cards_to_email');
add_action('wp_ajax_nopriv_send_cards_to_email', 'send_cards_to_email');

function enqueue_styles() {
    wp_enqueue_style('card-layout', plugin_dir_url(__FILE__) . 'css/card-layout.css');
}

add_action('wp_enqueue_scripts', 'enqueue_styles');

function run_card() {

	$plugin = new Card();
	$plugin->run();
}
run_card();
