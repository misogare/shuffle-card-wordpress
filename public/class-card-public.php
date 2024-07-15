<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://mesvak.software
 * @since      1.0.0
 *
 * @package    Card
 * @subpackage Card/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Card
 * @subpackage Card/public
 * @author     mesvak <mesvakc@gmail.com>
 */
class Card_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}
    public static function display_cards($shuffle = false) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'cards';

    // Determine ordering
    $order_by = $shuffle ? 'RAND()' : 'id ASC';
    $cards = $wpdb->get_results("SELECT * FROM $table_name ORDER BY $order_by");

    ob_start();
    echo '
<div id="my-plugin-modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:1000;">
    <div style="background:#fff; padding:20px; width:300px; margin:100px auto;">
        <select id="user-option">
            <option value="general">General</option>
            <option value="love">Love</option>
            <option value="money">Money</option>
        </select>
<div class="container elementor-button-wrapper">
<button id="confirm-selection" class="btn elementor-button elementor-button-link elementor-size-sm">
    <span class="elementor-button-content-wrapper">
        <span class="elementor-button-text">Confirm</span>
    </span>
</button>
</div>
    </div>
</div>

';
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
            echo '</div>'; // Close .card
        }
    } else {
        echo 'No cards found.';
    }

    // Navigation buttons outside the loop
    echo '<div class="card-navigation-buttons1">';
    echo '<button class="prev-button1">Previous</button>';
    echo '<button class="next-button1">Next</button>';
    echo '</div>';

    // End of the container
    echo '</div>';

    return ob_get_clean();
}
public static function ajax_shuffle_cards() {
        echo self::display_cards(true); // Call display_cards with shuffle
    wp_die();
}

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
        echo '<div class="card-set-container">'; // Container for the set and navigation buttons
        echo '<div class="card-set" id="set-' . $index . '" style="display: flex; flex-direction: row; justify-content: center;">';
        
        // Inside your foreach loop for each card
        $cardIndex = 0; // Initialize a counter for each card
        foreach ($set as $card) {
            echo '<div class="card1" data-id="' . esc_attr($card->id) . '" style="margin: 5px; --i: ' . $cardIndex++ . ';">';
            echo '<div class="front1">';
            echo '<img src="' . esc_url($card->icon) . '" alt="' . esc_attr($card->name) . '">';
            echo '</div>';
            echo '<div class="back1" style="margin: 5px;">';
            echo '<img src="' . plugin_dir_url(__FILE__) .'img/osho-zen-card-back.jpg" alt="Back of card">';
            echo '</div>';
            echo '</div>'; // Close .card1
        }
        
        echo '</div>'; // Close .card-set
echo '<div class="elementor-button-wrapper">';
echo '<button class="select-pile btn hypnotic-btn elementor-button elementor-button-link elementor-size-sm" data-set="' . $index . '">
    <span class="elementor-button-content-wrapper">
        <span class="elementor-button-text">Select Pile</span>
    </span>
</button>';
echo '</div>';
        // Navigation buttons for each set
  echo '<div class="card-navigation-buttons elementor-button-wrapper">';
echo '<button class="prev-button btn hypnotic-btn elementor-button elementor-button-link elementor-size-sm" data-set="' . $index . '">
    <span class="elementor-button-content-wrapper">
        <span class="elementor-button-text">Previous</span>
    </span>
</button>';
echo '<button class="next-button btn hypnotic-btn elementor-button elementor-button-link elementor-size-sm" data-set="' . $index . '">
    <span class="elementor-button-content-wrapper">
        <span class="elementor-button-text">Next</span>
    </span>
</button>';
echo '</div>';

        echo '</div>'; // Close .card-set-container
    }

    return ob_get_clean();
}

