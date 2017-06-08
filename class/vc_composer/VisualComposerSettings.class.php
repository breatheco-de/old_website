<?php

require("component.autoload.php");

include(dirname(__FILE__)."/../BCThemeOptions.class.php");

class VisualComposerSettings {

	private $excerciseClasses = array(
		"html" => 'html',
		"css" => 'css',
		"layouts" => 'layouts',
		"forms" => 'forms',
		"arrays" => 'arrays',
		"events" => 'events',
		"scaffolding" => 'scaffolding',
		"bootstrap" => 'bootstrap',
		"the-dom" => 'the-dom',
		"jquery-dom" => 'jquery-dom',
		"from-js-to-php" => 'from-js-to-php',
		"object-oriented-programing" => 'object-oriented-programing',
		"jquery-ajax" => 'jquery-ajax'
	);

	function __construct() {
		$codeHighliter = new VCComponent\VCCodeHighlighter();
		$codeREPL = new VCComponent\VCCodeREPL();
		$codePreview = new VCComponent\VCCodePreview();
		$codeClassroom = new VCComponent\VCReplitClassRoom();
		
		$replitTemplateKeys = get_option( BCThemeOptions::THEME_OPTIONS_KEY.'replit-courses' );
		if(!$replitTemplateKeys or !is_array($replitTemplateKeys) or count($replitTemplateKeys)==0) 
			$replitTemplateKeys = $this->excerciseClasses;
		else
		{
			$auxArray = array();
			foreach($replitTemplateKeys as $key => $value) $auxArray[$value] = $key;
			$replitTemplateKeys = $auxArray;
		}
		$codeReplitExercise = new VCComponent\VCReplitExercise($replitTemplateKeys);
		$codeRegexTester = new VCComponent\VCRegexTester();
		$codeSQLTester = new VCComponent\VCMySQLTester();
		$codeQuiz = new VCComponent\VCQuiz();
	}

}

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_coderepl extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_codepreview extends WPBakeryShortCode {}
    class WPBakeryShortCode_codehighliter extends WPBakeryShortCode {}
}
