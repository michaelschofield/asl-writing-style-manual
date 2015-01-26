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
	protected $asl_writing_style_manual;

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
	protected $url;

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
		$this->path = dirname( __FILE__ );
		$this->url 	= WP_PLUGIN_URL . '/';
		$this->version = '0.0.1';

		add_action( 'init', array( $this, 'create_the_example_post_type') );

	}

	/**
	 * Create a custom post type for individual examples
	 *
	 * @since 	1.0.0
	 */

	public function create_the_example_post_type() {

		register_post_type( 

			'examples', array(

			'labels' => 
				array(
					'name' => __('Examples' ), 
					'singular_name' => __('Example' ), 
					'all_items' => __('All Examples' ), 
					'add_new' => __('Add New Example' ),
					'add_new_item' => __('Add New Example' ), 
					'edit' => __( 'Edit'  ), 
					'edit_item' => __('Edit Example' ), 
					'new_item' => __('New Example' ), 
					'view_item' => __('View Example' ), 
					'search_items' => __('Search Examples' ),
					'not_found' =>  __('Nothing found.' ), 
					'not_found_in_trash' => __('Nothing found in the trash' ), 
					'parent_item_colon' => ''
				),

			'description' => __( 'Usage examples' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 1, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => $this->url . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'has_archive' => 'examples', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'thumbnail', 'revisions', 'sticky', 'excerpt')
		 	) /* end of options */
		); /* end of register post type */
	}

}