function picked_card() {
     if (!defined('DOING_AJAX') || !DOING_AJAX) {
        error_log('Not doing AJAX');
        return;
    }
    global $wpdb;
    $table_name = $wpdb->prefix . 'cards';

    // Initialize an empty array to hold the cards
    $cards = [];
        $is_from_classified = isset($_POST['is_from_classified']) && $_POST['is_from_classified'] == 'true';

    if (isset($_POST['card_ids']) && is_array($_POST['card_ids'])) {
        $card_ids = array_map('intval', $_POST['card_ids']);
        
        foreach ($card_ids as $card_id) {
            $card = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $card_id));
            if ($card) {
                $cards[] = $card;
            }
        }
    }
    else {
	

    if (isset($_POST['pick-seven-cards-button']) && $_POST['pick-seven-cards-button'] == true) {
       
        // Fetch a custom number of random cards if the user is an administrator
        $num_cards = 3; // default number of cards
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

function display_cards_in_sets_ajax() {
    echo do_shortcode('[display_cards_in_sets]');
    wp_die(); // This is required to terminate immediately and return a proper response
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
            echo '<div class="shuffled-card" data-card-id="' . esc_attr($card->id) . '" style="display: none;" >';
            echo '<img src="' . esc_url($card->icon) . '" alt="' . esc_attr($card->name) . '">';
            echo '<p>' . esc_html($card->description) . '</p>';
            echo '</div>';
        }

    echo '<hr>'; // Add a horizontal line to separate the above container with the below


        echo '<input type="string" id="first_name" placeholder="Enter your name" />';

        echo '<input type="email" id="user-email" placeholder="Enter your email" />';


    } else {
        echo 'No cards found.';
    }

    wp_die(); // This is required to terminate immediately and return a proper response
}
function display_options_on_load() {
    
        // Enqueue a JavaScript file
        wp_enqueue_script('my-plugin-script', plugin_dir_url(__FILE__) . 'js/my-plugin-script.js', array('jquery'), null, true);
          global $post;
    $isReadingCardPage = is_page('card-reading'); // Returns true if the current page is shuffle-card
        // Localize script to pass PHP variables to JS
        wp_localize_script('my-plugin-script', 'myPluginParams', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
                    'isReadingCardPage' => $isReadingCardPage, // Pass true/false to JavaScript

        ));
   
}



function load_content_based_on_selection() {
    $userOption = isset($_POST['option']) ? sanitize_text_field($_POST['option']) : '';
    
    
    
    wp_die(); // Always use wp_die() at the end of AJAX functions.
}

