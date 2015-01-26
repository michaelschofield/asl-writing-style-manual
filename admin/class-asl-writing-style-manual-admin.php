<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    ASL_Writing_Style_Manual
 * @subpackage ASL_Writing_Style_Manual/admin
 */

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    ASL_Writing_Style_Manual
 * @subpackage ASL_Writing_Style_Manual/admin
 * @author     Your Name <email@example.com>
 */
class ASL_Writing_Style_Manual_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $asl_writing_style_manual    The ID of this plugin.
	 */
	private $asl_writing_style_manual;

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
	 * @var      string    $asl_writing_style_manual       The name of this plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $asl_writing_style_manual, $version ) {

		$this->asl_writing_style_manual = $asl_writing_style_manual;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the Dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in ASL_Writing_Style_Manual_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The ASL_Writing_Style_Manual_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->asl_writing_style_manual, plugin_dir_url( __FILE__ ) . 'css/asl-writing-style-manual-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in ASL_Writing_Style_Manual_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The ASL_Writing_Style_Manual_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->asl_writing_style_manual, plugin_dir_url( __FILE__ ) . 'js/asl-writing-style-manual-admin.js', array( 'jquery' ), $this->version, false );

	}

}
