<?php

class WPLanguages{
	function __construct() {

		if (function_exists( 'pll_register_string' ) )
		{
			$languageURL = '/../assets/languages/en.json';
			$languageJson = file_get_contents(dirname(__FILE__).$languageURL);
	
			if(!$languageJson) throw new Exception("Unable to load language json from ".$languageURL, 1);
			
			$languageArray = json_decode($languageJson);
			foreach ($languageArray as $key => $value) {
				pll_register_string($key, $value);
			}
		}
	}
}