<?php

namespace BreatheCode;

use BreatheCode\Utils\HelperStringFormat;
use \Exception;

class WPLanguages{
	
	public static $currentLanguage = null;
	
	function __construct() {

		if (function_exists( 'pll_register_string' ) )
		{
			self::$currentLanguage = require(ABSPATH.'wp-content/themes/thedocs-child/src/php/languages/lang.en.php');
			if(!self::$currentLanguage) throw new Exception("Unable to load language json from ".$languageURL, 1);

			$languageArray = self::$currentLanguage['labels'];
			foreach ($languageArray as $key => $value) {
				pll_register_string($key, $value);
			}
		}
	}
	
	public static function getActivityTemplate($key, $args){
		
		if(!self::$currentLanguage) throw new Exception("Could not find the languages file");
		
		$activities = self::$currentLanguage['activities'];
		if(!isset($activities[$key])) throw new Exception("Invalid activity template string key");
		
		return [
			"description" => HelperStringFormat::sprintf($activities[$key]['description'], $args),
			"title" => HelperStringFormat::sprintf($activities[$key]['title'], $args)
		];
	}
}