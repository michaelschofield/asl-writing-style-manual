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

}

?>