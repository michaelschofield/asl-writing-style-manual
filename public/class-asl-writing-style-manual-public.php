<?php 

class ASL_Writing_Style_Manual_Public {

	protected $version;

	public function __construct( $version ) {
		$this->version = $version;
	}

	public function enqueue_unique_styles() {
		if (!is_admin()) {
		    wp_register_style( 'asl-writing-style-manual-stylesheet', '//sherman.library.nova.edu/cdn/styles/css/public-global/s--apa.css', array( 'pls-stylesheet' ), '1.1', 'all' );
		    wp_enqueue_style( 'asl-writing-style-manual-stylesheet' );
		}
	}

	public function enqueue_unique_scripts() {
		if (!is_admin()) {
		    wp_register_script( 'asl-writing-style-manual-script', plugins_url( 'asl-writing-style-manual/public/scripts/asl-writing-style-manual-scripts.js' ), array( 'pls-js' ), '0.1', true );
		    wp_enqueue_script( 'asl-writing-style-manual-script' );

		    wp_localize_script( 'asl-writing-style-manual-script', 'asl_writing_style_manual_search', array(
		    	'ajax_url' => admin_url( 'admin-ajax.php' )
	    	));
		}
	}

	public function replace_category_archive_template( $category ) {
		
		if ( is_category() ) {
			return plugin_dir_path( dirname( __FILE__ ) ) . 'public/templates/category.php';
		}

		return $category;
	}

	public function replace_tag_archive_template( $tag ) {
		
		if ( is_tag() ) {
			return plugin_dir_path( dirname( __FILE__ ) ) . 'public/templates/tag.php';
		}

		return $tag;
	}

	public function replace_search_results_template( $single ) {
		

		if ( is_search() ) {
			return plugin_dir_path( dirname( __FILE__ ) ) . 'public/templates/search.php';
		}

		return $single;

	}

	public function create_single_reference_view( $single ) {

		global $wp_query, $post;

		if ( $post->post_type == 'reference' ) {
			return plugin_dir_path( dirname( __FILE__ ) ) . 'public/templates/single-reference.php';
		}

		return $single;

	}

	public function create_single_formatting_view( $single ) {
		global $wp_query, $post;

		if ( $post->post_type =='formatting' ) {

			return plugin_dir_path( dirname( __FILE__ ) ) . 'public/templates/single-formatting.php';

		}

		return $single;
	}

	public function create_single_usage_view( $single ) {
		global $wp_query, $post;

		if ( $post->post_type =='usage' ) {

			return plugin_dir_path( dirname( __FILE__ ) ) . 'public/templates/single-usage.php';

		}

		return $single;
	}

	/*public function search_title_only_by_title_and_tag( $search, &$wp_query ) {
		global $wpdb;

		if ( empty( $search ) ) {
			return $search; // skip processing - no search term in query
		}

		$query = $wp_query->query_vars;
		$n = ! empty( $q[ 'exact' ] ) ? '' : '%';

		$search =
		$searchand = '';

	    foreach ( (array) $q['search_terms'] as $term ) {
	        $term = esc_sql( like_escape( $term ) );
	        $search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";
	        $searchand = ' AND ';
	    }

	    if ( ! empty( $search ) ) {
	        $search = " AND ({$search}) ";
	        if ( ! is_user_logged_in() )
	            $search .= " AND ($wpdb->posts.post_password = '') ";
	    }

	    return $search;
	}*/


	public function asl_writing_style_manual_search_fetch_results() {
		
		$query = sanitize_text_field( $_POST[ 'query' ] );

		$args = array(

			'post_type' => array( 'reference', 'formatting', 'usage', 'page' ),
			's' 		=> $query

		);

		$search = new WP_Query( $args );

		$count = 0;
		if ( $search->have_posts() ) : 

		?>
			<div class="hero">
			<header>
				<h1 class="archive-title hide-accessible"> Search Results: "<?php echo esc_attr(get_search_query()); ?>"</h1>
			</header>

			<?php
				while ( $search->have_posts() ) : $search->the_post(); ?>

					    <?php
					    $categories 		= get_the_category();
					    $references 		= get_field( 'reference-list_examples' );
					    $citations 			= get_field( 'in-text_examples' );
					    $fischler			= get_post_meta( get_the_ID(), 'fischler_rule', true );
					    //$notes 				= get_post_meta( get_the_ID(), 'asl_note', true );
					    $notes 				= get_field( 'asl_note' );
					    $primary_example	= ( $references ? $references[0]['reference_example'] : null );
					    $count++;
					    ?>
		
				    <article id="post-<?php the_ID(); ?>" <?php post_class('card--alt col--centered col-md--tencol'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
				
						<header data-type="Example">
							<a href="<?php echo get_the_permalink(); ?>">
							<h2 class="gamma" itemprop="headline"><?php the_title(); ?></h1>
							</a>
							
							<?php  echo ( has_excerpt() ? '<p>' . get_the_excerpt() . '</p>' : '' ); ?>
						</header>


						<?php if ( $primary_example ) : ?>
						<figure class="citation__example">
							<?php echo strip_tags( $primary_example, '<b><i><em><strong><b><i><em><strong><br><p>' ); ?>							
						</figure>
						<?php endif; ?>

						<section class="accordion">

							<?php if ( $notes ) : ?>
							<section class="accordion__section" id="<?php echo $count; ?>-notes">
								<a href="#<?php echo $count; ?>-notes">
									<h2 class="accordion__section__title">Notes</h2>
								</a>

								<div class="accordion__section__content">
									<?php echo strip_tags( $notes, '<b><i><em><strong><b><i><em><strong><br><p>' ); ?>
								</div>

							</section>
							<?php endif; ?>

					    	<?php if ( $references ) : ?>
							<section class="accordion__section" id="<?php echo $count; ?>-more-examples">
								<a href="#<?php echo $count; ?>-more-examples">
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
							<section class="accordion__section" id="<?php echo $count; ?>-fischler-modifications">
								<a href="#<?php echo $count; ?>-fischler-modifications">
									<h2 class="accordion__section__title">Fischler Modifications</h2>
								</a>

								<div class="accordion__section__content">
									<?php echo '<p>' . $fischler . '</p>'; ?>
								</div>

							</section>
							<?php endif; ?>
						</section>

				    </article> <!-- end article -->
				    </div>
					
				<?php

				endwhile;
				endif;

				$content = ob_get_clean();
				echo $content;

				// We muse use die() at the end, otherwise admin-ajax.php
				// will execute it's own die(0) code, echoing an additional
				// zero in the response.		
				die();
	}

}
?>