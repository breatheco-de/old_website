<?php

namespace BreatheCode;

use \WPAS\Controller\WPASController;
use \BreatheCode\Utils\BreatheCodeAPI;

class GeeksAcademyOnline {

	private $prependversion = 0.07;

	function __construct() {
		
		if(!defined('ASSETS_URL')) WPASAdminNotifier::addTransientMessage(WPASAdminNotifier::ERROR,'You need to define the ASSETS_URL inside of wp-config.php');
		if(WP_DEBUG) 
		{
			//error_reporting(E_ALL & ~E_NOTICE);
			error_reporting(E_ERROR | E_WARNING | E_PARSE);
			$this->prependversion = time();
		}
		
		//setup the child-theme
		add_action( 'after_setup_theme', [$this,'thedocs_child_theme_setup'] );
		//allowed mime types
		add_filter('upload_mimes', array($this,'custom_upload_mimes'));

		add_filter( 'wp_nav_menu_items', array($this,'wti_loginout_menu_link'), 10, 2 );
		add_action('wp_head', [$this,'include_head_scripts']);

		add_filter( 'cpt_post_types', [$this,'custom_post_type_templates'] );
		
		//Add styles and javascript's
		add_action( 'wp_enqueue_scripts', [$this,'add_styles'] );
		add_action( 'wp_enqueue_scripts', [$this,'add_scripts'] );
		
	}
	
	function init_theme(){
		$this->addAPISupport(['lesson']);
	}
	
	/**
	 * Setup thedocs Child Theme's textdomain.
	 *
	 * Declare textdomain for this child theme.
	 * Translations can be filed in the /languages/ directory.
	 */
	function thedocs_child_theme_setup() {
		load_child_theme_textdomain( 'thedocs-child', get_stylesheet_directory() . '/languages' );
	
	    register_nav_menus( array(
	        'assets-menu' => 'Menu for browsing all the lesson assets'
	    ) );
	
	    //add formats suppor to the theme.
	    add_theme_support( 'post-formats', array( 'link', 'video', 'image' ) );
	    // add post-formats to post_type 'lesson-assets'
	    add_post_type_support( 'lesson-asset', 'post-formats' ); 
	    
        if (!current_user_can('administrator') && !is_admin()) {
	        show_admin_bar(false);
	    }
	}
    
	/*
	 ESTILOS Y SCRIPTS
	*/
	function add_styles(){
	 
	    wp_enqueue_style( 'style-skin', get_template_directory_uri().'/assets/css/skin-blue.css', array('theDocs.all.min.css'), $this->prependversion);
	    
	    //if(is_page('mytalents')) wp_enqueue_style( 'mytalents', get_stylesheet_directory_uri().'/public/css/pages/mytalents.css', array(),$this->prependversion);
	    
	}

	function add_scripts(){
	    
	    //wp_register_script( 'bootstrap', get_stylesheet_directory_uri().'/public/bootstrap.min.js' ,[], $this->prependversion, true );
	    //wp_enqueue_script( 'bootstrap' );
	    
	    wp_register_script( 'vendor', get_stylesheet_directory_uri().'/public/vendor.js' ,[], $this->prependversion, true );
	    wp_enqueue_script( 'vendor' );
	    
	    wp_register_script( 'appjs', get_stylesheet_directory_uri().'/public/app.js' , ['vendor'], $this->prependversion );
	    wp_enqueue_script( 'appjs' );
	    
	}

	/**
	 * Hooks the WP cpt_post_types filter 
	 *
	 * @param array $post_types An array of post type names that the templates be used by
	 * @return array The array of post type names that the templates be used by
	 **/
	function custom_post_type_templates( $post_types ) {
	    $post_types[] = 'lesson';
	    $post_types[] = 'lesson-asset';
	    $post_types[] = 'lesson-project';
	    return $post_types;
	}
    
	function include_head_scripts(){
	    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
	}

	//aditional mime-types allowed
	function custom_upload_mimes ( $existing_mimes=array() ) {
	    // add your extension to the mimes array as below
	    $existing_mimes['zip'] = 'application/zip';
	    $existing_mimes['gz'] = 'application/x-gzip';
	    return $existing_mimes;
	}
	
	function wti_loginout_menu_link( $items, $args ) {
	   if ($args->theme_location == 'primary') {
	      if (is_user_logged_in()) {
	      	 if(!strpos($items,"Log Out")) $items .= '<li class="menu-item drop-normal"><a href="'. wp_logout_url() .'"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>';
	      } else {
	         if(!strpos($items,"Log In")) $items .= '<li class="menu-item drop-normal"><a href="http://student.breatheco.de">'. __("Log In") .'</a></li>';
	      }
	   }
	   return $items;
	}
	
}
