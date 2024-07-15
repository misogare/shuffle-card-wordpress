<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://mesvak.software
 * @since      1.0.0
 *
 * @package    Card
 * @subpackage Card/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Card
 * @subpackage Card/includes
 * @author     mesvak <mesvakc@gmail.com>
 */
class Card_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		 global $wpdb;
    $table_name = $wpdb->prefix . 'cards';

    $wpdb->query("DROP TABLE IF EXISTS $table_name");

	}

}
