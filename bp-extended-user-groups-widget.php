<?php
/**
 * Plugin Name: BuddyPress Extended User Groups Widget
 * Plugin URI: https://buddydev.com/plugins/bp-extended-user-groups-widget/
 * Version: 1.0.4
 * Description: Flexible group listing for BuddyPress user groups
 * Author: BuddyDev Team
 * Author URI: https://buddydev.com/
 * License: GPL
 **/

/**
 * Contributor Name: Ravi Sharma, Brajesh Singh
 */

// exit if file accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class BP_Extended_User_Groups_Widget_Helper
 */
class BP_Extended_User_Groups_Widget_Helper {

	/**
	 * Singeton instance.
	 *
	 * @var BP_Extended_User_Groups_Widget_Helper
	 */
	private static $instance;

	/**
	 * Path to the plugin directory.
	 *
	 * @var string
	 */
	private $path;

	/**
	 * Constructor.
	 */
	private function __construct() {

		$this->path = plugin_dir_path( __FILE__ );
		$this->setup();

	}

	/**
	 * Singleton access method.
	 *
	 * @return BP_Extended_User_Groups_Widget_Helper
	 */
	public static function get_instance() {

		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;

	}

	/**
	 * Setup hooks.
	 */
	private function setup() {

		add_action( 'bp_loaded', array( $this, 'load' ) );
		add_action( 'bp_widgets_init', array( $this, 'register_widget' ), 10 );
		add_action( 'bp_init', array( $this, 'load_text_domain' ) );

	}

	/**
	 * Load widget class
	 */
	public function load() {
		require_once $this->path . 'class-bp-extended-user-groups-widget.php';
	}

	/**
	 * Load Localization files.
	 */
	public function load_text_domain() {
		load_plugin_textdomain( 'bp-extended-user-groups-widget', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Register widget.
	 */
	public function register_widget() {

		if ( ! bp_is_active( 'groups' ) ) {
			return;
		}

		register_widget( 'BP_Extended_User_Groups_Widget' );
	}

}

BP_Extended_User_Groups_Widget_Helper::get_instance();
