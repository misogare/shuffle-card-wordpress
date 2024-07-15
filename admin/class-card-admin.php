<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://mesvak.software
 * @since      1.0.0
 *
 * @package    Card
 * @subpackage Card/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Card
 * @subpackage Card/admin
 * @author     mesvak <mesvakc@gmail.com>
 */
class Card_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}
	   public function card_mini_game_add_admin_menu() {
        add_menu_page(
            'Card Mini Game Settings',
            'Card Mini Game',
            'manage_options',
            'card-mini-game-settings',
            array($this, 'card_mini_game_settings_page')
        );
    }

    public function card_mini_game_settings_page() {
        ?>
        <div class="wrap">
            <h2>Card Mini Game Settings</h2>
            <form method="post" action="options.php">
                <?php settings_fields('card_mini_game_settings'); ?>
                <?php do_settings_sections('card_mini_game_settings'); ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">OpenAI API Key</th>
                        <td><input type="text" name="openai_api_key" value="<?php echo esc_attr(get_option('openai_api_key')); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">OpenAI Prompt Template (Love)</th>
                        <td>
                            <textarea name="openai_prompt_template_love" rows="5" cols="50"><?php echo esc_textarea(get_option('openai_prompt_template_love')); ?></textarea>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">OpenAI Prompt Template (Money)</th>
                        <td>
                            <textarea name="openai_prompt_template_money" rows="5" cols="50"><?php echo esc_textarea(get_option('openai_prompt_template_money')); ?></textarea>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">OpenAI Prompt Template (General)</th>
                        <td>
                            <textarea name="openai_prompt_template_general" rows="5" cols="50"><?php echo esc_textarea(get_option('openai_prompt_template_general')); ?></textarea>
                        </td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

    public function card_mini_game_register_settings() {
        register_setting('card_mini_game_settings', 'openai_api_key', array($this, 'card_mini_game_sanitize_api_key'));
        register_setting('card_mini_game_settings', 'openai_prompt_template_love', array($this, 'card_mini_game_sanitize_prompt_template'));
        register_setting('card_mini_game_settings', 'openai_prompt_template_money', array($this, 'card_mini_game_sanitize_prompt_template'));
        register_setting('card_mini_game_settings', 'openai_prompt_template_general', array($this, 'card_mini_game_sanitize_prompt_template'));
    }

    public function card_mini_game_sanitize_prompt_template($input) {
        return sanitize_textarea_field($input);
    }

    public function card_mini_game_sanitize_api_key($input) {
        return sanitize_text_field($input);
    }

    public function error_log_menu() {
        add_options_page(
            'Error Log',
            'Error Log',
            'manage_options',
            'error-log',
            array($this, 'error_log_page')
        );
    }

    public function error_log_page() {
        $log_path = ini_get('error_log');
        echo '<div class="wrap">';
        echo '<h1>Error Log</h1>';
        echo '<p>The error logs are stored at: ' . $log_path . '</p>';
        echo '</div>';
    }
	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/card-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/card-admin.js', array( 'jquery' ), $this->version, false );

	}

}