function send_cards_to_email() {
      $email_address = $_POST['email'];
    $card_ids = isset($_POST['card_ids']) ? $_POST['card_ids'] : [];
        $user_option = $_POST['user_option']; // Get the user selected option
        $first_name = $_POST['first_name'];
    global $wpdb;
    $table_name = $wpdb->prefix . 'cards';

    // Fetch specific cards by IDs
    $cards = $wpdb->get_results("SELECT * FROM $table_name WHERE id IN (" . implode(',', array_map('intval', $card_ids)) . ")");
        error_log('SQL Query: ' . $wpdb->last_query);

 $message = '';
    $openai_responses = '';

    if ($cards) {
        $openai_prompt_template = get_option('openai_prompt_template_' . $user_option);
        error_log(print_r(get_option('openai_prompt_template_love'), true));
                error_log('dalbaeyna'. $openai_prompt_template);

// Initialize OpenAI message with the prompt template
$openai_input = $openai_prompt_template ?: "These are 3 cards descriptions I'm sending you. They are all related to psychology and emotions.(tarrot cards) Make a very detailed description about who this person is not more than 300 chars. ";

        foreach ($cards as $card) {
            // Concatenate descriptions for OpenAI input
            $openai_input .= $card->ldescription . ' ';
                        error_log('Added card description: ' . $card->ldescription); // Log each card description


            // Build the email message with card details
           $message .= '<div class="shuffled-card" style="display: inline-block; margin-right: 10px;">';
            $message .= '<img src="' . esc_url($card->icon) . '" alt="' . esc_attr($card->name) . '" style="width:100px;height:auto;">';
            $message .= '</div>';
        }
                error_log('Final OpenAI input: ' . $openai_input);
        // Inside your send_cards_to_email function or wherever you're making the API call
        $openai_api_key = get_option('openai_api_key'); // Fetch the API key from settings
                                error_log('open api key : ' . $openai_api_key); // Log each card description

        // Call OpenAI API with the concatenated ldescriptions
        //$openai_api_key = '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';
       $response = wp_remote_post('https://api.openai.com/v1/chat/completions', array(
    'headers' => array(
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer ' . $openai_api_key,
    ),
    'body' => json_encode(array(
        'model' => 'gpt-3.5-turbo', // Use the chat model
        'messages' => array(
            array('role' => 'system', 'content' => 'You are a helpful assistant.'),
            array('role' => 'user', 'content' => $openai_input)
        )
    )),
        'timeout' => 15, // Increase timeout to 15 seconds

));


        if (is_wp_error($response)) {
            error_log('OpenAI API Error: ' . $response->get_error_message());
        } else {
            $http_code = wp_remote_retrieve_response_code($response);
            error_log('OpenAI API Response Code: ' . $http_code);
            
            if ($http_code === 200) {
            $body = json_decode(wp_remote_retrieve_body($response), true);
    $openai_responses = $body['choices'][0]['message']['content']; // Corrected line

                // Log the OpenAI response
                error_log('OpenAI Response: ' . $openai_responses);
            } else {
                error_log('OpenAI API Unexpected Response: ' . wp_remote_retrieve_body($response));
            }
        }

        // Include OpenAI's response in the email message
        $message .= '<div class="openai-response">';
        $message .= '<h3>Summary:</h3>';
        $message .= '<p>' . esc_html($openai_responses) . '</p>';
        $message .= '</div>';
	$message .= '
<div style="font-family: Arial, sans-serif; margin: 0 auto; max-width: 600px; padding: 20px;">
    <h2 style="color: #333;">Are you seeking clarity and guidance on your life\'s journey?</h2>
    <p style="color: #555;">Look no further! We\'re excited to offer you a complimentary 3-card reading, courtesy of Maria, our psychotherapist with intuitive abilities to uncover hidden obstacles, and paving the way for meaningful connections.</p>
    <p style="color: #555;">Your personalized 3-card reading will illuminate insights into your current situation, offering valuable guidance and direction. Simply click the button below to claim your free reading:</p>
    <a href="https://www.healoneself.com/card-reading/" style="background-color: #4CAF50; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;">Claim Your Free Reading</a>
    <h3 style="color: #333;">But wait, there\'s more!</h3>
    <p style="color: #555;">As a special offer for our valued clients, we\'re extending an exclusive opportunity to book a full-hour reading session with Maria for only $197 USD. Maria, with over 30 years of experience, combines her expertise in psychotherapy envision this reading as mirror reflecting innermost self. Approach this with curiosity and willingness to listen to insights unfold.</p>
    <p style="color: #555;">This exclusive offer is available for a limited time only. If you book your hour-long session within the next 48 hours, you\'ll unlock the transformative power of Maria\'s intuitive session at a discounted rate.</p>
    <p style="color: #555;">Don\'t miss out on this chance to gain deeper understanding and empowerment in your life\'s journey. Take the next step towards clarity and fulfillment today!</p>
    <a href="https://www.healoneself.com/maria/" style="background-color: #4CAF50; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;">Book Your Session</a>
    <p style="color: #555;">We look forward to helping you unlock new insights and possibilities on your path to personal growth and fulfillment.</p>
    <p style="color: #555;">Warm regards,</p>
    <p style="color: #555;">Maria Vrasidas</p>
    <p style="color: #555;">Psychotherapist/Healoneself</p>
</div>';

        $message .= '</body></html>';
    } else {
       $message = 'No cards found.';
        error_log('No cards found for provided IDs.');
    }

    // Set content-type header for HTML email
    $headers = array('Content-Type: text/html; charset=UTF-8');

    // Use WordPress function to send email
    wp_mail($email_address, 'Unlock Insights with Your Free 3-Card Reading + Exclusive Offer Inside!', $message, $headers);
 $admin_email_address = get_option('admin_email');

    // Send email to the owner (admin)
    wp_mail($admin_email_address, 'Unlock Insights with Your Free 3-Card Reading + Exclusive Offer Inside!', $message, $headers);
if (class_exists(\MailPoet\API\API::class)) {
    $mailpoet_api = \MailPoet\API\API::MP('v1');
    $list_id = (3); // The ID of the list to add subscribers to

    error_log('Email address: ' . $email_address);

    try {
        // Attempt to retrieve the subscriber
                    $subscriber = $mailpoet_api->getSubscriber($email_address);

        // Check if the subscriber is already in the list
        $is_in_list = false;
        foreach ($subscriber['subscriptions'] as $subscription) {
            if ($subscription['segment_id'] == $list_id) {
                $is_in_list = true;
                error_log('test1: '.$subscription['segment_id'] );
                break;
            }
        }
        error_log('test2: '.$subscription['segment_id'] );
        // If the subscriber is not in the list, add them
        if (!$is_in_list) {
            $list_id = [3];
           
            $mailpoet_api->subscribeToLists($subscriber['id'], $list_id);
        }
    } catch (Exception $e) {
        // If the subscriber does not exist, catch the exception and create them
        if (strpos($e->getMessage(), 'This subscriber does not exist.') !== false) {
            try {
                $list_id = [3];
                // Subscriber does not exist, create them and add to the list
                $subscriber_data = array(
                    'email' => $email_address,
                    'first_name'  => $first_name,
                    // Include other subscriber details as needed
                );
  $options = array(
                    'send_confirmation_email' => false // Disable confirmation email
                );
                $mailpoet_api->addSubscriber($subscriber_data,$list_id,$options);
            } catch (Exception $e) {
                // Handle any exceptions thrown while creating the subscriber
                error_log('Unable to create new subscriber: ' . $e->getMessage());
            }
        } else {
            // Log other exceptions
            error_log('Error: ' . $e->getMessage());
        }
    }
}
    wp_die(); // End AJAX request properly
}
function admin_button_shortcode() {
    if (is_user_logged_in() && current_user_can('administrator')) {
        // User is logged in and is an admin
        return '
        <div class="elementor-button-wrapper" style="text-align: center;">
            <a href="https://localhost/testsite/admin-reading/" id="admin-page-button" class="btn shuffle-btn elementor-button elementor-button-link elementor-size-sm">
                <span class="elementor-button-content-wrapper">
                    <span class="elementor-button-text">Go to Full Reading</span>
                </span>
            </a>
        </div>';
    }
    return ''; // Return nothing if the user is not logged in or not an admin
}
	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Card_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Card_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/card-public.css', array(), $this->version, 'all' );
        wp_enqueue_style('custom-style', plugin_dir_url(__FILE__) . 'css/custom-style.css');
        wp_enqueue_style('my-plugin-styles', plugin_dir_url(__FILE__) . 'css/pileset-style.css');
                wp_enqueue_style('my_card_shuffle', plugin_dir_url(__FILE__) . 'css/card-shuffle.css');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Card_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Card_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		// Enqueue jQuery UI CSS
