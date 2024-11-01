<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wonkasoft.com
 * @since      1.0.0
 *
 * @package    Wonka_Slide
 * @subpackage Wonka_Slide/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wonka_Slide
 * @subpackage Wonka_Slide/admin
 * @author     Wonkasoft <support@wonkasoft.com>
 */
class Wonka_Slide_Admin {

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
		 * defined in Wonka_Slide_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wonka_Slide_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wonka-slide-admin.css', array(), $this->version, 'all' );

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
		 * defined in Wonka_Slide_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wonka_Slide_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wonka-slide-admin.js', array( 'jquery' ), $this->version, false );

	}

	// Active the Admin / Settings page
	public function wonka_slide_display_admin_page() {

		/**
		 * This will check for Wonkasoft Tools Menu, if not found it will make it.
		 */
		if ( empty ( $GLOBALS['admin_page_hooks']['wonkasoft_menu'] ) ) {
			
			global $wonka_slide_page;
			$wonka_slide_page = 'wonkasoft_menu';
			add_menu_page(
				'Wonkasoft',
				'Wonkasoft Tools',
				'manage_options',
				'wonkasoft_menu',
				array( $this,'wonka_slide_show_settings_page' ),
				plugins_url( "/img/wonka-logo-2.svg", __FILE__ ),
				100
			);

			add_submenu_page(
				'wonkasoft_menu',
				'Wonka Slide',
				'Wonka Slide',
				'manage_options',
				'wonkasoft_menu',
				array( $this,'wonka_slide_show_settings_page' )
			);

		} else {

			/**
			 * This creates option page in the settings tab of admin menu
			 */
			global $wonka_slide_page;
			$wonka_slide_page = 'wonka_slide_settings_page';
			add_submenu_page(
				'wonkasoft_menu',
				'Wonka Slide',
				'Wonka Slide',
				'manage_options',
				'wonka_slide_settings_page',
				array( $this,'wonka_slide_show_settings_page' )
			);

		}
	}

	// To display the setting page for Wonka Slide
	public function wonka_slide_show_settings_page() {
		include plugin_dir_path( __FILE__ ) . 'partials/wonka-slide-admin-display.php';
	}

	// Create the action links on the plugins page
	public function wonka_slide_add_action_links() {
		include plugin_dir_path( __FILE__ ) . 'partials/wonka-slide-add-action-links.php';
	}
}