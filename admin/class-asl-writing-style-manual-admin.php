<?php 

class ASL_Writing_Style_Manual_Admin {

	private $version;

	public function __construct( $version ) {
		$this->version = $version;
	}

	public function create_the_reference_post_type() {

		register_post_type( 

			'reference', array(

			'labels' => 
				array(
					'name' => __('References' ), 
					'singular_name' => __('Reference' ), 
					'all_items' => __('All References' ), 
					'add_new' => __('Add New Reference' ),
					'add_new_item' => __('Add New Reference' ), 
					'edit' => __( 'Edit'  ), 
					'edit_item' => __('Edit Reference' ), 
					'new_item' => __('New Reference' ), 
					'view_item' => __('View Reference' ), 
					'search_items' => __('Search References' ),
					'not_found' =>  __('Nothing found.' ), 
					'not_found_in_trash' => __('Nothing found in the trash' ), 
					'parent_item_colon' => ''
				),

			'description' => __( '' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 1, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => plugin_dir_path( dirname( __FILE__ ) ) . 'library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'has_archive' => 'reference', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'revisions', 'excerpt')
		 	) /* end of options */
		); /* end of register post type */
	}

	public function create_the_formatting_post_type() {

		register_post_type( 

			'formatting', array(

			'labels' => 
				array(
					'name' => __('Formatting Rules' ), 
					'singular_name' => __('Rule' ), 
					'all_items' => __('All Rules' ), 
					'add_new' => __('Add New Rule' ),
					'add_new_item' => __('Add New Rule' ), 
					'edit' => __( 'Edit'  ), 
					'edit_item' => __('Edit Rule' ), 
					'new_item' => __('New Rule' ), 
					'view_item' => __('View Rule' ), 
					'search_items' => __('Search Formatting Rules' ),
					'not_found' =>  __('Nothing found.' ), 
					'not_found_in_trash' => __('Nothing found in the trash' ), 
					'parent_item_colon' => ''
				),

			'description' => __( '' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 1, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => plugin_dir_path( dirname( __FILE__ ) ) . 'library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'has_archive' => 'formatting', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'revisions', 'excerpt')
		 	) /* end of options */
		); /* end of register post type */
	}

	public function create_the_usage_post_type() {

		register_post_type( 

			'usage', array(

			'labels' => 
				array(
					'name' => __('Usage and Grammar' ), 
					'singular_name' => __('Usage' ), 
					'all_items' => __('All Examples' ), 
					'add_new' => __('Add New Example' ),
					'add_new_item' => __('Add New Example' ), 
					'edit' => __( 'Edit'  ), 
					'edit_item' => __('Edit Example' ), 
					'new_item' => __('New Example' ), 
					'view_item' => __('View Example' ), 
					'search_items' => __('Search Usage Examples' ),
					'not_found' =>  __('Nothing found.' ), 
					'not_found_in_trash' => __('Nothing found in the trash' ), 
					'parent_item_colon' => ''
				),

			'description' => __( '' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 2, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => plugin_dir_path( dirname( __FILE__ ) ) . 'library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'has_archive' => 'usage', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'revisions', 'excerpt')
		 	) /* end of options */
		); /* end of register post type */
	}
}