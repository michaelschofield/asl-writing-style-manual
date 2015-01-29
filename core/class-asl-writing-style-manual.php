<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the dashboard.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    ASL_Writing_Style_Manual
 * @subpackage ASL_Writing_Style_Manual/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, dashboard-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    ASL_Writing_Style_Manual
 * @subpackage ASL_Writing_Style_Manual/includes
 * @author     Your Name <email@example.com>
 */
class ASL_Writing_Style_Manual {

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $asl_writing_style_manual    The string used to uniquely identify this plugin.
	 */
	protected $asl_writing_style_manual; //plugin slug

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the path of this plugin
	 * 
	 * @since 	1.0.0
	 * @access 	protected
	 */
	protected $path;

	/**
	 * Define the URL of this plugin
	 *
	 * @since 	1.0.0
	 * @access 	protected
	 */

	protected $loader;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the Dashboard and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->asl_writing_style_manual = 'asl-writing-style-manual';
		$this->version = '0.0.1';

		$this->load_dependences();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	private function load_dependences() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-asl-writing-style-manual-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-asl-writing-style-manual-public.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'core/class-asl-writing-style-manual-loader.php';
		$this->loader = new ASL_Writing_Style_Manual_Loader();

	}

	private function define_admin_hooks() {

		$admin = new ASL_Writing_Style_Manual_Admin( $this->get_version() );
		$this->loader->add_action( 'init', $admin, 'create_the_reference_post_type' );
		$this->loader->add_action( 'init', $admin, 'create_the_formatting_post_type' );
		$this->loader->add_action( 'init', $admin, 'create_the_usage_post_type' );

	}

	private function define_public_hooks() {
		$public = new ASL_Writing_Style_Manual_Public( $this->get_version() );
		$this->loader->add_filter( 'single_template', $public, 'create_single_reference_view' );
	}

	public function run() {

		$this->loader->run();

	}

	public function get_version() {
		return $this->version;
	}

}
