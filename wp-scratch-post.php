<?php
/*
Plugin Name: WP Scratch Post
Plugin Author: crazyjaco (Bradley Jacobs)
Plugin Inspriation: John Patz
Plugin Name: StevenKWord
*/

class WP_Scratch_Post {
	private static $instance = false;
	private $protocol        = 'http://';
	private $url_base        = 'thecatapi.com';
	private $api             = '/api';
	private $image_endpoint  = '/images';
	private $cat_endpoint    = '/category';
	private $types           = array( 'src', 'html', 'xml' );
 
	public static function instance() {
		if ( ! self::$instance ) {
			self::$instance = new WP_Scratch_Post;			
		}
		return self::$instance;
	}
 
	function __construct() {
 		add_filter( 'the_content', array( $this, 'replace_content_with_cats' ) );
	}
 
	function replace_content_with_cats( $content ) {
		$url = $this->build_restful_url( '/get', $this->image_endpoint );
		if ( ! $url ) {
			return $content;
		}
		return '<img src="' . $url . '">';
	}

	function build_restful_url( $action, $endpoint, $format = 'src', $type = 'gif' ) {
 		$url = $this->protocol . $this->url_base . $this->api . $endpoint . $action . '?format=' . $format . '&type=' . $type;
 		return $url;
 	}


}
 
WP_Scratch_Post::instance();