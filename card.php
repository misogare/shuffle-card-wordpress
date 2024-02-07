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
        array('name' => 'Card 1', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-00-The-Fool.jpg', 'description' => 'Description 1'),
        array('name' => 'Card 2', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-01-Existence.jpg', 'description' => 'Description 2'),
        array('name' => 'Card 3', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-02-Inner Voice.jpg', 'description' => 'Description 3'),
        array('name' => 'Card 4', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-03-Creativity.jpg', 'description' => 'Description 4'),
        array('name' => 'Card 5', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-04-The-Rebel.jpg', 'description' => 'Description 5'),
        array('name' => 'Card 6', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-05-No-Thingness.jpg', 'description' => 'Description 6'),
        array('name' => 'Card 7', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-06-The-Lovers.jpg', 'description' => 'Description 7'),
        array('name' => 'Card 8', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-07-Awareness.jpg', 'description' => 'Description 8'),
        array('name' => 'Card 9', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-08-Courage.jpg', 'description' => 'Description 8'),
        array('name' => 'Card 10', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-09-Aloneness.jpg', 'description' => 'Description 8'),
          array('name' => 'Card 11', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-10-Change.jpg', 'description' => 'Description 1'),
        array('name' => 'Card 12', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-11-Breakthrough.jpg', 'description' => 'Description 2'),
        array('name' => 'Card 13', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-12-New-Vision.jpg', 'description' => 'Description 3'),
        array('name' => 'Card 14', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-13-Transformation.jpg', 'description' => 'Description 4'),
        array('name' => 'Card 15', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-14-Integration.jpg', 'description' => 'Description 5'),
        array('name' => 'Card 16', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-15-Conditioning.jpg', 'description' => 'Description 6'),
        array('name' => 'Card 17', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-16-Thunderbolt.jpg', 'description' => 'Description 7'),
        array('name' => 'Card 18', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-17-Silence.jpg', 'description' => 'Description 8'),
        array('name' => 'Card 19', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-18-Past-Lives.jpg', 'description' => 'Description 8'),
        array('name' => 'Card 20', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-19-Innocence.jpg', 'description' => 'Description 8'),
          array('name' => 'Card 21', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-20-Beyond-Illusion.jpg', 'description' => 'Description 1'),
        array('name' => 'Card 22', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-21-Completion.jpg', 'description' => 'Description 2'),
        array('name' => 'Card 23', 'icon' => plugin_dir_url(__FILE__) . 'img/0M-22-The-Master.jpg', 'description' => 'Description 3'),
        array('name' => 'Card 24', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-01-Going-With-The-Flow.jpg', 'description' => 'Description 4'),
        array('name' => 'Card 25', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-02-Friendliness.jpg', 'description' => 'Description 5'),
        array('name' => 'Card 26', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-03-Celebration.jpg', 'description' => 'Description 6'),
        array('name' => 'Card 27', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-04-Turning-In.jpg', 'description' => 'Description 7'),
        array('name' => 'Card 28', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-05-Clinging-To-The-Past.jpg', 'description' => 'Description 8'),
        array('name' => 'Card 29', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-06-The-Dream.jpg', 'description' => 'Description 8'),
        array('name' => 'Card 30', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-07-Projections.jpg', 'description' => 'Description 8'),
          array('name' => 'Card 31', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-08-Letting-Go.jpg', 'description' => 'Description 1'),
        array('name' => 'Card 32', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-09-Laziness.jpg', 'description' => 'Description 2'),
        array('name' => 'Card 33', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-10-Harmony.jpg', 'description' => 'Description 3'),
        array('name' => 'Card 34', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-11-Understanding.jpg', 'description' => 'Description 4'),
        array('name' => 'Card 35', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-12-Trust.jpg', 'description' => 'Description 5'),
        array('name' => 'Card 36', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-13-Receptivity.jpg', 'description' => 'Description 6'),
        array('name' => 'Card 37', 'icon' => plugin_dir_url(__FILE__) . 'img/1W-14-Healing.jpg', 'description' => 'Description 7'),
        array('name' => 'Card 38', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-01-Consciousness.jpg', 'description' => 'Description 8'),
        array('name' => 'Card 39', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-02-Schizophrenia.jpg', 'description' => 'Description 8'),
        array('name' => 'Card 40', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-03-Ice-Olation.jpg', 'description' => 'Description 8'),
          array('name' => 'Card 41', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-04-Postponement.jpg', 'description' => 'Description 1'),
        array('name' => 'Card 42', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-05-Comparison.jpg', 'description' => 'Description 2'),
        array('name' => 'Card 43', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-06-The-Burden.jpg', 'description' => 'Description 3'),
        array('name' => 'Card 44', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-07-Politics.jpg', 'description' => 'Description 4'),
        array('name' => 'Card 45', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-08-Guilt.jpg', 'description' => 'Description 5'),
        array('name' => 'Card 46', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-09-Sorrow.jpg', 'description' => 'Description 6'),
        array('name' => 'Card 47', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-10-Rebirth.jpg', 'description' => 'Description 7'),
        array('name' => 'Card 48', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-11-Mind.jpg', 'description' => 'Description 8'),
        array('name' => 'Card 49', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-12-Fighting.jpg', 'description' => 'Description 8'),
        array('name' => 'Card 50', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-13-Morality.jpg', 'description' => 'Description 8'),
          array('name' => 'Card 51', 'icon' => plugin_dir_url(__FILE__) . 'img/2C-14-Control.jpg', 'description' => 'Description 1'),
        array('name' => 'Card 52', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-01-The-Source.jpg', 'description' => 'Description 2'),
        array('name' => 'Card 53', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-02-Possibilities.jpg', 'description' => 'Description 3'),
        array('name' => 'Card 54', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-03-Experiencing.jpg', 'description' => 'Description 4'),
        array('name' => 'Card 55', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-04-Participation.jpg', 'description' => 'Description 5'),
        array('name' => 'Card 56', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-05-Totality.jpg', 'description' => 'Description 6'),
        array('name' => 'Card 57', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-06-Success.jpg', 'description' => 'Description 7'),
        array('name' => 'Card 58', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-07-Stress.jpg', 'description' => 'Description 8'),
        array('name' => 'Card 59', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-08-Traveling.jpg', 'description' => 'Description 8'),
        array('name' => 'Card 60', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-09-Exhaustion.jpg', 'description' => 'Description 8'),
          array('name' => 'Card 61', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-10-Supression.jpg', 'description' => 'Description 1'),
        array('name' => 'Card 62', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-11-Playfulness.jpg', 'description' => 'Description 2'),
        array('name' => 'Card 63', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-12-Intensity.jpg', 'description' => 'Description 3'),
        array('name' => 'Card 64', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-13-Sharing.jpg', 'description' => 'Description 4'),
        array('name' => 'Card 65', 'icon' => plugin_dir_url(__FILE__) . 'img/3F-14-The-Creator.jpg', 'description' => 'Description 5'),
        array('name' => 'Card 66', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-01-Maturity.jpg', 'description' => 'Description 6'),
        array('name' => 'Card 67', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-02-Moment-To-Moment.jpg', 'description' => 'Description 7'),
        array('name' => 'Card 68', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-03-Guidance.jpg', 'description' => 'Description 8'),
        array('name' => 'Card 69', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-04-The-Miser.jpg', 'description' => 'Description 8'),
        array('name' => 'Card 70', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-05-The-Outsider.jpg', 'description' => 'Description 8'),
        array('name' => 'Card 71', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-06-Compromise.jpg', 'description' => 'Description 8'),
        array('name' => 'Card 72', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-07-Patience.jpg', 'description' => 'Description 8'),
        array('name' => 'Card 73', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-08-Ordinariness.jpg', 'description' => 'Description 8'),
        array('name' => 'Card 74', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-09-Ripeness.jpg', 'description' => 'Description 8'),
        array('name' => 'Card 75', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-10-We-Are-The-World.jpg', 'description' => 'Description 8'),
        array('name' => 'Card 76', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-11-Adventure.jpg', 'description' => 'Description 8'),
        array('name' => 'Card 77', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-12-Slowing Down.jpg', 'description' => 'Description 8'),
       array('name' => 'Card 78', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-13-Flowering.jpg', 'description' => 'Description 8'),
       array('name' => 'Card 79', 'icon' => plugin_dir_url(__FILE__) . 'img/4R-14-Abundance.jpg', 'description' => 'Description 8'),

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
    global $wpdb;
    $table_name = $wpdb->prefix . 'cards';

    $wpdb->query("DROP TABLE IF EXISTS $table_name");
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
            echo '<div class="card" data-id="' . esc_attr($card->id) . '" >';
            echo '<div class="front" >';
            echo '<img src="' . esc_url($card->icon) . '" alt="' . esc_attr($card->name) . '">';
            echo '</div>';
            echo '<div class="back">';
echo '<img src="' . plugin_dir_url(__FILE__) .'img/osho-zen-card-back.jpg" alt="Back of card">';
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

function display_cards_in_sets() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'cards';

    // Fetch all cards
    $cards = $wpdb->get_results("SELECT * FROM $table_name ORDER BY RAND()");

    // Shuffle the cards and divide into three sets
    shuffle($cards);
    $sets = array_chunk($cards, ceil(count($cards) / 3));

    ob_start();

    // Display the sets
    foreach ($sets as $index => $set) {
echo '<div class="card-set" id="set-' . $index . '" style="display: flex; flex-direction: row; justify-content: center;">';       
// Inside your foreach loop for each card
$cardIndex = 0; // Initialize a counter for each card
foreach ($set as $card) {
    echo '<div class="card1" data-id="' . esc_attr($card->id) . '" style="margin: 5px; --i: ' . $cardIndex++ . ';">';

            echo '<div class="front1" >';
            echo '<img src="' . esc_url($card->icon) . '" alt="' . esc_attr($card->name) . ' ">'; // Set only the width
                   echo '</div>';
            echo '<div class="back1" style="margin: 5px; ">';
echo '<img src="' . plugin_dir_url(__FILE__) .'img/osho-zen-card-back.jpg" alt="Back of card">';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    }

    return ob_get_clean();
}

// Register the function as a shortcode to use it easily within WordPress
add_shortcode('display_cards_in_sets', 'display_cards_in_sets');


function picked_card() {
     if (!defined('DOING_AJAX') || !DOING_AJAX) {
        error_log('Not doing AJAX');
        return;
    }
    global $wpdb;
    $table_name = $wpdb->prefix . 'cards';

    // Initialize an empty array to hold the cards
    $cards = [];

    if (isset($_POST['pick-seven-cards-button']) && $_POST['pick-seven-cards-button'] == true) {
        if (!is_user_logged_in()) {
            echo 'You must be logged in to pick cards.';
            wp_die();
        }
        // Fetch a custom number of random cards if the user is an administrator
        $num_cards = 7; // default number of cards
        if (current_user_can('administrator') && isset($_POST['num_cards'])) {
            $num_cards = intval($_POST['num_cards']);
            error_log('Number of cards to pick: ' . $num_cards); // Log the number of cards
        }
error_log('Executing SQL query with num_cards: ' . $num_cards); // Log the number of cards

        error_log('User role: ' . (current_user_can('administrator') ? 'Administrator' : 'Not Administrator'));
        error_log('POST data: ' . print_r($_POST, true));

        $cards = $wpdb->get_results("SELECT * FROM $table_name ORDER BY RAND() LIMIT $num_cards");
    } else {
        if (!isset($_POST['card_id'])) {
            error_log('No card ID in POST data');
            echo 'No card picked yet.';
            wp_die();
        }
        $card_id = intval($_POST['card_id']);
        // Fetch the specific card by ID
        $card = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $card_id));
        if ($card) {
            $cards[] = $card; // Add the single card to the cards array for consistent processing
        }
    }


    ob_start();

    if (!empty($cards)) {
        foreach ($cards as $card) {
            echo '<div class="picked-card" data-id="' . esc_attr($card->id) . '">';
            echo '<button class="remove-card">X</button>';
            echo '<div class="front" style="margin: 5px;" >';
            echo '<img src="' . esc_url($card->icon) . '" alt="' . esc_attr($card->name) . '">';
            echo '</div>';
            echo '<div class="back">';
echo '<img src="' . plugin_dir_url(__FILE__) .'img/osho-zen-card-back.jpg" alt="Back of card">';
            echo '</div>';
            echo '</div>';
        }
    } else {
        error_log('No card found');
        echo 'No card found.';
    }

    echo ob_get_clean();
    wp_die();
}


add_action('wp_ajax_picked_card', 'picked_card');
add_action('wp_ajax_nopriv_picked_card', 'picked_card');



function enqueue_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-dialog'); // Add this line
        wp_enqueue_script('ajax-script', plugin_dir_url(__FILE__). '/js/ajax.js', array('jquery'), '1.0', true);

    wp_enqueue_script('card-shuffle', plugin_dir_url(__FILE__) . 'js/card-shuffle.js', array('jquery', 'jquery-ui-dialog'), '1.0', true); // Add 'jquery-ui-dialog' to the dependencies array
        wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ),'is_admin' => current_user_can('administrator') ? 'yes' : 'no','is_user_logged_in' => is_user_logged_in() ? 'yes' : 'no') );
        wp_enqueue_script('my-plugin-show-cards', plugin_dir_url(__FILE__) . 'js/show-cards.js', array('jquery'), null, true);
    wp_localize_script('my-plugin-show-cards', 'ajaxurl', admin_url('admin-ajax.php'));

    // Pass the AJAX URL to script.js
    wp_localize_script('card-shuffle', 'card_shuffle', array('ajax_url' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'enqueue_scripts');


// Create an AJAX endpoint for shuffling cards
add_action( 'wp_ajax_card_shuffle', 'card_shuffle_callback' );
add_action( 'wp_ajax_nopriv_card_shuffle', 'card_shuffle_callback' );

function display_cards_in_sets_ajax() {
    echo do_shortcode('[display_cards_in_sets]');
    wp_die(); // This is required to terminate immediately and return a proper response
}

add_action('wp_ajax_display_cards_in_sets_ajax', 'display_cards_in_sets_ajax');
add_action('wp_ajax_nopriv_display_cards_in_sets_ajax', 'display_cards_in_sets_ajax');

add_action('admin_menu', 'error_log_menu');

function error_log_menu() {
    add_options_page(
        'Error Log', // Page title
        'Error Log', // Menu title
        'manage_options', // Capability
        'error-log', // Menu slug
        'error_log_page' // Function that handles the page content
    );
}

function error_log_page() {
    $log_path = ini_get('error_log'); // Get the path of the error log

    echo '<div class="wrap">';
    echo '<h1>Error Log</h1>';
    echo '<p>The error logs are stored at: ' . $log_path . '</p>';
    echo '</div>';
}


function card_shuffle_callback() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'cards';

    // Logging the POST data
    error_log('POST data: ' . print_r($_POST, true));

    $picked_card_ids = isset($_POST['picked_card_ids']) ? array_map('intval', $_POST['picked_card_ids']) : array();

    // Log the picked card IDs
    error_log('Picked card IDs: ' . implode(', ', $picked_card_ids));

    if (!empty($picked_card_ids)) {
        $ids_format = implode(',', array_fill(0, count($picked_card_ids), '%d'));
        $query = $wpdb->prepare("SELECT * FROM $table_name WHERE id IN ($ids_format) ORDER BY RAND() LIMIT 3", $picked_card_ids);
        $cards = $wpdb->get_results($query);

        // Log the query to check if it's correct
        error_log('SQL Query: ' . $wpdb->last_query);
    } else {
        $cards = array(); // If no cards are picked, set to an empty array
        error_log('No picked card IDs provided.');
    }

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
    wp_mail($email_address, 'Shuffled cards', $message, $headers);
 $admin_email_address = get_option('admin_email');

    // Send email to the owner (admin)
    wp_mail($admin_email_address, $subject, $message, $headers);

    wp_die(); // End AJAX request properly
}
add_action('wp_ajax_send_cards_to_email', 'send_cards_to_email');
add_action('wp_ajax_nopriv_send_cards_to_email', 'send_cards_to_email');

function enqueue_styles() {
    wp_enqueue_style('card-layout', plugin_dir_url(__FILE__) . 'css/card-layout.css');
        wp_enqueue_style('my-plugin-styles', plugin_dir_url(__FILE__) . 'css/pileset-style.css');

}

add_action('wp_enqueue_scripts', 'enqueue_styles');
function add_custom_style() {
    wp_enqueue_style('custom-style', plugin_dir_url(__FILE__) . 'css/custom-style.css');
}
add_action('wp_enqueue_scripts', 'add_custom_style');

function run_card() {

	$plugin = new Card();
	$plugin->run();
}
run_card();
