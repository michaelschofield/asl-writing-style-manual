<?php 

class ASL_Writing_Style_Manual_Public {

	protected $version;

	public function __construct( $version ) {
		$this->version = $version;
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