wp_enqueue_style('jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css');

// Enqueue main plugin script with jQuery as a dependency
wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/card-public.js', array('jquery'), $this->version, true);

// Enqueue jQuery UI Dialog script
wp_enqueue_script('jquery-ui-dialog');

// Enqueue card shuffle script with jQuery and jQuery UI Dialog as dependencies
wp_enqueue_script('card-shuffle', plugin_dir_url(__FILE__) . 'js/card-shuffle.js', array('jquery', 'jquery-ui-dialog'), '1.0', true);

// Add inline script data
$script_data = 'const ajax_object = ' . json_encode(array(
    'ajax_url' => admin_url('admin-ajax.php'),
    'is_admin' => current_user_can('administrator') ? 'yes' : 'no',
    'is_user_logged_in' => is_user_logged_in() ? 'yes' : 'no'
)) . ';';
wp_add_inline_script('card-shuffle', $script_data);

// Enqueue script for showing cards
wp_enqueue_script('my-plugin-show-cards', plugin_dir_url(__FILE__) . 'js/show-cards.js', array('jquery'), null, true);
wp_localize_script('my-plugin-show-cards', 'ajaxurl', array('ajax_url' => admin_url('admin-ajax.php')));

// Enqueue mini window script
wp_enqueue_script('mini-window-button', plugin_dir_url(__FILE__) . 'js/mini-window.js', array('jquery'), null, true);
wp_localize_script('mini-window-button', 'ajaxurl1', array('ajax_url' => admin_url('admin-ajax.php')));

// Localize script for card shuffle to pass AJAX URL
wp_localize_script('card-shuffle', 'card_shuffle', array('ajax_url' => admin_url('admin-ajax.php')));

  // Enqueue a JavaScript file
        wp_enqueue_script('my-plugin-script', plugin_dir_url(__FILE__) . 'js/my-plugin-script.js', array('jquery'), null, true);
          global $post;
    $isReadingCardPage = is_page('card-reading'); // Returns true if the current page is shuffle-card
        // Localize script to pass PHP variables to JS
        wp_localize_script('my-plugin-script', 'myPluginParams', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
                    'isReadingCardPage' => $isReadingCardPage, // Pass true/false to JavaScript

        ));


	}

}
add_action('wp_ajax_shuffle_cards', array('Card_Public', 'ajax_shuffle_cards'));
add_action('wp_ajax_nopriv_shuffle_cards', array('Card_Public', 'ajax_shuffle_cards')); 
