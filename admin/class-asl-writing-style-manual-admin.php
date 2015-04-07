<?php 

class ASL_Writing_Style_Manual_Admin {

	private $version;

	public function __construct( $version ) {
		$this->version = $version;


		add_shortcode( 'apa_example', array( &$this, 'embed_reference_example_shortcode') );
		add_shortcode( 'example', array( &$this, 'create_example_shortcode' ) );
	}

	public function create_example_shortcode( $atts, $the_example = null ) {
		$a = shortcode_atts( array(
			'indent' => 'false'
		), $atts );

		return "<figure class='citation__example" . ( $a['indent'] == 'true' ? '' : '--alt' ) . "'><p>$the_example</p></figure>";
	}

	public function embed_reference_example_shortcode( $atts )  {
		ob_start();

		$a = shortcode_atts(array(
			'id' => ''
		), $atts );

		$the_query = new WP_Query( array(
			'post_type' => 'reference',
			'p' => $a['id']
		) );

		if ( $the_query->have_posts()) : while ( $the_query->have_posts()) :  $the_query->the_post();
				    
	    $categories 		= get_the_category();
	    $references 		= get_field( 'reference-list_examples' );
	    $citations 			= get_field( 'in-text_examples' );
	    $fischler			= get_post_meta( get_the_ID(), 'fischler_rule', true );
	    $notes 				= get_field( 'asl_note' );
	    $primary_example	= ( $references ? $references[0]['reference_example'] : null ); ?>
		
		<div class="card--alt col--centered clearfix">

			<header>
				<h1 class="gamma" itemprop="headline"><?php the_title(); ?></h1>
				
				<?php  echo ( has_excerpt() ? '<p>' . get_the_excerpt() . '</p>' : '' ); ?>
			</header>


			<?php if ( $primary_example ) : ?>
			<figure class="citation__example">
				<?php echo strip_tags( $primary_example, '<b><i><em><strong><b><i><em><strong><br><p>' ); ?>							
			</figure>
			<?php endif; ?>

			<section class="accordion">

				<?php if ( $notes ) : ?>
				<section class="accordion__section" id="<?php echo get_the_ID() ?>-notes">
					<a href="#<?php echo get_the_ID() ?>-notes">
						<h2 class="accordion__section__title">Notes</h2>
					</a>

					<div class="accordion__section__content">
						<?php echo strip_tags( $notes, '<b><i><em><strong><b><i><em><strong><br><p>' ); ?>
					</div>

				</section>
				<?php endif; ?>

		    	<?php if ( $references ) : ?>
				<section class="accordion__section" id="<?php echo get_the_ID() ?>-more-examples">
					<a href="#<?php echo get_the_ID() ?>-more-examples">
						<h2 class="accordion__section__title">More Examples</h2>
					</a>

					<div class="accordion__section__content">

				    	<?php foreach( $references as $reference ) : ?>
				    	<figure class="citation__example">
				    		<?php echo strip_tags( $reference['reference_example'], '<b><i><em><strong><br><p>' ); ?>
				    	</figure>
				    	<?php endforeach; ?>

			    	</div>

				</section>
				<?php endif; ?>

				<?php if ( $fischler ) : ?>
				<section class="accordion__section" id="<?php echo get_the_ID() ?>-fischler-rules">
					<a href="#<?php echo get_the_ID() ?>-fischler-rules">
						<h2 class="accordion__section__title">Fischler Rules</h2>
					</a>

					<div class="accordion__section__content">
						<?php echo '<p>' . $fischler . '</p>'; ?>
					</div>

				</section>
				<?php endif; ?>
			</section>

		</div><!--/.card-->

		<?php


		endwhile;
		endif;

		wp_reset_query();

		return ob_get_clean();
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
			'taxonomies' => array( 'category', 'post_tag' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => -1, /* this is what order you want it to appear in on the left hand side menu */ 
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
			'taxonomies' => array( 'category', 'post_tag' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => -1, /* this is what order you want it to appear in on the left hand side menu */ 
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
			'taxonomies' => array( 'category', 'post_tag' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => -1, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => plugin_dir_path( dirname( __FILE__ ) ) . 'library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'has_archive' => 'usage', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'revisions', 'excerpt')
		 	) /* end of options */
		); /* end of register post type */
	}

	public function register_post_type_custom_fields() {

		if(function_exists("register_field_group"))
		{
			register_field_group(array (
				'id' => 'acf_fischler-rules',
				'title' => 'Fischler Rules',
				'fields' => array (
					array (
						'key' => 'field_54c944e99339d',
						'label' => 'Fischler Rule',
						'name' => 'fischler_rule',
						'type' => 'wysiwyg',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'no',
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'reference',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'usage',
							'order_no' => 0,
							'group_no' => 1,
						),
					),
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'formatting',
							'order_no' => 0,
							'group_no' => 2,
						),
					),
				),
				'options' => array (
					'position' => 'normal',
					'layout' => 'no_box',
					'hide_on_screen' => array (
					),
				),
				'menu_order' => 0,
			));
			register_field_group(array (
				'id' => 'acf_notes',
				'title' => 'Notes',
				'fields' => array (
					array (
						'key' => 'field_54c94454feeb2',
						'label' => 'Note',
						'name' => 'asl_note',
						'type' => 'wysiwyg',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'no',
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'reference',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'usage',
							'order_no' => 0,
							'group_no' => 1,
						),
					),
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'formatting',
							'order_no' => 0,
							'group_no' => 2,
						),
					),
				),
				'options' => array (
					'position' => 'normal',
					'layout' => 'default',
					'hide_on_screen' => array (
					),
				),
				'menu_order' => 0,
			));
			register_field_group(array (
				'id' => 'acf_reference-and-in-text-citations',
				'title' => 'Reference and In-Text Citations',
				'fields' => array (
					array (
						'key' => 'field_54c9209cb9ab4',
						'label' => 'Reference List',
						'name' => 'reference-list_examples',
						'type' => 'repeater',
						'sub_fields' => array (
							array (
								'key' => 'field_54c920c7b9ab5',
								'label' => 'Examples',
								'name' => 'reference_example',
								'type' => 'wysiwyg',
								'column_width' => 100,
								'default_value' => '',
								'toolbar' => 'full',
								'media_upload' => 'no',
							),
						),
						'row_min' => '',
						'row_limit' => '',
						'layout' => 'table',
						'button_label' => 'Add Reference',
					),
					array (
						'key' => 'field_54c93da929fb4',
						'label' => 'In-Text Citations',
						'name' => 'in-text_examples',
						'type' => 'repeater',
						'sub_fields' => array (
							array (
								'key' => 'field_54c9400529fb5',
								'label' => 'Examples',
								'name' => 'in-text_example',
								'type' => 'wysiwyg',
								'column_width' => '',
								'default_value' => '',
								'toolbar' => 'basic',
								'media_upload' => 'no',
							),
						),
						'row_min' => '',
						'row_limit' => '',
						'layout' => 'row',
						'button_label' => 'Add Citation',
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'reference',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
				),
				'options' => array (
					'position' => 'acf_after_title',
					'layout' => 'default',
					'hide_on_screen' => array (
						0 => 'featured_image',
					),
				),
				'menu_order' => 1,
			));
		}
	}
}