<?php


use WPTypes\WPCourse as WPCourse;
use Utils\wp_theme_settings as wp_theme_settings;

class BCThemeOptions {
	
	private $wpts;
	const THEME_OPTIONS_KEY = "bc_theme_options_";
	const PREWORK_FULLSTACK_OPTION = 'fullstack_prework_course'; 
	const PREMIUM_FULLSTACK_OPTION = 'fullstack_premium_course';
	
	function __construct() {
		
		add_action('admin_enqueue_scripts', array($this,'wp_theme_settings_add_stylesheet'));
		
		$coursesFields = [
				[
				    'type' => 'select', 
				    'label' => 'Full Stack Prework Course',
				    'name' => self::PREWORK_FULLSTACK_OPTION,
					'description' => 'Select the prework that is used for fullstack?',
					'options' => []
				],
				[
				    'type' => 'select', 
				    'label' => 'Full Stack Premium Course',
				    'name' => self::PREMIUM_FULLSTACK_OPTION ,
					'description' => 'What is the parent course for the rest of whole fullstack?',
					'options' => []
				],
				[
				    'type' => 'select', 
				    'label' => 'Full Stack Prework Course (ESP)',
				    'name' => self::PREWORK_FULLSTACK_OPTION.'-es',
					'description' => 'The spanish version of the prework fullstack',
					'options' => []
				],
				[
				    'type' => 'select', 
				    'label' => 'Full Stack Premium Course (ESP)',
				    'name' => self::PREMIUM_FULLSTACK_OPTION.'-es' ,
					'description' => 'The spanish version of the fullstack',
					'options' => []
				]
			];
			
		
		
		/*
		* WPTS
		*/
		$this->wpts = new wp_theme_settings(
			array(
				'general' => array('description' => 'A custom WordPress class for creating theme settings page'),
				'settingsID' => 'wp_theme_settings',
				'settingFields' => array('wp_theme_settings_title'), 
				'tabs' => array(
					'courses' => array('text' => 'Courses', 'dashicon' => 'dashicons-admin-page', 'tabFields' => $coursesFields),
					'replit' => array('text' => 'Replit\'s', 'dashicon' => 'dashicons-hammer', 'tabFields' => $this->getReplitCoursesOptions()),
					'buttons' => array('text' => 'Buttons')
				),
			)
		);
		
		add_filter('wpts_tab_courses_before',array($this,'render_courses'));
		//add_filter('wpts_tab_replit_before',array($this,'render_replit'));
		add_action('wpts_tab_replit_table_after',array($this,'insert_another'));
	}
	
	function wp_theme_settings_add_stylesheet()
	{
	  wp_enqueue_style('wp_theme_settings', get_stylesheet_directory_uri().'/assets/css/wp_theme_settings.css');
	  wp_register_script('wp_theme_settings',get_stylesheet_directory_uri() . '/assets/js/wp_theme_settings.js', array('jquery'));
	  wp_enqueue_script('wp_theme_settings');
	}
	
	function render_courses($tab){
		
		$courses = get_terms(array(
				'taxonomy' => WPCourse::TAX_SLUG,
		        'hide_empty'=>false
			));
		$auxCourses = array();
		foreach($courses as $c) $auxCourses[$c->term_id] = ($c->parent) ? '- '.$c->name : $c->name;
		
		$fields =	[
						[
							'name' => self::PREWORK_FULLSTACK_OPTION,
							'options' => $auxCourses
						],
						[
							'name' => self::PREMIUM_FULLSTACK_OPTION,
							'options' => $auxCourses
						],
						[
							'name' => self::PREWORK_FULLSTACK_OPTION.'-es',
							'options' => $auxCourses
						],
						[
							'name' => self::PREMIUM_FULLSTACK_OPTION.'-es',
							'options' => $auxCourses
						]
					];
		
		$cont = 0;
		foreach($fields as $field)
		{
			if($tab['tabFields'][$cont]['name']==$field['name'])
				foreach($field as $key => $value){
					$tab['tabFields'][$cont][$key] = $value;
				}
				
			$cont++;
		}
		
		return $tab;
	}
	
	function getReplitCoursesOptions(){
		$replitCourses = array();
		$optionArray = $this->getThemeOptions('replit-courses');
		if(is_array($optionArray))
		{
			foreach($optionArray as $key => $value)
			{
				array_push($replitCourses,[
					    'type' => 'text_array', 
					    'label' => $key,
					    'name' => self::THEME_OPTIONS_KEY.'replit-courses',
						'description' => 'Input the URL for the class about '.$key,
					]);
			}
		}

		array_push($replitCourses,[
			    'type' => 'array', 
			    'label' => 'Add another replit class',
			    'target' => self::THEME_OPTIONS_KEY.'replit-courses'
			]);
		
		return $replitCourses;
		
	}
	
	function insert_another(){

	}
	
	function getThemeOptions($optKey)
	{
		$rawValue = get_option( self::THEME_OPTIONS_KEY.$optKey );
		
		return $rawValue;
	}
	
	function setThemeOption($optKey, $optValue)
	{
		$currentOptionValue = get_option( self::THEME_OPTIONS_KEY );
		if($currentOptionValue and (is_array($currentOptionValue) or is_object($currentOptionValue)))
		{
			$currentOptionValue[$optKey] = $optValue;
			return update_option(self::THEME_OPTIONS_KEY, $currentOptionValue);
		}
	}
	
}