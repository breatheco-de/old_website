<?php
require('AbstractFunctionality.class.php');

/*
 * Event Showcase
 * Creates an 'event' content type to showcase upcoming functions and information
 * Uses hooks and filters inside your theme to output relevant information
 */
 
 class CustomLogin extends AbstractFunctionality{
 	
	//variables
	private $directory = '';
	private $singular_name = 'login';
	private $plural_name = 'logins';
	private $content_type_name = 'academy_login';
	
	//magic function, called on creation
	public function __construct(){
		
		$this->set_directory_value(); //set the directory url on creation
		add_action('init', array($this,'add_content_type')); //add content type
		add_action('init', array($this,'check_flush_rewrite_rules')); //flush re-write rules for permalinks (because of content type)
		add_action('add_meta_boxes', array($this,'add_meta_boxes_for_content_type')); //add meta boxes 
		add_action('wp_enqueue_scripts', array($this,'enqueue_public_scripts_and_styles')); //enqueue public facing elements
		add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts_and_styles')); //enqueues admin elements
		add_action('save_post_' . $this->content_type_name, array($this,'save_custom_content_type')); //handles saving of content type meta info
		add_action('display_content_type_meta', array($this,'display_additional_meta_data')); //displays the saved content type meta info	
	}

	//sets the directory (path) so that we can use this for our enqueuing
	public function set_directory_value(){
		$this->directory = get_stylesheet_directory_uri() . '';
	}

	//check if we need to flush rewrite rules
	public function check_flush_rewrite_rules(){
		$has_been_flushed = get_option($this->content_type_name . '_flush_rewrite_rules');
		//if we haven't flushed re-write rules, flush them (should be triggered only once)
		if($has_been_flushed != true){
			flush_rewrite_rules(true);
			update_option($this->content_type_name . '_flush_rewrite_rules', true);
		}
	}

	//enqueue public scripts and styles
	public function enqueue_public_scripts_and_styles(){	
		//public styles
		wp_enqueue_style(
			$this->content_type_name . '_public_styles', 
			$this->directory . '/css/' . $this->content_type_name . '_public_styles.css'
		);
		//public scripts
		wp_enqueue_script(
			$this->content_type_name . '_public_scripts', 
			$this->directory . '/js/' . $this->content_type_name . '_public_scripts.js', 
			array('jquery')
		); 
	}
 }
 //create new object 
 $login = new CustomLogin();