<?php

namespace BreatheCode;

use \BreatheCode\WPTypes\PostType\WPCourse;
use \WPAS\Settings\WPASThemeSettingsBuilder;
use WPAS\Messaging\WPASAdminNotifier;

class BCThemeOptions {
	
	private $wpts;
	const THEME_OPTIONS_KEY = "bc_theme_options_";
	const PREWORK_FULLSTACK_OPTION = 'fullstack_prework_course'; 
	const PREMIUM_FULLSTACK_OPTION = 'fullstack_premium_course';
	const BREATHECODE_OPTION = 'breathecode_course';
	
	function __construct() {
		
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
				],
				[
				    'type' => 'select', 
				    'label' => 'Breathe Code Teacher Course (EN)',
				    'name' => self::BREATHECODE_OPTION ,
					'description' => 'The main course for the BreatheCode Teachers traning',
					'options' => []
				]
			];
		
		$apiFields = [
				[
				    'type' => 'text', 
				    'label' => 'API Token',
				    'name' => 'breathecode-api-token',
					'description' => 'Oauth token for BreatheCode API'
				],
				[
				    'type' => 'button', 
				    'label' => 'Sync Locations with API',
				    'id' => 'sync-bc-locations-api',
				    'name' => 'sync-bc-locations-api',
					'description' => function(){
					    
					    $locations = WPASThemeSettingsBuilder::getThemeOption('sync-bc-locations-api');
					    if(empty($locations)) echo 'No locations sync';
					    else $this->printTableFromArray($locations,function($loca){
					        return $loca['name'].' ('.$loca['slug'].')';
					    });
					}
				]
			];
			
		
		
		/*
		* WPTS
		*/
		$this->wpts = new WPASThemeSettingsBuilder(
			array(
				'general' => array(
					'description' => 'BreatheCode Theme Options',
					'menu_slug' => 'bc_theme_options',
					'menu_title' => 'BC Theme Settings'
				),
				'settingsID' => 'wp_theme_settings',
				'settingFields' => array('wp_theme_settings_title'), 
				'tabs' => array(
					'courses' => array('text' => 'Courses', 'dashicon' => 'dashicons-admin-page', 'tabFields' => $coursesFields),
					'replit' => array('text' => 'Replit\'s', 'dashicon' => 'dashicons-hammer', 'tabFields' => $this->getReplitCoursesOptions()),
					'api' => array('text' => 'API', 'dashicon' => 'dashicons-admin-page', 'tabFields' => $apiFields),
					'buttons' => array('text' => 'Buttons')
				),
			)
		);
		
		add_filter('wpts_tab_courses_before',array($this,'render_courses'));
		//add_filter('wpts_tab_replit_before',array($this,'render_replit'));
		add_action('wpts_tab_replit_table_after',array($this,'insert_another'));
		add_filter('wpas_settings_button_action',array($this,'settings_hook_pressed'),1);
	}
	
	function settings_hook_pressed($inputId){
	    
	    switch($inputId)
	    {
            case 'sync-bc-locations-api': $this->syncLocations($inputId); break;
            //case 'sync-bc-profiles-api': $this->syncProfiles($inputId); break;
	    }
	}
	
	private function syncLocations($inputId){
	    $locationsJSON = file_get_contents(BREATHECODE_API_HOST.'/locations/');
        if($locationsJSON)
        {
            $locations = json_decode($locationsJSON);
            //print_r($locations); die();
        	$result = [];
            if($locations && $locations->code==200){
            	foreach($locations->data as $loc) $result[] = (array) $loc;
            	WPASThemeSettingsBuilder::setThemeOption($inputId,$result);
            }
            else
            {
            	throw new Exception('Error requesting locations');
            }
            
        }
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
						],
						[
							'name' => self::BREATHECODE_OPTION,
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
		$optionArray = self::getThemeOptions('replit-courses');
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
	
	public static function getThemeOptions($optKey){
		
		$rawValue = get_option( self::THEME_OPTIONS_KEY.$optKey );
		
		return $rawValue;
	}
	
	function setThemeOption($optKey, $optValue){
		
		$currentOptionValue = get_option( self::THEME_OPTIONS_KEY );
		if($currentOptionValue and (is_array($currentOptionValue) or is_object($currentOptionValue)))
		{
			$currentOptionValue[$optKey] = $optValue;
			return update_option(self::THEME_OPTIONS_KEY, $currentOptionValue);
		}
	}
	
	private function printTableFromArray($rows, $renderRow){
	    
        echo "<table style='background: white; padding: 5px;'>" ;               
        foreach ($rows as $value){
            echo "<tr>";
                echo "<td style='padding: 0;'>".$renderRow($value)."</td>";
            echo "</tr>";
        }
        echo "</table>";
	}
	
}